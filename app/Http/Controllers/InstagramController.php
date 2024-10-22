<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Carbon\Carbon;

class InstagramController extends Controller
{
    private $apiHost = 'instagram-scraper-api2.p.rapidapi.com';
    private $apiKey = '83d66bfb92msh905dafbe8d4ccbap1e9d9djsn943c5dac18cb';

    // Daftar kata yang tidak akan dihitung
    private $stopWords = [
        'dan',
        'atau',
        'itu',
        'yang',
        'adalah',
        'dari',
        'ke',
        'pada',
        'di',
        'untuk',
        'dengan',
        'sebuah',
        'itu',
        'ada',
        'ini',
        'kita',
        'saya',
        'anda',
        'kami',
        'mereka',
        'ber',
        'lah',
        'pun',
        'juga',
        'tetapi',
        'selain',
        'karena',
        'sebab',
        'bisa',
        'mungkin',
        'hanya',
        'tidak',
        'belum',
        'sudah',
        'akan',
        'semua',
        'setiap',
        'tersebut',
        'namun',
        'sama',
        'lebih',
        'sangat',
        'bagus',
        'baik',
    ];

    private $positiveWords = [
        'bagus',
        'hebat',
        'inspirasi',
        'kolaborasi',
        'sukses',
        'meriah',
        'rayakan',
        'menarik',
        'prestasi',
        'pemenang',
        'cerah',
        'positif'
    ];

    private $negativeWords = [
        'buruk',
        'jelek',
        'kekurangan',
        'masalah',
        'kesulitan',
        'gagal',
        'risiko',
        'sedih'
    ];

    public function analyze(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255|regex:/^[a-zA-Z0-9._]+$/',
        ], [
            'username.required' => 'Username harus diisi.',
            'username.string' => 'Username harus berupa teks.',
            'username.max' => 'Username tidak boleh lebih dari 255 karakter.',
            'username.regex' => 'Username hanya boleh mengandung huruf, angka, titik, dan garis bawah.',
        ]);

        $username = $request->input('username');

        $client = new Client();
        $url = "https://{$this->apiHost}/v1/info?username_or_id_or_url={$username}";
        $postsUrl = "https://{$this->apiHost}/v1.2/posts?username_or_id_or_url={$username}";

        try {
            // Fetch user data
            $response = $client->request('GET', $url, [
                'headers' => [
                    'x-rapidapi-host' => $this->apiHost,
                    'x-rapidapi-key' => $this->apiKey,
                ],
            ]);

            $userData = json_decode($response->getBody()->getContents(), true);

            if (isset($userData['data'])) {
                $instagramData = $userData['data'];

                // Extract user data
                $followerCount = $instagramData['follower_count'];
                $postsCount = $instagramData['media_count'];
                $profilePicUrl = $instagramData['profile_pic_url'];
                $bioLinks = $instagramData['bio_links'];

                // Fetch posts data
                $postsResponse = $client->request('GET', $postsUrl, [
                    'headers' => [
                        'x-rapidapi-host' => $this->apiHost,
                        'x-rapidapi-key' => $this->apiKey,
                    ],
                ]);

                $postsData = json_decode($postsResponse->getBody()->getContents(), true);

                // Initialize variables for analysis
                $totalLikes = $totalComments = $postCount = 0;
                $timestamps = $previousTimestamps = [];
                $hashtagCounts = $wordCounts = [];
                $positiveCount = $negativeCount = $totalWords = 0;
                $currentTime = Carbon::now()->timestamp;

                // Initialize arrays for post counts and engagement counts
                $postsByDay = array_fill(0, 7, 0); // Count for each day of the week
                $engagementByDay = array_fill(0, 7, 0); // Count for engagement (likes + comments) by day

                // Initialize array to hold all posts
                $allPosts = []; // New array to hold all post data for later use

                // Analyze posts
                if (isset($postsData['data']['items']) && is_array($postsData['data']['items'])) {
                    // Limit to the latest 100 posts
                    $recentPosts = array_slice($postsData['data']['items'], 0, 100);

                    foreach ($recentPosts as $post) {
                        $totalLikes += $post['like_count'] ?? 0;
                        $totalComments += $post['comment_count'] ?? 0;
                        $postCount++;

                        // Use created_at timestamp for posts
                        $postTime = (int) ($post['caption']['created_at'] ?? 0);

                        // Validate postTime
                        if ($postTime === 0) {
                            continue;
                        }

                        // Count posts by day
                        $dayOfWeek = Carbon::createFromTimestamp($postTime)->dayOfWeek;
                        $postsByDay[$dayOfWeek]++;

                        // Count engagement by day (likes + comments)
                        $engagementByDay[$dayOfWeek] += ($post['like_count'] ?? 0) + ($post['comment_count'] ?? 0);

                        // Count hashtags
                        if (isset($post['caption']['hashtags'])) {
                            foreach ($post['caption']['hashtags'] as $hashtag) {
                                $hashtagCounts[$hashtag] = ($hashtagCounts[$hashtag] ?? 0) + 1;
                            }
                        }

                        // Count word frequency
                        if (isset($post['caption']['text'])) {
                            $captionText = $post['caption']['text'];
                            $words = preg_split('/\s+/', trim($captionText));
                            $totalWords += count($words);

                            foreach ($words as $word) {
                                $word = strtolower(preg_replace('/[^\w]/', '', $word));
                                if (!empty($word) && !in_array($word, $this->stopWords)) {
                                    $wordCounts[$word] = ($wordCounts[$word] ?? 0) + 1;
                                }
                                // Sentiment analysis
                                if (in_array($word, $this->positiveWords)) {
                                    $positiveCount++;
                                } elseif (in_array($word, $this->negativeWords)) {
                                    $negativeCount++;
                                }
                            }
                        }

                        // Posts in the last 30 days
                        if (($currentTime - $postTime) <= 2592000) {
                            $timestamps[] = $postTime;
                        }

                        // Posts between 30-60 days ago
                        if (($currentTime - $postTime) > 2592000 && ($currentTime - $postTime) <= 5184000) {
                            $previousTimestamps[] = $postTime;
                        }

                        // Keep track of the posts for later use
                        $allPosts[] = [
                            'like_count' => $post['like_count'] ?? 0,
                            'comment_count' => $post['comment_count'] ?? 0,
                            'created_at' => $post['caption']['created_at'] ?? 0,
                            'image_url' => $post['image_versions']['items'][0]['url'] ?? null,
                        ];
                    }
                }
            }
        }
    }
}