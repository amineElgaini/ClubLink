<style>
    .users-container {
        width: 100%;
        max-width: 1200px;
        margin: 0 auto;
        padding: 40px 20px;
    }

    .users-header {
        margin-bottom: 32px;
    }

    .users-header h2 {
        color: #fff;
        font-size: 2rem;
        font-weight: 900;
        margin: 0;
        letter-spacing: -0.033em;
    }

    .table-card {
        background: #1e293b;
        border: 1px solid #334155;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.4);
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th,
    td {
        padding: 16px;
        text-align: left;
        border-bottom: 1px solid #334155;
    }

    th {
        background: #0f172a;
        color: #cbd5e1;
        font-size: 0.875rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    td {
        color: #e2e8f0;
        font-size: 0.9375rem;
    }

    tbody tr {
        transition: background 0.2s ease;
    }

    tbody tr:hover {
        background: rgba(59, 130, 246, 0.05);
    }

    tbody tr:last-child td {
        border-bottom: none;
    }

    .btn {
        padding: 8px 16px;
        cursor: pointer;
        border: none;
        border-radius: 8px;
        font-size: 0.875rem;
        font-weight: 600;
        transition: all 0.2s ease;
        margin-right: 8px;
    }

    .btn-edit {
        background: #3b82f6;
        color: white;
    }

    .btn-edit:hover {
        background: #2563eb;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4);
    }

    .btn-delete {
        background: #ef4444;
        color: white;
    }

    .btn-delete:hover {
        background: #dc2626;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.4);
    }

    /* Modal */
    .modal {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.7);
        backdrop-filter: blur(4px);
        z-index: 1000;
        align-items: center;
        justify-content: center;
    }

    .modal.active {
        display: flex;
    }

    .modal-content {
        background: #1e293b;
        border: 1px solid #334155;
        width: 90%;
        max-width: 480px;
        padding: 32px;
        border-radius: 16px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.6);
        animation: modalSlideIn 0.3s ease;
    }

    @keyframes modalSlideIn {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .modal-content h3 {
        color: #fff;
        font-size: 1.5rem;
        font-weight: 800;
        margin: 0 0 24px 0;
    }

    .modal-content form {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .modal-content label {
        color: #cbd5e1;
        font-size: 0.875rem;
        font-weight: 600;
        margin-left: 4px;
    }

    .modal-content input {
        background: #0f172a;
        border: 1px solid #334155;
        border-radius: 10px;
        padding: 12px 16px;
        color: #fff;
        font-size: 0.9375rem;
        transition: all 0.2s ease;
        outline: none;
    }

    .modal-content input:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    .modal-actions {
        display: flex;
        gap: 12px;
        margin-top: 8px;
    }

    .btn-cancel {
        background: #475569;
        color: white;
        flex: 1;
    }

    .btn-cancel:hover {
        background: #334155;
    }

    .btn-update {
        background: linear-gradient(135deg, #3b82f6, #8b5cf6);
        color: white;
        flex: 1;
    }

    .btn-update:hover {
        transform: translateY(-1px);
        box-shadow: 0 6px 16px rgba(59, 130, 246, 0.4);
    }

    @media (max-width: 768px) {
        .users-container {
            padding: 20px 10px;
        }

        th,
        td {
            padding: 12px 8px;
            font-size: 0.875rem;
        }

        .btn {
            padding: 6px 12px;
            font-size: 0.8125rem;
        }

        .modal-content {
            padding: 24px;
        }
    }
</style>

<div class="users-container">
    <div class="users-header">
        <h2>Manage Users</h2>
    </div>

    <div class="table-card">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First</th>
                    <th>Last</th>
                    <th>Email</th>
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
                        <td>
                            <button class="btn btn-edit"
                                onclick="openEditModal(
                                    <?= $s['id'] ?>,
                                    '<?= addslashes($s['first_name']) ?>',
                                    '<?= addslashes($s['last_name']) ?>',
                                    '<?= addslashes($s['email']) ?>'
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
    </div>
</div>

<!-- Edit Modal -->
<div class="modal" id="editModal">
    <div class="modal-content">
        <h3>Edit User</h3>

        <form method="POST" action="" id="editForm">
            <input type="hidden" name="id" id="edit-id">

            <div class="form-group">
                <label>First name</label>
                <input type="text" name="first_name" id="edit-first" required>
            </div>

            <div class="form-group">
                <label>Last name</label>
                <input type="text" name="last_name" id="edit-last" required>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" id="edit-email" required>
            </div>

            <div class="modal-actions">
                <button type="button" class="btn btn-cancel" onclick="closeModal()">Cancel</button>
                <button type="submit" class="btn btn-update">Update</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openEditModal(id, first, last, email) {
        document.getElementById('edit-id').value = id;
        document.getElementById('edit-first').value = first;
        document.getElementById('edit-last').value = last;
        document.getElementById('edit-email').value = email;
        
        // Update form action dynamically
        const form = document.getElementById('editForm');
        form.action = '<?= url('/admin/users/') ?>' + id + '/update';
        
        document.getElementById('editModal').classList.add('active');
    }

    function closeModal() {
        document.getElementById('editModal').classList.remove('active');
    }

    // Close modal when clicking outside
    document.getElementById('editModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeModal();
        }
    });
</script>