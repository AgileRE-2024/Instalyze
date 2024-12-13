<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Instalyze</title>
        <link rel="icon" type="image/png" href="images/logo.png">
    <script src="https://cdn.tailwindcss.com">
    </script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
</head>

<style>
    body {
        font-family: 'Product Sans', sans-serif;
        background-color: #f5f5f5;
    }
</style>

<body class="bg-gray-100">
    <div class="max-w-6xl mx-auto p-4">
        <!-- Search Bar -->
        <div class="flex items-center justify-center gap-2 mb-8">
            <form class="flex w-1/2 h-6" action="{{ route('profileanalyze') }}" method="POST">
                @csrf
                <input
                    class="flex-grow p-4 focus:outline-none h-12 rounded-l-md border border-gray-300 focus:border-blue-500"
                    placeholder="Enter Instagram username" type="text" name="username" required />
                <button class="bg-red-500 p-4 text-white hover:bg-red-600 h-12 rounded-r-md" type="submit">
                    <i class="fas fa-arrow-right"></i>
                </button>
            </form>
        </div>
        <!-- Profile Not Found Section -->
        <div class="bg-white p-6 rounded-lg shadow-md text-center">
            <img alt="Profile not found illustration" class="w-[560px] mx-auto mb-4" height="200"
                src="https://img.freepik.com/free-vector/400-error-bad-request-concept-illustration_114360-1921.jpg"
                width="200" />
            <h2 class="text-2xl font-bold text-red-500 mb-2">
                Profile Not Found
            </h2>
            <p class="text-gray-600 mb-4">
                The profile you are looking for does not exist. Please try searching for another profile.
            </p>
            <button class="bg-red-500 text-white px-4 py-2 rounded-full"
                onclick="window.location.href='{{ url('/') }}'">
                Go Back
            </button>

        </div>
    </div>
</body>

</html>