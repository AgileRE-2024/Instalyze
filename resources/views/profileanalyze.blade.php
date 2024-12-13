<head>
    <script src="https://cdn.tailwindcss.com">
    </script>

    <head>
        <title>Instalyze</title>
        <link rel="icon" type="image/png" href="images/logo.png">
    </head>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Product+Sans:wght@400;500;700&amp;display=swap"
        rel="stylesheet" />
    <style>
        body {
            font-family: 'Product Sans', sans-serif;
            background-color: #f5f5f5;
        }

        .tooltip-wrapper:hover .tooltip-content {
            display: block;
        }

        .tooltip-content {
            max-width: 200px;
            background-color: #f87171;
            color: white;
            padding: 8px;
            border-radius: 0.375rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
            white-space: normal;
        }
    </style>
    <script>
        function toggleTab(tab) {
            const mostLikedButton = document.getElementById('most-liked-button');
            const mostCommentedButton = document.getElementById('most-commented-button');
            const mostLikedContent = document.getElementById('most-liked-content');
            const mostCommentedContent = document.getElementById('most-commented-content');

            if (tab === 'liked') {
                mostLikedButton.classList.add('bg-red-500', 'text-white');
                mostLikedButton.classList.remove('bg-gray-200', 'text-gray-700');
                mostCommentedButton.classList.add('bg-gray-200', 'text-gray-700');
                mostCommentedButton.classList.remove('bg-red-500', 'text-white');
                mostLikedContent.classList.remove('hidden');
                mostCommentedContent.classList.add('hidden');
            } else {
                mostCommentedButton.classList.add('bg-red-500', 'text-white');
                mostCommentedButton.classList.remove('bg-gray-200', 'text-gray-700');
                mostLikedButton.classList.add('bg-gray-200', 'text-gray-700');
                mostLikedButton.classList.remove('bg-red-500', 'text-white');
                mostCommentedContent.classList.remove('hidden');
                mostLikedContent.classList.add('hidden');
            }
        }

    </script>
</head>

