<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('customer.profile.edit');
    }

    public function update(Request $request)
    {
        $user = auth('penumpang')->user();

        // Validasi dasar untuk semua field
        $rules = [
            'nama_penumpang' => [
                'required',
                'string',
                'max:255',
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('penumpangs')->ignore($user->id_penumpang, 'id_penumpang')
            ],
            'telp' => [
                'required',
                'numeric',
                'digits_between:10,13',
            ],
            'alamat_penumpang' => [
                'required',
                'string',
                'max:500'
            ],
            'profile_photo' => [
                'nullable',
                'image',
                'mimes:jpeg,png,jpg',
                'max:2048',
            ],
        ];

        // Validasi password hanya jika user mencoba mengubah password
        if ($request->filled('current_password') || $request->filled('password')) {
            $rules['current_password'] = [
                'required',
                function ($attribute, $value, $fail) use ($user) {
                    if (!Hash::check($value, $user->password)) {
                        $fail('Password saat ini tidak sesuai dengan password Anda.');
                    }
                },
            ];
            
            $rules['password'] = [
                'required',
                'min:8',
                'confirmed'
            ];

            $rules['password_confirmation'] = [
                'required'
            ];
        }

        $messages = [
            'nama_penumpang.required' => 'Nama lengkap tidak boleh kosong',
            'nama_penumpang.string' => 'Nama lengkap harus berupa teks',
            'nama_penumpang.max' => 'Nama lengkap maksimal 255 karakter',
            
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah digunakan',
            
            'telp.required' => 'Nomor telepon tidak boleh kosong',
            'telp.numeric' => 'Nomor telepon harus berupa angka',
            'telp.digits_between' => 'Nomor telepon harus antara 10-13 digit',
            
            'alamat_penumpang.required' => 'Alamat tidak boleh kosong',
            'alamat_penumpang.max' => 'Alamat maksimal 500 karakter',
            
            'profile_photo.image' => 'File harus berupa gambar',
            'profile_photo.mimes' => 'Format gambar harus jpeg, png, atau jpg',
            'profile_photo.max' => 'Ukuran gambar maksimal 2MB',
            
            'current_password.required' => 'Password saat ini harus diisi',
            'password.required' => 'Password baru harus diisi',
            'password.min' => 'Password minimal 8 karakter',
            'password.confirmed' => 'Konfirmasi password tidak sesuai',
            'password_confirmation.required' => 'Konfirmasi password harus diisi'
        ];

        $request->validate($rules, $messages);

        // Update foto profile jika ada
        if ($request->hasFile('profile_photo')) {
            // Hapus foto lama jika ada
            if ($user->profile_photo) {
                Storage::disk('public')->delete($user->profile_photo);
            }

            // Upload foto baru
            $path = $request->file('profile_photo')->store('profile-photos', 'public');
            $user->profile_photo = $path;
        }

        // Update data user
        $user->nama_penumpang = $request->nama_penumpang;
        $user->email = $request->email;
        $user->telp = $request->telp;
        $user->alamat_penumpang = $request->alamat_penumpang;

        // Update password jika ada
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return back()->with('success', 'Profile berhasil diperbarui');
    }
} 