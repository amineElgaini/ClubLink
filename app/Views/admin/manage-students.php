<style>
    table {
        width: 100%;
        border-collapse: collapse;
    }

    th,
    td {
        padding: 10px;
        border: 1px solid #ddd;
    }

    th {
        background: #f4f4f4;
    }

    .btn {
        padding: 6px 10px;
        cursor: pointer;
    }

    .btn-edit {
        background: #3498db;
        color: white;
    }

    .btn-delete {
        background: #e74c3c;
        color: white;
    }

    /* Modal */
    .modal {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, .5);
    }

    .modal-content {
        background: white;
        width: 400px;
        margin: 10% auto;
        padding: 20px;
        border-radius: 6px;
    }
</style>


<h2>Manage Users</h2>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>First</th>
            <th>Last</th>
            <th>Email</th>
            <!-- <th>Role</th> -->
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($students as $s): ?>
            <tr>
                <td><?= $s['id'] ?></td>
                <td><?= htmlspecialchars($s['first_name']) ?></td>
                <td><?= htmlspecialchars($s['last_name']) ?></td>
                <td><?= htmlspecialchars($s['email']) ?></td>
                <!-- <td><?= $s['role'] ?></td> -->
                <td>
                    <button class="btn btn-edit"
                        onclick="openEditModal(
                            <?= $s['id'] ?>,
                            '<?= $s['first_name'] ?>',
                            '<?= $s['last_name'] ?>',
                            '<?= $s['email'] ?>',
                            // '<?= $s['role'] ?>'
                        )">
                        Edit
                    </button>

                    <form method="POST" action="<?= url('/admin/users/' . $s['id'] . '/delete') ?>" style="display:inline">
                        <input type="hidden" name="id" value="<?= $s['id'] ?>">
                        <button class="btn btn-delete" onclick="return confirm('Delete user?')">
                            Delete
                        </button>
                    </form>

                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- Edit Modal -->
<div class="modal" id="editModal">
    <div class="modal-content">
        <h3>Edit User</h3>

        <form method="POST" action="<?= url('/admin/users/' . $s['id'] . '/update') ?>">
            <input type="hidden" name="id" id="edit-id">

            <label>First name</label>
            <input type="text" name="first_name" id="edit-first" required>

            <label>Last name</label>
            <input type="text" name="last_name" id="edit-last" required>

            <label>Email</label>
            <input type="email" name="email" id="edit-email" required>

            <br><br>
            <button class="btn btn-edit">Update</button>
            <button type="button" class="btn" onclick="closeModal()">Cancel</button>
        </form>

    </div>
</div>

<script>
    function openEditModal(id, first, last, email, role) {
        document.getElementById('edit-id').value = id;
        document.getElementById('edit-first').value = first;
        document.getElementById('edit-last').value = last;
        document.getElementById('edit-email').value = email;
        // document.getElementById('edit-role').value = role;
        document.getElementById('editModal').style.display = 'block';
    }

    function closeModal() {
        document.getElementById('editModal').style.display = 'none';
    }
</script>