<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
?>


<!DOCTYPE html>
<html class="dark" lang="en">
<head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
  <title>Club Details - <?= htmlspecialchars($club['name']) ?></title>

  <link href="https://fonts.googleapis.com" rel="preconnect"/>
  <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
  <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@300;400;500;600;700&family=Noto+Sans:wght@400;500;700&display=swap" rel="stylesheet"/>

  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
  <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>

  <script id="tailwind-config">
    tailwind.config = {
      darkMode: "class",
      theme: {
        extend: {
          colors: {
            "primary": "#0d7ff2",
            "background-light": "#f5f7f8",
            "background-dark": "#101922",
            "card-dark": "#16202a",
            "card-lighter": "#1c2836",
            "text-subtle": "#9cabba",
          },
          fontFamily: {
            "display": ["Lexend", "sans-serif"],
            "body": ["Noto Sans", "sans-serif"],
          },
          borderRadius: {"DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "full": "9999px"},
        },
      },
    }
  </script>
</head>

<body class="bg-background-light dark:bg-background-dark text-slate-900 dark:text-white font-display antialiased selection:bg-primary selection:text-white overflow-x-hidden">
    <div class="relative flex min-h-screen w-full flex-col">

    <!-- Header (keep as-is) -->
    <header class="sticky top-0 z-50 flex items-center justify-between whitespace-nowrap border-b border-solid border-b-slate-200 dark:border-b-[#283039] bg-background-light/95 dark:bg-background-dark/95 backdrop-blur-md px-4 sm:px-10 py-3">
        <div class="flex items-center gap-8">
        <div class="flex items-center gap-4 text-slate-900 dark:text-white cursor-pointer">
            <div class="size-8 text-primary">
            <svg class="w-full h-full" fill="none" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                <path d="M24 4C25.7818 14.2173 33.7827 22.2182 44 24C33.7827 25.7818 25.7818 33.7827 24 44C22.2182 33.7827 14.2173 25.7818 4 24C14.2173 22.2182 22.2182 14.2173 24 4Z" fill="currentColor"></path>
            </svg>
            </div>
            <h2 class="text-lg font-bold leading-tight tracking-[-0.015em]">CampusClubs</h2>
        </div>
        </div>
    </header>

    <div class="flex-1 flex flex-col items-center">
        <div class="w-full max-w-[1200px] flex flex-col px-4 sm:px-6 lg:px-8 py-6">

        <!-- Breadcrumbs -->
        <div class="flex flex-wrap gap-2 pb-6">
            <span class="text-slate-500 dark:text-[#9cabba] text-sm font-medium leading-normal">Home</span>
            <span class="text-slate-500 dark:text-[#9cabba] text-sm font-medium leading-normal">/</span>
            <span class="text-slate-500 dark:text-[#9cabba] text-sm font-medium leading-normal">Clubs</span>
            <span class="text-slate-500 dark:text-[#9cabba] text-sm font-medium leading-normal">/</span>
            <span class="text-slate-900 dark:text-white text-sm font-medium leading-normal"><?= htmlspecialchars($club['name']) ?></span>
        </div>

        <!-- Hero -->
        <div class="relative overflow-hidden rounded-xl bg-card-lighter p-6 sm:p-8 shadow-lg mb-8 border border-white/5">
            <div class="absolute top-0 right-0 -mt-10 -mr-10 h-64 w-64 rounded-full bg-primary/10 blur-3xl"></div>

            <div class="relative z-10 flex flex-col md:flex-row gap-6 md:items-center justify-between">
            <div class="flex flex-col sm:flex-row gap-6 items-start sm:items-center">
                <div class="bg-white dark:bg-white/10 p-1 rounded-full">
                <div class="bg-center bg-no-repeat bg-cover rounded-full h-24 w-24 sm:h-32 sm:w-32 shadow-xl"
                    style='background-image: url("<?= htmlspecialchars($club['logo_url']) ?>");'></div>
                </div>

                <div class="flex flex-col justify-center">
                <h1 class="text-3xl sm:text-4xl font-bold leading-tight tracking-tight text-slate-900 dark:text-white mb-2">
                    <?= htmlspecialchars($club['name']) ?>
                </h1>

                <p class="text-slate-600 dark:text-[#9cabba] text-lg font-normal leading-normal max-w-2xl">
                    <?= htmlspecialchars($club['tagline']) ?>
                </p>

                <div class="flex items-center gap-2 mt-3 text-sm font-medium text-slate-500 dark:text-slate-400">
                    <span class="material-symbols-outlined text-[18px]">location_on</span>
                    <span><?= htmlspecialchars($club['location']) ?></span>
                    <span class="mx-2">•</span>
                </div>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto mt-4 md:mt-0">
                <?php if ($club['is_full']): ?>
                <button disabled class="flex items-center justify-center gap-2 rounded-lg bg-slate-500/40 text-white font-bold h-12 px-6 w-full sm:w-auto cursor-not-allowed">
                    <span class="material-symbols-outlined">hourglass</span>
                    <span>Full</span>
                </button>
                <?php else: ?>
                    <?php if (!empty($_SESSION['user']) && !$club['is_full'] && empty($userClubId)): ?>
                        <form method="POST" action="/clubs/<?= (int)$club['id'] ?>/join">
                            <button class="flex items-center justify-center gap-2 rounded-lg bg-primary hover:bg-blue-600 text-white font-bold h-12 px-6 transition-all shadow-[0_0_15px_rgba(13,127,242,0.3)] w-full sm:w-auto">
                            <span class="material-symbols-outlined">group_add</span>
                            <span>Join Club</span>
                            </button>
                        </form>
                        <?php else: ?>
                        <button disabled class="flex items-center justify-center gap-2 rounded-lg bg-slate-500/40 text-white font-bold h-12 px-6 w-full sm:w-auto cursor-not-allowed">
                            <span class="material-symbols-outlined">lock</span>
                            <span>
                            <?php
                                if (empty($_SESSION['user'])) echo "Login to join";
                                elseif (!empty($userClubId)) echo "Already in a club";
                                else echo "Club full";
                            ?>
                            </span>
                        </button>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
            </div>
        </div>

            <!-- Main Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

                <!-- Left -->
                <div class="lg:col-span-8 flex flex-col gap-8">

                    <!-- President -->
                    <section>
                        <h2 class="text-xl font-bold text-slate-900 dark:text-white mb-4 flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">verified_user</span>
                        Club President
                        </h2>

                        <div class="flex items-stretch justify-between gap-4 rounded-xl bg-card-lighter p-5 border border-white/5 shadow-sm relative overflow-hidden">
                        <div class="absolute left-0 top-0 bottom-0 w-1 bg-primary"></div>

                        <div class="flex flex-col justify-center gap-4 z-10">
                            <?php if (!empty($president)): ?>
                            <div class="flex flex-col gap-1">
                                <p class="text-slate-900 dark:text-white text-xl font-bold leading-tight"><?= htmlspecialchars($president['full_name']) ?></p>
                                <p class="text-primary font-medium text-sm"><?= htmlspecialchars($president['subtitle']) ?></p>
                                <p class="text-slate-500 dark:text-[#9cabba] text-sm mt-1 max-w-md">"<?= htmlspecialchars($president['quote']) ?>"</p>
                            </div>
                            <?php else: ?>
                            <p class="text-slate-500 dark:text-[#9cabba]">Not assigned yet.</p>
                            <?php endif; ?>
                        </div>

                        <div class="hidden sm:block w-32 h-32 bg-center bg-no-repeat bg-cover rounded-lg shrink-0 border border-white/10"
                            style='background-image: url("<?= htmlspecialchars($president['avatar_url'] ?? "https://ui-avatars.com/api/?name=President") ?>");'></div>
                        </div>
                    </section>

                    <!-- About -->
                    <section>
                        <h2 class="text-xl font-bold text-slate-900 dark:text-white mb-4">About the Club</h2>
                        <div class="bg-card-dark rounded-xl p-6 border border-white/5 text-slate-600 dark:text-[#9cabba] leading-relaxed">
                        <p><?= nl2br(htmlspecialchars($club['description'])) ?></p>
                        </div>
                    </section>

                    <!-- Members -->
                    <section>
                        <div class="flex items-center justify-between mb-4">
                        <h2 class="text-xl font-bold text-slate-900 dark:text-white">Members</h2>
                        <span class="bg-primary/20 text-primary text-xs font-bold px-3 py-1 rounded-full">
                            <?= (int)$club['members_count'] ?> / <?= (int)$club['max_members'] ?> Spots Filled
                        </span>
                        </div>

                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                            <?php foreach ($members as $m): ?>
                                <div class="bg-card-lighter p-4 rounded-xl border border-white/5 flex flex-col items-center text-center gap-3">
                                <div class="w-16 h-16 rounded-full bg-cover bg-center ring-2 ring-primary/20"
                                    style='background-image: url("<?= htmlspecialchars($m['avatar_url']) ?>");'></div>
                                <div>
                                    <p class="text-slate-900 dark:text-white font-bold text-sm"><?= htmlspecialchars($m['full_name']) ?></p>
                                    <p class="text-slate-500 dark:text-[#9cabba] text-xs">Member</p>
                                </div>
                                </div>
                            <?php endforeach; ?>

                            <?php for ($i = 0; $i < (int)$club['open_spots']; $i++): ?>
                                <div class="rounded-xl border border-slate-200 dark:border-white/10 bg-white/60 dark:bg-white/5 p-4 flex flex-col items-center justify-center text-center gap-2 min-h-[148px]">
                                    <div class="w-16 h-16 rounded-full bg-slate-200/70 dark:bg-white/10"></div>
                                    <p class="text-slate-500 dark:text-[#9cabba] font-medium text-sm">No member yet</p>
                                    <p class="text-slate-400 dark:text-white/30 text-xs">Spot available</p>
                                </div>
                            <?php endfor; ?>
                        </div>
                    </section>

                </div>

                <!-- Right -->
                <div class="lg:col-span-4 flex flex-col gap-8">

                <!-- Past Events -->
                <div class="bg-card-lighter rounded-xl p-5 border border-white/5">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white">Events</h3>
                    </div>

                    <div class="flex flex-col gap-4">
                        <?php foreach ($pastEvents as $ev): ?>
                            <a href="/ClubLink/clubs/events/<?= (int)$ev['id'] ?>" class="flex gap-4 items-start group">
                                <div class="flex flex-col items-center justify-center bg-background-dark rounded w-12 h-12 border border-white/10 shrink-0">
                                <span class="text-[10px] font-bold text-primary uppercase"><?= htmlspecialchars($ev['month']) ?></span>
                                <span class="text-lg font-bold text-white leading-none"><?= htmlspecialchars($ev['day']) ?></span>
                                </div>

                                <div>
                                <h4 class="text-slate-900 dark:text-white font-semibold text-sm group-hover:text-primary transition-colors">
                                    <?= htmlspecialchars($ev['title']) ?>
                                </h4>
                                <p class="text-xs text-slate-500 dark:text-[#9cabba] mt-1 line-clamp-2">
                                    <?= htmlspecialchars($ev['description']) ?>
                                </p>
                                </div>
                            </a>
                        <?php endforeach; ?>
                        <?php if (empty($pastEvents)): ?>
                            <p class="text-sm text-slate-500 dark:text-[#9cabba]">No events yet.</p>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Articles -->
                <div class="bg-card-lighter rounded-xl p-5 border border-white/5">
                    <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white">Recent Articles</h3>
                    </div>

                    <div class="flex flex-col gap-4">
                    <?php foreach ($recentArticles as $a): ?>
                        <div class="flex gap-3 items-center">
                        <div class="cursor-pointer h-16 w-20 shrink-0 rounded bg-cover bg-center"
                            style='background-image: url("<?= htmlspecialchars($a['image_url'] ?? "https://picsum.photos/200") ?>");'>
                        </div>
                        <div class="cursor-pointer">
                            <h4 class="text-slate-900 dark:text-white font-bold text-sm"><?= htmlspecialchars($a['title']) ?></h4>
                            <p class="text-xs text-slate-500 dark:text-[#9cabba]"><?= htmlspecialchars($a['date_text']) ?></p>
                        </div>
                        </div>
                    <?php endforeach; ?>
                    <?php if (empty($recentArticles)): ?>
                        <p class="text-sm text-slate-500 dark:text-[#9cabba]">No articles yet.</p>
                    <?php endif; ?>
                    </div>
                </div>

                </div>
            </div>

        </div>
    </div>
    </div>
</body>
</html>
