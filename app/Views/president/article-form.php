<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
?>

<!DOCTYPE html>
<html class="dark" lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?></title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@300;400;500;700;800&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#0d7ff2",
                        "background-light": "#f5f7f8",
                        "background-dark": "#0a0f16",
                        "card-dark": "#1a242f",
                        "frame-light": "#ffffff",
                        "frame-dark": "#161f2a"
                    },
                    fontFamily: {
                        "display": ["Lexend", "sans-serif"]
                    },
                    borderRadius: {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "2xl": "1rem",
                        "3xl": "1.5rem",
                        "full": "9999px"
                    },
                },
            },
        }
    </script>
    <style type="text/tailwindcss">
        body {
            font-family: 'Lexend', sans-serif;
        }
        .grainy-bg {
            background-image: radial-gradient(circle at 2px 2px, rgba(255,255,255,0.03) 1px, transparent 0);
            background-size: 40px 40px;
        }
        .editor-toolbar-btn {
            @apply p-1.5 hover:bg-slate-100 dark:hover:bg-slate-700 rounded transition-colors text-slate-600 dark:text-slate-400;
        }
    </style>
</head>

<body class="bg-background-light dark:bg-background-dark text-slate-900 dark:text-slate-100 min-h-screen flex flex-col grainy-bg">
    <header class="w-full border-b border-solid border-slate-200 dark:border-slate-800 px-6 lg:px-12 py-4 flex items-center justify-between bg-background-light/80 dark:bg-background-dark/80 backdrop-blur-md sticky top-0 z-50">
        <div class="flex items-center gap-3">
            <div class="text-primary text-3xl">
                <svg class="w-8 h-8" fill="none" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                    <path d="M42.1739 20.1739L27.8261 5.82609C29.1366 7.13663 28.3989 10.1876 26.2002 13.7654C24.8538 15.9564 22.9595 18.3449 20.6522 20.6522C18.3449 22.9595 15.9564 24.8538 13.7654 26.2002C10.1876 28.3989 7.13663 29.1366 5.82609 27.8261L20.1739 42.1739C21.4845 43.4845 24.5355 42.7467 28.1133 40.548C30.3042 39.2016 32.6927 37.3073 35 35C37.3073 32.6927 39.2016 30.3042 40.548 28.1133C42.7467 24.5355 43.4845 21.4845 42.1739 20.1739Z" fill="currentColor"></path>
                </svg>
            </div>
            <h2 class="text-xl font-bold tracking-tight">CampusClubs</h2>
        </div>
        <nav class="hidden md:flex items-center gap-8">
            <a class="hover:text-primary transition-colors font-medium text-sm" href="<?= htmlspecialchars($dashboardHref) ?>">Dashboard</a>
            <a class="hover:text-primary transition-colors font-medium text-sm text-primary" href="<?= htmlspecialchars($clubHref) ?>">My Club</a>
            <div class="w-10 h-10 rounded-full border-2 border-primary/20 bg-cover bg-center" style="background-image: url('<?= htmlspecialchars($userAvatarUrl) ?>');"></div>
        </nav>
    </header>

    <main class="flex-grow max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-12 py-8">
        <nav aria-label="Breadcrumb" class="flex items-center gap-2 text-sm text-slate-500 mb-8">
            <a class="hover:text-primary transition-colors" href="<?= htmlspecialchars($dashboardHref) ?>">Dashboard</a>
            <span class="material-symbols-outlined text-xs">chevron_right</span>
            <a class="hover:text-primary transition-colors" href="<?= htmlspecialchars($clubHref) ?>">My Club</a>
            <span class="material-symbols-outlined text-xs">chevron_right</span>
            <span class="text-slate-900 dark:text-white font-semibold">Create Article</span>
        </nav>

        <?php if (!empty($_SESSION['error'])): ?>
            <div class="mb-6 p-4 bg-red-500/10 border border-red-500/20 rounded-xl text-red-500">
                <?= htmlspecialchars($_SESSION['error']) ?>
                <?php unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <div class="flex flex-col lg:flex-row gap-8 items-start">
            <div class="flex-grow lg:w-2/3">
                <div class="bg-frame-light dark:bg-frame-dark rounded-3xl shadow-xl shadow-slate-200/50 dark:shadow-black/20 border border-slate-200 dark:border-slate-800/60 overflow-hidden">
                    <div class="p-8 sm:p-10">
                        <header class="mb-10">
                            <h1 class="text-3xl font-extrabold tracking-tight text-slate-900 dark:text-white mb-3">
                                Publish Event Review</h1>
                            <p class="text-slate-500 dark:text-slate-400">Share the best moments and accomplishments of your club with the community.</p>
                        </header>

                        <form id="article-form" class="space-y-8" action="<?= htmlspecialchars($basePath) ?>/articles" method="POST">
                            <input type="hidden" name="club_id" value="<?= (int)$club['id'] ?>">

                            <!-- Event Selection -->
                            <div class="space-y-3">
                                <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wide" for="event_id">
                                    Select Past Event
                                </label>
                                
                                <?php if (empty($events) || (count($events) === 1 && (int)$events[0]['id'] === 0)): ?>
                                    <div class="p-4 bg-yellow-500/10 border border-yellow-500/20 rounded-xl text-yellow-600 dark:text-yellow-500 flex items-start gap-3">
                                        <span class="material-symbols-outlined">info</span>
                                        <div>
                                            <p class="font-semibold">No past events available</p>
                                            <p class="text-sm mt-1">You need to have past events to create an article. Create an event first!</p>
                                        </div>
                                    </div>
                                    <input type="hidden" name="event_id" value="0">
                                <?php else: ?>
                                    <select 
                                        id="event_id" 
                                        name="event_id" 
                                        class="w-full bg-slate-50 dark:bg-slate-900/50 border-slate-200 dark:border-slate-800 rounded-xl px-5 py-3.5 focus:ring-2 focus:ring-primary focus:border-transparent outline-none transition-all text-slate-900 dark:text-slate-100"
                                        onchange="updateEventInfo(this)"
                                        required>
                                        <?php foreach ($events as $evt): ?>
                                            <option 
                                                value="<?= (int)$evt['id'] ?>" 
                                                data-date="<?= htmlspecialchars($evt['formatted_date']) ?>"
                                                data-location="<?= htmlspecialchars($evt['location']) ?>"
                                                <?= (int)$evt['id'] === (int)$event['id'] ? 'selected' : '' ?>>
                                                <?= htmlspecialchars($evt['title']) ?> - <?= htmlspecialchars($evt['formatted_date']) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                <?php endif; ?>
                            </div>

                            <div class="space-y-3">
                                <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wide" for="article-title">
                                    Article Title
                                </label>
                                <input
                                    class="w-full bg-slate-50 dark:bg-slate-900/50 border-slate-200 dark:border-slate-800 rounded-xl px-5 py-3.5 focus:ring-2 focus:ring-primary focus:border-transparent outline-none transition-all placeholder:text-slate-400 dark:placeholder:text-slate-600 text-slate-900 dark:text-slate-100"
                                    id="article-title" 
                                    name="title"
                                    placeholder="Ex: Gala Night 2024 Retrospective" 
                                    type="text"
                                    value="<?= htmlspecialchars($article['title']) ?>" 
                                    required />
                            </div>

                            <div class="space-y-3">
                                <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wide">
                                    Cover Image
                                </label>
                                <div class="relative group">
                                    <div class="border-2 border-dashed border-slate-200 dark:border-slate-800 rounded-2xl overflow-hidden bg-slate-50/50 dark:bg-slate-900/30 hover:border-primary transition-all">
                                        <div class="aspect-[21/9] w-full relative flex flex-col items-center justify-center">
                                            <img 
                                                id="cover-preview"
                                                alt="Cover image preview"
                                                class="absolute inset-0 w-full h-full object-cover opacity-40 group-hover:opacity-50 transition-opacity"
                                                src="<?= htmlspecialchars($article['image_url']) ?>" />
                                            <div class="relative z-10 flex flex-col items-center p-6 text-center">
                                                <div class="w-14 h-14 rounded-full bg-primary/20 text-primary flex items-center justify-center mb-4 group-hover:scale-110 transition-transform backdrop-blur-sm">
                                                    <span class="material-symbols-outlined text-3xl">add_photo_alternate</span>
                                                </div>
                                                <p class="text-sm font-bold text-slate-900 dark:text-white drop-shadow-sm">
                                                    Change cover image (paste URL below)</p>
                                                <p class="text-xs text-slate-600 dark:text-slate-400 mt-1 font-medium bg-white/60 dark:bg-black/40 px-2 py-1 rounded-md backdrop-blur-sm">
                                                    Recommended: 1200x500px (JPG, PNG)</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input
                                    type="url"
                                    name="image_url"
                                    id="image_url"
                                    placeholder="https://example.com/image.jpg"
                                    class="w-full bg-slate-50 dark:bg-slate-900/50 border-slate-200 dark:border-slate-800 rounded-xl px-5 py-3 focus:ring-2 focus:ring-primary focus:border-transparent outline-none transition-all text-slate-900 dark:text-slate-100 text-sm"
                                    value="<?= htmlspecialchars($article['image_url']) ?>"
                                    onchange="document.getElementById('cover-preview').src = this.value" />
                            </div>

                            <div class="space-y-3">
                                <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wide">
                                    Detailed Description
                                </label>
                                <div class="border border-slate-200 dark:border-slate-800 rounded-xl overflow-hidden bg-white dark:bg-slate-900/30">
                                    <div class="flex flex-wrap items-center gap-1 p-2.5 border-b border-slate-200 dark:border-slate-800 bg-slate-50/80 dark:bg-slate-800/40">
                                        <button class="editor-toolbar-btn" type="button" title="Bold">
                                            <span class="material-symbols-outlined">format_bold</span>
                                        </button>
                                        <button class="editor-toolbar-btn" type="button" title="Italic">
                                            <span class="material-symbols-outlined">format_italic</span>
                                        </button>
                                        <button class="editor-toolbar-btn" type="button" title="Underline">
                                            <span class="material-symbols-outlined">format_underlined</span>
                                        </button>
                                        <div class="w-px h-6 bg-slate-200 dark:bg-slate-700 mx-1"></div>
                                        <button class="editor-toolbar-btn" type="button" title="Bullet List">
                                            <span class="material-symbols-outlined">format_list_bulleted</span>
                                        </button>
                                        <button class="editor-toolbar-btn" type="button" title="Numbered List">
                                            <span class="material-symbols-outlined">format_list_numbered</span>
                                        </button>
                                    </div>
                                    <textarea
                                        class="w-full bg-transparent border-none focus:ring-0 px-5 py-5 text-slate-700 dark:text-slate-300 resize-none min-h-[300px] leading-relaxed"
                                        placeholder="Tell about your event here..."
                                        rows="10"
                                        name="content"
                                        required><?= htmlspecialchars($article['content']) ?></textarea>
                                </div>
                            </div>

                            <div class="flex items-center justify-between pt-8 border-t border-slate-100 dark:border-slate-800/60">
                                <a href="<?= htmlspecialchars($clubHref) ?>" 
                                   class="px-6 py-3 rounded-xl border border-slate-200 dark:border-slate-700 font-semibold text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors flex items-center gap-2">
                                    <span class="material-symbols-outlined text-lg">arrow_back</span>
                                    Cancel
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <aside class="lg:w-1/3 w-full">
                <div class="sticky top-24 space-y-6">
                    <div class="bg-frame-light dark:bg-frame-dark rounded-3xl border border-slate-200 dark:border-slate-800 p-8 shadow-xl shadow-slate-200/50 dark:shadow-black/20">
                        <h3 class="text-lg font-bold mb-6 flex items-center gap-2 text-slate-900 dark:text-white">
                            <span class="material-symbols-outlined text-primary">analytics</span>
                            Publication Summary
                        </h3>

                        <div class="space-y-4">
                            <div class="p-4 bg-slate-50 dark:bg-slate-900/50 rounded-2xl border border-slate-100 dark:border-slate-800/40">
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-3">Linked Event</p>
                                <div class="flex items-start gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-primary/10 flex items-center justify-center text-primary shrink-0">
                                        <span class="material-symbols-outlined">celebration</span>
                                    </div>
                                    <div id="event-info">
                                        <p class="text-sm font-bold leading-tight text-slate-900 dark:text-white">
                                            <?= htmlspecialchars($event['title']) ?></p>
                                        <p class="text-xs text-slate-500 mt-1">Date: <span id="event-date"><?= htmlspecialchars($eventDateText) ?></span></p>
                                    </div>
                                </div>
                            </div>

                            <div class="space-y-3 py-2 px-1">
                                <div class="flex justify-between items-center text-sm">
                                    <span class="text-slate-500">Club</span>
                                    <span class="font-bold text-slate-700 dark:text-slate-300"><?= htmlspecialchars($club['name']) ?></span>
                                </div>

                                <div class="flex justify-between items-center text-sm">
                                    <span class="text-slate-500">Visibility</span>
                                    <span class="flex items-center gap-1 text-green-500 font-bold">
                                        <span class="material-symbols-outlined text-sm">public</span> Public
                                    </span>
                                </div>
                            </div>

                            <div class="pt-6 border-t border-slate-100 dark:border-slate-800/60">
                                <button
                                    class="w-full bg-primary hover:bg-primary/90 text-white font-bold py-4 rounded-xl shadow-lg shadow-primary/25 transition-all active:scale-[0.98] flex items-center justify-center gap-2 disabled:opacity-50 disabled:cursor-not-allowed"
                                    type="submit" 
                                    form="article-form"
                                    <?= (empty($events) || (count($events) === 1 && (int)$events[0]['id'] === 0)) ? 'disabled' : '' ?>>
                                    <span class="material-symbols-outlined">send</span>
                                    Publish Now
                                </button>
                                <p class="text-[11px] text-center text-slate-500 mt-4 leading-relaxed">
                                    By publishing, you accept the campus <a class="underline hover:text-primary transition-colors" href="#">moderation rules</a>.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-primary/5 rounded-2xl p-6 border border-primary/10">
                        <h4 class="font-bold text-sm text-primary mb-2 flex items-center gap-2">
                            <span class="material-symbols-outlined text-lg">lightbulb</span>
                            Tip
                        </h4>
                        <p class="text-sm text-slate-600 dark:text-slate-400 leading-relaxed">
                            Choose an impactful cover image. It will be the first thing students see in the news feed.
                        </p>
                    </div>
                </div>
            </aside>
        </div>
    </main>

    <footer class="mt-12 border-t border-slate-200 dark:border-slate-800 p-8 text-center text-slate-500 text-sm">
        <p>© 2024 CampusClubs Platform. University Services.</p>
    </footer>

    <script>
        // Update event info when selection changes
        function updateEventInfo(select) {
            const selectedOption = select.options[select.selectedIndex];
            const eventTitle = selectedOption.text.split(' - ')[0];
            const eventDate = selectedOption.getAttribute('data-date');
            
            const eventInfo = document.getElementById('event-info');
            if (eventInfo) {
                eventInfo.innerHTML = `
                    <p class="text-sm font-bold leading-tight text-slate-900 dark:text-white">${eventTitle}</p>
                    <p class="text-xs text-slate-500 mt-1">Date: <span id="event-date">${eventDate}</span></p>
                `;
            }
        }
    </script>
</body>

</html>