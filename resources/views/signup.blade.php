<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Instalyze</title>
    <link rel="icon" type="image/png" href="images/logo.png">
    <script src="https://cdn.tailwindcss.com">
    </script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Product+Sans&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: 'Product Sans', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-100">
    <div class="flex items-center justify-center min-h-screen">
        <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md relative">
            <button class="absolute top-4 right-4 text-gray-600 hover:text-gray-800"
                onclick="window.location.href='{{ url('/') }}'">
                <i class="fas fa-times text-xl">
                </i>
            </button>
            <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">
                Sign Up
            </h2>
            <form method="POST" action="{{ route('signup') }}">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2" for="name">
                        Username
                    </label>
                    <input class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500"
                        id="name" name="name" placeholder="Enter your username" required type="text" />
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2" for="email">
                        Email
                    </label>
                    <input class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500"
                        id="email" name="email" placeholder="Enter your email" required type="email" />
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2" for="password">
                        Password
                    </label>
                    <input class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500"
                        id="password" name="password" placeholder="Enter your password" required type="password" />
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2" for="confirm-password">
                        Confirm Password
                    </label>
                    <input class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500"
                        id="confirm-password" name="password_confirmation" placeholder="Confirm your password" required
                        type="password" />
                </div>
                <button
                    class="w-full bg-red-500 text-white p-3 rounded-lg font-semibold hover:bg-red-600 transition duration-200"
                    type="submit">
                    Sign Up
                </button>
            </form>

            <p class="text-gray-600 mt-4 text-center">
                Already have an account?
                <a class="text-red-500 font-semibold hover:underline" href="{{ url('/signin') }}">
                    Log In
                </a>
            </p>
        </div>
    </div>
</body>

</html>