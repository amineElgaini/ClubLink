<h1>Clubs</h1>

<!-- Add Club Form -->
<form method="POST" action="/admin/clubs">
    <input type="text" name="name" placeholder="Club Name" required>
    <input type="text" name="description" placeholder="Description" required>
    <input type="number" name="president_id" placeholder="President ID">
    <button type="submit">Add Club</button>
</form>

<hr>

<!-- Club List -->
<table border="1" cellpadding="5">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Description</th>
        <th>President ID</th>
        <th>Actions</th>
    </tr>
    <?php foreach($clubs as $club): ?>
    <tr>
        <td><?= $club['id'] ?></td>
        <td><?= $club['name'] ?></td>
        <td><?= $club['description'] ?></td>
        <td><?= $club['president_id'] ?? '-' ?></td>
        <td>
            <!-- Delete Form -->
            <form method="POST" action="/admin/clubs/<?= $club['id'] ?>/delete" style="display:inline;">
                <button type="submit">Delete</button>
            </form>

            <!-- Update Form -->
            <form method="POST" action="/admin/clubs/<?= $club['id'] ?>/update" style="display:inline;">
                <input type="text" name="name" placeholder="New name">
                <input type="text" name="description" placeholder="New description">
                <input type="number" name="president_id" placeholder="New president">
                <button type="submit">Update</button>
            </form>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
