<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\clinic;
use App\Models\Appointment;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class userController extends Controller
{
    public function index()
    {
        return view('admin.user', [
            "users" => User::all()
        ]);
    }

    public function status()
    {
        return view('admin.status', [
            "users" => User::all()
        ]);
    }

    public function admin()
    {
        $app = Appointment::with(['user', 'pet', 'service', 'session', 'clinic'])->get();
        $currdate = Carbon::now("Asia/Jakarta")->format('Y-m-d');
        return view('admin.admin', [
            "users" => User::all(),
            "clinics" => clinic::all(),
            "apps" => $app,
            "date" => Carbon::now("Asia/Jakarta")->format('l, d-m-Y'),
            "currdate" => $currdate
        ]);
    }

    // public function show()
    // {
    //     $app = Appointment::with(['user', 'pet', 'service', 'session', 'clinic'])->get();
    //     return view('admin.admin', [
    //         "appss" => $app
    //     ]);
    // }

    public function store(Request $request)
    {
        if ($request->isMethod('post')) {
            user::create([
                'id' => $request->id,
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'address' => $request->address,
                'notelp' => $request->number,
                'city' => $request->city,
                'role' => $request->role,
                'status' => $request->status,
                'petugas' => $request->petugas,
            ]);
            return redirect('/adm-user')->with('status', 'New Data Added to Database');
        }
        return view('/adm-user');
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->email = $request->email;
        $user->name = $request->name;
        $user->address = $request->address;
        $user->notelp = $request->number;
        $user->city = $request->city;
        $user->petugas = $request->petugas;
        $user->save();
        return redirect('home');
    }

    public function updateadm(Request $request, $id)
{
    // Validasi input
    $request->validate([
        'email' => 'required|email',
        'name' => 'required|string|max:255',
        'address' => 'nullable|string|max:255',
        'number' => 'nullable|string|max:15',
        'city' => 'nullable|string|max:100',
        'role' => 'required|string',
        'password' => 'nullable|string|min:8|confirmed', // Validasi password
    ]);

    $user = User::findOrFail($id);
    $user->email = $request->email;
    $user->name = $request->name;
    $user->address = $request->address;
    $user->notelp = $request->number;
    $user->city = $request->city;
    $user->role = $request->role;

    // Jika password baru diberikan, hash dan simpan
    if ($request->filled('password')) {
        $user->password = bcrypt($request->password);
    }

    $user->save();
    return redirect('/adm-user')->with('success', 'User  updated successfully.');
}

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('profile', ['user' => $user])->with('status', 'Changes Saved');
    }

    public function editadm(User $user, $id)
    {
        $user = User::findOrFail($id);
        // dd($pet);
        return view('admin.useredit', ['user' => $user]);
    }

    public function destroy(user $user)
    {
        $user->delete();
        return redirect('/adm-user')->with('statusdel', 'Data Deleted');
    }

    public function resetStatus()
    {
        // Mengupdate status semua pengguna menjadi 0
        User::query()->update(['status' => 0]);

        // Redirect ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('status', 'All user statuses have been reset to available');
    }

    public function availStatus()
    {
        // Mengupdate status semua pengguna menjadi 0
        User::query()->update(['status' => 0]);

        // Redirect ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('status', 'All user statuses have been reset to sedia');
    }

    public function sibukStatus(Request $request, $id)
{
    // Mengambil user berdasarkan ID
    $user = User::findOrFail($id);

    // Mengubah status user sesuai request (misalnya status sibuk = 1)
    $user->status = 1;  // Atau $request->status jika ingin lebih dinamis

    // Menyimpan perubahan
    $user->save();

    // Redirect ke halaman home dengan pesan sukses
    return redirect('home')->with('status', 'Status berhasil diubah menjadi sibuk');
}

public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|integer|in:0,1,2,3',
        ]);

        $user = User::findOrFail($id);
        $user->status = $request->status;
        $user->save();

        return redirect()->back()->with('status', 'Status pengguna berhasil diperbarui.');
    }
}
