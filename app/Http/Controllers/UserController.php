<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //pour recuperer le nombre exact des user qui ont l'attribut evaluateur
        $countEvaluateurs = User::where('evaluateur', 0)->count();
        return view("backend.admin.pages.evaluateur.index" , [
            "evaluateurs"=> User::orderBy("created_at","desc")->paginate(10),
            'countEvaluateurs' => $countEvaluateurs,
        ]);
    }

    /**
     * Show the form for creating a new resource.
    */
    public function create()
    {
        $evaluateur = new User();
        return view("backend.admin.pages.evaluateur.createForm" , [
           'evaluateur' => $evaluateur,
        ]);
    }

    /**
     * Store a newly created resource in storage.
    */
    public function store(UserRequest $request)
    {
        $data = $request->validated();
        
        // Compare password with password confirmation
        if ($data['password'] !== $data['confirme']) {
            return redirect()->back()->withErrors(['confirme' => 'Le mot de passe est incorrest.'])->withInput();
        }
        $data['password'] = Hash::make($data['password']);

        // Set default value for the boolean field
        $data['niveau'] = false;
        $data['droit_eval'] = false;
        $data['evaluateur'] = false;

        // Upload and store the photo
        $photo = $request->file('photo');
        if ($photo !== null && !$photo->getError()) {
            $photoSansExt = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);
            $nouveauNom = $photoSansExt . '_' . now()->format('YmdHis') . '.' . $photo->getClientOriginalExtension();
            $photo->storeAs('public/evaluateurs', $nouveauNom);
            $data['photo'] = $nouveauNom;
        }

        // Create the user
        User::create($data);
        return redirect()->route('admin.evaluateur.index')->with('success', 'Ajout éffectué avec succès');
    }


    /**
     * Display the specified resource.
     */
    public function show(User $evaluateur)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $evaluateur)
    {
        return view('backend.admin.pages.evaluateur.editForm' , [
            'evaluateur' => $evaluateur,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, User $evaluateur)
    {
        $data = $request->validated();
        
        // Compare password with password confirmation
        if ($data['password'] !== $data['confirme']) {
            return redirect()->back()->withErrors(['confirme' => 'Le mot de passe est incorrest.'])->withInput();
        }
        $data['password'] = Hash::make($data['password']);

        // Set default value for the boolean field
        $data['niveau'] = false;

        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            if ($evaluateur->photo) {
                Storage::disk('public')->delete('evaluateurs/'.$evaluateur->photo);
            }

            $photoSansExt = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);
            $nouveauNom = $photoSansExt . '_' . now()->format('YmdHis') . '.' . $photo->getClientOriginalExtension();
            $photo->storeAs('public/evaluateurs', $nouveauNom);
            $data['photo'] = $nouveauNom;
        }

        // Create the user
        $evaluateur->update($data);
        return redirect()->route('admin.evaluateur.index')->with('success', 'Modification éffectué avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $evaluateur)
    {
        if ($evaluateur->photo) {
            Storage::disk('public')->delete('evaluateurs/'.$evaluateur->photo);
        }
        $evaluateur->delete();
        return redirect()->route('admin.evaluateur.index')->with('success','Modification éffectuée avec succès');
    }


    // Pour attribuer le droit d'evaluer
    public function updateDroitEvaluateur(Request $request)
    {
        // reccuperer l'identifiant du champ input de type hidden
        $evaluateurId = $request->input('evaluateur_id');
        // rechercher dans la base de donnee
        $evaluateur = User::find($evaluateurId);
        if ($evaluateur) {
            // verifier
            $isChecked = $request->has('droit_eval');
            $evaluateur->droit_eval = $isChecked;
            $evaluateur->save();
            return redirect()->back()->with('success', 'État de l\'évaluateur mis à jour avec succès');
        } else {
            return redirect()->back()->with('error', 'Évaluateur non trouvé');
        }
    }


    // methode pour retirer parmi les evaluateur
    public function updateEvaluateur(Request $request)
    {
        // reccuperer l'identifiant du champ input de type hidden
        $evaluateurId = $request->input('evaluateur_id');
        // rechercher dans la base de donnee
        $evaluateur = User::find($evaluateurId);
        if ($evaluateur) {
            // verifier
            $isChecked = $request->has('evaluateur');
            $evaluateur->evaluateur = $isChecked;
            $evaluateur->save();
            return redirect()->back()->with('success', 'Retrait effectué avec succès');
        } else {
            return redirect()->back()->with('error', 'Évaluateur non trouvé');
        }
    }

    /**
     * Rechercher un utilisateur par e-mail ou numéro de téléphone.
     */
    public function searchUser(Request $request)
    {
        $request->validate([
            'search' => 'required|string',
        ]);

        $searchTerm = $request->input('search');

        // requet pour rechercher dans la bd
        $user = User::where('email', $searchTerm)
                    ->orWhere('telephone', $searchTerm)
                    ->first();

        if ($user) {
            return view('backend.admin.pages.evaluateur.createForm', [
                'evaluateur' => $user,
                'inputIne' => $searchTerm,
            ]);
        } else {
            return redirect()->back()->withErrors(['search' => 'Aucun utilisateur correspondant trouvé'])->withInput();
        }
    }
//     public function updateDroitEvaluateur(Request $request)
// {
//     $evaluateur = Evaluateur::find($request->id);
//     if ($evaluateur) {
//         $evaluateur->droit_evaluateur = $request->droit_evaluateur;
//         $evaluateur->save();
//         return response()->json(['success' => true, 'message' => 'Droit de l\'évaluateur mis à jour avec succès']);
//     }
//     return response()->json(['success' => false, 'message' => 'Évaluateur non trouvé']);
// }


    // methode pour le telechargement d'un evaluateur
    // public function download(User $evaluateur)
    // {
    //     $photoPath = storage_path('app/public/evaluateurs/' . $evaluateur->photo);

    //     if (file_exists($photoPath)) {
    //         return response()->download($photoPath, $evaluateur->photo);
    //     } else {
    //         abort(404);
    //     }
    // }

}
