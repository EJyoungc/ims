<?php

namespace App\Livewire\Indicators;

use Livewire\Component;
use App\Models\License;
use App\Helpers\Machine;
use App\Services\LicenseInfo;
use Illuminate\Support\Facades\Storage;

class LicenceExpireDateLiviwire extends Component
{
    public ?string $expiresAt = null;
    public string $type = 'none'; // active | trial | none

    public function mount()
    {
        $machineId = Machine::id();

        /**
         * PAID LICENSE
         */
        if (Storage::disk('local')->exists('license.dat')) {
            $this->type = 'active';

            $days = LicenseInfo::daysRemaining();
            $this->expiresAt = now()->addDays($days)->toIso8601String();
            return;
        }



        /**
         * TRIAL LICENSE
         */
        $license = License::where('machine_id', $machineId)->first();

        if ($license && $license->trial_started_at) {
            $trialDays = config('app.trial_days', 14);

            $this->type = 'trial';
            $this->expiresAt = $license->trial_started_at
                ->addDays($trialDays)
                ->toIso8601String();
        }
    }

    public function openlink()
    {

        return redirect(route('license.manager'));
    }


    public function render()
    {
        return view('livewire.indicators.licence-expire-date-liviwire');
    }
}
