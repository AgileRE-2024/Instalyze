<html>

<head>
    <script src="https://cdn.tailwindcss.com">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

<body class="p-6">
    <div class="max-w-5xl mx-auto">

        <!-- Search Bar -->
        <div class="flex items-center mb-2">
            <div class="flex w-1/3"> <!-- No rounding here, controlled in child elements -->
                <form action="{{ route('analyze') }}" method="POST" class="flex w-full">
                    @csrf
                    <input class="flex-grow p-4 focus:outline-none h-12 rounded-l-md"
                        placeholder="Enter Instagram username" type="text" name="username" required />
                    <!-- Rounded only on the left side -->
                    <button class="bg-red-500 p-4 text-white hover:bg-red-600 h-12 rounded-r-md" type="submit">
                        <!-- Rounded only on the right side -->
                        <i class="fas fa-arrow-right"></i>
                    </button>
                </form>
            </div>
        </div>

        <!-- Profile and Engagement Cards -->
        <div class="flex justify-between items-start mb-6">
            <!-- Profile Card -->
            <div class="bg-white p-6 rounded-lg shadow-md w-1/2 h-72 flex flex-col justify-between">
                <!-- Added flex and justify-between -->
                <div class="flex items-center justify-between mb-4"> <!-- Added margin bottom -->
                    <div class="flex items-center">
                        <img src="{{ $data['profile_pic_url'] }}" alt="Profile Picture"
                            class="w-16 h-16 rounded-full mr-4" /> <!-- Profile Picture -->
                        <div>
                            <h2 class="text-xl font-bold">
                                {{ $data['full_name'] }}
                            </h2>
                            <p class="text-gray-500">
                                @ {{ $data['username'] }}
                            </p>
                            <p class="text-sm text-gray-500">
                                {{ $data['category'] ?? 'No Category Available' }}
                            </p>
                        </div>
                    </div>

                    <div class="flex items-center">
                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                            {{ $data['account_score'] }} {{ $data['predicate'] }}
                        </span>
                    </div>
                </div>

                <div class="mt-4 flex-grow flex flex-col justify-center"> <!-- Added flex-grow and justify-center -->
                    <p class="text-gray-700">
                        {{ $data['bio'] }}
                    </p>
                    <div class="mt-2">
                        @if (isset($data['bio_links']) && count($data['bio_links']) > 0)
                            <a href="{{ $data['bio_links'][0]['url'] }}"
                                class="block w-full p-2 border border-gray-300 rounded-lg text-blue-600 hover:text-blue-800"
                                target="_blank" rel="noopener noreferrer">
                                {{ $data['bio_links'][0]['url'] }}
                            </a>
                        @else
                            <p class="text-gray-500">No bio link available</p>
                        @endif
                    </div>
                </div>
            </div>



            <!-- Engagement Card -->
            <div class="bg-white p-6 rounded-lg shadow-md w-1/2 ml-6 h-72 flex flex-col justify-between">
                <div class="flex justify-between items-center mb-4">
                    <div>
                        <h3 class="text-xl font-bold">
                            Engagement
                        </h3>
                        <p class="text-2xl font-bold text-green-500">
                            {{ $data['engagement_rate'] }}%
                        </p>

                        <p class="text-gray-500 mt-2 text-lg">
                            Avg. activity
                        </p>
                        <p class="text-lg font-bold text-green-500">
                            {{ $data['avg_activity'] }}%
                        </p>
                    </div>
                    <div class="text-right">
                        <p class="text-gray-500 text-lg">
                            Followers
                        </p>
                        <p class="text-xl font-bold">
                            {{ number_format($data['follower_count']) }}
                        </p>
                        <p class="text-gray-500 text-lg">
                            Uploads
                        </p>
                        <p class="text-xl font-bold">
                            {{ number_format($data['posts_count']) }}
                        </p>
                        <p class="text-gray-500 text-lg">
                            Avg. likes
                        </p>
                        <p class="text-xl font-bold">
                            {{ $data['avg_likes'] }}
                        </p>
                        <p class="text-gray-500 text-lg">
                            Avg. comments
                        </p>
                        <p class="text-xl font-bold">
                            {{ $data['avg_comments'] }}
                        </p>
                    </div>
                </div>
            </div>

               
        </div>
    </div>
</body>
</html>