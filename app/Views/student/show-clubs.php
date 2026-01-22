<?php
?>

<style>
    /* Override container for full-width clubs view */
    body {
        background: #0f172a !important;
        color: #fff;
    }
    
    .container {
        width: 95% !important;
        max-width: 1400px !important;
        margin: 20px auto !important;
        background: transparent !important;
        padding: 0 16px !important;
        box-shadow: none !important;
    }

    .clubs-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-bottom: 24px;
        border-bottom: 1px solid #334155;
        margin-bottom: 32px;
    }

    .clubs-header h1 {
        color: #fff;
        font-size: 2rem;
        font-weight: 900;
        margin: 0;
        letter-spacing: -0.033em;
    }

    .clubs-header p {
        color: #94a3b8;
        margin: 6px 0 0 0;
        font-size: 0.9rem;
    }

    .clubs-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 16px;
        max-width: 100%;
        width: 100%;
    }

    .club-card {
        background: #1e293b;
        border: 1px solid #334155;
        border-radius: 12px;
        overflow: hidden;
        transition: all 0.3s ease;
        cursor: pointer;
        text-decoration: none;
        color: inherit;
        display: block;
        max-width: 100%;
    }

    .club-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
    }

    .club-header {
        height: 80px;
        position: relative;
    }

    .club-header.gradient-1 {
        background: linear-gradient(135deg, #3b82f6, #8b5cf6);
    }

    .club-header.gradient-2 {
        background: linear-gradient(135deg, #10b981, #14b8a6);
    }

    .club-header.gradient-3 {
        background: linear-gradient(135deg, #ec4899, #f43f5e);
    }

    .club-header.gradient-4 {
        background: linear-gradient(135deg, #f97316, #dc2626);
    }

    .club-header.gradient-5 {
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
    }

    .club-header.gradient-6 {
        background: linear-gradient(135deg, #eab308, #f59e0b);
    }

    .club-header::after {
        content: '';
        position: absolute;
        inset: 0;
        background: rgba(0, 0, 0, 0.2);
    }

    .club-badge {
        position: absolute;
        bottom: 12px;
        left: 12px;
        background: rgba(30, 41, 59, 0.9);
        backdrop-filter: blur(8px);
        padding: 4px 10px;
        border-radius: 6px;
        z-index: 1;
    }

    .club-badge span {
        font-size: 0.6875rem;
        font-weight: 700;
        color: #0d7ff2;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .club-body {
        padding: 16px;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .club-title-row {
        display: flex;
        align-items: start;
        justify-content: space-between;
        gap: 8px;
    }

    .club-title {
        color: #fff;
        font-size: 1rem;
        font-weight: 700;
        margin: 0;
        line-height: 1.3;
        flex: 1;
    }

    .club-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        border: 2px solid #334155;
        font-size: 1.25rem;
    }

    .club-description {
        color: #94a3b8;
        font-size: 0.8125rem;
        line-height: 1.4;
        margin: 0;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .club-meta {
        display: flex;
        align-items: center;
        gap: 12px;
        padding-top: 10px;
        border-top: 1px solid #334155;
        font-size: 0.6875rem;
        color: #64748b;
    }

    .club-meta-item {
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .club-meta-icon {
        font-size: 0.875rem;
    }

    .club-button {
        width: 100%;
        margin-top: 6px;
        padding: 8px;
        background: rgba(13, 127, 242, 0.1);
        border: 1px solid rgba(13, 127, 242, 0.2);
        border-radius: 8px;
        color: #0d7ff2;
        font-size: 0.8125rem;
        font-weight: 700;
        text-align: center;
        transition: all 0.2s ease;
        cursor: pointer;
    }

    .club-button:hover {
        background: rgba(13, 127, 242, 0.2);
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #64748b;
    }

    .empty-state-icon {
        font-size: 4rem;
        margin-bottom: 16px;
        opacity: 0.5;
    }

    @media (max-width: 768px) {
        .container {
            width: 100% !important;
            padding: 0 12px !important;
        }

        .clubs-grid {
            grid-template-columns: 1fr;
        }

        .clubs-header h1 {
            font-size: 1.5rem;
        }
    }

    @media (min-width: 769px) and (max-width: 1024px) {
        .clubs-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (min-width: 1025px) {
        .clubs-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    @media (min-width: 1400px) {
        .clubs-grid {
            grid-template-columns: repeat(4, 1fr);
        }
    }

    /* Material Icons fallback */
    .material-symbols-outlined {
        font-family: 'Material Symbols Outlined';
        font-weight: normal;
        font-style: normal;
        font-size: 24px;
        line-height: 1;
        letter-spacing: normal;
        text-transform: none;
        display: inline-block;
        white-space: nowrap;
        word-wrap: normal;
        direction: ltr;
    }
</style>

<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>

<div class="clubs-header">
    <div>
        <h1>Student Clubs</h1>
        <p>Discover and join communities that match your interests</p>
    </div>
</div>

<?php if (empty($clubs)): ?>
    <div class="empty-state">
        <div class="empty-state-icon">🎯</div>
        <h2 style="color: #94a3b8; margin: 0 0 8px 0;">No clubs found</h2>
        <p>Check back later for new club listings</p>
    </div>
<?php else: ?>
    <div class="clubs-grid">
        <?php 
        $gradients = ['gradient-1', 'gradient-2', 'gradient-3', 'gradient-4', 'gradient-5', 'gradient-6'];
        $icons = ['💻', '🌱', '📷', '🏀', '🚀', '🌍'];
        $index = 0;
        ?>
        
        <?php foreach ($clubs as $club): ?>
            <a href="/clubs/<?= $club['id'] ?>" class="club-card">
                <div class="club-header <?= $gradients[$index % count($gradients)] ?>">
                    <div class="club-badge">
                        <span>Active</span>
                    </div>
                </div>
                
                <div class="club-body">
                    <div class="club-title-row">
                        <h3 class="club-title"><?= htmlspecialchars($club['name']) ?></h3>
                        <div class="club-icon" style="background: <?= ['#3b82f6', '#10b981', '#ec4899', '#f97316', '#6366f1', '#eab308'][$index % 6] ?>;">
                            <?= $icons[$index % count($icons)] ?>
                        </div>
                    </div>
                    
                    <p class="club-description">
                        <?= htmlspecialchars($club['description']) ?>
                    </p>
                    
                    <div class="club-meta">
                        <div class="club-meta-item">
                            <span class="material-symbols-outlined club-meta-icon">person</span>
                            <span>President: <?= $club['president_id'] ? '#' . $club['president_id'] : 'None' ?></span>
                        </div>
                        <div class="club-meta-item">
                            <span class="material-symbols-outlined club-meta-icon">event</span>
                            <span><?= date('M Y', strtotime($club['created_at'])) ?></span>
                        </div>
                    </div>
                    
                    <div class="club-button">
                        View Club Details
                    </div>
                </div>
            </a>
            <?php $index++; ?>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<script>
    // Add smooth scroll behavior
    document.querySelectorAll('.club-card').forEach(card => {
        card.addEventListener('click', function(e) {
            if (e.target.classList.contains('club-button')) {
                e.preventDefault();
                window.location.href = this.href;
            }
        });
    });
</script>