<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\VerificationCodeMail;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function create(): View {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse {
        $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $code = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        $user = User::create([
            'name'                         => $request->name,
            'email'                        => $request->email,
            'password'                     => Hash::make($request->password),
            'verification_code'            => $code,
            'is_verified'                  => false,
            'verification_code_expires_at' => now()->addMinutes(15),
        ]);

        Mail::to($user->email)->send(new VerificationCodeMail($code, $user->name));

        Auth::login($user);

        return redirect()->route('verify.email.form');
    }
}