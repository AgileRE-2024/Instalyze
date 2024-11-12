<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <title>Hashtag Report</title>
  <script src="https://cdn.tailwindcss.com"></script>
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
      <!-- Hashtag Input -->
      <div class="flex w-1/3">
        <form action="{{ route('hashtaganalyze') }}" method="POST" class="flex w-full">
          @csrf
          <input class="flex-grow p-4 focus:outline-none h-12 rounded-l-md text-black" placeholder="Enter hashtag"
            type="text" name="hashtag" required />
          <button class="bg-red-600 p-4 text-white hover:bg-red-700 h-12 rounded-r-md border-2 border-white"
            type="submit">
            <i class="fas fa-arrow-right"></i>
          </button>
        </form>
      </div>
    </div>
    <!-- Hashtag Section -->
    <div class="bg-white p-6 rounded-lg shadow-md mb-6">
      <h2 class="text-lg font-bold mb-4 border-b-2 border-red-500 pb-2 text-center">
        Hashtag #{{ $hashtag }} terkait di Instagram:
      </h2>
      <div class="grid grid-cols-2 gap-4">
        @if(isset($topHashtags))
      @foreach($topHashtags as $tag => $count)
      <div>
      <div class="flex items-center justify-between mb-2">
      <a href="{{ route('hashtaganalyze', ['hashtag' => ltrim($tag, '#')]) }}" class="hover:text-black">
        <span class="text-red-500 hover:text-black">{{ $tag }}</span>
      </a>

      <div class="flex items-center">
        <span class="mr-2"> {{ number_format($count) }} </span>
        <input type="checkbox" />
      </div>
      </div>
      </div>
    @endforeach
    @else
    <p class="text-red-500">No hashtags found.</p>
  @endif
      </div>
    </div>

    <!-- Popular Posts Section -->
    <div class="bg-white p-6 rounded-lg shadow-md mb-6">
      <h2 class="text-xl font-semibold mb-2">
        Postingan terpopuler dengan hashtag
        <span class="text-red-500"> #{{ $hashtag }} </span>:
      </h2>
      <p class="text-gray-600 mb-4">
        Daftar postingan yang menggunakan tagar #{{ $hashtag }}
      </p>
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach ($popularPosts as $post)
      <div class="bg-white rounded-lg shadow-md overflow-hidden flex flex-col h-full">
        <div class="relative">
        <img alt="Instagram post image" class="w-full h-48 object-cover filter blur-lg transition-all duration-300"
          src="{{ $post['image_url'] }}" />

        <!-- Tombol "Show Post" dengan link -->
        <a href="https://www.instagram.com/p/{{ $post['shortcode'] }}/" target="_blank">
          <button
          class="absolute bottom-2 left-1/2 transform -translate-x-1/2 bg-red-500 text-white px-4 py-2 rounded-lg opacity-70 hover:opacity-100 transition-opacity duration-300">
          Show Post
          </button>
        </a>
        </div>
        <div class="p-4 flex-grow">
        <div class="flex items-center mb-2">
          <i class="fab fa-instagram text-gray-500 mr-2"></i>
          <span class="text-gray-500">{{ $post['username'] }}</span>
        </div>
        <p class="text-gray-800 mb-4">{{ $post['caption'] }}</p>
        <div class="flex justify-between items-center">
          <div class="flex space-x-2 text-gray-500 items-center">
          <i class="far fa-heart"></i>
          <span>{{ $post['like_count'] }}</span>
          <i class="far fa-comment"></i>
          <span>{{ $post['comment_count'] }}</span>
          </div>
        </div>
        <p class="text-gray-500 mt-2">{{ $post['created_at'] }}</p>
        </div>
        <a class="block mt-2 bg-red-500 text-white text-center py-2 rounded-t-none hover:bg-red-600"
        href="{{ route('profileanalyze', ['username' => $post['username']]) }}">
        Lihat Analisis Profile
        </a>
      </div>
    @endforeach
      </div>
    </div>

  </div>

  </div>
</body>

</html>