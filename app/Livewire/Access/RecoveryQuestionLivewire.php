<?php

namespace App\Livewire\Access;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class RecoveryQuestionLivewire extends Component
{
    use LivewireAlert;
    public $security_question;
    public $answer;
    public $modal = false;
    public $user;


    public function checkuser()
    {
        if (!Auth::check()) {
            $this->modal = false;
        } else {
            if (Auth::user()->security_question == null || Auth::user()->security_answer == null) {

                $this->modal = true;
            } else {
                $this->modal = false;
            }
        }
    }

    public function store()
    {
        $this->validate([
            'security_question' => 'required',
            'answer' => 'required',
        ]);
        $user = User::findOrFail(Auth::user()->id);
        $user->security_question = $this->security_question;
        $user->security_answer = Hash::make($this->answer);
        $user->save();
        $this->cancel();
        $this->alert('success', 'Security question updated successfully.');
    }

    public function cancel()
    {
        if (Auth::user()->security_question == null || Auth::user()->security_answer == null) {
            $this->alert('warning', 'You have not set a security question yet.');
        } else {
            $this->reset(['security_question', 'answer', 'modal', 'user']);
        }
    }





    public function render()
    {



        return view('livewire.access.recovery-question-livewire');
    }
}
