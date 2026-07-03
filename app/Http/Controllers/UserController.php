<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('user.index',[
            'title' => 'User',
            'users' => User::latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.create',[
            'title' => 'Tambah User',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
$validated = $request->validate([
    'name'            => 'required|string|max:255',
    'email'           => 'required|string|email|max:255|unique:users,email', 
    'password'        => 'required|string|min:8',
    'passwordconfirm' => 'required|same:password',
    'avatar'          => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Diubah ke 2048 agar sesuai dengan 2MB
    'role'            => 'required|in:Superadmin,Admin',
], [
    'name.required'             => 'Nama wajib diisi.',
    'name.max'                  => 'Nama tidak boleh lebih dari :max karakter.',
    
    'email.required'            => 'Email wajib diisi.',
    'email.email'               => 'Format email tidak valid.',
    'email.max'                 => 'Email tidak boleh lebih dari :max karakter.',
    'email.unique'              => 'Email sudah terdaftar.',
    
    'password.required'         => 'Password wajib diisi.',
    'password.min'              => 'Password minimal harus :min karakter.',

    // Tambahan pesan error untuk passwordconfirm
    'passwordconfirm.required'  => 'Konfirmasi password wajib diisi.',
    'passwordconfirm.same'      => 'Konfirmasi password harus sama dengan password.',
    
    'avatar.image'              => 'Avatar harus berupa gambar.',
    'avatar.mimes'              => 'Format gambar harus jpeg, png, atau jpg.',
    'avatar.max'                => 'Ukuran gambar maksimal :max KB (2MB).', // Menggunakan :max agar dinamis
    
    'role.required'             => 'Role wajib dipilih.',
    'role.in'                   => 'Role yang dipilih harus Superadmin atau Admin.',
]);

    DB::beginTransaction();
            try {

            if($request->file('avatar')) {
                $validated['avatar'] = $request->file('avatar')->store('avatar', 'public');
            }

            $validated['password'] = bcrypt($request->password);
            $validated['email_verified_at'] = now();

                
                User::create($validated);
                DB::commit();
                return to_route('user.index')->withSuccess('Data Berhasil Di Tambahkan');


            } catch(\Exception $e) {
                DB::rollBack();
                return to_route('user.create')->withError('Data Gagal Di Tambahkan');
            }

    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('user.show',[
            'title' => 'Detail User',
            'user' => $user,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('user.edit',[
            'title' => 'Edit User',
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name'            => 'required|string|max:255',
            'email'           => 'required|string|email|max:255|unique:users,email,' .$user->id, 
            'password'        => 'nullable|string|min:8',
            'passwordconfirm' => 'nullable|same:password',
            'avatar'          => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Diubah ke 2048 agar sesuai dengan 2MB
            'role'            => 'required|in:Superadmin,Admin',
        ], [
            'name.required'             => 'Nama wajib diisi.',
            'name.max'                  => 'Nama tidak boleh lebih dari :max karakter.',
    
            'email.required'            => 'Email wajib diisi.',
            'email.email'               => 'Format email tidak valid.',
            'email.max'                 => 'Email tidak boleh lebih dari :max karakter.',
            'email.unique'              => 'Email sudah terdaftar.',
    
            'password.required'         => 'Password wajib diisi.',
            'password.min'              => 'Password minimal harus :min karakter.',

            // Tambahan pesan error untuk passwordconfirm
            'passwordconfirm.required'  => 'Konfirmasi password wajib diisi.',
            'passwordconfirm.same'      => 'Konfirmasi password harus sama dengan password.',
    
            'avatar.image'              => 'Avatar harus berupa gambar.',
            'avatar.mimes'              => 'Format gambar harus jpeg, png, atau jpg.',
            'avatar.max'                => 'Ukuran gambar maksimal :max KB (2MB).', // Menggunakan :max agar dinamis
    
            'role.required'             => 'Role wajib dipilih.',
            'role.in'                   => 'Role yang dipilih harus Superadmin atau Admin.',
        ]);

        DB::beginTransaction();
            try {

            if($request->file('avatar')) {
                $validated['avatar'] = $request->file('avatar')->store('avatar', 'public');
                if($user->avatar) {
                    Storage::disk('public')->delete($user->avatar);
                }
            }


            if($request->password){
                $validated['password'] = bcrypt($request->password);
            } else {
                unset($validated['password']);
            }

                
                $user->update($validated);
                DB::commit();
                return to_route('user.index')->withSuccess('Data Berhasil Di Ubah');


            } catch(\Exception $e) {
                DB::rollBack();
                return to_route('user.edit', $user)->withError('Data Gagal Di Ubah');
            }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        DB::beginTransaction();
        try {

        $user->delete();
        if($user->avatar) {
        Storage::disk('public')->delete($user->avatar);
        }
            DB::commit();
                return to_route('user.index')->withSuccess('Data Berhasil Di Hapus');


                } catch(\Exception $e) {
                    DB::rollBack();
                    return to_route('user.index')->withError('Data Gagal Di Hapus');
                }
    }
}
