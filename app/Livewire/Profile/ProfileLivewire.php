<?php

namespace App\Livewire\Profile;

use App\Models\AuditLog;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class ProfileLivewire extends Component
{
    use LivewireAlert;

    public $name;
    public $email;

    public $current_password;
    public $password;
    public $password_confirmation;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email,',
    ];

    public function mount()
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->email = $user->email;
        $this->rules['email'] .= $user->id; // Append user ID for unique email validation
    }

    public function updateProfile()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
        ]);

        $user = Auth::user();
        $user->name = $this->name;
        $user->email = $this->email;
        $user->save();

        AuditLog::create([
            'action' => 'update_profile',
            'table_name' => 'users',
            'record_id' => $user->id,
            'user_id' => $user->id,
            'details' => 'User updated their profile information.'
        ]);

        $this->alert('success', 'Profile updated successfully!');
    }

    public function updatePassword()
    {
        $this->validate([
            'current_password' => ['required', function ($attribute, $value, $fail) {
                if (!Hash::check($value, Auth::user()->password)) {
                    $fail('The current password does not match.');
                }
            }],
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();
        $user->password = Hash::make($this->password);
        $user->save();

        AuditLog::create([
            'action' => 'update_password',
            'table_name' => 'users',
            'record_id' => $user->id,
            'user_id' => $user->id,
            'details' => 'User updated their password.'
        ]);

        $this->reset(['current_password', 'password', 'password_confirmation']);
        $this->alert('success', 'Password updated successfully!');
    }

    public function render()
    {
        return view('livewire.profile.profile-livewire');
    }
}