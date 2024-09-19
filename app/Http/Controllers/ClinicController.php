<?php

namespace App\Http\Controllers;

use App\Models\clinic;
use App\Http\Requests\StoreclinicRequest;
use App\Http\Requests\UpdateclinicRequest;
use Illuminate\Http\Request;

class ClinicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.clinic', [
            "clinics" => clinic::all()
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
     * @param  \App\Http\Requests\StoreclinicRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreclinicRequest $request)
    {
        if ($request->isMethod('post')) {
            clinic::create([
                'id' => $request->id,
                'clinic_name' => $request->clinic_name,
                'clinic_address' => $request->clinic_address,
                'img_link' => $request->img_link,
                'map_link' => $request->map_link,
            ]);
            return redirect('/adm-clinic')->with('status', 'New Data Added to Database');
        }
        return view('/adm-clinic');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\clinic  $clinic
     * @return \Illuminate\Http\Response
     */
    public function show(clinic $clinic)
    {
        return view('/adm-clinic', [
            "clinics" => $clinic
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\clinic  $clinic
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $clinic = clinic::findOrFail($id);
        return view('admin.clinicedit', ['clinic' => $clinic]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateclinicRequest  $request
     * @param  \App\Models\clinic  $clinic
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $clinic = clinic::findOrFail($id);
        $clinic->id = $request->id;
        $clinic->clinic_name = $request->name;
        $clinic->clinic_address = $request->address;
        $clinic->img_link = $request->img_link;
        $clinic->map_link = $request->map_link;
        $clinic->save();
        return redirect('/adm-clinic')->with('status', 'Changes Saved');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\clinic  $clinic
     * @return \Illuminate\Http\Response
     */
    public function destroy(clinic $clinic)
    {
        $clinic->delete();
        return redirect('/adm-clinic')->with('statusdel', 'Data Deleted');
    }
}
