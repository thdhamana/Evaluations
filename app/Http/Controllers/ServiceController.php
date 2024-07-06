<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Route;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("backend.admin.pages.service.index" , [
            "services"=> Service::orderBy("created_at","asc")->paginate(2)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $service = new Service();
        return view("backend.admin.pages.service.form" , [
           'service' => $service
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $id = $request->route('service');
        $request->validate([
            'nom' => ['required' , 'string', 'min:2' ,  Rule::unique('services')->ignore($id, 'id')],
            'abreger' => ['required', 'string', 'min:2' , Rule::unique('services')->ignore($id,'id')],
        ]);
        Service::create($request->all());
        return redirect()->route('admin.service.index')->with('success','Ajout éffectué avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        return view('backend.admin.pages.service.form' , [
            'service' => $service
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
    {
        $id = $request->route('service');
        $request->validate([
            'nom' => ['required' , 'string', 'min:2' ,  Rule::unique('services')->ignore($id, 'id')],
            'abreger' => ['required', 'string', 'min:2' , Rule::unique('services')->ignore($id,'id')],
        ]);
        $data = $request->all();
        $service -> update($data);
        return redirect()->route('admin.service.index')->with('success','Modification éffectuée avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('admin.service.index')->with('success','Modification éffectuée avec succès');
    }
}
