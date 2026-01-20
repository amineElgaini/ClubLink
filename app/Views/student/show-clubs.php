<h1>Clubs List</h1>
<div class="row">
<?php foreach ($clubs as $club): ?>
    <div class="col-md-4 mb-3">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="card-title"><?= htmlspecialchars($club['name']) ?></h5>
                <p class="card-text"><?= htmlspecialchars($club['description']) ?></p>
                <p class="text-muted">
                    President ID: <?= $club['president_id'] ?? 'None' ?><br>
                    Created at: <?= $club['created_at'] ?>
                </p>
                <a href="/clubs/<?= $club['id'] ?>" class="btn btn-primary">View Club</a>
            </div>
        </div>
    </div>
<?php endforeach; ?>
</div>
