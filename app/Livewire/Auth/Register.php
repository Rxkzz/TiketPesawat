<?php

namespace App\Livewire\Auth;

use App\Models\Penumpang;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;

class Register extends Component
{
    public $username;
    public $email;
    public $password;
    public $nama_penumpang;
    public $alamat_penumpang;
    public $tanggal_lahir;
    public $jenis_kelamin;
    public $telp;

    protected $rules = [
        'username' => 'required|unique:penumpangs|min:3',
        'email' => 'required|email|unique:penumpangs',
        'password' => 'required|min:6',
        'nama_penumpang' => 'required|min:3',
        'alamat_penumpang' => 'required',
        'tanggal_lahir' => 'required|date',
        'jenis_kelamin' => 'required|in:L,P',
        'telp' => 'required|numeric'
    ];

    public function register()
    {
        $this->validate();

        $penumpang = Penumpang::create([
            'username' => $this->username,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'nama_penumpang' => $this->nama_penumpang,
            'alamat_penumpang' => $this->alamat_penumpang,
            'tanggal_lahir' => $this->tanggal_lahir,
            'jenis_kelamin' => $this->jenis_kelamin,
            'telp' => $this->telp,
        ]);

        auth('penumpang')->login($penumpang);

        return redirect()->route('home');
    }

    public function render()
    {
        return view('livewire.auth.register')
            ->layout('layouts.guest');
    }
} 