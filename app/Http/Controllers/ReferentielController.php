<?php

namespace App\Http\Controllers;

use App\Models\Referentiel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ReferentielController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("backend.admin.pages.referentiel.index" , [
            "referentiels"=> Referentiel::orderBy("created_at","desc")->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $referentiel = new referentiel();
        return view("backend.admin.pages.referentiel.form" , [
           'referentiel' => $referentiel,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $id = $request->route('referentiel');
        $data = $request->validate([
            'nom' => ['required' , 'string', 'min:5' ,  Rule::unique('referentiels')->ignore($id, 'id')],
            'pdf'=> ['required', 'mimes:pdf'],
        ]);

        $pdf = $data['pdf'];
        
        /** @var UploadedFile|null $pdf */
        if ($pdf !== null && !$pdf->getError()) {
            $pdfSansExt = pathinfo($pdf->getClientOriginalName(), PATHINFO_FILENAME);
            $nouveauNom = $pdfSansExt . '_' . now()->format('YmdHis') . '.' . $pdf->getClientOriginalExtension();
            $pdf->storeAs('public/referentiels', $nouveauNom);
            $data['pdf'] = $nouveauNom;
        }

        Referentiel::create($data);
        return redirect()->route('admin.referentiel.index')->with('success','Ajout éffectué avec succès');
    }


    /**
     * Display the specified resource.
     */
    public function show(referentiel $referentiel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(referentiel $referentiel)
    {
        return view('backend.admin.pages.referentiel.form' , [
            'referentiel' => $referentiel,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Referentiel $referentiel)
    {
        $id = $referentiel->id;
        $request->validate([
            'nom' => ['required', 'string', 'min:5', Rule::unique('referentiels')->ignore($id, 'id')],
            'pdf' => ['nullable', 'mimes:pdf'],
        ]);

        $data = $request->all();

        if ($request->hasFile('pdf')) {
            $pdf = $request->file('pdf');
            if ($referentiel->pdf) {
                Storage::disk('public')->delete('referentiels/'.$referentiel->pdf);
            }
            
            // Générer un nouveau nom de fichier avec la date actuelle
            $pdfSansExt = pathinfo($pdf->getClientOriginalName(), PATHINFO_FILENAME);
            $nouveauNom = $pdfSansExt . '_' . now()->format('YmdHis') . '.' . $pdf->getClientOriginalExtension();
            $pdf->storeAs('public/referentiels', $nouveauNom);
            $data['pdf'] = $nouveauNom;
        }
    

        $referentiel->update($data);
        return redirect()->route('admin.referentiel.index')->with('success', 'Modification effectuée avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(referentiel $referentiel)
    {
        if ($referentiel->pdf) {
            Storage::disk('public')->delete('referentiels/'.$referentiel->pdf);
        }
        $referentiel->delete();
        return redirect()->route('admin.referentiel.index')->with('success','Suppression éffectuée avec succès');
    }


    // methode pour le telechargement d'un referentiel
    public function download(Referentiel $referentiel)
    {
        $pdfPath = storage_path('app/public/referentiels/' . $referentiel->pdf);

        if (file_exists($pdfPath)) {
            return response()->download($pdfPath, $referentiel->pdf);
        } else {
            abort(404);
        }
    }

}
