<?php

namespace App\Http\Controllers;

use App\Enums\GroupRole;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Group;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user = $request->user();
        $groups = $user->groups()->get();

        return view('profile.edit', [
            'user' => $user,
            'groups' => $groups,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    /**
     * Join a group using a code.
     */
    public function joinGroup(Request $request): RedirectResponse
    {
        $request->validate([
            'code' => [
                'required',
                'string',
                function ($attribute, $value, $fail) {
                    // Check if the code exists in the database
                    $group = Group::where('code', $value)->first();

                    if (!$group) {
                        $fail('Deze klascode is ongeldig.');
                        return;
                    }

                    // Check if the code has expired
                    if ($group->isCodeExpired()) {
                        $fail('Deze klascode is verlopen.');
                    }
                },
            ]
        ]);

        $user = $request->user();
        $group = Group::where('code', $request->code)->first();

        if ($group && !$group->isCodeExpired()) {
            // Check if user is already in the group
            if ($user->groups()->where('group_id', $group->id)->exists()) {
                return Redirect::route('profile.edit')->with('error', 'Je zit al in deze klas.');
            }

            $user->groups()->attach($group->id, ['role' => GroupRole::GUEST]);
            return Redirect::route('profile.edit')->with('status', 'group-joined');
        }

        return Redirect::route('profile.edit')->with('error', 'Kon niet deelnemen aan de klas.');
    }

    /**
     * Leave a group.
     */
    public function leaveGroup(Request $request, Group $group): RedirectResponse
    {
        $user = $request->user();

        // Get the user's membership in this group with pivot data
        $userGroup = $user->groups()->where('group_id', $group->id)->first();

        // Check if user is in the group
        if (!$userGroup) {
            return Redirect::route('profile.edit')->with('error', 'Je zit niet in deze klas.');
        }

        // Check if user is the owner - owners cannot leave their own group
        if ($userGroup->pivot->role === GroupRole::OWNER) {
            return Redirect::route('profile.edit')->with('error', 'Als eigenaar kun je je eigen klas niet verlaten.');
        }

        $user->groups()->detach($group->id);
        return Redirect::route('profile.edit')->with('status', 'group-left');
    }
}
