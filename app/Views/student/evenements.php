<!DOCTYPE html>
<html class="light" lang="en">

<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <title>Event Details and Reviews - UniEvents</title>
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com" rel="preconnect" />
  <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
  <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&amp;family=Noto+Sans:wght@300..800&amp;display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet" />
  <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
  <script id="tailwind-config">
    tailwind.config = {
      darkMode: "class",
      theme: {
        extend: {
          colors: {
            "primary": "#0d7ff2",
            "background-light": "#f5f7f8",
            "background-dark": "#0f172a",
            "surface-light": "#ffffff",
            "surface-dark": "#1e293b",
            "border-dark": "#334155",
          },
          fontFamily: {
            "display": ["Lexend", "sans-serif"],
            "body": ["Noto Sans", "sans-serif"],
          },
          borderRadius: {
            "DEFAULT": "0.25rem",
            "lg": "0.5rem",
            "xl": "0.75rem",
            "full": "9999px"
          },
        },
      },
    }
  </script>
  <style>
    .material-symbols-outlined {
      font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24;
    }

    .star-filled {
      font-variation-settings: 'FILL' 1;
      color: #fbbf24;
    }

    .star-empty {
      font-variation-settings: 'FILL' 0;
      color: #d1d5db;
    }
  </style>
</head>

