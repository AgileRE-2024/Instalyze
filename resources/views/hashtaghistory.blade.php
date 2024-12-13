<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Instalyze</title>
    <link rel="icon" type="image/png" href="images/logo.png">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Product+Sans&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: 'Product Sans', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-100">
    <div class="max-w-6xl mx-auto p-4">
        <div id="HashtagAnalysis" class="tabcontent bg-white p-6 rounded-lg shadow-md mt-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">History Hashtag Analysis</h2>
            <ul>
                @foreach ($histories as $history)
                    @if (!empty($history->hashtag)) <!-- Pastikan hanya yang memiliki hashtag -->
                        <li class="flex items-center justify-between bg-gray-50 p-4 rounded-lg shadow-sm">
                            <div class="flex items-center">
                                <i class="fas fa-hashtag text-xl text-gray-600 mr-4"></i>
                                <span class="text-gray-800">{{ $history->hashtag }}</span>
                            </div>
                            <a href="{{ route('hashtaganalyze', ['hashtag' => $history->hashtag]) }}"
                                class="bg-red-500 text-white px-4 py-2 rounded-full">View Hashtag</a>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>

    </div>
</body>

</html>