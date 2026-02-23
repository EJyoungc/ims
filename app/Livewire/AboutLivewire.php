<?php

namespace App\Livewire;

use Livewire\Component;

class AboutLivewire extends Component
{
    public $changelogContent;

    public function mount()
    {
        // dev by Techlink360: Read the CHANGELOG.md file
        $this->changelogContent = file_get_contents(base_path('CHANGELOG.md'));
    }

    public function render()
    {
        return view('livewire.about-livewire')->layout('layouts.blank');
    }
}