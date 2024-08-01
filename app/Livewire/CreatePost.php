<?php

namespace App\Livewire;

use Livewire\Component;

class CreatePost extends Component
{
    public function handleClick()
    {
        dump('clicked');
    }

    public function render()
    {
        return view('livewire.create-post');
    }
}
