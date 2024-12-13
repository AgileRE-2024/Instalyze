<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />

    <head>
        <title>Instalyze</title>
        <link rel="icon" type="image/png" href="images/logo.png">
    </head>
    <script src="https://cdn.tailwindcss.com">
    </script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Product+Sans:wght@400;500;700&amp;display=swap"
        rel="stylesheet" />
    <style>
        body {
            font-family: 'Product Sans', sans-serif;
            background-color: #f5f5f5;
        }
    </style>
</head>

<body class="p-8">
    <div class="p-6 rounded-lg shadow-lg">
        <div class="flex items-center justify-center gap-2 mb-4">
            <!-- Icon Back -->
            <a href="{{ url('/') }}" class="flex items-center text-red-500 hover:text-red-700 mr-4">
                <i class="fas fa-arrow-left mr-2"></i> Back
            </a>
            <form class="flex w-1/2 h-6" action="{{ route('headlineanalyze') }}" method="POST">
                @csrf
                <input
                    class="flex-grow p-4 focus:outline-none h-12 rounded-l-md border border-gray-300 focus:border-blue-500"
                    placeholder="Enter Instagram headline" type="text" name="headline" required />
                <button class="bg-red-500 p-4 text-white hover:bg-red-600 h-12 rounded-r-md" type="submit">
                    <i class="fas fa-arrow-right"></i>
                </button>


            </form>
        </div>

        <div class="flex space-x-6 mt-12 mb-6 gap-8">
            <div class="w-[280px] bg-white p-4 rounded-lg shadow">
                <img alt="Healthy food in a container with vegetables and grains" class="rounded-lg" height="300"
                    src="https://headlines.coschedule.com/img/instagram.png" width="250" />
                <div class="flex flex-col items-start mt-2 text-gray-500">
                    <div class="flex space-x-2">
                        <i class="far fa-heart">
                        </i>
                        <i class="far fa-comment">
                        </i>
                        <i class="far fa-paper-plane">
                        </i>
                    </div>
                    <span class="mt-2">
                        <span class="font-bold">Instagram</span>
                        @if(isset($headline))
                            {{ $headline }} <!-- Menampilkan input headline yang sudah dimasukkan -->
                        @else
                            Healthy Food <!-- Tampilkan default jika tidak ada input -->
                        @endif
                    </span>

                </div>
            </div>
            <div class="w-2/3">
                @isset($analysis)
                    <div class="mb-8">
                        <div class="flex items-center justify-between">
                            <span class="font-bold text-gray-700 mt-[72px]">Word Count</span>
                        </div>
                        <div class="flex items-center space-x-4 mt-2">
                            <span id="word_count" class="text-red-500 text-2xl font-bold">{{ $analysis['word_count'] }}</span>
                            <p id="word_recommendation" class="text-gray-500 text-sm">{{ $analysis['word_recommendation'] }}</p>
                        </div>
                    </div>
                    <div class="mb-8">
                        <div class="flex items-center justify-between">
                            <span class="font-bold text-gray-700">Character Count</span>
                        </div>
                        <div class="flex items-center space-x-4 mt-2">
                            <span id="char_count" class="text-red-500 text-2xl font-bold">{{ $analysis['char_count'] }}</span>
                            <p id="char_recommendation" class="text-gray-500 text-sm">{{ $analysis['char_recommendation'] }}</p>
                        </div>
                    </div>
                @endisset
            </div>

        </div>
        <div class="bg-white p-6 rounded-lg mb-6">
            <div class="flex flex-row space-x-4 mb-6">
                <!-- Column 1: 30 Headline Score & List Items -->
                <div class="flex flex-col items-center mx-10 w-40">
                    <!-- Circle with Headline Score -->
                    <div class="relative flex items-center justify-center mt-24">
                        <svg class="absolute w-24 h-24">
                            <circle cx="48" cy="48" r="40" class="text-gray-200" stroke-width="8" fill="none" />
                            <circle cx="48" cy="48" r="40" class="text-red-500" stroke-width="8" fill="none"
                                stroke-dasharray="251.2" stroke-dashoffset="75.36"
                                style="transition: stroke-dashoffset 0.5s;">
                            </circle>
                        </svg>
                        <div
                            class="bg-red-100 text-red-500 text-2xl font-bold w-24 h-24 rounded-full flex items-center justify-center">
                            <div id="headline_score" class="text-center">
                                {{ $analysis['headline_score'] }}
                                <div class="text-xs font-semibold text-red-500">
                                    HEADLINE SCORE
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- List of Criteria
                    <div class="flex flex-col space-y-1 mt-1">
                        <div class="flex items-center space-x-1 text-green-500 text-xs">
                            <i class="fas fa-check-circle"></i>
                            <span>Word Balance</span>
                        </div>
                        <div class="flex items-center space-x-1 text-red-500 text-xs whitespace-nowrap w-40">
                            <i class="fas fa-times-circle"></i>
                            <span>Reading Grade Level</span>
                        </div>
                        <div class="flex items-center space-x-1 text-yellow-500 text-xs">
                            <i class="fas fa-exclamation-circle"></i>
                            <span>Sentiment</span>
                        </div>
                        <div class="flex items-center space-x-1 text-green-500 text-xs">
                            <i class="fas fa-check-circle"></i>
                            <span>Clarity</span>
                        </div>
                        <div class="flex items-center space-x-1 text-green-500 text-xs">
                            <i class="fas fa-check-circle"></i>
                            <span>Skimmability</span>
                        </div>
                    </div> -->
                </div>

                <div class="flex">
                    <!-- Kolom 1: Reading Grade Level dan Clarity -->
                    <div class="flex flex-col w-1/2 mr-4">
                        <!-- Kotak Reading Grade Level -->
                        <div class="bg-white rounded-lg shadow mb-4">
                            <div class="bg-gray-100 p-4">
                                <div class="flex items-center space-x-2">
                                    <div class="bg-green-500 p-2 rounded-full">
                                        <i class="fas fa-book text-white"></i> <!-- Ikon Buku -->
                                    </div>
                                    <span class="font-semibold">Reading Grade Level</span>
                                </div>
                            </div>
                            <div class="p-4">
                                <div class="flex items-center justify-between mt-2 space-x-4">
                                    <span
                                        id="reading_grade_level" class="text-2xl font-bold text-red-500">{{ $analysis['reading_grade_level'] }}</span>
                                    <p id="reading_grade_explanation" class="text-gray-500 text-sm">
                                        {{ $analysis['reading_grade_explanation'] }}
                                    </p>
                                </div>
                                <!-- <div class="bg-red-100 h-2 rounded-full mt-2">
                                    <div class="bg-red-500 h-2 rounded-full w-1/6"></div>
                                </div> -->
                            </div>
                        </div>

                        <!-- Kotak Clarity -->
                        <div class="bg-white rounded-lg shadow">
                            <div class="bg-gray-100 p-4">
                                <div class="flex items-center space-x-2">
                                    <div class="bg-green-500 p-2 rounded-full">
                                        <i class="fas fa-lightbulb text-white"></i> <!-- Ikon Lampu -->
                                    </div>
                                    <span class="font-semibold">Clarity</span>
                                </div>
                            </div>
                            <div class="p-4">
                                <div class="flex items-center justify-between mt-2">
                                    <p id="clarity_analysis" class="text-gray-500 text-xs">
                                        {{ $analysis['clarity_analysis'] }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Kolom 2: Sentiment -->
                    <div class="bg-white rounded-lg shadow w-1/2">
                        <div class="bg-gray-100 p-4">
                            <div class="flex items-center space-x-2">
                                <div class="bg-red-500 p-2 rounded-full">
                                    <i class="fas fa-smile text-white"></i> <!-- Ikon Senyum -->
                                </div>
                                <span id="sentiment" class="font-semibold">Sentiment</span>
                            </div>
                        </div>
                        <div class="p-4">
                            <div class="flex flex-col items-start mt-2">
                                <span class="text-2xl font-bold text-gray-700 mb-3">{{ $analysis['sentiment'] }}</span>
                                <p id="sentiment_suggestion" class="text-gray-500 text-xs">
                                    {{ $analysis['sentiment_suggestion'] }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="bg-gray-100 p-4 rounded-t-lg">
                <span class="font-semibold text-gray-700">Suggestions</span>
            </div>
            <ul class="mt-4 space-y-2 p-4 text-xs">
                @if(isset($suggestions) && !empty($suggestions))
                                @php
                                    // Pastikan $suggestions adalah string
                                    $suggestionsText = is_array($suggestions) ? implode("\n", $suggestions) : $suggestions;
                                @endphp

                                @foreach(explode("\n", $suggestionsText) as $suggestion)
                                    @foreach(explode(".", $suggestion) as $point)
                                        @if(trim($point) !== '')
                                            <li class="flex items-center justify-between">
                                                <div class="flex items-center space-x-2">
                                                    <i class="fas fa-circle text-red-500 text-xs"></i>
                                                    <span class="text-gray-500">{{ trim($point) }}</span>
                                                </div>
                                            </li>
                                        @endif
                                    @endforeach
                                @endforeach
                @endif
            </ul>


        </div>
        <div class="bg-red-500 p-6 rounded-lg shadow">
            <div class="flex items-center mb-4">
                <div class="bg-white p-2 rounded-full mr-2"> <!-- Ikon latar belakang merah -->
                    <i class="fas fa-star text-red-500"></i> <!-- Ganti dengan ikon yang diinginkan -->
                </div>
                <span class="font-bold text-white text-lg">
                    Headline Recommendations
                </span>
            </div>
            <hr class="border-t-4 border-white my-4 w-full">
            <ul class="mt-4 space-y-2 text-sm">
                @foreach ($recommendations as $recommendation)
                    <li class="flex items-center justify-between">
                        <span class="text-white">
                            {{ $recommendation }}
                        </span>
                    </li>
                @endforeach
            </ul>
        </div>


    </div>
</body>

</html>