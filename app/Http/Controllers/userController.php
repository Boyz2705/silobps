<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\clinic;
use App\Models\Appointment;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;

class userController extends Controller
{
    public function index()
    {
        return view('admin.user', [
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
        $user->save();
        return redirect('home');
    }

    public function updateadm(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->email = $request->email;
        $user->name = $request->name;
        $user->address = $request->address;
        $user->notelp = $request->number;
        $user->city = $request->city;
        $user->role = $request->role;
        $user->save();
        return redirect('/adm-user');
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
}
