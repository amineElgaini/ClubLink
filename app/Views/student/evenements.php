
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

<main class="bg-background-dark flex flex-1 justify-center py-8 px-4 md:px-6">
  <div class="flex flex-col max-w-[1100px] flex-1 gap-8">
    <section class="flex flex-col gap-6">
      <div class="w-full h-64 md:h-96 rounded-2xl overflow-hidden shadow-lg shadow-black/20 relative group border border-border-dark">
        <div class="w-full h-full bg-center bg-no-repeat bg-cover transform transition-transform duration-700 group-hover:scale-105" data-alt="Event image" style='background-image: url("<?= htmlspecialchars($result['image_url'] ?? '') ?>");'></div>
        <div class="absolute inset-0 bg-gradient-to-t from-background-dark via-transparent to-transparent opacity-80"></div>
      </div>
      <div class="flex flex-col lg:flex-row justify-between items-start lg:items-end gap-6 border-b border-border-dark pb-6">
        <div class="flex flex-col gap-3 flex-1">
          <h1 class="text-white text-3xl md:text-5xl font-black leading-tight tracking-[-0.033em]"><?= htmlspecialchars($result['title']) ?></h1>
        </div>
        <form action="<?= url('clubs/events/'.($result['id'] ?? 0).'/register') ?>" method="POST" class="flex shrink-0 w-full lg:w-auto">
          <button type="submit" class="w-full lg:w-auto bg-primary hover:bg-blue-600 text-white text-base font-bold py-3 px-8 rounded-xl shadow-lg shadow-blue-500/20 transition-all active:scale-95 flex items-center justify-center gap-2">
            <span class="material-symbols-outlined">how_to_reg</span> Register Now
          </button>
        </form>
      </div>
    </section>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
      <div class="lg:col-span-2 flex flex-col gap-10">

        <div class="bg-surface-dark p-6 rounded-xl border border-border-dark shadow-sm">
          <h3 class="text-xl font-bold mb-4 flex items-center gap-2 text-white">
            <span class="material-symbols-outlined text-primary">info</span> About this event
          </h3>
          <div class="prose prose-invert text-gray-300 leading-relaxed space-y-4 max-w-none">
            <p><?= htmlspecialchars($result['description'] ?? 'No description available.') ?></p>
          </div>
        </div>

        <div class="bg-surface-dark p-6 rounded-xl border border-border-dark shadow-sm">
          <h3 class="text-xl font-bold mb-4 flex items-center gap-2 text-white">
            <span class="material-symbols-outlined text-primary">article</span> Article
          </h3>
          <div class="prose prose-invert text-gray-300 leading-relaxed space-y-4 max-w-none">
            <?php if ($article && !empty($article['content'])): ?>
              <p><?= htmlspecialchars($article['content']) ?></p>
            <?php else: ?>
              <p>No article available for this event.</p>
            <?php endif; ?>
          </div>
        </div>

        <div class="flex flex-col gap-6 pt-6 border-t border-border-dark">
          <div class="flex items-center justify-between">
            <h3 class="text-2xl font-bold text-white">Reviews &amp; Ratings</h3>
            <button class="text-primary font-medium hover:underline text-sm md:hidden">Write a review</button>
          </div>

          <?php if (!empty($comment)): ?>
            <?php foreach ($comment as $c): ?>
              <div class="flex flex-col gap-4">
                <div class="bg-surface-dark rounded-lg p-4 border border-border-dark shadow-sm">
                  <div class="flex justify-between items-start mb-2">
                    <div class="flex items-center gap-3">
                      <div class="bg-center bg-no-repeat bg-cover rounded-full w-10 h-10" style="background-image: url('<?= htmlspecialchars($c['avatar'] ?? 'https://via.placeholder.com/40') ?>');"></div>
                      <div>
                        <p class="text-white font-medium text-sm"><?= htmlspecialchars($c['first_name'].' '.$c['last_name']) ?></p>
                      </div>
                    </div>
                  </div>
                  <p class="text-gray-300 text-sm leading-relaxed"><?= htmlspecialchars($c['comment']) ?></p>
                </div>
              </div>
            <?php endforeach; ?>
          <?php else: ?>
            <p class="text-gray-400">No reviews yet. Be the first to review!</p>
          <?php endif; ?>

          <div class="bg-surface-dark rounded-xl p-6 border border-border-dark mt-4 shadow-sm">
            <h4 class="text-lg font-bold mb-4 text-white">Leave a Review</h4>
            <form action='<?= url('/clubs/events/'.($result['id'] ?? 0).'/comments') ?>' method="POST" class="flex flex-col gap-4">
              <div>
                <label class="block text-sm font-medium text-gray-400 mb-2">Your Rating (1 out of 5)</label>
                <input class="text-primary" type="range" min="1" max="5" value="" name="rating"/>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-400 mb-2">Your Review</label>
                <textarea name="review" class="w-full rounded-lg bg-background-dark border-border-dark p-4 text-white placeholder:text-gray-500 focus:ring-2 focus:ring-primary h-32 resize-none" placeholder="Share your experience with us..."></textarea>
              </div>
              <div class="flex justify-end">
                <button class="bg-primary/10 hover:bg-primary/20 text-primary font-bold py-2 px-6 rounded-lg transition-colors border border-primary/20">Submit Review</button>
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
