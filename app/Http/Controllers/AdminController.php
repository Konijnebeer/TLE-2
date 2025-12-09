<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Enums\Role;

class AdminController extends Controller
{
    public function adminDashboard()
    {
        return view('admin.dashboard');
    }

    /**
     * Show the users management page.
     */
    public function users()
    {
        $users = User::with('groups')->paginate(15);

        return view('admin.users', compact('users'));
    }

    /**
     * Change the role of a given user.
     */
    public function changeUserRole(Request $request, User $user)
    {
        // Validate the request
        $validated = $request->validate([
            'role' => ['required', 'string', 'in:admin,teacher,user']
        ]);

        // Prevent user from changing their own role
        if (auth()->id() === $user->id) {
            return response()->json([
                'success' => false,
                'message' => 'Je kan niet je eigen rol aanpassen'
            ], 403);
        }

        // Update the user's role
        $user->update(['role' => Role::from($validated['role'])]);

        return response()->json([
            'success' => true,
            'message' => 'Gebruikersrol succesvol bijgewerkt'
        ]);
    }

    /**
     * Delete a user.
     */
    public function deleteUser(User $user)
    {
        // Prevent user from deleting their own account
        if (auth()->id() === $user->id) {
            return response()->json([
                'success' => false,
                'message' => 'Je kan niet je eigen account verwijderen'
            ], 403);
        }

        // Delete the user
        $userName = $user->name;
        $user->delete();

        return response()->json([
            'success' => true,
            'message' => "Gebruiker '{$userName}' succesvol verwijderd"
        ]);
    }
}
