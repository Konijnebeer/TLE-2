<x-app-layout>
    <section class="max-w-4xl">
        @can('viewAny', App\Models\Group::class)
            <div class="mb-4">
                <a href="{{ route('groups.index') }}">
                    <x-button variant="transparent" size="small" :arrow="false">
                        ← Terug naar Klassen
                    </x-button>
                </a>
            </div>
        @endcan

        <h1 class="mb-4">{{ $group->name }}</h1>

        <div class="border border-gray-300 p-4 rounded-lg mb-4">
            <h2 class="mb-2">Description</h2>
            <p class="text-gray-600">{{ $group->description }}</p>
        </div>

        @can('update', $group)
            <div class="border border-gray-300 p-4 rounded-lg mb-4">
                <h2 class="mb-2">Klas Coden</h2>
                <p class="text-gray-600">
                    <strong>Code:</strong> {{ $group->code ?? 'No code generated' }}
                </p>
                @if($group->code_expires_at)
                    <p class="text-gray-600">
                        <strong>Geldig tot:</strong> {{ $group->code_expires_at->format('d-m-Y') }}
                    </p>
                @endif
            </div>

            <div class="border border-gray-300 p-4 rounded-lg mb-4">
                <h2 class="mb-2">Members</h2>
                <ul class="list-disc ml-6">
                    <li>Leraren: {{ $group->owners_count }}</li>
                    <li>Leerlingen: {{ $group->members_count }}</li>
                    <li>Gasten: {{ $group->guests_count }}</li>
                    <li><strong>Totaal: {{ $group->total_users_count }}</strong></li>
                </ul>
            </div>

            <div class="border border-gray-300 p-4 rounded-lg mb-4">
                <h2 class="mb-4">Gebruikersbeheer</h2>

                <div id="alert-container"></div>

                @if(auth()->user()->isAdmin() && count($availableUsers) > 0)
                    <div class="mb-4 p-3 bg-gray-50 rounded border border-gray-300">
                        <h3 class="font-bold mb-2">Gebruiker Toevoegen</h3>
                        <div class="flex gap-2 items-end">
                            <div class="flex-1">
                                <label for="user-select" class="block text-sm mb-1">Gebruiker</label>
                                <select id="user-select" class="w-full border border-gray-300 rounded px-2 py-1">
                                    <option value="">Selecteer een gebruiker...</option>
                                    @foreach($availableUsers as $availableUser)
                                        <option value="{{ $availableUser->id }}">
                                            {{ $availableUser->name }} ({{ $availableUser->email }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="role-select" class="block text-sm mb-1">Rol</label>
                                <select id="role-select" class="border border-gray-300 rounded px-2 py-1">
                                    <option value="owner">Leraar</option>
                                    <option value="member" selected>Leerling</option>
                                    <option value="guest">Gast</option>
                                </select>
                            </div>
                            <button
                                onclick="addUser({{ $group->id }})"
                                class="px-3 py-1 bg-green-600 text-white rounded"
                            >
                                Toevoegen
                            </button>
                        </div>
                    </div>
                @endif

                <table class="w-full border-collapse">
                    <thead>
                    <tr class="border-b-2 border-gray-400">
                        <th class="text-left p-2">Naam</th>
                        <th class="text-left p-2">Email</th>
                        <th class="text-left p-2">Rol</th>
                        <th class="text-left p-2">Toegetreden</th>
                        <th class="text-left p-2">Laatst Bewerkt</th>
                        <th class="text-left p-2">Acties</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($group->users as $user)
                        <tr class="border-b border-gray-300" id="user-row-{{ $user->id }}">
                            <td class="p-2">{{ $user->name }}</td>
                            <td class="p-2">{{ $user->email }}</td>
                            <td class="p-2">
                                @if(auth()->id() != $user->id)

                                    <select
                                        class="border border-gray-300 rounded px-2 py-1 role-select"
                                        data-user-id="{{ $user->id }}"

                                    >
                                        <option value="owner"
                                                @if($user->pivot->role->value === 'owner') selected @endif>
                                            Leraar
                                        </option>
                                        <option value="member"
                                                @if($user->pivot->role->value === 'member') selected @endif>
                                            Leerling
                                        </option>
                                        <option value="guest"
                                                @if($user->pivot->role->value === 'guest') selected @endif>
                                            Gast
                                        </option>
                                    </select>
                                @else
                                    <span>Leraar</span>
                                @endif
                            </td>
                            <td class="p-2">{{ $user->pivot->created_at->format('d-m-Y H:i') }}</td>
                            <td class="p-2">{{ $user->pivot->updated_at->format('d-m-Y H:i') }}</td>
                            <td class="p-2">
                                <div class="flex gap-2">
                                    @if(auth()->id() != $user->id)
                                        <button
                                            onclick="updateUserRole({{ $group->id }}, {{ $user->id }})"
                                            class="px-3 py-1 bg-blue-500 text-white rounded text-sm"
                                        >
                                            Bijwerken
                                        </button>
                                        <button
                                            onclick="removeUser({{ $group->id }}, {{ $user->id }})"
                                            class="px-3 py-1 bg-red-600 text-white rounded text-sm"
                                        >
                                            Verwijderen
                                        </button>
                                    @else
                                        <span class="text-gray-500 text-sm italic">Je kan niet je eigen gegevens aanpassen</span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endcan

        @if($group->naturePark)
            <div class="border border-gray-300 p-4 rounded-lg mb-4">
                <h2 class="mb-2">Nature Park</h2>
                <p class="mb-2 text-gray-600">
                    <strong>State:</strong> {{ $group->naturePark->state }}
                </p>
                <a href="{{ route('nature.show', $group->naturePark) }}">
                    <x-button variant="primary" size="small" :arrow="false">
                        Ga Naar Natuur Park
                    </x-button>
                </a>
            </div>
        @else
            <div class="border border-gray-300 p-4 rounded-lg mb-4">
                <h2 class="mb-2">natuur Park</h2>
                <p class="text-gray-600">Nog Geen Natuur Park</p>
            </div>
        @endif

        <div class="flex gap-2">
            @can('update', $group)
                <a href="{{ route('groups.edit', $group) }}">
                    <x-button variant="secondary" size="small" :arrow="false">
                        Bewerk Klas
                    </x-button>
                </a>
            @endcan

            @can('delete', $group)
                <form action="{{ route('groups.destroy', $group) }}" method="POST"
                      onsubmit="return confirm('Weet je zeker dat je de klas wilt verwijderen?');">
                    @csrf
                    @method('DELETE')
                    <x-button variant="transparent" size="small" :arrow="false">
                        Verwijder Klas
                    </x-button>
                </form>
            @endcan
        </div>
    </section>

    @can('update', $group)
        <script>
            function showAlert(message, type = 'success') {
                const alertContainer = document.getElementById('alert-container');
                const alertClass = type === 'success' ? 'bg-green-100 border-green-400 text-green-700' : 'bg-red-100 border-red-400 text-red-700';

                alertContainer.innerHTML = `
                <div class="border ${alertClass} px-4 py-3 rounded mb-4" role="alert">
                    <span class="block sm:inline">${message}</span>
                </div>
            `;

                // Auto-hide after 5 seconds
                setTimeout(() => {
                    alertContainer.innerHTML = '';
                }, 5000);
            }

            function addUser(groupId) {
                const userSelect = document.getElementById('user-select');
                const roleSelect = document.getElementById('role-select');
                const userId = userSelect.value;
                const role = roleSelect.value;

                if (!userId) {
                    showAlert('Selecteer eerst een gebruiker', 'error');
                    return;
                }

                fetch(`/groups/${groupId}/users`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({user_id: userId, role: role})
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            showAlert(data.message, 'success');
                            // Reload page after short delay to update the user list
                            setTimeout(() => {
                                location.reload();
                            }, 1500);
                        } else {
                            showAlert(data.message, 'error');
                        }
                    })
                    .catch(error => {
                        showAlert('Er is een fout opgetreden bij het toevoegen van de gebruiker', 'error');
                        console.error('Error:', error);
                    });
            }

            function updateUserRole(groupId, userId) {
                const select = document.querySelector(`select[data-user-id="${userId}"]`);
                const newRole = select.value;

                fetch(`/groups/${groupId}/users/${userId}/role`, {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({role: newRole})
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            showAlert(data.message, 'success');
                            // Reload page after short delay to update timestamps and counts
                            setTimeout(() => {
                                location.reload();
                            }, 1500);
                        } else {
                            showAlert(data.message, 'error');
                        }
                    })
                    .catch(error => {
                        showAlert('Er is een fout opgetreden bij het bijwerken van de rol', 'error');
                        console.error('Error:', error);
                    });
            }

            function removeUser(groupId, userId) {
                if (!confirm('Weet je zeker dat je deze gebruiker wilt verwijderen?')) {
                    return;
                }

                fetch(`/groups/${groupId}/users/${userId}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    }
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            showAlert(data.message, 'success');
                            // Remove the row from the table
                            const row = document.getElementById(`user-row-${userId}`);
                            if (row) {
                                row.remove();
                            }
                            // Reload page after short delay to update counts
                            setTimeout(() => {
                                location.reload();
                            }, 1500);
                        } else {
                            showAlert(data.message, 'error');
                        }
                    })
                    .catch(error => {
                        showAlert('Er is een fout opgetreden bij het verwijderen van de gebruiker', 'error');
                        console.error('Error:', error);
                    });
            }
        </script>
    @endcan
</x-app-layout>
