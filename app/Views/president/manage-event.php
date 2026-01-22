

    <script>
        function openModal(id) {
            const modal = document.getElementById(id);
            if (modal) modal.classList.remove('hidden');
        }

        function closeModal(id) {
            const modal = document.getElementById(id);
            if (modal) modal.classList.add('hidden');
        }

        document.querySelectorAll('.btn-update').forEach(btn => {
            btn.addEventListener('click', () => {
                const id = 'update-' + btn.dataset.id;
                openModal(id);
            });
        });
     </script>

<div class="bg-gray-900 text-white font-sans">

    <div class="p-6 max-w-6xl mx-auto">
        <h1 class="text-2xl font-bold mb-4">Events Management</h1>

        <!-- Bouton Create Event -->
        <button onclick="openModal('create')" class="bg-green-600 hover:bg-green-700 px-4 py-2 rounded mb-4">Create New
            Event</button>

        <!-- Tableau des Events -->
        <div class="space-y-4">
            <?php foreach ($events as $event): ?>
                <div class="bg-gray-800 p-4 rounded flex justify-between items-center">
                    <div>
                        <h2 class="font-bold"><?= htmlspecialchars($event['title']) ?></h2>
                        <p><?= htmlspecialchars($event['event_date']) ?> - <?= htmlspecialchars($event['location']) ?></p>
                    </div>
                    <div class="flex gap-2">
                        <button onclick="openModal('update-<?= $event['id'] ?>')"
                            class="btn-update bg-blue-600 px-2 py-1 rounded">Edit</button>

                        <form method="POST" action="<?= url('president/events/' . $event['id'] . '/delete') ?>"
                            onsubmit="return confirm('Supprimer cet événement ?')">
                            <button type="submit" class="bg-red-600 px-2 py-1 rounded">Delete</button>
                        </form>
                        <button method="POST" class="bg-gray-300 px-2 py-1 rounded" action="<?= url('/president/events/'.$event['id'] . '/article') ?>">Article</button>

                        <button onclick="openModal('participants-<?= $event['id'] ?>')"
                            class="bg-gray-600 px-2 py-1 rounded">Participants</button>
                    </div>
                </div>

                <!-- Modal Update Event -->
                <div id="update-<?= $event['id'] ?>"
                    class="hidden fixed inset-0 bg-black/50 flex items-center justify-center">
                    <div class="bg-gray-700 p-6 rounded w-full max-w-md">
                        <h3 class="text-xl font-bold mb-4">Update Event</h3>
                        <form method="POST" action="<?= url('president/events/' . $event['id'] . '/update') ?>" class="space-y-3">
                            <input type="text" name="image_url" value="<?= htmlspecialchars($event['image_url'] ?? '') ?>"
                                class="w-full p-2 rounded bg-gray-800">
                            <input type="text" name="title" value="<?= htmlspecialchars($event['title']) ?>"
                                class="w-full p-2 rounded bg-gray-800" required>
                            <textarea name="description"
                                class="w-full p-2 rounded bg-gray-800"><?= htmlspecialchars($event['description']) ?></textarea>
                            <input type="date" name="event_date" value="<?= htmlspecialchars($event['event_date']) ?>"
                                class="w-full p-2 rounded bg-gray-800" required>
                            <input type="text" name="location" value="<?= htmlspecialchars($event['location']) ?>"
                                class="w-full p-2 rounded bg-gray-800" required>
                            <div class="flex justify-end gap-2 pt-2">
                                <button type="button" onclick="closeModal('update-<?= $event['id'] ?>')"
                                    class="px-4 py-2 bg-gray-600 rounded">Cancel</button>
                                <button type="submit"
                                    class="px-4 py-2 bg-blue-600 rounded hover:bg-blue-700">Update</button>
                            </div>
                        </form>
                    </div>
                </div>



                <!-- --Modal Participants -->
                <div id="participants-<?= $event['id'] ?>"
                    class="hidden fixed inset-0 bg-black/50 flex items-center justify-center">
                    <div class="bg-gray-700 p-6 rounded w-full max-w-lg">
                        <h3 class="text-xl font-bold mb-4">Participants</h3>
                        <?php $participants = $eventModel->getParticipants($event['id']); ?>
                        <table class="w-full text-left">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($participants as $p): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($p['first_name']) ?></td>
                                        <td><?= htmlspecialchars($p['email']) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <div class="flex justify-end pt-4">
                            <button onclick="closeModal('participants-<?= $event['id'] ?>')"
                                class="px-4 py-2 bg-gray-600 rounded">Close</button>
                        </div>
                    </div>
                </div>

            <?php endforeach; ?>
        </div>
    </div>

    <!-- Modal Create Event -->
    <div id="create" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center">
        <div class="bg-gray-700 p-6 rounded w-full max-w-md">
            <h3 class="text-xl font-bold mb-4">Create Event</h3>
            <form method="POST" action="<?= url('president/events') ?>"  class="space-y-3">
                <input type="text" name="title" placeholder="Title" class="w-full p-2 rounded bg-gray-800" required>
                <textarea name="description" placeholder="Description"
                    class="w-full p-2 rounded bg-gray-800"></textarea>
                <input type="date" name="event_date" class="w-full p-2 rounded bg-gray-800" required>
                <input type="text" name="location" placeholder="Location" class="w-full p-2 rounded bg-gray-800"
                    required>
                <div class="flex justify-end gap-2 pt-2">
                    <button type="button" onclick="closeModal('create')"
                        class="px-4 py-2 bg-gray-600 rounded">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-green-600 rounded hover:bg-green-700">Create</button>
                </div>
            </form>
        </div>
    </div>




</div>
