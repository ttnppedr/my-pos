<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Header extends Component
{
    public $showLogoutModal = false;

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
