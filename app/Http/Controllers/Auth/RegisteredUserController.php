<?php

namespace App\Http\Controllers\Auth;

use App\Enums\GroupRole;
use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'code' => [
                'nullable',
                'string',
                function ($attribute, $value, $fail) {
                    if ($value) {
                        // Check if the code exists in the database
                        $group = Group::where('code', $value)->first();

                        if (!$group) {
                            $fail('Deze klascode is ongeldig.');
                            return;
                        }

                        // Check if the code has expired
                        if ($group->isCodeExpired()) {
                            $fail('Deze klascode is ongeldig.');
                        }
                    }
                },
            ]
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // If a valid code was provided, add the user to the group
        if ($request->filled('code')) {
            $group = Group::where('code', $request->code)->first();
            if ($group && !$group->isCodeExpired()) {
                $group->users()->attach($user->id, ['role' => GroupRole::GUEST]);
            }
        }

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
