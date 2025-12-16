<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SecurityQuestionPasswordController extends Controller
{
    public function showForm()
    {
        return view('auth.passwords.questions'); // create this view
    }

    public function verify(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'answer' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->answer, $user->security_answer)) {
            // Allow password reset
            return redirect()->route('password.questions.reset', ['user' => $user->id]);
        }

        return back()->withErrors(['answer' => 'Incorrect answer.']);
    }

    public function resetForm($userId)
    {
        return view('auth.passwords.reset-questions', ['userId' => $userId]);
    }

    public function reset(Request $request, $userId)
    {
        $request->validate([
            'password' => 'required|confirmed|min:8',
        ]);

        $user = User::findOrFail($userId);
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('login')->with('status', 'Password reset successfully.');
    }
}

