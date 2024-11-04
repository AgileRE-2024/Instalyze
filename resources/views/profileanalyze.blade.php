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
                <form action="{{ route('profileanalyze') }}" method="POST" class="flex w-full">
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

        <!-- Publishing Frequency -->
        <div class="bg-white p-6 rounded-lg shadow-md mb-6">
            <h3 class="text-lg font-bold mb-4">
                Publishing frequency
            </h3>
            <div class="flex items-center mb-4">
                <p class="text-2xl font-bold">
                    {{ $data['publishing_frequency'] }} posts/week
                </p>
                <p class="{{ $data['percentage_change'] >= 0 ? 'text-green-500' : 'text-red-500' }} ml-2">
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
                            <p class="text-center font-bold text-lg mb-2">
                                Posts by Day of the Week
                                {{ $data['most_active_day'] }} 
                            </p>
                        </div>

                        <canvas id="postTimeChart" class="w-full h-auto"></canvas>
                    </div>
                </div>

                <script>
                    document.addEventListener("DOMContentLoaded", function () {
                        const postsByDayData = JSON.parse(`{!! json_encode($data['posts_by_day']) !!}`);

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
                        const engagementByDayData = JSON.parse(`{!! json_encode($data['engagement_by_day']) !!}`);

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
        <!-- Hashtags, Caption Words, Semantical Analysis -->
        <div class="bg-white p-6 rounded-lg shadow-md mb-6">
            <div class="flex justify-between">
                <div class="w-1/3">
                    <h4 class="text-sm font-bold mb-2">Top hashtags</h4>
                    <div class="bg-gray-100 p-4 rounded-lg">
                        @if(!empty($data['top_hashtags']))
                            @foreach($data['top_hashtags'] as $hashtag => $count)
                                <p>
                                    <span class="font-bold">{{ $hashtag }}</span>
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
                    <div class="bg-gray-100 p-4 rounded-lg">
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
                        Semantical analysis
                    </h4>
                    <div class="bg-gray-100 p-4 rounded-lg">
                        <div class="flex items-center mb-2">
                            <span class="w-3 h-3 bg-green-500 rounded-full mr-2"></span>
                            <p class="text-gray-700">
                                Positive
                                <span class="font-bold">{{ $data['positive_percentage'] }}%</span>
                            </p>
                        </div>
                        <div class="flex items-center mb-2">
                            <span class="w-3 h-3 bg-gray-500 rounded-full mr-2"></span>
                            <p class="text-gray-700">
                                Neutral
                                <span class="font-bold">{{ $data['neutral_percentage'] }}%</span>
                            </p>
                        </div>
                        <div class="flex items-center">
                            <span class="w-3 h-3 bg-red-500 rounded-full mr-2"></span>
                            <p class="text-gray-700">
                                Negative
                                <span class="font-bold">{{ $data['negative_percentage'] }}%</span>
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
                <button class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">
                    DOWNLOAD FULL PROFILE
                </button>
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
                    @foreach($data['top_posts'] as $post)
                        <div class="bg-gray-100 p-4 rounded-lg">
                            <img alt="Post image" class="w-full h-48 object-cover rounded-lg mb-2" height="200"
                                src="{{ $post['image_url'] }}" width="200" /> <!-- Displaying the image URL dynamically -->
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
                    <div class="bg-gray-100 p-4 rounded-lg">
                        <img alt="Post image 1" class="w-full h-48 object-cover rounded-lg mb-2" height="200"
                            src="https://storage.googleapis.com/a1aa/image/F6GvtqBFmkK2NdDXrFG1AffRbKcyP0m2qKWjvAhgPT5xjVoTA.jpg"
                            width="200" /> <!-- Change the image URL -->
                        <div class="flex justify-between items-center">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>