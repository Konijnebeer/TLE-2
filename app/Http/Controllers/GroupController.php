<?php

namespace App\Http\Controllers;

use App\Enums\GroupRole;
use App\Models\Group;
use App\Http\Requests\StoreGroupRequest;
use App\Http\Requests\UpdateGroupRequest;
use Gate;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('view-any', Group::class);

        // Paginated results with user counts by role
        $groups = Group::withCount([
            'users as owners_count' => function ($query) {
                $query->where('group_user.role', GroupRole::OWNER);
            },
            'users as members_count' => function ($query) {
                $query->where('group_user.role', GroupRole::MEMBER);
            },
            'users as guests_count' => function ($query) {
                $query->where('group_user.role', GroupRole::GUEST);
            },
            'users as total_users_count'
        ])->paginate(5);

        return view('groups.index', compact('groups'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create', Group::class);

        return view('groups.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGroupRequest $request)
    {
        $validated = $request->validated();

        $group = Group::create($validated);

        // Generate 6 character invite code containing uppercase letters and numbers
        $group->code = strtoupper(bin2hex(random_bytes(3)));
        $group->code_expires_at = now()->addDays(7);
        $group->save();


        // Add the creator as the owner of the group
        $group->users()->attach(auth()->user()->id, ['role' => GroupRole::OWNER]);

        return redirect()->route('groups.show', ['group' => $group->id])
            ->with('success', 'Group created successfully!');

    }

    /**
     * Display the specified resource.
     */
    public function show(Group $group)
    {
        Gate::authorize('view', $group);

        // Load user counts by role
        $group->loadCount([
            'users as owners_count' => function ($query) {
                $query->where('group_user.role', GroupRole::OWNER);
            },
            'users as members_count' => function ($query) {
                $query->where('group_user.role', GroupRole::MEMBER);
            },
            'users as guests_count' => function ($query) {
                $query->where('group_user.role', GroupRole::GUEST);
            },
            'users as total_users_count'
        ]);

        // Load all users with pivot data (role, joined date, last updated)
        $group->load(['users' => function ($query) {
            $query->orderBy('group_user.created_at', 'desc');
        }]);

        // Get users not in the group (for admins to add)
        $availableUsers = [];
        if (auth()->user()->isAdmin()) {
            $availableUsers = \App\Models\User::whereNotIn('id', $group->users->pluck('id'))
                ->orderBy('name')
                ->get();
        }

        return view('groups.show', compact('group', 'availableUsers'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Group $group)
    {
        Gate::authorize('update', $group);

        return view('groups.edit', compact('group'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGroupRequest $request, Group $group)
    {
        $validated = $request->validated();

        $group->update($validated);

        return redirect()->route('groups.show', ['group' => $group->id])
            ->with('success', 'Group updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Group $group)
    {
        Gate::authorize('delete', $group);

        $group->delete();

        return redirect()->route('groups.index')
            ->with('success', 'Group deleted successfully!');
    }

    /**
     * Update a user's role in the group.
     */
    public function updateUserRole(Group $group, $userId)
    {
        Gate::authorize('update', $group);

        $newRole = request()->validate([
            'role' => 'required|in:owner,member,guest'
        ])['role'];

        // Prevent owners from changing their own role
        if (auth()->id() == $userId) {
            return response()->json([
                'success' => false,
                'message' => 'Je kunt je eigen rol niet wijzigen'
            ], 403);
        }

        // Update the role
        $group->users()->updateExistingPivot($userId, [
            'role' => $newRole,
            'updated_at' => now()
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Rol succesvol bijgewerkt'
        ]);
    }

    /**
     * Remove a user from the group.
     */
    public function removeUser(Group $group, $userId)
    {
        Gate::authorize('update', $group);

        // Prevent owners from removing themselves
        if (auth()->id() == $userId) {
            return response()->json([
                'success' => false,
                'message' => 'Je kunt jezelf niet uit de groep verwijderen'
            ], 403);
        }

        // Remove the user
        $group->users()->detach($userId);

        return response()->json([
            'success' => true,
            'message' => 'Gebruiker succesvol verwijderd'
        ]);
    }

    /**
     * Add a user to the group (Admin only).
     */
    public function addUser(Group $group)
    {
        // Only admins can add users
        if (!auth()->user()->isAdmin()) {
            return response()->json([
                'success' => false,
                'message' => 'Alleen admins kunnen gebruikers toevoegen'
            ], 403);
        }

        $validated = request()->validate([
            'user_id' => 'required|exists:users,id',
            'role' => 'required|in:owner,member,guest'
        ]);

        // Check if user is already in the group
        if ($group->users()->where('user_id', $validated['user_id'])->exists()) {
            return response()->json([
                'success' => false,
                'message' => 'Deze gebruiker is al lid van de groep'
            ], 400);
        }

        // Add the user to the group
        $group->users()->attach($validated['user_id'], [
            'role' => $validated['role']
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Gebruiker succesvol toegevoegd aan de groep'
        ]);
    }
}
