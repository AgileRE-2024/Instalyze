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

                // Get the top 3 posts based on likes
                usort($allPosts, function ($a, $b) {
                    return $b['like_count'] - $a['like_count'];
                });
                $topPosts = array_slice($allPosts, 0, 6); // Top 3 posts

                // Prepare data for view
                arsort($hashtagCounts);
                $topHashtags = array_slice($hashtagCounts, 0, 10, true);

                arsort($wordCounts);
                $topWords = array_slice($wordCounts, 0, 10, true);

                // Calculate averages and rates
                $avgLikes = $postCount > 0 ? $totalLikes / $postCount : 0;
                $avgComments = $postCount > 0 ? $totalComments / $postCount : 0;

                $totalEngagement = $totalLikes + $totalComments;
                $engagementRate = $followerCount > 0 ? ($totalEngagement / $followerCount) * 100 : 0;

                $avgActivity = ($postsCount > 0 && $followerCount > 0)
                    ? (($totalLikes + $totalComments) / ($postsCount * $followerCount)) * 100
                    : 0;

                // Analyze posts in recent periods
                if (count($timestamps) > 0) {
                    $postsInLast30Days = count($timestamps);
                    $postsPerWeek = $postsInLast30Days > 0 ? ($postsInLast30Days / 4.29) : 0;

                    $postsInPrevious30Days = count($previousTimestamps);
                    $previousPostsPerWeek = $postsInPrevious30Days > 0 ? ($postsInPrevious30Days / 4.29) : 0;

                    $percentageChange = $previousPostsPerWeek > 0
                        ? (($postsPerWeek - $previousPostsPerWeek) / $previousPostsPerWeek)
                        : 0;
                } else {
                    $postsPerWeek = $percentageChange = 0;
                }

                // Calculate post frequency and engagement score
                $postFrequency = $postsCount > 0 ? ($postsCount / $followerCount) * 100 : 0;
                $averageEngagement = ($avgLikes + $avgComments) / 2;
                $accountScore = min(max(floor(($postFrequency + $averageEngagement + $engagementRate) / 30 * 10), 1), 10);

                // Determine account quality
                $predicate = match (true) {
                    $accountScore >= 9 => 'Very Good',
                    $accountScore >= 7 => 'Good',
                    $accountScore >= 5 => 'Moderate',
                    default => 'Poor',
                };

                // Calculate sentiment percentages
                $sentimentTotal = $positiveCount + $negativeCount + ($totalWords - ($positiveCount + $negativeCount));
                $positivePercentage = $sentimentTotal > 0 ? ($positiveCount / $sentimentTotal) * 100 : 0;
                $negativePercentage = $sentimentTotal > 0 ? ($negativeCount / $sentimentTotal) * 100 : 0;
                $neutralPercentage = $sentimentTotal > 0 ? (($totalWords - ($positiveCount + $negativeCount)) / $sentimentTotal) * 100 : 0;

                // Determine the most active posting day
                $maxDay = array_search(max($postsByDay), $postsByDay);
                $dayNames = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
                $mostActiveDay = $dayNames[$maxDay];

                // Prepare data for view rendering
                $viewData = [
                    'username' => $instagramData['username'],
                    'full_name' => $instagramData['full_name'],
                    'bio' => $instagramData['biography'],
                    'category' => $instagramData['category'],
                    'follower_count' => $followerCount,
                    'following_count' => $instagramData['following_count'],
                    'posts_count' => $postsCount,
                    'profile_pic_url' => $profilePicUrl,
                    'bio_links' => $bioLinks,
                    'top_hashtags' => $topHashtags,
                    'top_words' => $topWords,
                    'avg_likes' => number_format($avgLikes, 2),
                    'avg_comments' => number_format($avgComments, 2),
                    'engagement_rate' => number_format($engagementRate, 2),
                    'avg_activity' => number_format($avgActivity, 2),
                    'posts_per_week' => $postsPerWeek,
                    'percentage_change' => number_format($percentageChange, 2),
                    'posts_by_day' => json_encode($postsByDay),
                    'account_score' => $accountScore,
                    'predicate' => $predicate,
                    'publishing_frequency' => number_format($postsPerWeek, 2),
                    'positive_percentage' => number_format($positivePercentage, 2),
                    'negative_percentage' => number_format($negativePercentage, 2),
                    'neutral_percentage' => number_format($neutralPercentage, 2),
                    'most_active_day' => $mostActiveDay,
                    'engagement_by_day' => json_encode($engagementByDay),
                    'top_posts' => $topPosts // Added top posts data
                ];
            } else {
                return back()->withErrors(['error' => 'User data not found.']);
            }
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to fetch data: ' . $e->getMessage()]);
        }

        return view('analyze', ['data' => $viewData]);
    }
}