<?php

namespace App\Http\Controllers;

use App\Models\Domaine;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DomaineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("backend.admin.pages.domaine.index" , [
            "domaines"=> Domaine::orderBy("created_at","desc")->paginate(25)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $domaine = new Domaine();
        return view("backend.admin.pages.domaine.form" , [
           'domaine' => $domaine
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $id = $request->route('domaine');
        $request->validate([
            'nom' => ['required' , 'string', 'min:2' ,  Rule::unique('domaines')->ignore($id, 'id')],
            'description' => ['required', 'string', 'min:8'],
        ]);
        Domaine::create($request->all());
        return redirect()->route('admin.domaine.index')->with('success','Ajout éffectué avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(Domaine $domaine)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Domaine $domaine)
    {
        return view('backend.admin.pages.domaine.form' , [
            'domaine' => $domaine
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Domaine $domaine)
    {
        $id = $request->route('domaine');
        $request->validate([
            'nom' => ['required' , 'string', 'min:2' ,  Rule::unique('domaines')->ignore($id, 'id')],
            'description' => ['required', 'string', 'min:8'],
        ]);
        
        $data = $request->all();
        $domaine -> update($data);
        return redirect()->route('admin.domaine.index')->with('success','Modification éffectuée avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Domaine $domaine)
    {
        $domaine->delete();
        return redirect()->route('admin.domaine.index')->with('success','Modification éffectuée avec succès');
    }
}
