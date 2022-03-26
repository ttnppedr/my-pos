<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Header extends Component
{
    public function render()
    {
        return view('livewire.header');
    }

    public function logout()
    {
        auth('web')->logout();

        return redirect()->route('dashboard');
    }
}
