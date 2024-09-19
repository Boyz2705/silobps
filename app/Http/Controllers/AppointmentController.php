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
        $app = Appointment::with(['user', 'pet', 'service', 'session', 'clinic'])->get();
        return view('admin.appointment', [
            "apps" => $app,
            "receipts" => $receipt
        ]);
    }

    public function myapp()
    {
        $rec = payment::all();
        $appointment = Appointment::with(['service', 'session', 'clinic'])->get();
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
        $bill = service::findOrFail($request->service);
        if ($request->isMethod('post')) {
            Appointment::create([
                'user_id' => $request->user_id,
                'app_date' => $request->app_date,
                'session_id' => $request->session,
                'clinic_id' => $request->branch,
                'detail' => $request->detail,
                'pet_id' => $request->pet_id,
                'service_id' => $request->service,
                'bill' => $bill->price,
            ]);
            return redirect('/');
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
}
