<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\HashtagSearchHistory;
use Illuminate\Support\Facades\Auth;

class HashtagController extends Controller
{
    private $apiHost = 'instagram-scraper-api2.p.rapidapi.com';
    private $apiKey = '084090d571msh6682e6f441dba93p1b02aajsnbf37bc06ffa9';

    public function hashtaganalyze(Request $request)
    {
        // Validate the request to ensure a hashtag is provided
        $request->validate([
            'hashtag' => 'required|string|max:255',
        ]);


        if (Auth::check()) {
            $existingSearch = HashtagSearchHistory::where('user_id', Auth::id())
                ->where('hashtag', $request->hashtag)
                ->first();

            if (!$existingSearch) {
                HashtagSearchHistory::create([
                    'user_id' => Auth::id(),
                    'hashtag' => $request->hashtag,
                ]);
            }
        }


        // Get the hashtag from the request
        $hashtag = $request->input('hashtag');

        $client = new Client();
        $url = "https://{$this->apiHost}/v1/hashtag?hashtag=" . urlencode($hashtag);

        try {
            // Fetch hashtag data from the API
            $response = $client->request('GET', $url, [
                'headers' => [
                    'x-rapidapi-host' => $this->apiHost,
                    'x-rapidapi-key' => $this->apiKey,
                ],
            ]);

            $data = json_decode($response->getBody()->getContents(), true);

            // Check if data is received
            if (isset($data['data']['items'])) {
                $items = $data['data']['items'];
                $hashtags = [];
                $popularPosts = [];

                // Loop through the items and gather hashtags and post data
                foreach ($items as $item) {
                    // Collect hashtags from captions
                    $caption = $item['caption']['text'] ?? '';
                    preg_match_all('/#(\w+)/', $caption, $matches);
                    $hashtagsList = $matches[0];

                    foreach ($hashtagsList as $tag) {
                        $hashtags[$tag] = $hashtags[$tag] ?? 0;
                        $hashtags[$tag]++;
                    }

                    // Collect data for popular posts
                    $popularPosts[] = [
                        'image_url' => $item['media_url'] ?? '',
                        'like_count' => $item['like_count'] ?? 0,
                        'comment_count' => $item['comment_count'] ?? 0,
                        'created_at' => date('d F Y', $item['caption']['created_at'] ?? time()),
                        'caption' => $item['caption']['text'] ?? '',
                        'username' => $item['user']['username'] ?? '',
                        'profile_pic_url' => $item['user']['profile_pic_url'] ?? '',
                        'shortcode' => $item['code'] ?? null,
                    ];
                }

                // Sort popular posts by like count in descending order
                usort($popularPosts, function ($a, $b) {
                    return $b['like_count'] <=> $a['like_count'];
                });

                // Limit to top 3 posts after sorting
                $popularPosts = array_slice($popularPosts, 0, 3);

                // Sort hashtags by count in descending order and get top 20
                arsort($hashtags);
                $topHashtags = array_slice($hashtags, 0, 20, true);
            } else {
                return back()->withErrors(['error' => 'No hashtags found for this query.']);
            }
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to fetch data: ' . $e->getMessage()]);
        }

        // Pass the top hashtags and popular posts to the view
        return view('hashtaganalyze', compact('topHashtags', 'hashtag', 'popularPosts'));
    }
    public function showHashtagHistory()
    {
        $histories = HashtagSearchHistory::where('user_id', Auth::id())
            ->distinct('hashtag') 
            ->get();
        return view('/hashtaghistory', compact('histories'));
    }

}