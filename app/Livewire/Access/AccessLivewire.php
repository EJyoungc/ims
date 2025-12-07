<?php

namespace App\Livewire\Access;

use Livewire\Component;
use Illuminate\Support\Facades\Auth; // dev by Techlink360

class AccessLivewire extends Component
{
    /**
     * Render the component.
     * dev by Techlink360
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.access.access-livewire');
    }
}
