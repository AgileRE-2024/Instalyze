<html lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
  <title>
   Healthy Food Report
  </title>
  <script src="https://cdn.tailwindcss.com">
  </script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&amp;display=swap" rel="stylesheet"/>
  <style>
   body {
            font-family: 'Inter', sans-serif;
            background-color: #F7FAFC; /* Tailwind's gray-50 */
        }
  </style>
 </head>
 <body class="p-8">
  <div class="p-6 rounded-lg shadow-lg">
   <!-- Header Section with Search Bar and Save Button -->
   <div class="flex items-center justify-between mb-6">
    <!-- Search Bar -->
    <div class="flex items-center mb-2 w-2/3">
        <form action="{{ route('analyze') }}" method="POST" class="flex w-full">
            <input
                class="flex-grow p-4 focus:outline-none h-12 rounded-l-md"
                placeholder="Enter Headline" type="text" name="username" required
            />
            <button
                class="bg-red-500 text-white px-4 py-2 rounded-lg"
                type="submit"
            >
                <i class="fas fa-arrow-right"></i>
            </button>
        </form>
    </div>
    <!-- Save Report Button -->
    <button class="bg-red-500 text-white px-3 py-1 rounded-lg">
        Save Report
    </button>
</div>
   <div class="flex space-x-6 mb-6">
    <div class="w-1/3 bg-white p-4 rounded-lg shadow">
     <img alt="Healthy food in a container with vegetables and grains" class="rounded-lg" height="300" src="https://storage.googleapis.com/a1aa/image/enWdX1BNNK0wdSuKv5bfkrKQAwfHv2pr0WuX8hvxqaxENKbnA.jpg" width="300"/>
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
       <span class="font-bold">Instagram</span> Healthy Food
      </span>
     </div>
    </div>
    <div class="w-2/3">
     <div class="mb-8">
      <div class="flex items-center justify-between">
       <span class="font-bold text-gray-700">
        Word Count
       </span>
      </div>
      <div class="flex items-center justify-between space-x-4 mt-2">
       <span class="text-red-500 text-2xl font-bold">
        2
       </span>
       <p class="text-gray-500 text-sm">
        Your caption is too light on words. Try increasing the length of your caption by 5+ words to grab attention and drive engagement.
       </p>
      </div>
      <div class="bg-red-100 h-2 rounded-full mt-2">
       <div class="bg-red-500 h-2 rounded-full w-1/6">
       </div>
      </div>
     </div>
     <div class="mb-8">
      <div class="flex items-center justify-between">
       <span class="font-bold text-gray-700">
        Character Count
       </span>
      </div>
      <div class="flex items-center justify-between space-x-4 mt-2">
       <span class="text-red-500 text-2xl font-bold">
        12
       </span>
       <p class="text-gray-500 text-sm">
        Your caption is too short. Try increasing the number of characters in your caption to improve its SEO readability.
       </p>
      </div>
      <div class="bg-red-100 h-2 rounded-full mt-2">
       <div class="bg-red-500 h-2 rounded-full w-1/6">
       </div>
      </div>
     </div>
    </div>
   </div>
    <div class="bg-white p-6 rounded-lg mb-6">
        <div class="flex flex-row space-x-4">
            <!-- Column 1: 30 Headline Score & List Items -->
            <div class="flex flex-col items-center mx-10 w-40">
                <!-- Circle with Headline Score -->
                <div class="relative flex items-center justify-center">
                    <svg class="absolute w-24 h-24">
                        <circle cx="48" cy="48" r="40" class="text-gray-200" stroke-width="8" fill="none"/>
                        <circle cx="48" cy="48" r="40" class="text-red-500" stroke-width="8" fill="none" 
                                stroke-dasharray="251.2" stroke-dashoffset="75.36" style="transition: stroke-dashoffset 0.5s;">
                        </circle>
                    </svg>
                    <div class="bg-red-100 text-red-500 text-2xl font-bold w-24 h-24 rounded-full flex items-center justify-center">
                        <div class="text-center">
                            30
                            <div class="text-xs font-semibold text-red-500">
                                HEADLINE SCORE
                            </div>
                        </div>
                    </div>
                </div>
                <!-- List of Criteria -->
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
                </div>
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
                                <span class="text-2xl font-bold text-red-500">6</span>
                                <p class="text-gray-500 text-sm">
                                    Your caption reads at or below a 7th grade reading level, making it easy for most readers to comprehend.
                                </p>
                            </div>
                            <div class="bg-red-100 h-2 rounded-full mt-2">
                                <div class="bg-red-500 h-2 rounded-full w-1/6"></div>
                            </div>
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
                                <p class="text-gray-500 text-xs">
                                    Nice work! Your caption's message is clear and concise.
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
                            <span class="font-semibold">Sentiment</span>
                        </div>
                    </div>
                    <div class="p-4">
                        <div class="flex flex-col items-start mt-2">
                            <span class="text-2xl font-bold text-gray-700">Neutral</span>
                            <p class="text-gray-500 text-xs">
                                Your caption conveys a <span class="font-bold text-black">neutral</span> sentiment. Add more emotionally positive or negative words to help it stand out and drive more engagement.
                            </p>
                        </div>
                    </div>
                </div>
            </div>            
            
    </div>

    <div class="bg-white p-6 rounded-lg">
     <div class="bg-gray-100 p-4 rounded-t-lg">
      <span class="font-semibold text-gray-700">Suggestions</span>
     </div>
     <ul class="mt-4 space-y-2 p-4 text-xs">
      <li class="flex items-center justify-between">
       <div class="flex items-center space-x-2">
        <i class="fas fa-circle text-red-500 text-xs"></i>
        <span class="text-gray-500">
         Use Keyword Explore to find a new keyword topic that will increase your search volume
        </span>
       </div>
       <a class="text-blue-500" href="#">Open Keyword Explorer</a>
      </li>
      <li class="flex items-center justify-between">
       <div class="flex items-center space-x-2">
        <i class="fas fa-circle text-orange-500 text-xs"></i>
        <span class="text-gray-500">Use longer, more specific keywords</span>
       </div>
       <a class="text-blue-500" href="#">Open Keyword Explorer</a>
      </li>
      <li class="flex items-center justify-between">
       <div class="flex items-center space-x-2">
        <i class="fas fa-circle text-red-500 text-xs"></i>
        <span class="text-gray-500">
         Try using a more or less targeted keyword phrase in your headline
        </span>
       </div>
       <a class="text-blue-500" href="#">Open Keyword Explorer</a>
      </li>
      <li class="flex items-center justify-between">
       <div class="flex items-center space-x-2">
        <i class="fas fa-circle text-orange-500 text-xs"></i>
        <span class="text-gray-500">
         Use a keyword topic that has an increasing trendline
        </span>
       </div>
       <a class="text-blue-500" href="#">
        Open Keyword Explorer
       </a>
      </li>
     </ul>
    </div>
   </div>
    <div class="bg-white p-6 rounded-lg shadow">
        <div class="flex items-center mb-4">
            <div class="bg-red-500 p-2 rounded-full mr-2"> <!-- Ikon latar belakang merah -->
                <i class="fas fa-star text-white"></i> <!-- Ganti dengan ikon yang diinginkan -->
            </div>
            <span class="font-bold text-gray-700 text-lg">
                Headline Recommendations
            </span>
        </div>
        <hr class="border-t-4 border-red-500 my-4 w-full">
        <ul class="mt-4 space-y-2 text-sm">
            <li class="flex items-center justify-between">
                <span class="text-gray-700">
                    Healthy Food Lists for a Week
                </span>
            </li>
            <li class="flex items-center justify-between">
                <span class="text-gray-700">
                    Start your day with healthy food!
                </span>
            </li>
            <li class="flex items-center justify-between">
                <span class="text-gray-700">
                    Healthy food as your ammunition
                </span>
            </li>
            <li class="flex items-center justify-between">
                <span class="text-gray-700">
                    Let healthy foods be your guide
                </span>
            </li>
        </ul>
    </div>

  </div>
 </body>
</html>