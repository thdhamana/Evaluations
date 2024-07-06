<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("backend.admin.pages.section.index" , [
            "sections"=> Section::orderBy("created_at","asc")->paginate(2),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $section = new Section();
        return view("backend.admin.pages.section.form" , [
           'section' => $section,
           'services' => Service::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $id = $request->route('section');
        $request->validate([
            'nom' => ['required' , 'string', 'min:2' ,  Rule::unique('sections')->ignore($id, 'id')],
            'abreger' => ['required', 'string', 'min:2' , Rule::unique('sections')->ignore($id,'id')],
            'service_id'=> ['required','exists:services,id'],
        ]);
        Section::create($request->all());
        return redirect()->route('admin.section.index')->with('success','Ajout éffectué avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(Section $section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Section $section)
    {
        return view('backend.admin.pages.section.form' , [
            'section' => $section,
            'services' => Service::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Section $section)
    {
        $id = $request->route('section');
        $request->validate([
            'nom' => ['required' , 'string', 'min:2' ,  Rule::unique('sections')->ignore($id, 'id')],
            'abreger' => ['required', 'string', 'min:2' , Rule::unique('sections')->ignore($id,'id')],
            'service_id'=> ['required','exists:services,id'],
        ]);
        $data = $request->all();
        $section -> update($data);
        return redirect()->route('admin.section.index')->with('success','Modification éffectuée avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Section $section)
    {
        $section->delete();
        return redirect()->route('admin.section.index')->with('success','Modification éffectuée avec succès');
    }
}
