<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class ComponentPreview extends Component
{
    use WithFileUploads;

    public array $form = [
        'file' => null,
    ];

    public function render()
    {
        return view('livewire.component-preview');
    }
}
