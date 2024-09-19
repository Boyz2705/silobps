<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\service;
use App\Models\Gallery;
use App\Models\clinic;
use App\Models\Session;
use App\Http\Requests\StorePetRequest;
use Illuminate\Http\Request;
use App\Http\Requests\UpdatePetRequest;

class PetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function indexs()
    {
        $data['pets'] = Pet::orderBy('id')->paginate(5);
        return view('admin.pet', $data);
    }

    public function index()
    {
        return view('home', [
            "pets" => Pet::all(),
            "services" => service::all(),
            "galleries" => Gallery::all(),
            "clinics" => clinic::all(),
            "sessions" => Session::all()
        ]);
    }

    public function grooming()
    {
        return view('services.grooming', [
            "pets" => Pet::all(),
            "services" => service::all(),
            "clinics" => clinic::all(),
            "sessions" => Session::all()
        ]);
    }

    public function vaccine()
    {
        return view('services.vaccine', [
            "pets" => Pet::all(),
            "services" => service::all(),
            "clinics" => clinic::all(),
            "sessions" => Session::all()
        ]);
    }

    public function surgery()
    {
        return view('services.surgery', [
            "pets" => Pet::all(),
            "services" => service::all(),
            "clinics" => clinic::all(),
            "sessions" => Session::all()
        ]);
    }

    public function consultation()
    {
        return view('services.consultation', [
            "pets" => Pet::all(),
            "services" => service::all(),
            "clinics" => clinic::all(),
            "sessions" => Session::all()
        ]);
    }

    public function adm_pet()
    {
        return view('admin.pet', [
            "pets" => Pet::all()
        ]);
    }

    public function tests()
    {
        return view('admin.appointment', [
            "pets" => Pet::all()
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
     * @param  \App\Http\Requests\StorePetRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePetRequest $request)
    {
        if ($request->isMethod('post')) {
            Pet::create([
                'id' => $request->id,
                'pet_name' => $request->name,
            ]);
            return redirect('/adm-pet')->with('status', 'New Data Added to Database');
        }
        return view('/adm-pet');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pet  $pet
     * @return \Illuminate\Http\Response
     */
    public function show(Pet $pet)
    {
        return view('home', [
            "pet" => $pet
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pet  $pet
     * @return \Illuminate\Http\Response
     */
    public function edit(Pet $pet)
    {
        return view('admin.petedit', compact('pet'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePetRequest  $request
     * @param  \App\Models\Pet  $pet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $request->validate([
        //     'nama' => 'required',
        //     'email' => 'required',
        //     'alamat' => 'required',
        // ]);
        $pet = Pet::findOrFail($id);
        $pet->id = $request->id;
        $pet->pet_name = $request->name;
        $pet->save();
        return redirect('/adm-pet');
    }

    /** 
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pet  $pet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pet $pet)
    {
        $pet->delete();
        return redirect('/adm-pet')->with('statusdel', 'Data Deleted');
    }

    public function peteditf(Request $request, $id)
    {
        $pet = Pet::findOrFail($id);
        // dd($pet);
        return view('admin.petedit', ['pet' => $pet])->with('status', 'Changes Saved');
    }
}
