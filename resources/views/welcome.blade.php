@ -3,9 +3,12 @@
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>
        Analyze Instagram
    </title>

    <head>
        <title>Instalyze</title>
        <link rel="icon" type="image/png" href="images/logo.png">
    </head>

    <script src="https://cdn.tailwindcss.com">
    </script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
@ -33,20 +36,33 @@
    <div class="flex w-full max-w-6xl min-h-screen">
        <!-- Left Section -->
        <div class="w-1/2 p-10 text-white flex flex-col justify-center">

            @if (Auth::check())
            <h1 class="text-4xl font-bold mb-4">
                Hi {{ Auth::user()->name }}👋
            </h1>
            <h1 class="text-4xl font-bold mb-4">
                What would you like to analyze today?
            </h1>
            @else
            <h1 class="text-4xl font-bold mb-4">
                Hi, What would you like to analyze today?
            </h1>
            @endif

            <p class="mb-8 max-w-sm">
                Analyze Instagram usernames, hashtags, and headlines to gain insights and optimize engagement.
                Analyze Instagram usernames, hashtags, and headlines based on the last 12 posts to gain insights and
                optimize engagement.
            </p>
            <div class="space-y-1"> <!-- Ganti space-y-2 dengan space-y-1 untuk mengurangi jarak antar elemen -->
                <!-- Instagram Username Input -->
                <div class="flex items-center">
                    <form action="{{ route('profileanalyze') }}" method="POST" class="flex w-full">
                        @csrf
                        <input class="flex-grow max-w-sm p-4 focus:outline-none h-12 rounded-l-md text-black"
                        <input dusk="username-input" id="username-input"
                            class="flex-grow max-w-sm p-4 focus:outline-none h-12 rounded-l-md text-black"
                            placeholder="Enter Instagram username" type="text" name="username" required />
                        <button
                        <button dusk="profile-analyze-button"
                            class="bg-red-600 p-4 text-white hover:bg-red-700 h-12 rounded-r-md border-2 border-white"
                            type="submit">
                            <i class="fas fa-arrow-right"></i>
@ -58,9 +74,10 @@ class="bg-red-600 p-4 text-white hover:bg-red-700 h-12 rounded-r-md border-2 bor
                <div class="flex items-center">
                    <form action="{{ route('hashtaganalyze') }}" method="POST" class="flex w-full">
                        @csrf
                        <input class="flex-grow max-w-sm p-4 focus:outline-none h-12 rounded-l-md text-black"
                        <input dusk="hashtag-input"
                            class="flex-grow max-w-sm p-4 focus:outline-none h-12 rounded-l-md text-black"
                            placeholder="Enter hashtag" type="text" name="hashtag" required />
                        <button
                        <button dusk="hashtag-analyze-button"
                            class="bg-red-600 p-4 text-white hover:bg-red-700 h-12 rounded-r-md border-2 border-white"
                            type="submit">
                            <i class="fas fa-arrow-right"></i>
@ -68,30 +85,72 @@ class="bg-red-600 p-4 text-white hover:bg-red-700 h-12 rounded-r-md border-2 bor
                    </form>
                </div>


                <!-- Headline Input -->
                <div class="flex items-center">
                    <form action="{{ route('profileanalyze') }}" method="POST" class="flex w-full">
                    <form action="{{ route('headlineanalyze') }}" method="POST" class="flex w-full">
                        @csrf
                        <input class="flex-grow max-w-sm p-4 focus:outline-none h-12 rounded-l-md text-black"
                        <input dusk="headline-input"
                            class="flex-grow max-w-sm p-4 focus:outline-none h-12 rounded-l-md text-black"
                            placeholder="Enter headline" type="text" name="headline" required />
                        <button
                        <button dusk="headline-analyze-button"
                            class="bg-red-600 p-4 text-white hover:bg-red-700 h-12 rounded-r-md border-2 border-white"
                            type="submit">
                            <i class="fas fa-arrow-right"></i>
                        </button>
                    </form>
                </div>

            </div>
            @if (Auth::check())
            <p class="mt-4 max-w-sm text-2xl font-bold">
            </p>
            @else
            <p class="mt-4 max-w-sm text-2xl font-bold">
                Log in to save your history!
            </p>
            @endif

        </div>
        <!-- Right Section -->
        <div class="w-1/2 relative flex items-center justify-center">
            <button
                class="absolute top-4 right-4 bg-white text-red-500 py-2 px-4 rounded-lg hover:bg-gray-100 shadow-lg">
                Register
            <button class="absolute top-[50px] right-1 bg-white text-red-500 py-2 px-4 rounded-lg shadow-lg">
                @if (Auth::check())
                <div class="flex items-center space-x-4">
                    <!-- Button History -->
                    <!-- History Link with Dropdown -->
                    <div class="relative group">
                        <a class="text-red-500 flex items-center hover:text-red-800 rounded-lg px-4 py-2">
                            <i class="fas fa-history mr-2"></i> History
                        </a>
                        <!-- Dropdown Menu -->
                        <div class="absolute left-0 hidden bg-white shadow-md rounded-lg group-hover:block">
                            <ul class="space-y-2 p-2">
                                <li><a href="{{ url('/history') }}"
                                        class="block px-4 py-2 text-gray-800 rounded-lg hover:bg-red-500 hover:text-white">Profile
                                        Analysis</a></li>
                                <li><a href="{{ url('/hashtaghistory') }}"
                                        class="block px-4 py-2 text-gray-800 rounded-lg hover:bg-red-500 hover:text-white">Hashtag
                                        Analysis</a></li>
                                <li><a href="{{ url('/headlinehistory') }}"
                                        class="block px-4 py-2 text-gray-800 rounded-lg hover:bg-red-500 hover:text-white">Headline
                                        Analysis</a></li>
                            </ul>
                        </div>
                    </div>


                    <!-- Logout Button -->
                    <a href="{{ route('logout') }}" class="text-gray-500 hover:text-gray-800">Logout</a>
                </div>
                @else
                <a href="{{ url('/signup') }}" class="text-red-500 hover:text-red-800">Sign Up</a>
                @endif
            </button>


            <img alt="Illustration of social media analytics and graphs" class="rounded-lg"
                src="https://img.freepik.com/free-vector/performance-overview-concept-illustration_114360-5246.jpg?t=st=1729340371~exp=1729343971~hmac=ca326455003dab9520b14658f8ad29ae272db50ffda6f846e29deabe502381da&w=740" />
                src="https://img.freepik.com/free-vector/data-inform-illustration-concept_114360-864.jpg?t=st=1733930791~exp=1733934391~hmac=aa4bbfb01f8bef325a0a535bc35474bdbf786d6ca12f006077e35e8dc4edd78b&w=1060" />
        </div>
    </div>
</body>
