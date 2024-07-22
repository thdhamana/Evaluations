<?php

namespace App\Http\Controllers;

use App\Models\Domaine;
use App\Models\Evaluer;
use App\Models\Stand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Mockery\Loader\EvalLoader;
use Nette\Utils\Strings;

class EvaluerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.personnal.pages.evaluer.index', [
            'domaines' => Domaine::orderBy('created_at', 'desc')->paginate(25),
        ]);
    }

    public function getStandards(Domaine $domaine) {
        $allStandard = Stand::whereIn('domaine_id', $domaine)->get();
        $allStandardDocs = Evaluer::whereIn('domaine_id', $domaine)->get();
        return view('backend/personnal/pages/evaluer/evaluerIndex', [
            'evaluers' => $allStandard,
            'evaluersDocs' => $allStandardDocs,
            'standards' => Stand::all(),
        
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $evaluer = new Evaluer();
        return view('backend/personnal/pages/evaluer/form', [
            'evaluer' => $evaluer,
            'standards' => Stand::all(),
        ]);
    }

    /**
     * pour charger le fichier avec le nom du standard
    */
    public function edit(Stand $evaluer, Request $request)
    {
        // dd($evaluer)
        $nomstandard = $evaluer->nom;
        $standardId = $evaluer->id;
        $domaineId = $evaluer->domaine_id;
        $request->session()->put('stand_id', $standardId);
        $request->session()->put('domaine_id', $domaineId);
        
        return view('backend.personnal.pages.evaluer.formAdd' , [
            'nomstandard' => $nomstandard,
            'evaluer' => $evaluer,
            'standards' => Stand::all(),
        ]);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'docs'=> ['required', 'mimes:pdf'],
        ]);

        // recuperation de l'idenfiant du standard mise en session
        $data['stand_id'] = $request->session()->get('stand_id');
        $data['domaine_id'] = $request->session()->get('domaine_id');
        // recuperation de l'identifiant de l'utilisateur connecte
        $data['user_id'] = Auth::user()->id;
        // les booleans
        $data['soumetre'] = false;
        $data['etat'] = false;
        $data['resultat'] = false;

        $docs = $data['docs'];
        
        /** @var UploadedFile|null $docs */
        if ($docs !== null && !$docs->getError()) {
            $docsSansExt = pathinfo($docs->getClientOriginalName(), PATHINFO_FILENAME);
            $nouveauNom = $docsSansExt . '_' . now()->format('YmdHis') . '.' . $docs->getClientOriginalExtension();
            $docs->storeAs('public/evaluers', $nouveauNom);
            $data['docs'] = $nouveauNom;
        }

        Evaluer::create($data);
        return redirect()->route('personnal.evaluer.index')->with('success', 'Upload effectuée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    // public function edits(Evaluer $evaluer, Request $request)
    // {
    //     $nomstandard = $evaluer->stand->nom; // Assumant que le modèle Evaluer a une relation avec Stand
    //     $request->session()->put('stand_id', $evaluer->stand_id);
    //     $request->session()->put('domaine_id', $evaluer->domaine_id);
        
    //     return view('backend.personnal.pages.evaluer.formEdit', [
    //         'nomstandard' => $nomstandard,
    //         'evaluer' => $evaluer,
    //     ]);
    // }


    public function edits(Evaluer $evaluer, Request $request)
{
    dd($evaluer);
    if (!$evaluer) {
        return redirect()->route('personnal.evaluer.index')->withErrors('Document non trouvé.');
    }

    $nomstandard = $evaluer->nom;
    $standardId = $evaluer->id;
    $domaineId = $evaluer->domaine_id;
    $request->session()->put('stand_id', $standardId);
    $request->session()->put('domaine_id', $domaineId);

    return view('backend.personnal.pages.evaluer.formEdit', [
        'nomstandard' => $nomstandard,
        'evaluer' => $evaluer,
        'standards' => Stand::all(),
    ]);
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Evaluer $evaluer)
    {
        dd($evaluer);
        $data = $request->validate([
            'docs' => ['required', 'mimes:pdf'],
        ]);

        $data['stand_id'] = $request->session()->get('stand_id');
        $data['domaine_id'] = $request->session()->get('domaine_id');
        $data['user_id'] = Auth::user()->id;
        $data['soumetre'] = false;
        $data['etat'] = false;
        $data['resultat'] = false;

        if ($request->hasFile('docs')) {
            $docs = $request->file('docs');
            if ($evaluer->docs && Storage::disk('public')->exists('evaluers/' . $evaluer->docs)) {
                Storage::disk('public')->delete('evaluers/' . $evaluer->docs);
            }

            $docsSansExt = pathinfo($docs->getClientOriginalName(), PATHINFO_FILENAME);
            $nouveauNom = $docsSansExt . '_' . now()->format('YmdHis') . '.' . $docs->getClientOriginalExtension();
            $docs->storeAs('public/evaluers', $nouveauNom);
            $data['docs'] = $nouveauNom;
        }

        $evaluer->update($data);

        return redirect()->route('personnal.evaluer.index')->with('success', 'Modification effectuée avec succès');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
