<?php

namespace App\Http\Controllers;

use App\Models\service;
use App\Http\Requests\StoreserviceRequest;
use App\Http\Requests\UpdateserviceRequest;
// use GuzzleHttp\Psr7\Request;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['services'] = service::orderBy('id')->paginate(5);
        return view('admin.services', $data);
    }

    // public function indexhome()
    // {
    //     return view('home', [
    //         "services" => service::all()
    //     ]);
    // }

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
     * @param  \App\Http\Requests\StoreserviceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreserviceRequest $request)
    {
        // dd($request->name);
        if ($request->isMethod('post')) {
            service::create([
                'id' => $request->id,
                'services_name' => $request->name,
                'img_link' => $request->img_link,
                'srv_routes' => $request->routes,
                'price' => $request->price,
            ]);
            return redirect('/adm-services')->with('status', 'New Data Added to Database');
        }
        return view('/adm-services');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(service $service)
    {
        return view('/adm-services', [
            "service" => $service
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $service = service::findOrFail($id);
        // dd($pet);
        return view('admin.servicesedit', ['service' => $service]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateserviceRequest  $request
     * @param  \App\Models\service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $service = service::findOrFail($id);
        $service->id = $request->id;
        $service->services_name = $request->name;
        $service->img_link = $request->img_link;
        $service->price = $request->price;
        $service->save();
        return redirect('/adm-services')->with('status', 'Changes Saved');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(service $service)
    {
        $service->delete();
        return redirect('/adm-services')->with('statusdel', 'Data Deleted');
    }
}
