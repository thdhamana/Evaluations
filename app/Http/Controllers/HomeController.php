<?php

namespace App\Http\Controllers;

use App\Models\Domaine;
use App\Models\Referentiel;
use App\Models\Stand;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view("frontend.home", [
            'referentiels' => Referentiel::all(),                                                                   
        ]);
    }

    public function adminHome()
    {
        return view("backend/adminDashboard");
    }

    public function personnalHome()
    {
        return view("backend/personnalDashboard");
    }

    // pour les views du personnel
    public function referentiel()
    {
        return view("backend/personnal/pages/referentiel/index" ,[
            "referentiels"=> Referentiel::orderBy("created_at","desc")->paginate(2)
        ]);
    }

    public function domaine()
    {
        return view("backend/personnal/pages/domaine/index" ,[
            "domaines"=> Domaine::orderBy("created_at","desc")->paginate(25)
        ]);
    }

    public function standard(Domaine $domaine) {
        $standards = Stand::whereIn('domaine_id', $domaine)->get();
        return view('backend/personnal/pages/domaine/standardIndex', [
            'standards' => $standards
        ]);
    }

    

}
