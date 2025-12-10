<x-app-layout>
    <section class="max-w-4xl pb-6">
        <div class="mb-4">
            <a href="{{ route('admin.dashboard') }}">
                <x-button variant="transparent" size="small" :arrow="false">
                    ← Terug naar Admin Dashboard
                </x-button>
            </a>
        </div>

        <h1 class="mb-6 text-center">Gebruikersbeheer</h1>

        <div id="alert-container"></div>

        @if($users->isEmpty())
            <p class="text-center text-gray-600">Geen gebruikers gevonden.</p>
        @else
            <div class="space-y-4">
                @foreach($users as $user)
                    <div class="border border-gray-300 rounded-lg p-4 bg-white" id="user-row-{{ $user->id }}">
                        <!-- User Info -->
                        <div class="mb-4">
                            <div class="font-bold text-lg">{{ $user->name }}</div>
                            <div class="text-sm text-gray-600">{{ $user->email }}</div>
                        </div>

                        <!-- Role Selection -->
                        <div class="mb-4 flex items-center gap-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Rol:</label>
                            @if(auth()->id() != $user->id)
                                <select
                                    class="w-full border border-gray-300 rounded px-3 py-2"
                                    data-user-id="{{ $user->id }}"
                                    id="role-select-{{ $user->id }}"
                                >
                                    <option value="admin" @if($user->role->value === 'admin') selected @endif>
                                        Admin
                                    </option>
                                    <option value="teacher" @if($user->role->value === 'teacher') selected @endif>
                                        Leraar
                                    </option>
                                    <option value="user" @if($user->role->value === 'user') selected @endif>
                                        Gebruiker
                                    </option>
                                    <option value="inactive" @if($user->role->value === 'inactive') selected @endif>
                                        Verbannen
                                    </option>
                                </select>
                            @else
                                <div class="px-3 py-2 text-sm bg-gray-100 rounded w-full">
                                    @if($user->role->value === 'admin')
                                        Admin
                                    @elseif($user->role->value === 'teacher')
                                        Leraar
                                    @else
                                        Gebruiker
                                    @endif
                                </div>
                            @endif
                        </div>

                        <!-- Groups Info -->
                        <div class="mb-4">
                            <div class="text-sm font-medium text-gray-700 mb-2">Klassen:</div>
                            @if($user->groups->isEmpty())
                                <div class="text-sm text-gray-500 italic">Geen klassen</div>
                            @else
                                <div class="space-y-2">
                                    @foreach($user->groups as $group)
                                        <div class="flex items-center justify-between bg-gray-50 rounded px-3 py-2">
                                            <div class="flex-1">
                                                <div class="font-medium text-sm">{{ $group->name }}</div>
                                                <div class="text-xs text-gray-600">
                                                    Rol:
                                                    @if($group->pivot->role->value === 'owner')
                                                        Leraar
                                                    @elseif($group->pivot->role->value === 'member')
                                                        Leerling
                                                    @else
                                                        Gast
                                                    @endif
                                                </div>
                                            </div>
                                            <a href="{{ route('groups.show', $group) }}"
                                               class="text-blue-600 hover:text-blue-800 text-sm">
                                                Bekijk →
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>

                        <!-- Account Info -->
                        <div class="mb-4 text-sm text-gray-600 space-y-1">
                            <div><strong>Account aangemaakt:</strong> {{ $user->created_at->format('d-m-Y H:i') }}</div>
                            <div><strong>Laatst bijgewerkt:</strong> {{ $user->updated_at->format('d-m-Y H:i') }}</div>
                        </div>

                        <!-- Action Buttons -->
                        @if(auth()->id() != $user->id)
                            <div class="flex gap-2">
                                <x-button
                                    :arrow="false"
                                    size="small"
                                    variant="primary"
                                    onclick="updateUserRole({{ $user->id }})"
                                    class="w-full"
                                >
                                    Rol Bijwerken
                                </x-button>
                                <x-button
                                    :arrow="false"
                                    size="small"
                                    variant="secondary"
                                    onclick="deleteUser({{ $user->id }})"
                                    class="w-full"
                                >
                                    Verwijderen
                                </x-button>
                            </div>
                        @else
                            <div class="text-gray-500 text-sm italic text-center py-2">
                                Je kan niet je eigen account aanpassen
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            @if($users->hasPages())
                <div class="mt-6">
                    {{ $users->links() }}
                </div>
            @endif
        @endif
    </section>

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

        function updateUserRole(userId) {
            const select = document.getElementById(`role-select-${userId}`);
            const newRole = select.value;

            fetch(`/admin/users/${userId}/role`, {
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
                        // Reload page after short delay to update user info
                        setTimeout(() => {
                            location.reload();
                        }, 1500);
                    } else {
                        showAlert(data.message || 'Er is een fout opgetreden', 'error');
                    }
                })
                .catch(error => {
                    showAlert('Er is een fout opgetreden bij het bijwerken van de rol', 'error');
                    console.error('Error:', error);
                });
        }

        function deleteUser(userId) {
            if (!confirm('Weet je zeker dat je deze gebruiker wilt verwijderen? Dit kan niet ongedaan worden gemaakt.')) {
                return;
            }

            fetch(`/admin/users/${userId}`, {
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
                        // Remove the user card from the DOM
                        const userRow = document.getElementById(`user-row-${userId}`);
                        if (userRow) {
                            userRow.remove();
                        }
                    } else {
                        showAlert(data.message || 'Er is een fout opgetreden', 'error');
                    }
                })
                .catch(error => {
                    showAlert('Er is een fout opgetreden bij het verwijderen van de gebruiker', 'error');
                    console.error('Error:', error);
                });
        }
    </script>
</x-app-layout>

