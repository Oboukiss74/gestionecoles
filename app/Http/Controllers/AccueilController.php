<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Classes;
class AccueilController extends Controller
{
    //
    public function index()
    {
        return view('dist.form-elements');
    }
    //creer une fonction qui regroupe toutes les vues dependant du clic pour afficher la vue correspondante
    public function AfficherLesDist($page)
    {
        $niveau = Classes::all();
        return view('dist.' . $page, compact('niveau'));
    }
    public function AfficherLesSrc($page)
    {
        return view('src.' . $page);
    }
}
