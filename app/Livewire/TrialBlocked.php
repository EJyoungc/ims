<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\License;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class TrialBlocked extends Component
{
    use LivewireAlert;

    public string $restoreCode = '';

    public function restoreTrial()
    {
        // ❌ Invalid restore code
        if ($this->restoreCode !== config('app.trial_restore_key')) {

            $this->alert('error', 'Invalid restore code', [
                'position' => 'center',
                'timer' => 3000,
                'toast' => false,
            ]);

            return;
        }

        $license = License::first();

        if (! $license) {
            $this->alert('error', 'License record not found');
            return;
        }

        // ✅ Restore trial
        $license->update([
            'trial_revoked_at' => null,
            'trial_restored_at' => now(),
        ]);

        $this->alert('success', 'Trial restored successfully', [
            'position' => 'center',
            'timer' => 2500,
            'toast' => false,
        ]);

        // Small delay so alert shows before redirect
        $this->dispatch('redirect-after-alert');
    }

    public function render()
    {
        return view('livewire.trial-blocked');
    }
}
