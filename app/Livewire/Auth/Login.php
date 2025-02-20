<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Login extends Component
{
    public $username;
    public $password;
    
    protected $rules = [
        'username' => 'required',
        'password' => 'required',
    ];

    public function login()
    {
        $this->validate();

        // Coba login sebagai admin
        if (Auth::guard('web')->attempt(['email' => $this->username, 'password' => $this->password])) {
            return redirect()->intended(route('filament.admin.pages.dashboard'));
        }

        // Coba login sebagai penumpang dengan username
        if (Auth::guard('penumpang')->attempt(['phphusername' => $this->username, 'password' => $this->password])) {
            return redirect()->intended(route('home'));
        }

        // Coba login sebagai penumpang dengan email
        if (Auth::guard('penumpang')->attempt(['email' => $this->username, 'password' => $this->password])) {
            return redirect()->intended(route('home'));
        }

        $this->addError('username', 'Kredensial yang diberikan tidak cocok dengan data kami.');
    }

    public function render()
    {
        return view('livewire.auth.login')
            ->layout('layouts.guest');
    }
} 