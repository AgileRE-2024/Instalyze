<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\HeadlineSearchHistory;
use Illuminate\Support\Facades\Auth;

class HeadlineController extends Controller
{
    public function headlineanalyze(Request $request)
    {
        // Validasi input
        $request->validate([
            'headline' => 'required|string|max:255',
        ]);

        if (Auth::check()) {
            $existingSearch = HeadlineSearchHistory::where('user_id', Auth::id())
                ->where('headline', $request->headline)
                ->first();

            if (!$existingSearch) {
                HeadlineSearchHistory::create([
                    'user_id' => Auth::id(),
                    'headline' => $request->headline,
                ]);
            }
        }

        // Mengambil input headline dari user
        $headline = $request->input('headline');

        // Mengirim permintaan ke API GPT untuk mendapatkan saran perbaikan
        $client = new Client();
        $response = $client->post('https://chatgpt-42.p.rapidapi.com/gpt4', [
            'headers' => [
                'Content-Type' => 'application/json',
                'x-rapidapi-host' => 'chatgpt-42.p.rapidapi.com',
                'x-rapidapi-key' => 'fd5546dd29mshaaa62f217104f27p1f671ajsn6a01e268785f',
            ],
            'json' => [
                'messages' => [
                    [
                        'role' => 'user',
                        'content' => "Please analyze the following headline and provide suggestions on what to improve: '{$headline}'. Your suggestions should include things like keyword optimization, specificity, trend relevance, and readability. Jawabannya langsung to the poin 4 poin saja, tanpa huruf bold dan tanpa nomor buat dalam bahasa indonesia tapi kalo inputnya bahasa inggris jawaban untuk suggestions ini ya bahasa inggris"
                    ]
                ],
                'web_access' => false
            ]
        ]);

        // Mendapatkan hasil dari respons API
        $data = json_decode($response->getBody(), true);

        // Akses 'result' untuk mendapatkan saran headline
        $suggestions = $data['result'] ?? 'No suggestions available.';

        // Mengirim permintaan kedua ke API GPT untuk mendapatkan rekomendasi headline
        $responseRecommendations = $client->post('https://chatgpt-42.p.rapidapi.com/gpt4', [
            'headers' => [
                'Content-Type' => 'application/json',
                'x-rapidapi-host' => 'chatgpt-42.p.rapidapi.com',
                'x-rapidapi-key' => 'fd5546dd29mshaaa62f217104f27p1f671ajsn6a01e268785f',  // Ganti dengan key Anda
            ],
            'json' => [
                'messages' => [
                    [
                        'role' => 'user',
                        'content' => "Please analyze the following headline: '{$headline}'. Based on the analysis, provide 4 headline recommendations that are catchy and relevant. Your suggestions should focus on keyword optimization, trend relevance, and readability. Jawabannya langsung to the poin 4 poin saja, tanpa huruf bold dan tanpa nomor buat dalam bahasa indonesia tapi kalo inputnya bahasa inggris rekomendasinya ya bahasa inggris"
                    ]
                ],
                'web_access' => false
            ]
        ]);

        // Mendapatkan hasil dari respons API untuk rekomendasi headline
        $dataRecommendations = json_decode($responseRecommendations->getBody(), true);
        $recommendations = $dataRecommendations['result'] ?? 'No recommendations available.';



        // Simulasi analisis headline
        $wordCount = str_word_count($headline);
        $charCount = strlen($headline);

        $wordResponse = $client->post('https://chatgpt-42.p.rapidapi.com/gpt4', [
            'headers' => [
                'Content-Type' => 'application/json',
                'x-rapidapi-host' => 'chatgpt-42.p.rapidapi.com',
                'x-rapidapi-key' => 'fd5546dd29mshaaa62f217104f27p1f671ajsn6a01e268785f', // Ganti dengan API key Anda
            ],
            'json' => [
                'messages' => [
                    [
                        'role' => 'user',
                        'content' => "Berikan analisi berdasarkan jumlah kata '{$wordCount}' nah itu jumlah katanya kalo di headline gimana optimal atau ngga, buat dalam 1 paragraf analisisnya"
                    ]
                ],
                'web_access' => false
            ]
        ]);

        // Mendapatkan hasil dari respons API
        $data = json_decode($wordResponse->getBody(), true);

        // Memproses hasil analisis dari GPT
        $wordanalysis = $data['result'] ?? 'No analysis available.';

        $characterResponse = $client->post('https://chatgpt-42.p.rapidapi.com/gpt4', [
            'headers' => [
                'Content-Type' => 'application/json',
                'x-rapidapi-host' => 'chatgpt-42.p.rapidapi.com',
                'x-rapidapi-key' => 'fd5546dd29mshaaa62f217104f27p1f671ajsn6a01e268785f', // Ganti dengan API key Anda
            ],
            'json' => [
                'messages' => [
                    [
                        'role' => 'user',
                        'content' => "Berikan analisi berdasarkan jumlah character '{$charCount}' nah itu jumlah characternya kalo di headline gimana optimal atau ngga, buat dalam 1 paragraf analisisnya"
                    ]
                ],
                'web_access' => false
            ]
        ]);

        // Mendapatkan hasil dari respons API
        $data = json_decode($characterResponse->getBody(), true);

        // Memproses hasil analisis dari GPT
        $characteranalysis = $data['result'] ?? 'No analysis available.';

        // Rekomendasi terkait word count dan character count
        $wordRecommendation = $wordanalysis ?? 'No word count recommendation available.';
        $charRecommendation = $characteranalysis ?? 'No character count recommendation available.';        // Return hasil analisis ke view

        // Mengirim permintaan untuk analisis sentimen
        $sentimentResponse = $client->post('https://chatgpt-42.p.rapidapi.com/gpt4', [
            'headers' => [
                'Content-Type' => 'application/json',
                'x-rapidapi-host' => 'chatgpt-42.p.rapidapi.com',
                'x-rapidapi-key' => 'fd5546dd29mshaaa62f217104f27p1f671ajsn6a01e268785f', // Ganti dengan API key Anda
            ],
            'json' => [
                'messages' => [
                    [
                        'role' => 'user',
                        'content' => "Analyze the sentiment of the following headline: '{$headline}'. Jawab 1 kata saja, Is it positive, neutral, or negative?"
                    ]
                ],
                'web_access' => false
            ]
        ]);

        // Mendapatkan hasil dari respons API untuk analisis sentimen
        $dataSentiment = json_decode($sentimentResponse->getBody(), true);
        $sentiment = $dataSentiment['result'] ?? 'No sentiment analysis available.';

        // Menambahkan rekomendasi berdasarkan sentimen
        $suggestionResponse = $client->post('https://chatgpt-42.p.rapidapi.com/gpt4', [
            'headers' => [
                'Content-Type' => 'application/json',
                'x-rapidapi-host' => 'chatgpt-42.p.rapidapi.com',
                'x-rapidapi-key' => 'fd5546dd29mshaaa62f217104f27p1f671ajsn6a01e268785f', // Ganti dengan API key Anda
            ],
            'json' => [
                'messages' => [
                    [
                        'role' => 'user',
                        'content' => "Based on the sentiment of '{$sentiment}', provide specific suggestions to improve the '{$headline}'. For example, if it's 'Neutral', suggest adding emotionally positive or negative words to make it stand out. Please give the suggestion in one sentence langsung to the point. dalam bahasa indonesia jika inputnya bahasa indonesia"
                    ]
                ],
                'web_access' => false
            ]
        ]);

        // Mendapatkan hasil saran dari respons API
        $dataSuggestion = json_decode($suggestionResponse->getBody(), true);
        $sentimentSuggestion = $dataSuggestion['result'] ?? 'No sentiment suggestion available.';

        // Mengirim permintaan untuk analisis clarity
        $clarityResponse = $client->post('https://chatgpt-42.p.rapidapi.com/gpt4', [
            'headers' => [
                'Content-Type' => 'application/json',
                'x-rapidapi-host' => 'chatgpt-42.p.rapidapi.com',
                'x-rapidapi-key' => 'fd5546dd29mshaaa62f217104f27p1f671ajsn6a01e268785f',
            ],
            'json' => [
                'messages' => [
                    [
                        'role' => 'user',
                        'content' => "Analyze the clarity of the following headline: '{$headline}'. Is it clear and concise? Provide a short explanation on whether the message is clear and concise or needs improvement. Buat 1 kalimat saja, jika inputnya bahasa indonesia gunakan bahasa indonesia"
                    ]
                ],
                'web_access' => false
            ]
        ]);

        // Mendapatkan hasil dari respons API untuk analisis clarity
        $dataClarity = json_decode($clarityResponse->getBody(), true);
        $clarityAnalysis = $dataClarity['result'] ?? 'No clarity analysis available.';

        // Mengirim permintaan ke API GPT untuk menghitung Reading Grade Level
        $readingLevelResponse = $client->post('https://chatgpt-42.p.rapidapi.com/gpt4', [
            'headers' => [
                'Content-Type' => 'application/json',
                'x-rapidapi-host' => 'chatgpt-42.p.rapidapi.com',
                'x-rapidapi-key' => 'fd5546dd29mshaaa62f217104f27p1f671ajsn6a01e268785f',
            ],
            'json' => [
                'messages' => [
                    [
                        'role' => 'user',
                        'content' => "Evaluate the following text's reading grade level on a scale of 1 to 10, where 1 is very simple (easily understood by children) and 10 is very complex (requires advanced reading skills). Only provide the grade level number without explanation: '{$headline}'. cukup angkanya saja!!"
                    ]
                ],
                'web_access' => false
            ]
        ]);

        // Mendapatkan hasil dari respons API
        $dataReadingLevel = json_decode($readingLevelResponse->getBody(), true);
        $readingGradeLevel = $dataReadingLevel['result'] ?? 'No reading grade level available.';

        // Mengirim permintaan ke API GPT untuk deskripsi skor Reading Grade Level
        $readingLevelExplanationResponse = $client->post('https://chatgpt-42.p.rapidapi.com/gpt4', [
            'headers' => [
                'Content-Type' => 'application/json',
                'x-rapidapi-host' => 'chatgpt-42.p.rapidapi.com',
                'x-rapidapi-key' => 'fd5546dd29mshaaa62f217104f27p1f671ajsn6a01e268785f', // Ganti dengan API key Anda
            ],
            'json' => [
                'messages' => [
                    [
                        'role' => 'user',
                        'content' => "Based on the reading grade level score '{$readingGradeLevel}', provide a short explanation of the text's complexity. Keep it concise, clear, and suitable for user feedback. cukup 1 kalimat saja, jika inputnya bahasa indonesia gunakan bahasa indonesia"
                    ]
                ],
                'web_access' => false
            ]
        ]);

        // Mendapatkan hasil dari respons API
        $dataReadingLevelExplanation = json_decode($readingLevelExplanationResponse->getBody(), true);
        $readingGradeExplanation = $dataReadingLevelExplanation['result'] ?? 'No explanation available.';

        // Meminta Headline Score dari GPT
        $headlineScoreResponse = $client->post('https://chatgpt-42.p.rapidapi.com/gpt4', [
            'headers' => [
                'Content-Type' => 'application/json',
                'x-rapidapi-host' => 'chatgpt-42.p.rapidapi.com',
                'x-rapidapi-key' => 'fd5546dd29mshaaa62f217104f27p1f671ajsn6a01e268785f', // Ganti dengan API key Anda
            ],
            'json' => [
                'messages' => [
                    [
                        'role' => 'user',
                        'content' => "Analyze the following headline: '{$headline}'. Provide a single Headline Score between 1 and 100 based on its clarity, sentiment, reading grade level, and keyword relevance."
                    ]
                ],
                'web_access' => false
            ]
        ]);

        // Mendapatkan hasil dari respons API
        $dataHeadlineScore = json_decode($headlineScoreResponse->getBody(), true);

        // Mendapatkan skor dan penjelasan
        $headlineScore = $dataHeadlineScore['result']['score'] ?? 50; // Default 50 jika API gagal
        $headlineScoreExplanation = $dataHeadlineScore['result']['explanation'] ?? 'No explanation available.';


        return view('headlineanalyze', [
            'headline' => $headline,
            'analysis' => [
                'word_count' => $wordCount,
                'char_count' => $charCount,
                'reading_grade_level' => $readingGradeLevel,
                'reading_grade_explanation' => $readingGradeExplanation,
                'word_recommendation' => $wordRecommendation,
                'char_recommendation' => $charRecommendation,
                'sentiment' => $sentiment,
                'sentiment_suggestion' => $sentimentSuggestion,
                'clarity_analysis' => $clarityAnalysis,
                'headline_score' => $headlineScore,

            ],
            'suggestions' => explode("\n", $suggestions),  // Pisahkan saran per baris
            'recommendations' => explode("\n", $recommendations),  // Pisahkan rekomendasi per baris
        ]);
    }
    public function showHeadlineHistory()
    {
        $histories = HeadlineSearchHistory::where('user_id', Auth::id())
            ->distinct('headline')
            ->get();

        return view('/headlinehistory', compact('histories'));
    }

}
