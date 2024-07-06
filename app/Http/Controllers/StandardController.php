<?php

namespace App\Http\Controllers;

use App\Models\Domaine;
use App\Models\Stand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class StandardController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("backend.admin.pages.stand.index" , [
            "stands"=> Stand::orderBy("created_at","desc")->paginate(10),
            "domaines"=> Domaine::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $stand = new Stand();
        return view("backend.admin.pages.stand.form" , [
           'stand' => $stand,
           "domaines"=> Domaine::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nom' => ['required', 'min:8', Rule::unique('stands')->ignore($request->id, 'id')],
            'domaine_id' => ['required', 'exists:domaines,id'],  
            'fichier' => ['required', 'mimes:pdf'],
        ]);

        $fichier = $request->file('fichier');

        if ($fichier) {
            $nouveauNom = pathinfo($fichier->getClientOriginalName(), PATHINFO_FILENAME) . '_' . now()->format('YmdHis') . '.' . $fichier->getClientOriginalExtension();
            $fichier->storeAs('public/standards', $nouveauNom);
            $data['fichier'] = $nouveauNom;
        }

        Stand::create($data);
        return redirect()->route('admin.stand.index')->with('success', 'Ajout effectué avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(Stand $stand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Stand $stand)
    {
        return view('backend.admin.pages.stand.form' , [
            'stand' => $stand,
            "domaines"=> Domaine::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Stand $stand)
    {
        $request->validate([
            'nom' => ['required', 'min:8', Rule::unique('stands')->ignore($stand->id, 'id')],
            'domaine_id' => ['required', 'exists:domaines,id'],
            'fichier' => ['nullable', 'mimes:pdf'],
        ]);

        $data = $request->all();

        if ($request->hasFile('fichier')) {
            $pdf = $request->file('fichier');
            if ($stand->fichier) {
                // Supprimer l'ancien fichier
                Storage::disk('public')->delete('standards/' . $stand->fichier);
            }
            
            // Générer un nouveau nom de fichier avec la date actuelle
            $pdfSansExt = pathinfo($pdf->getClientOriginalName(), PATHINFO_FILENAME);
            $nouveauNom = $pdfSansExt . '_' . now()->format('YmdHis') . '.' . $pdf->getClientOriginalExtension();
            $pdf->storeAs('public/standards', $nouveauNom);
            $data['fichier'] = $nouveauNom;
        }

        $stand->update($data);

        return redirect()->route('admin.stand.index')->with('success', 'Modification effectuée avec succès');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stand $stand)
    {
        if($stand->fichier){
            Storage::disk('public')->delete('standards/'.$stand->fichier);
        }
        $stand->delete();
        return redirect()->route('admin.stand.index')->with('success','Suppression éffectuée avec succès');
    }

    // pour la previsualisation du pdf
    public function preview($id)
    {
        $stand = Stand::findOrFail($id);
        $filePath = storage_path('public/standards' . $stand->fichier);

        if (!file_exists($filePath)) {
            abort(404, 'Le fichier n\'existe pas.');
        }

        return response()->file($filePath);
    }

}