<body class="bg-background-dark text-white font-display overflow-x-hidden transition-colors duration-200 antialiased">
  <header class="sticky top-0 z-50 bg-surface-dark border-b border-border-dark">
    <div class="px-4 md:px-10 py-3 flex items-center justify-between max-w-[1280px] mx-auto w-full">
      <div class="flex items-center gap-8">
        <div class="flex items-center gap-4 text-white">
          <div class="size-8 text-primary">
            <svg class="w-full h-full" fill="none" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
              <path d="M42.4379 44C42.4379 44 36.0744 33.9038 41.1692 24C46.8624 12.9336 42.2078 4 42.2078 4L7.01134 4C7.01134 4 11.6577 12.932 5.96912 23.9969C0.876273 33.9029 7.27094 44 7.27094 44L42.4379 44Z" fill="currentColor"></path>
            </svg>
          </div>
          <h2 class="text-xl font-bold leading-tight tracking-[-0.015em]"> club
          </h2>
        </div>

      </div>
      <div class="flex items-center gap-4 md:gap-8">
        <label class="hidden md:flex flex-col min-w-40 !h-10 max-w-64">
        </label>
        <div class="bg-center bg-no-repeat bg-cover rounded-full size-10 ring-2 ring-border-dark shadow-sm cursor-pointer" data-alt="User profile avatar showing a smiling student" style='background-image: url();'></div>
      </div>
    </div>
  </header>
  <main class=" bg-background-dark flex flex-1 justify-center py-8 px-4 md:px-6">
    <div class="flex flex-col max-w-[1100px] flex-1 gap-8">
      <section class="flex flex-col gap-6">
        <div class="w-full h-64 md:h-96 rounded-2xl overflow-hidden shadow-lg shadow-black/20 relative group border border-border-dark">
          <div class="w-full h-full bg-center bg-no-repeat bg-cover transform transition-transform duration-700 group-hover:scale-105" data-alt="Students collaborating on laptops during a hackathon event" style='background-image: url(<?= $result['image_url'] ?>);'></div>
          <div class="absolute inset-0 bg-gradient-to-t from-background-dark via-transparent to-transparent opacity-80"></div>
          <div class="absolute bottom-4 left-4 md:bottom-6 md:left-6 flex gap-2">
            <span class="px-3 py-1 bg-surface-dark/90 text-xs font-bold uppercase tracking-wider rounded-md backdrop-blur-sm shadow-sm text-primary border border-border-dark">Technology</span>
            <span class="px-3 py-1 bg-surface-dark/90 text-xs font-bold uppercase tracking-wider rounded-md backdrop-blur-sm shadow-sm text-white border border-border-dark">Free</span>
          </div>
        </div>
        <div class="flex flex-col lg:flex-row justify-between items-start lg:items-end gap-6 border-b border-border-dark pb-6">
          <div class="flex flex-col gap-3 flex-1">
              <h1 class="text-white text-3xl md:text-5xl font-black leading-tight tracking-[-0.033em]"><?= $result['title'] ?></h1>
            <div class="flex flex-wrap items-center gap-y-2 gap-x-6 text-gray-400 mt-2">
              
              
            </div>
          </div>
          <div class="flex shrink-0 w-full lg:w-auto">
            <button class="w-full lg:w-auto bg-primary hover:bg-blue-600 text-white text-base font-bold py-3 px-8 rounded-xl shadow-lg shadow-blue-500/20 transition-all active:scale-95 flex items-center justify-center gap-2">
              <span class="material-symbols-outlined">how_to_reg</span>
              Register Now
            </button>
          </div>
        </div>
      </section>
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 flex flex-col gap-10">
          <div class="bg-surface-dark p-6 rounded-xl border border-border-dark shadow-sm">
            <h3 class="text-xl font-bold mb-4 flex items-center gap-2 text-white">
              <span class="material-symbols-outlined text-primary">info</span>
              About this event
            </h3>
            <div class="prose prose-invert text-gray-300 leading-relaxed space-y-4 max-w-none">
              <p>
                <?= $result['description'] ?>
              </p>
            </div>
          </div>
          <div class="bg-surface-dark p-6 rounded-xl border border-border-dark shadow-sm">
            <h3 class="text-xl font-bold mb-4 flex items-center gap-2 text-white">
              <span class="material-symbols-outlined text-primary">info</span>
              Articles
            </h3>
            <div class="prose prose-invert text-gray-300 leading-relaxed space-y-4 max-w-none">
              <p>
                <?= $result['content'] ?>
              </p>
            </div>
          </div>

          <div class="flex flex-col gap-6 pt-6 border-t border-border-dark">
            <div class="flex items-center justify-between">
              <h3 class="text-2xl font-bold text-white">Reviews &amp; Ratings</h3>
              <button class="text-primary font-medium hover:underline text-sm md:hidden">Write a review</button>
            </div>
            <div class="bg-surface-dark border border-border-dark rounded-xl p-6 flex flex-col md:flex-row gap-8 items-center md:items-start shadow-sm">
              <div class="flex flex-col items-center justify-center text-center min-w-[140px]">
                <span class="text-5xl font-black text-white"><?= $result['rating'] ?></span>

                <span class="text-sm text-gray-400">Based on 124 reviews</span>
              </div>
              <div class="flex-1 w-full space-y-2">
                <div class="flex items-center gap-3 text-sm">
                  <span class="w-3 font-medium text-gray-300">5</span>
                  <div class="flex-1 h-2 bg-background-dark rounded-full overflow-hidden">
                    <div class="h-full bg-yellow-400 w-[75%] rounded-full"></div>
                  </div>
                  <span class="w-8 text-right text-gray-400">75%</span>
                </div>
                <div class="flex items-center gap-3 text-sm">
                  <span class="w-3 font-medium text-gray-300">4</span>
                  <div class="flex-1 h-2 bg-background-dark rounded-full overflow-hidden">
                    <div class="h-full bg-yellow-400 w-[15%] rounded-full"></div>
                  </div>
                  <span class="w-8 text-right text-gray-400">15%</span>
                </div>
                <div class="flex items-center gap-3 text-sm">
                  <span class="w-3 font-medium text-gray-300">3</span>
                  <div class="flex-1 h-2 bg-background-dark rounded-full overflow-hidden">
                    <div class="h-full bg-yellow-400 w-[5%] rounded-full"></div>
                  </div>
                  <span class="w-8 text-right text-gray-400">5%</span>
                </div>
                <div class="flex items-center gap-3 text-sm">
                  <span class="w-3 font-medium text-gray-300">2</span>
                  <div class="flex-1 h-2 bg-background-dark rounded-full overflow-hidden">
                    <div class="h-full bg-gray-600 w-[2%] rounded-full"></div>
                  </div>
                  <span class="w-8 text-right text-gray-400">2%</span>
                </div>
                <div class="flex items-center gap-3 text-sm">
                  <span class="w-3 font-medium text-gray-300">1</span>
                  <div class="flex-1 h-2 bg-background-dark rounded-full overflow-hidden">
                    <div class="h-full bg-gray-600 w-[3%] rounded-full"></div>
                  </div>
                  <span class="w-8 text-right text-gray-400">3%</span>
                </div>
              </div>
            </div>
            <?php
            foreach ($comment as $c) {
              echo "
              <div class='flex flex-col gap-4'>
              <div class='bg-surface-dark rounded-lg p-4 border border-border-dark shadow-sm'>
                <div class='flex justify-between items-start mb-2'>
                  <div class='flex items-center gap-3'>
                    <div class='bg-center bg-no-repeat bg-cover rounded-full size-10' data-alt='Profile picture of Sarah J.' style='background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuA7jhfEBU2TQFbhhAOcMRS_NgcdTxbP_Qtv4JEqxcs1viL2rpBE0ePPN5GcGTUUQLONHWYPM6PeLiBngsNxv0oPcC-5VbUnabLJR9NJ_h8UjM5-ArdatD2y8so_U9fBtc3NukPXxlctky99_oJTg2bjgev_NQUFrignKboToFyLYGnIpwhVl45qu7lzawWtdmHcH71EkJYgOye23TzQJwTXgMCg6_ZOQWun3qSJstbtmut5hDB9Lbff83291C47u95BkJDH74SVTMM');'></div>
                    <div>
                      <p class='text-white font-medium text-sm'>" . $c['first_name'] . " " . $c['last_name'] . "</p>
                    </div>
                  </div>
                </div>
                <p class='text-gray-300 text-sm leading-relaxed'>" . $c['comment'] . "</p>
              </div>
            </div>
              ";
            }
            ?>
            <div class="bg-surface-dark rounded-xl p-6 border border-border-dark mt-4 shadow-sm">
              <h4 class="text-lg font-bold mb-4 text-white">Leave a Review</h4>

              <form action='./comments' method="POST" class="flex flex-col gap-4">
                <div>
                  <label class="block text-sm font-medium text-gray-400 mb-2">Your Rating (1 out of 5)</label>
                    <input class="text-primary" type="range" min="1" max="5" value ="" name = "rating"/>
                  
                </div>
                <div>
                  <label class="block text-sm font-medium text-gray-400 mb-2">Your Review</label>
                  <textarea name="review" class="w-full rounded-lg bg-background-dark border-border-dark p-4 text-white placeholder:text-gray-500 focus:ring-2 focus:ring-primary h-32 resize-none" placeholder="Share your experience with us..."></textarea>
                </div>
                <div class="flex justify-end">
                  <button class="bg-primary/10 hover:bg-primary/20 text-primary font-bold py-2 px-6 rounded-lg transition-colors border border-primary/20">
                    Submit Review
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>


</body>

</html>
