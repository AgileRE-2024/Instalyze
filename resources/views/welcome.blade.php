<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>
        Analyze Instagram
    </title>
    <script src="https://cdn.tailwindcss.com">
    </script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Product+Sans:wght@400;700&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: 'Product Sans', sans-serif;
        }

        .hover\:bg-red-700:hover {
            background-color: #c53030;
        }

        .hover\:bg-red-900:hover {
            background-color: #7f1d1d;
        }

        input:focus {
            outline: none;
        }
    </style>
</head>

<body class="bg-red-500 flex items-center justify-center min-h-screen">
    <div class="flex w-full max-w-6xl min-h-screen">
        <!-- Left Section -->
        <div class="w-1/2 p-10 text-white flex flex-col justify-center">
            <h1 class="text-4xl font-bold mb-4">
                What would you like to analyze today?
            </h1>
            <p class="mb-8 max-w-sm">
                Analyze Instagram usernames, hashtags, and headlines to gain insights and optimize engagement.
            </p>
            <div class="space-y-1"> <!-- Ganti space-y-2 dengan space-y-1 untuk mengurangi jarak antar elemen -->
                <!-- Instagram Username Input -->
                <div class="flex items-center">
                    <form action="{{ route('profileanalyze') }}" method="POST" class="flex w-full">
                        @csrf
                        <input class="flex-grow max-w-sm p-4 focus:outline-none h-12 rounded-l-md text-black"
                            placeholder="Enter Instagram username" type="text" name="username" required />
                        <button
                            class="bg-red-600 p-4 text-white hover:bg-red-700 h-12 rounded-r-md border-2 border-white"
                            type="submit">
                            <i class="fas fa-arrow-right"></i>
                        </button>
                    </form>
                </div>

                <!-- Hashtag Input -->
                <div class="flex items-center">
                    <form action="{{ route('profileanalyze') }}" method="POST" class="flex w-full">
                        @csrf
                        <input class="flex-grow max-w-sm p-4 focus:outline-none h-12 rounded-l-md text-black"
                            placeholder="Enter hashtag" type="text" name="hashtag" required />
                        <button
                            class="bg-red-600 p-4 text-white hover:bg-red-700 h-12 rounded-r-md border-2 border-white"
                            type="submit">
                            <i class="fas fa-arrow-right"></i>
                        </button>
                    </form>
                </div>

                <!-- Headline Input -->
                <div class="flex items-center">
                    <form action="{{ route('profileanalyze') }}" method="POST" class="flex w-full">
                        @csrf
                        <input class="flex-grow max-w-sm p-4 focus:outline-none h-12 rounded-l-md text-black"
                            placeholder="Enter headline" type="text" name="headline" required />
                        <button
                            class="bg-red-600 p-4 text-white hover:bg-red-700 h-12 rounded-r-md border-2 border-white"
                            type="submit">
                            <i class="fas fa-arrow-right"></i>
                        </button>
                    </form>
                </div>
            </div>

        </div>
        <!-- Right Section -->
        <div class="w-1/2 relative flex items-center justify-center">
            <button
                class="absolute top-4 right-4 bg-white text-red-500 py-2 px-4 rounded-lg hover:bg-gray-100 shadow-lg">
                Register
            </button>
            <img alt="Illustration of social media analytics and graphs" class="rounded-lg"
                src="https://img.freepik.com/free-vector/performance-overview-concept-illustration_114360-5246.jpg?t=st=1729340371~exp=1729343971~hmac=ca326455003dab9520b14658f8ad29ae272db50ffda6f846e29deabe502381da&w=740" />
        </div>
    </div>
</body>

</html>