<body class="p-6">
    <div class="max-w-5xl mx-auto">

        <!-- Search Bar -->
        <div class="flex items-center mb-2">
            <div class="flex w-1/3"> <!-- No rounding here, controlled in child elements -->
                <a href="{{ url('/') }}" class="flex items-center text-red-500 hover:text-red-700 mr-4">
                    <i class="fas fa-arrow-left mr-2"></i> Back
                </a>
                <form action="{{ route('profileanalyze') }}" method="POST" class="flex w-full">
                    @csrf
                    <!-- Add an id for easier selection in Dusk -->
                    <input id="username-input" class="flex-grow p-4 focus:outline-none h-12 rounded-l-md"
                        dusk="username-input" placeholder="Enter Instagram username" type="text" name="username"
                        required />
                    <button class="bg-red-500 p-4 text-white hover:bg-red-600 h-12 rounded-r-md"
                        dusk="profile-analyze-button" type="submit">
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
                        <!-- <img src="{{ $data['profile_pic_url'] }}" alt="Profile Picture"
                            class="w-16 h-16 rounded-full mr-4" /> Profile Picture -->
                        <div>
                            <h2 id="full-name" class="text-xl font-bold">
                                {{ $data['full_name'] }}
                            </h2>
                            <p class="text-gray-500">
                                @ {{ $data['username'] }}
                            </p>
                            <p id="category" class="text-sm text-gray-500">
                                {{ $data['category'] ?? 'No Category Available' }}
                            </p>
                        </div>
                    </div>

                    <div class="flex items-center space-x-2">
                        <span id="account_score" class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                            {{ $data['account_score'] }} {{ $data['predicate'] }}
                        </span>
                        <div class="relative flex items-center">
                            <div class="tooltip-wrapper cursor-pointer">
                                <i class="fas fa-question-circle text-gray-500 tooltip-icon"></i>
                                <div
                                    class="tooltip-content hidden absolute left-1/2 transform -translate-x-1/2 mt-1 w-64 bg-red-500 text-white text-sm p-2 rounded-md shadow-lg">
                                    Account score is an internal metric on Instalyze, calculated based on account
                                    behavioral indicators, posting frequency, quantity and quality of content.
                                </div>
                            </div>
                        </div>



                    </div>

                </div>

                <div class="mt-4 flex-grow flex flex-col justify-center"> <!-- Added flex-grow and justify-center -->
                    <p id="bio" class="text-gray-700">
                        {{ $data['bio'] }}
                    </p>
                    <div id="bio_links" class="mt-2">
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
                        <h3 class="text-xl font-bold flex items-center">
                            Engagement
                            <div class="relative flex items-center ml-2 tooltip-wrapper cursor-pointer">
                                <i class="fas fa-question-circle text-gray-500 tooltip-icon"></i>
                                <div
                                    class="tooltip-content hidden absolute left-1/2 transform -translate-x-1/2 mt-1 w-64 bg-red-500 text-white text-sm p-2 rounded-md shadow-lg">
                                    (likes + comments) / followers * 100
                                </div>
                            </div>
                        </h3>

                        <p id="engagement_rate" class="text-2xl font-bold text-green-500">
                            {{ $data['engagement_rate'] }}%
                        </p>

                        <p class="text-gray-500 mt-2 text-lg flex items-center relative group">
                            Avg. activity
                        <div class="tooltip-wrapper cursor-pointer">
                            <i class="fas fa-question-circle text-gray-500 tooltip-icon"></i>
                            <div
                                class="tooltip-content hidden absolute left-1/2 transform -translate-x-1/2 mt-1 w-64 bg-red-500 text-white text-sm p-2 rounded-md shadow-lg">
                                Shows the ratio of likes and comments to the number posts and followers
                            </div>
                        </div>
                        </p>



                        <p id="avg_activity" class="text-lg font-bold text-green-500">
                            {{ $data['avg_activity'] }}%
                        </p>
                    </div>
                    <div class="text-right">
                        <p class="text-gray-500 text-lg">
                            Followers
                        </p>
                        <p id="follower_count" class="text-xl font-bold">
                            {{ number_format($data['follower_count']) }}
                        </p>
                        <p class="text-gray-500 text-lg">
                            Uploads
                        </p>
                        <p id="posts_count" class="text-xl font-bold">
                            {{ number_format($data['posts_count']) }}
                        </p>
                        <p class="text-gray-500 text-lg">
                            Avg. likes
                        </p>
                        <p id="avg_likes" class="text-xl font-bold">
                            {{ $data['avg_likes'] }}
                        </p>
                        <p class="text-gray-500 text-lg">
                            Avg. comments
                        </p>
                        <p id="avg_comments" class="text-xl font-bold">
                            {{ $data['avg_comments'] }}
                        </p>
                    </div>
                </div>
            </div>

        </div>

        <!-- Publishing Frequency -->
        <div class="bg-white p-6 rounded-lg shadow-md mb-6">
            <h3 class="text-lg font-bold mb-4">
                Publishing frequency
            </h3>
            <div class="flex items-center mb-4">
                <p id="publishing_frequency" class="text-2xl font-bold">
                    {{ $data['publishing_frequency'] }} posts/week
                </p>
                <p id="percentage_change" class="{{ $data['percentage_change'] >= 0 ? 'text-green-500' : 'text-red-500' }} ml-2">
                    {{ $data['percentage_change'] }}
                </p>
                <p class="ml-2">
                    Change in posting frequency
                </p>
            </div>


            <div class="flex">
                <div class="w-1/2">
                    <!-- <h4 class="text-sm font-bold mb-2">
                        By week
                    </h4> -->
                    <div class="bg-gray-100 p-4 rounded-lg flex flex-col items-center">
                        <div class="text-center">
                            <p id="most_active_day" class="text-center font-bold text-lg mb-2">
                                Posts by Day of the Week
                                {{ $data['most_active_day'] }}
                            </p>
                        </div>

                        <canvas id="postTimeChart" class="w-full h-auto"></canvas>
                    </div>
                </div>

                <script>
                    document.addEventListener("DOMContentLoaded", function () {
                        const postsByDayData = JSON.parse({!! json_encode($data['posts_by_day']) !!});

                        const ctx = document.getElementById('postTimeChart').getContext('2d');
                        const postTimeChart = new Chart(ctx, {
                            type: 'bar', // Change this to 'line' or other types if needed
                            data: {
                                labels: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'], // Abbreviated labels
                                datasets: [{
                                    label: 'Number of Posts',
                                    data: postsByDayData,
                                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                    borderColor: 'rgba(75, 192, 192, 1)',
                                    borderWidth: 1,
                                }],
                            },
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true,
                                        ticks: {
                                            stepSize: 1, // Set step size to 1 for whole numbers
                                            callback: function (value) {
                                                return Number.isInteger(value) ? value : ''; // Display only whole numbers
                                            }
                                        },
                                        title: {
                                            display: false,
                                            text: 'Number of Posts',
                                        },
                                    },
                                    x: {
                                        title: {
                                            display: false,
                                            text: 'Days of the Week',
                                        },
                                    }
                                },
                                plugins: {
                                    legend: {
                                        display: false,
                                        position: 'top',
                                    },
                                },
                            },
                        });
                    });
                </script>

                <div class="w-1/2 pl-4">
                    <!-- <h4 class="text-sm font-bold mb-2">
                        Engagement by Day of the Week
                    </h4> -->
                    <div class="bg-gray-100 p-4 rounded-lg flex flex-col items-center">
                        <p class="text-center font-bold text-lg mb-2">
                            Engagement by Day of the Week
                        </p>
                        <canvas id="engagementTimeChart" class="w-full h-auto"></canvas>
                    </div>
                </div>

                <script>
                    document.addEventListener("DOMContentLoaded", function () {
                        // Assuming engagement data is passed in a similar format to posts_by_day
                        const engagementByDayData = JSON.parse({!! json_encode($data['engagement_by_day']) !!});

                        const ctx = document.getElementById('engagementTimeChart').getContext('2d');
                        const engagementTimeChart = new Chart(ctx, {
                            type: 'bar', // Change this to 'line' or other types if needed
                            data: {
                                labels: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'], // Abbreviated labels
                                datasets: [{
                                    label: 'Number of Engagements',
                                    data: engagementByDayData,
                                    backgroundColor: 'rgba(255, 99, 132, 0.2)', // Change color as needed
                                    borderColor: 'rgba(255, 99, 132, 1)', // Change color as needed
                                    borderWidth: 1,
                                }],
                            },
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true,
                                        title: {
                                            // display: true,
                                            // text: 'Number of Engagements'
                                        }
                                    },
                                    x: {
                                        title: {
                                            // display: true,
                                            // text: 'Days of the Week'
                                        }
                                    }
                                },
                                plugins: {
                                    legend: {
                                        display: false,
                                        position: 'top',
                                    },
                                },
                            },
                        });
                    });
                </script>

            </div>
        </div>
        <!-- Hashtags, Caption Words, Sentiment Analysis -->
        <div class="bg-white p-6 rounded-lg shadow-md mb-6">
            <div class="flex justify-between">
                <div class="w-1/3">
                    <h4 class="text-sm font-bold mb-2">Top hashtags</h4>
                    <div id="top_hashtags" class="bg-gray-100 p-4 rounded-lg">
                        @if(!empty($data['top_hashtags']))
                            @foreach($data['top_hashtags'] as $hashtag => $count)
                                <p>
                                    <a href="{{ route('hashtaganalyze', ['hashtag' => ltrim($hashtag, '#')]) }}"
                                        class="hover:text-red-500">
                                        <span class="font-bold">{{ $hashtag }}</span>
                                    </a>

                                    <span class="text-gray-500">{{ $count }}</span>
                                </p>
                            @endforeach
                        @else
                            <p>No hashtags found.</p>
                        @endif
                    </div>
                </div>

                <div class="w-1/3 px-4">
                    <h4 class="text-sm font-bold mb-2">
                        Top caption words
                    </h4>
                    <div id="top_words" class="bg-gray-100 p-4 rounded-lg">
                        @if(!empty($data['top_words']))
                            @foreach($data['top_words'] as $word => $count)
                                <p>
                                    <span class="font-bold">{{ $word }}</span>
                                    <span class="text-gray-500">{{ $count }}</span>
                                </p>
                            @endforeach
                        @else
                            <p>No words found.</p>
                        @endif
                    </div>
                </div>


                <div class="w-1/3">
                    <h4 class="text-sm font-bold mb-2">
                        Sentiment analysis
                    </h4>
                    <div class="bg-gray-100 p-4 rounded-lg">
                        <div class="flex items-center mb-2">
                            <span class="w-3 h-3 bg-green-500 rounded-full mr-2"></span>
                            <p class="text-gray-700">
                                Positive
                                <span id="positive_percentage" class="font-bold">{{ $data['positive_percentage'] }}%</span>
                            </p>
                        </div>
                        <div class="flex items-center mb-2">
                            <span class="w-3 h-3 bg-gray-500 rounded-full mr-2"></span>
                            <p class="text-gray-700">
                                Neutral
                                <span id="neutral_percentage" class="font-bold">{{ $data['neutral_percentage'] }}%</span>
                            </p>
                        </div>
                        <div class="flex items-center">
                            <span class="w-3 h-3 bg-red-500 rounded-full mr-2"></span>
                            <p class="text-gray-700">
                                Negative
                                <span id="negative_percentage" class="font-bold">{{ $data['negative_percentage'] }}%</span>
                            </p>
                        </div>
                    </div>

                    <!-- Donut Chart -->
                    <div class="flex justify-center"> <!-- Centering the chart -->
                        <canvas id="sentimentChart" width="200" height="200"
                            class="max-w-[250px] max-h-[150px]"></canvas>
                    </div>
                    <script>
                        const ctx = document.getElementById('sentimentChart').getContext('2d');
                        const sentimentChart = new Chart(ctx, {
                            type: 'doughnut',
                            data: {
                                labels: ['Positive', 'Neutral', 'Negative'],
                                datasets: [{
                                    label: 'Sentiment Analysis',
                                    data: [
                    {{ $data['positive_percentage'] }},
                    {{ $data['neutral_percentage'] }},
                    {{ $data['negative_percentage'] }},
                                    ],
                                    backgroundColor: [
                                        'rgba(76, 175, 80, 0.2)',
                                        'rgba(201, 203, 207, 0.2)',
                                        'rgba(255, 99, 132, 0.2)',
                                    ],
                                    borderColor: [
                                        'rgba(76, 175, 80, 1)',
                                        'rgba(201, 203, 207, 1)',
                                        'rgba(255, 99, 132, 1)',
                                    ],
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                responsive: true,
                                layout: {
                                    padding: {
                                        top: 25,
                                    }
                                },
                                plugins: {
                                    legend: {
                                        position: 'left',
                                        labels: {
                                            padding: 5,
                                        }
                                    },
                                }
                            }
                        });
                    </script>

                </div>


            </div>
        </div>
        <!-- Posts -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-bold">
                    Posts
                </h3>
                <!-- <button class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">
                    DOWNLOAD FULL PROFILE
                </button> -->
            </div>
            <div class="flex mb-4">
                <button class="bg-red-500 text-white px-4 py-2 rounded-l-lg hover:bg-red-600" id="most-liked-button"
                    onclick="toggleTab('liked')">
                    Most liked
                </button>
                <button class="bg-gray-200 text-gray-700 px-4 py-2 rounded-r-lg hover:bg-red-600"
                    id="most-commented-button" onclick="toggleTab('commented')">
                    Most commented
                </button>
            </div>
            <div id="most-liked-content">
                <div class="grid grid-cols-3 gap-4">
                    @foreach($data['top_liked_posts'] as $post)
                        <div class="bg-gray-100 p-4 rounded-lg">
                            <div class="relative">
                                <img alt="Post image"
                                    class="w-full h-48 object-cover rounded-lg mb-2 filter blur-lg transition-all duration-300"
                                    height="200" src="{{ $post['image_url'] }}" width="200" />

                                <!-- Tombol "Show Post" dengan link -->
                                <a href="https://www.instagram.com/p/{{ $post['shortcode'] }}/" target="_blank">
                                    <button
                                        class="absolute bottom-2 left-1/2 transform -translate-x-1/2 bg-red-500 text-white px-4 py-2 rounded-lg opacity-70 hover:opacity-100 transition-opacity duration-300">
                                        Show Post
                                    </button>
                                </a>
                            </div>


                            <div class="flex justify-between items-center">
                                <p class="text-gray-700">
                                    <i class="fas fa-heart"></i>
                                    {{ $post['like_count'] }} <!-- Displaying the number of likes dynamically -->
                                </p>
                                <p class="text-gray-700">
                                    <i class="fas fa-comment"></i>
                                    {{ $post['comment_count'] }} <!-- Displaying the number of comments dynamically -->
                                </p>
                            </div>
                            <p class="text-gray-500 text-sm">
                                {{ \Carbon\Carbon::createFromTimestamp($post['created_at'])->format('d M, Y') }}
                                <!-- Displaying the date -->
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="hidden" id="most-commented-content">
                <div class="grid grid-cols-3 gap-4">
                    @foreach($data['top_commented_posts'] as $post)
                        <div class="bg-gray-100 p-4 rounded-lg">
                            <div class="relative">
                                <img alt="Post image"
                                    class="w-full h-48 object-cover rounded-lg mb-2 filter blur-lg transition-all duration-300"
                                    height="200" src="{{ $post['image_url'] }}" width="200" />

                                <!-- Tombol "Show Post" dengan link -->
                                <a href="https://www.instagram.com/p/{{ $post['shortcode'] }}/" target="_blank">
                                    <button
                                        class="absolute bottom-2 left-1/2 transform -translate-x-1/2 bg-red-500 text-white px-4 py-2 rounded-lg opacity-70 hover:opacity-100 transition-opacity duration-300">
                                        Show Post
                                    </button>
                                </a>
                            </div>


                            <div class="flex justify-between items-center">
                                <p class="text-gray-700">
                                    <i class="fas fa-heart"></i>
                                    {{ $post['like_count'] }} <!-- Displaying the number of likes dynamically -->
                                </p>
                                <p class="text-gray-700">
                                    <i class="fas fa-comment"></i>
                                    {{ $post['comment_count'] }} <!-- Displaying the number of comments dynamically -->
                                </p>
                            </div>
                            <p class="text-gray-500 text-sm">
                                {{ \Carbon\Carbon::createFromTimestamp($post['created_at'])->format('d M, Y') }}
                                <!-- Displaying the date -->
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</body>