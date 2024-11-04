<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Hashtag Report</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&amp;display=swap"
      rel="stylesheet"
    />
    <style>
      body {
        font-family: "Roboto", sans-serif;
      }
    </style>
  </head>
  <body class="bg-gray-100 p-6">
    <div class="max-w-4xl mx-auto">
      <!-- Search Bar -->
      <div class="flex items-center mb-2">
        <div class="flex w-1/3">
          <!-- No rounding here, controlled in child elements -->
          <form
            action="{{ route('hashtaganalyze') }}"
            method="POST"
            class="flex w-full"
          >
            <input
              class="flex-grow p-4 focus:outline-none h-12 rounded-l-md"
              placeholder="Enter Hashtag"
              type="text"
              name="username"
              required
            />
            <!-- Rounded only on the left side -->
            <button
              class="bg-red-500 p-4 text-white hover:bg-red-600 h-12 rounded-r-md"
              type="submit"
            >
              <!-- Rounded only on the right side -->
              <i class="fas fa-arrow-right"></i>
            </button>
          </form>
        </div>
      </div>
      <!-- Hashtag Section -->
      <div class="bg-white p-6 rounded-lg shadow-md mb-6">
        <h2
          class="text-lg font-bold mb-4 border-b-2 border-red-500 pb-2 text-center"
        >
          Hashtag #makansiang terkait di instagram:
        </h2>
        <div class="grid grid-cols-2 gap-4">
          <div>
            <div class="flex items-center justify-between mb-2">
              <span class="text-red-500"> #makansiang </span>
              <div class="flex items-center">
                <span class="mr-2"> 1.56M </span>
                <input type="checkbox" />
              </div>
            </div>
            <div class="flex items-center justify-between mb-2">
              <span class="text-red-500"> #makansiangenak </span>
              <div class="flex items-center">
                <span class="mr-2"> 64K </span>
                <input type="checkbox" />
              </div>
            </div>
            <div class="flex items-center justify-between mb-2">
              <span class="text-red-500"> #makansiangenak2 </span>
              <div class="flex items-center">
                <span class="mr-2"> 64K </span>
                <input type="checkbox" />
              </div>
            </div>
            <div class="flex items-center justify-between mb-2">
              <span class="text-red-500"> #makansiangenak </span>
              <div class="flex items-center">
                <span class="mr-2"> 64K </span>
                <input type="checkbox" />
              </div>
            </div>
            <div class="flex items-center justify-between mb-2">
              <span class="text-red-500"> #makansiangkantor </span>
              <div class="flex items-center">
                <span class="mr-2"> 14K </span>
                <input type="checkbox" />
              </div>
            </div>
            <div class="flex items-center justify-between mb-2">
              <span class="text-red-500"> #makansiangrumahan </span>
              <div class="flex items-center">
                <span class="mr-2"> 10K </span>
                <input type="checkbox" />
              </div>
            </div>
            <div class="flex items-center justify-between mb-2">
              <span class="text-red-500"> #makansiangsemarang </span>
              <div class="flex items-center">
                <span class="mr-2"> 4K </span>
                <input type="checkbox" />
              </div>
            </div>
            <div class="flex items-center justify-between mb-2">
              <span class="text-red-500"> #makansiangbersama </span>
              <div class="flex items-center">
                <span class="mr-2"> 9K </span>
                <input type="checkbox" />
              </div>
            </div>
            <div class="flex items-center justify-between mb-2">
              <span class="text-red-500"> #makansianganak </span>
              <div class="flex items-center">
                <span class="mr-2"> 6K </span>
                <input type="checkbox" />
              </div>
            </div>
            <div class="flex items-center justify-between mb-2">
              <span class="text-red-500"> #makansianganak2 </span>
              <div class="flex items-center">
                <span class="mr-2"> 6K </span>
                <input type="checkbox" />
              </div>
            </div>
          </div>
          <div>
            <div class="flex items-center justify-between mb-2">
              <span class="text-red-500"> #makansiangsehat </span>
              <div class="flex items-center">
                <span class="mr-2"> 70K </span>
                <input type="checkbox" />
              </div>
            </div>
            <div class="flex items-center justify-between mb-2">
              <span class="text-red-500"> #makansianghariini </span>
              <div class="flex items-center">
                <span class="mr-2"> 21K </span>
                <input type="checkbox" />
              </div>
            </div>
            <div class="flex items-center justify-between mb-2">
              <span class="text-red-500"> #makansianghariini2 </span>
              <div class="flex items-center">
                <span class="mr-2"> 21K </span>
                <input type="checkbox" />
              </div>
            </div>
            <div class="flex items-center justify-between mb-2">
              <span class="text-red-500"> #makansiangjogja </span>
              <div class="flex items-center">
                <span class="mr-2"> 13K </span>
                <input type="checkbox" />
              </div>
            </div>
            <div class="flex items-center justify-between mb-2">
              <span class="text-red-500"> #makansianggratis </span>
              <div class="flex items-center">
                <span class="mr-2"> 9K </span>
                <input type="checkbox" />
              </div>
            </div>
            <div class="flex items-center justify-between mb-2">
              <span class="text-red-500"> #makansianggr </span>
              <div class="flex items-center">
                <span class="mr-2"> 2K </span>
                <input type="checkbox" />
              </div>
            </div>
            <div class="flex items-center justify-between mb-2">
              <span class="text-red-500"> #makansiangbareng </span>
              <div class="flex items-center">
                <span class="mr-2"> 8K </span>
                <input type="checkbox" />
              </div>
            </div>
            <div class="flex items-center justify-between mb-2">
              <span class="text-red-500"> #makansiangbareng2 </span>
              <div class="flex items-center">
                <span class="mr-2"> 8K </span>
                <input type="checkbox" />
              </div>
            </div>
            <div class="flex items-center justify-between mb-2">
              <span class="text-red-500"> #makansianggolo </span>
              <div class="flex items-center">
                <span class="mr-2"> 6K </span>
                <input type="checkbox" />
              </div>
            </div>
            <div class="flex items-center justify-between mb-2">
              <span class="text-red-500"> #makansianggolo2 </span>
              <div class="flex items-center">
                <span class="mr-2"> 6K </span>
                <input type="checkbox" />
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Popular Posts Section -->
      <div class="bg-white p-6 rounded-lg shadow-md mb-6">
        <h2 class="text-xl font-semibold mb-2">
          Postingan terpopuler dengan hashtag
          <span class="text-red-500"> #makansiang </span>
          :
        </h2>
        <p class="text-gray-600 mb-4">
          Daftar postingan yang menggunakan tagar #makansiang
        </p>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
          <!-- Card 1 -->
          <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <img
              alt="Person eating a meal with a fork and a glass of juice on the table"
              class="w-full h-48 object-cover"
              height="400"
              src="https://storage.googleapis.com/a1aa/image/BwTzD8BdQwIFCVfPsW1xYdRmNaNP4AoXoRw27sChg5hr0z2JA.jpg"
              width="600"
            />
            <div class="p-4">
              <div class="flex items-center mb-2">
                <i class="fab fa-instagram text-gray-500 mr-2"> </i>
                <span class="text-gray-500"> Instagram </span>
              </div>
              <p class="text-gray-800 mb-4">Bekal untuk siang hari ini!</p>
              <div class="flex justify-between items-center">
                <div class="flex space-x-2 text-gray-500 items-center">
                  <i class="far fa-heart"> </i>
                  <span> 120 </span>
                  <i class="far fa-comment"> </i>
                  <span> 45 </span>
                </div>
              </div>
              <p class="text-gray-500 mt-2">12 Oktober 2023</p>
            </div>
            <div class="bg-red-500 text-white text-center py-2">
              <a class="block" href="#"> Lihat Lebih Lanjut </a>
            </div>
          </div>
          <!-- Card 2 -->
          <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <img
              alt="Person holding a plate of salad with a boiled egg"
              class="w-full h-48 object-cover"
              height="400"
              src="https://storage.googleapis.com/a1aa/image/HdecPQ2ThQwKb6elMue2WV8GcpdJaeafhVuiriTE7UleW6Z7E.jpg"
              width="600"
            />
            <div class="p-4">
              <div class="flex items-center mb-2">
                <i class="fab fa-instagram text-gray-500 mr-2"> </i>
                <span class="text-gray-500"> Instagram </span>
              </div>
              <p class="text-gray-800 mb-4">Makan siang enak</p>
              <div class="flex justify-between items-center">
                <div class="flex space-x-2 text-gray-500 items-center">
                  <i class="far fa-heart"> </i>
                  <span> 200 </span>
                  <i class="far fa-comment"> </i>
                  <span> 60 </span>
                </div>
              </div>
              <p class="text-gray-500 mt-2">10 Oktober 2023</p>
            </div>
            <div class="bg-red-500 text-white text-center py-2">
              <a class="block" href="#"> Lihat Lebih Lanjut </a>
            </div>
          </div>
          <!-- Card 3 -->
          <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <img
              alt="Group of people having lunch together at a table"
              class="w-full h-48 object-cover"
              height="400"
              src="https://storage.googleapis.com/a1aa/image/q80h17oW6ZpGCRn52rUeMWVow23Uq6QcDrQtkDm6l5ms0z2JA.jpg"
              width="600"
            />
            <div class="p-4">
              <div class="flex items-center mb-2">
                <i class="fab fa-instagram text-gray-500 mr-2"> </i>
                <span class="text-gray-500"> Instagram </span>
              </div>
              <p class="text-gray-800 mb-4">Makan siang bersama teman!</p>
              <div class="flex justify-between items-center">
                <div class="flex space-x-2 text-gray-500 items-center">
                  <i class="far fa-heart"> </i>
                  <span> 150 </span>
                  <i class="far fa-comment"> </i>
                  <span> 30 </span>
                </div>
              </div>
              <p class="text-gray-500 mt-2">8 Oktober 2023</p>
            </div>
            <div class="bg-red-500 text-white text-center py-2">
              <a class="block" href="#"> Lihat Lebih Lanjut </a>
            </div>
          </div>
          <!-- Card 3 -->
          <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <img
              alt="Group of people having lunch together at a table"
              class="w-full h-48 object-cover"
              height="400"
              src="https://storage.googleapis.com/a1aa/image/q80h17oW6ZpGCRn52rUeMWVow23Uq6QcDrQtkDm6l5ms0z2JA.jpg"
              width="600"
            />
            <div class="p-4">
              <div class="flex items-center mb-2">
                <i class="fab fa-instagram text-gray-500 mr-2"> </i>
                <span class="text-gray-500"> Instagram </span>
              </div>
              <p class="text-gray-800 mb-4">Makan siang bersama teman!</p>
              <div class="flex justify-between items-center">
                <div class="flex space-x-2 text-gray-500 items-center">
                  <i class="far fa-heart"> </i>
                  <span> 150 </span>
                  <i class="far fa-comment"> </i>
                  <span> 30 </span>
                </div>
              </div>
              <p class="text-gray-500 mt-2">8 Oktober 2023</p>
            </div>
            <div class="bg-red-500 text-white text-center py-2">
              <a class="block" href="#"> Lihat Lebih Lanjut </a>
            </div>
          </div>
          <!-- Card 3 -->
          <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <img
              alt="Group of people having lunch together at a table"
              class="w-full h-48 object-cover"
              height="400"
              src="https://storage.googleapis.com/a1aa/image/q80h17oW6ZpGCRn52rUeMWVow23Uq6QcDrQtkDm6l5ms0z2JA.jpg"
              width="600"
            />
            <div class="p-4">
              <div class="flex items-center mb-2">
                <i class="fab fa-instagram text-gray-500 mr-2"> </i>
                <span class="text-gray-500"> Instagram </span>
              </div>
              <p class="text-gray-800 mb-4">Makan siang bersama teman!</p>
              <div class="flex justify-between items-center">
                <div class="flex space-x-2 text-gray-500 items-center">
                  <i class="far fa-heart"> </i>
                  <span> 150 </span>
                  <i class="far fa-comment"> </i>
                  <span> 30 </span>
                </div>
              </div>
              <p class="text-gray-500 mt-2">8 Oktober 2023</p>
            </div>
            <div class="bg-red-500 text-white text-center py-2">
              <a class="block" href="#"> Lihat Lebih Lanjut </a>
            </div>
          </div>
          <!-- Card 3 -->
          <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <img
              alt="Group of people having lunch together at a table"
              class="w-full h-48 object-cover"
              height="400"
              src="https://storage.googleapis.com/a1aa/image/q80h17oW6ZpGCRn52rUeMWVow23Uq6QcDrQtkDm6l5ms0z2JA.jpg"
              width="600"
            />
            <div class="p-4">
              <div class="flex items-center mb-2">
                <i class="fab fa-instagram text-gray-500 mr-2"> </i>
                <span class="text-gray-500"> Instagram </span>
              </div>
              <p class="text-gray-800 mb-4">Makan siang bersama teman!</p>
              <div class="flex justify-between items-center">
                <div class="flex space-x-2 text-gray-500 items-center">
                  <i class="far fa-heart"> </i>
                  <span> 150 </span>
                  <i class="far fa-comment"> </i>
                  <span> 30 </span>
                </div>
              </div>
              <p class="text-gray-500 mt-2">8 Oktober 2023</p>
            </div>
            <div class="bg-red-500 text-white text-center py-2">
              <a class="block" href="#"> Lihat Lebih Lanjut </a>
            </div>
          </div>
          
        </div>
      </div>
    </div>
  </body>
</html>
