<?php
    print_r ($clubs);
?>
<style>
    .clubs-page {
        max-width: 1200px;
        margin: 0 auto;
        padding: 40px 20px;
    }

    .page-header {
        margin-bottom: 40px;
    }

    .page-header h1 {
        font-size: 32px;
        font-weight: 700;
        color: #f1f5f9;
        margin: 0 0 8px 0;
    }

    .page-header p {
        color: #94a3b8;
        margin: 0;
    }

    /* Add Club Card */
    .add-club-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 16px;
        padding: 32px;
        margin-bottom: 32px;
        box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
    }

    .add-club-card h2 {
        color: #fff;
        margin: 0 0 24px 0;
        font-size: 24px;
        font-weight: 600;
    }

    .form-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 16px;
        margin-bottom: 20px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
    }

    .form-group label {
        color: rgba(255, 255, 255, 0.9);
        font-size: 14px;
        font-weight: 500;
        margin-bottom: 8px;
    }

    .form-group input {
        padding: 12px 16px;
        border: 2px solid rgba(255, 255, 255, 0.2);
        border-radius: 8px;
        background: rgba(255, 255, 255, 0.1);
        color: #fff;
        font-size: 15px;
        transition: all 0.3s ease;
        width: 100%;
        box-sizing: border-box;
    }

    .form-group input::placeholder {
        color: rgba(255, 255, 255, 0.5);
    }

    .form-group input:focus {
        outline: none;
        border-color: rgba(255, 255, 255, 0.5);
        background: rgba(255, 255, 255, 0.15);
    }

    .btn-add {
        background: #fff;
        color: #667eea;
        padding: 12px 32px;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        font-size: 15px;
        cursor: pointer;
        transition: all 0.3s ease;
        width: auto;
        margin-top: 8px;
    }

    .btn-add:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
    }

    /* Clubs Grid */
    .clubs-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
        gap: 24px;
    }

    .club-card {
        background: #1e293b;
        border-radius: 12px;
        padding: 24px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
        transition: all 0.3s ease;
        border: 1px solid #334155;
    }

    .club-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.4);
        border-color: #475569;
    }

    .club-header {
        display: flex;
        justify-content: space-between;
        align-items: start;
        margin-bottom: 16px;
    }

    .club-id {
        background: #334155;
        color: #94a3b8;
        padding: 4px 12px;
        border-radius: 6px;
        font-size: 13px;
        font-weight: 600;
    }

    .club-card h3 {
        font-size: 20px;
        color: #f1f5f9;
        margin: 0 0 8px 0;
        font-weight: 600;
    }

    .club-description {
        color: #94a3b8;
        font-size: 14px;
        line-height: 1.6;
        margin-bottom: 16px;
        min-height: 42px;
    }

    .club-president {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 20px;
        padding: 12px;
        background: #0f172a;
        border-radius: 8px;
        border: 1px solid #334155;
    }

    .president-icon {
        width: 32px;
        height: 32px;
        background: #667eea;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 14px;
        font-weight: 600;
    }

    .president-info {
        flex: 1;
    }

    .president-label {
        font-size: 12px;
        color: #64748b;
        margin: 0;
    }

    .president-id {
        font-size: 14px;
        color: #cbd5e1;
        font-weight: 600;
        margin: 0;
    }

    /* Update Form in Card */
    .update-form {
        background: #0f172a;
        padding: 16px;
        border-radius: 8px;
        margin-bottom: 16px;
        border: 1px solid #334155;
    }

    .update-form input {
        width: 100%;
        padding: 10px 12px;
        margin-bottom: 10px;
        border: 1px solid #334155;
        border-radius: 6px;
        font-size: 14px;
        box-sizing: border-box;
        background: #1e293b;
        color: #f1f5f9;
    }

    .update-form input:focus {
        outline: none;
        border-color: #667eea;
    }

    .update-form input::placeholder {
        color: #64748b;
    }

    /* Action Buttons */
    .action-buttons {
        display: flex;
        gap: 8px;
    }

    .btn {
        padding: 10px 20px;
        border: none;
        border-radius: 6px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        flex: 1;
    }

    .btn-update {
        background: #667eea;
        color: #fff;
    }

    .btn-update:hover {
        background: #5568d3;
        transform: translateY(-1px);
    }

    .btn-delete {
        background: #ef4444;
        color: #fff;
    }

    .btn-delete:hover {
        background: #dc2626;
        transform: translateY(-1px);
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #64748b;
    }

    .empty-state h3 {
        color: #94a3b8;
        margin-bottom: 8px;
    }

    .empty-state svg {
        width: 80px;
        height: 80px;
        margin-bottom: 16px;
        opacity: 0.5;
    }
</style>

<div class="clubs-page">
    <div class="page-header">
        <h1>Manage Clubs</h1>
        <p>Create, update, and manage all clubs in the platform</p>
    </div>

    <!-- Add Club Form -->
    <div class="add-club-card">
        <h2>➕ Add New Club</h2>
        <form method="POST" action="<?= url('/admin/clubs') ?>">
            <div class="form-grid">
                <div class="form-group">
                    <label>Club Name</label>
                    <input type="text" name="name" placeholder="e.g., Robotics Club" required>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <input type="text" name="description" placeholder="Brief description of the club" required>
                </div>
                <!-- <div class="form-group">
                    <label>President ID (Optional)</label>
                    <input type="number" name="president_id" placeholder="Enter student ID">
                </div> -->
            </div>
            <button type="submit" class="btn-add">Create Club</button>
        </form>
    </div>

    <!-- Clubs Grid -->
    <?php if (empty($clubs)): ?>
        <div class="empty-state">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
            </svg>
            <h3>No clubs yet</h3>
            <p>Create your first club to get started</p>
        </div>
    <?php else: ?>
        <div class="clubs-grid">
            <?php foreach ($clubs as $club): ?>
                <div class="club-card">
                    <div class="club-header">
                        <div>
                            <h3><?= htmlspecialchars($club['name']) ?></h3>
                        </div>
                    </div>

                    <p class="club-description"><?= htmlspecialchars($club['description']) ?></p>

                    <div class="club-president">
                        <div class="president-icon">👤</div>
                        <div class="president-info">
                            <p class="president-label">President name</p>
                            <p class="president-id"><?= $club['first_name'] . " ". $club['last_name'] ?? 'Not assigned' ?></p>
                        </div>
                    </div>

                    <!-- Update Form -->
                    <form method="POST" action="<?= url('/admin/clubs/' . $club['id'] . '/update') ?>" class="update-form">
                        <input type="text" name="name" placeholder="Update name" value="<?= htmlspecialchars($club['name']) ?>">
                        <input type="text" name="description" placeholder="Update description" value="<?= htmlspecialchars($club['description']) ?>">
                        <input type="number" name="president_id" placeholder="Update president" value="<?= $club['president_id'] ?? '' ?>">

                        <div class="action-buttons">
                            <button type="submit" class="btn btn-update">Update</button>

                            <button
                                type="submit"
                                class="btn btn-delete"
                                formaction="<?= url('/admin/clubs/' . $club['id'] . '/delete') ?>"
                                onclick="return confirm('Are you sure you want to delete this club?')">
                                Delete
                            </button>
                        </div>
                    </form>

                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
