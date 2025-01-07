<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Http\Requests\StoreappointmentRequest;
use App\Http\Requests\UpdateappointmentRequest;
use App\Models\service;
use App\Models;
use App\Models\payment;
use App\Models\Services;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $receipt = payment::all();
        $app = Appointment::with(['user', 'pet', 'service', 'session', 'clinic'])
                ->orderBy('app_date', 'desc')
                ->get();

        return view('admin.appointment', [
            "apps" => $app,
            "receipts" => $receipt
        ]);

    }
    public function date(Request $request)
    {
    $query = Appointment::query();
        $startDate = $request->start_date; // e.g., 2024-09-23
        $endDate = $request->end_date; // Model App yang digunakan untuk logbook
        $receipt = payment::all();
        $app = Appointment::with(['user', 'pet', 'service', 'session', 'clinic'])
                ->whereBetween('app_date', [$startDate, $endDate])
                ->get();

        if ($app->isEmpty()) {
            return redirect()->back()->with('alert', 'Tidak ada logbook dalam rentang tanggal.');
        }

        return view('admin.appointment', [
            "apps" => $app,
            "receipts" => $receipt
        ]);

    // Ambil data yang sudah difilter
    $apps = $app->get();

    return view('admin.appointment', compact('apps'));
    }

    public function date2(Request $request)
    {
    $query = Appointment::query();
        $startDate = $request->start_date; // e.g., 2024-09-23
        $endDate = $request->end_date; // Model App yang digunakan untuk logbook
        $rec = payment::all();
        $appointment = Appointment::with(['service', 'session', 'clinic','pet'])
                        ->whereBetween('app_date', [$startDate, $endDate])
                        ->get();

        if ($appointment->isEmpty()) {
            return redirect()->back()->with('alert', 'Tidak ada Logbook dalam rentang tanggal');
        }

        return view('myappointment', [
            "appointments" => $appointment,
            "rec" => $rec
        ]);

    // Ambil data yang sudah difilter
    $appointments = $appointment->get();

    return view('myappointment', compact('appointments'));
    }

    public function myapp()
    {
        $rec = payment::all();
        $appointment = Appointment::with(['service', 'session', 'clinic','pet'])
                        ->orderBy('app_date', 'desc')
                        ->get();
        return view('myappointment', [
            "appointments" => $appointment,
            "rec" => $rec
        ]);
    }


    public function recap()
    {
        $app = Appointment::with(['user', 'pet', 'service', 'session', 'clinic'])->get();
        return view('admin.app-recap', [
            "apps" => $app
        ]);
    }

    public function invoice($id)
    {
        $app = Appointment::with(['user', 'pet', 'service', 'session', 'clinic'])->get();
        return view('invoice', [
            "apps" => $app,
            "id" => $id
        ]);
    }

    public function payment($id)
    {
        $app = Appointment::with(['user', 'pet', 'service', 'session', 'clinic'])->get();
        return view('payment', [
            "apps" => $app,
            "id" => $id,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAppointmentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    $bill = Service::findOrFail($request->service);
    if ($request->isMethod('post')) {
        $appointment = Appointment::create([
            'user_id' => $request->user_id,
            'app_date' => $request->app_date,
            'session_id' => $request->session,
            'clinic_id' => $request->branch,
            'detail' => $request->detail,
            'pet_id' => $request->pet_id,
            'service_id' => $request->service,
            'bill' => $bill->price,
        ]);

        $user = Auth::user();
        if ($user instanceof \App\Models\User) {
            // Pastikan bahwa $user adalah instance dari model User
            $user->status = 1; // 1 untuk unavailable
            $user->save();
        } elseif ($user) {
            // Jika $user ada tapi bukan instance User model, gunakan User::find()
            $userModel = \App\Models\User::find($user->id);
            if ($userModel) {
                $userModel->status = 1;
                $userModel->save();
            }
        } else {
            // Handle the case when the user is not authenticated
            return redirect('/login')->with('alert', 'You must be logged in to perform this action.');
        }

        return redirect('/')->with('success', 'Appointment created successfully.');
    }
    return view('/home');
}

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function show(Appointment $appointment)
    {
        return view('admin.appointment', [
            "appointment" => $appointment
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function edit(Appointment $appointment, $id)
    {
        $appointment = Appointment::findOrFail($id);
        // dd($pet);
        return view('admin.appointmentedit', [
            'appointment' => $appointment,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAppointmentRequest  $request
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->status = $request->status;
        $appointment->bill = $request->bill;
        $appointment->save();
        return redirect('/adm-app')->with('status', 'Data Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Appointment $appointment)
    {
        $appointment->delete();
        return redirect('/adm-app')->with('statusdel', 'Data Deleted');
    }

    public function updateWaktuSelesai(Request $request, $id)
{
    // Validasi input
    $request->validate([
        'waktuselesai' => 'required|date_format:H:i'
    ]);

    try {
        // Cari appointment berdasarkan ID
        $appointment = Appointment::findOrFail($id);

        // Update waktu selesai
        $appointment->waktuselesai = $request->waktuselesai;

        // Simpan perubahan
        $appointment->save();

        // Ambil appointments untuk user yang sedang login
        // $appointments = Appointment::with(['session', 'clinic', 'service', 'pet'])
        //     ->where('user_id', Auth::user()->id)
        //     ->orderBy('app_date', 'desc')
        //     ->get();

        // Return view dengan appointments
        return redirect()->back()
            ->with('success', 'Waktu selesai berhasil diupdate');

    } catch (\Exception $e) {
        // Ambil appointments untuk user yang sedang login
        $appointments = Appointment::with(['session', 'clinic', 'service', 'pet'])
            ->where('user_id', Auth::user()->id)
            ->orderBy('app_date', 'desc')
            ->get();

        // Return view dengan error
        return view('myappointment', compact('appointments'))
            ->with('error', 'Gagal mengupdate waktu selesai: ' . $e->getMessage());
    }
}
}
