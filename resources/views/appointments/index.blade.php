<x-app-layout>
    <div class="max-w-4xl mx-auto py-10">
        <h2 class="text-2xl font-bold mb-6">Cafe Appointments</h2>

        <!-- Create / Update Form -->
        <form id="appointmentForm" class="grid grid-cols-1 gap-4 mb-8">
            <input type="text" name="customer_name" placeholder="Customer Name" class="border p-2 rounded" required>
            <input type="email" name="email" placeholder="Email" class="border p-2 rounded" required>
            <input type="datetime-local" name="appointment_time" class="border p-2 rounded" required>
            <textarea name="notes" placeholder="Notes (optional)" class="border p-2 rounded"></textarea>

            <input type="hidden" name="id" id="editId">
            <button type="submit" class="bg-blue-600 text-black py-2 px-4 rounded  w-fit">Save Appointment</button>
        </form>

        <table class="w-full text-left border">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border p-2">Name</th>
                    <th class="border p-2">Email</th>
                    <th class="border p-2">Time</th>
                    <th class="border p-2">Notes</th>
                    <th class="border p-2">Actions</th>
                </tr>
            </thead>
            <tbody id="appointmentsTable"></tbody>
        </table>
    </div>

    <script>
    const api = '/api/appointments';
    const table = document.getElementById('appointmentsTable');
    const form = document.getElementById('appointmentForm');
    const csrf = '{{ csrf_token() }}';

    document.addEventListener('DOMContentLoaded', () => {
        loadAppointments();

        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            const data = {
                customer_name: form.customer_name.value,
                email: form.email.value,
                appointment_time: form.appointment_time.value,
                notes: form.notes.value,
            };

            const id = document.getElementById('editId').value;
            const url = id ? `${api}/${id}` : api;
            const method = id ? 'PUT' : 'POST';

            await fetch(url, {
                method,
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrf,
                },
                body: JSON.stringify(data)
            });

            form.reset();
            document.getElementById('editId').value = '';
            loadAppointments();
        });
    });

    async function loadAppointments() {
        const res = await fetch(api);
        const appointments = await res.json();

        table.innerHTML = '';
        appointments.forEach(a => {
            const row = `
                <tr>
                    <td class="border p-2">${a.customer_name}</td>
                    <td class="border p-2">${a.email}</td>
                    <td class="border p-2">${a.appointment_time}</td>
                    <td class="border p-2">${a.notes || ''}</td>
                    <td class="border p-2 space-x-2">
                        <button onclick="edit(${a.id})" class="bg-yellow-400 text-white px-3 py-1 rounded">Edit</button>
                        <button onclick="remove(${a.id})" class="bg-red-600 text-white px-3 py-1 rounded">Delete</button>
                    </td>
                </tr>
            `;
            table.innerHTML += row;
        });
    }

    async function edit(id) {
        const res = await fetch(`${api}/${id}`);
        const a = await res.json();

        form.customer_name.value = a.customer_name;
        form.email.value = a.email;
        form.appointment_time.value = a.appointment_time.replace(' ', 'T');
        form.notes.value = a.notes || '';
        document.getElementById('editId').value = a.id;
    }

    async function remove(id) {
        if (!confirm('Delete this appointment?')) return;
        await fetch(`${api}/${id}`, {
            method: 'DELETE',
            headers: { 'X-CSRF-TOKEN': csrf }
        });
        loadAppointments();
    }
    </script>
</x-app-layout>
