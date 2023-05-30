<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Huisdier;
use App\Models\User;
use App\Models\Reactie;
use App\Models\Soort;
use App\Models\ReviewOppasser;
use App\Models\ReviewHuisdier;




class DashboardController extends Controller
{
    public function show(){

        //om al je eigen shit te vinden
        $currentUserEmail = auth()->user()->email;
        //all je eigen huisdieren
        $huisdieren = User::where('email', $currentUserEmail)->first()->allHuisdieren;
        //alle eigen_aanvragen die je voor je huisdieren hebt
        $eigen_aanvragen = array();
        foreach ($huisdieren as $huisdier){
            $eigen_aanvragenPerDier = $huisdier->allAanvragen;
            if ($eigen_aanvragenPerDier){
                foreach ($eigen_aanvragenPerDier as $aanvraag) {
                    if($aanvraag->beschikbaar){
                        array_push($eigen_aanvragen, $aanvraag);
                    }
                }
            }
        }
        $reacties = Reactie::all();



        //alle gebuikers
        $gebruikers = User::all();
        // Alle aanvragen, behalve die van jezelf, zodat je kan browsen
        $aanvragen = array();
        foreach ($gebruikers as $gebruiker){
            if ($gebruiker->email !== $currentUserEmail){
                $huisdieren_gebruiker = $gebruiker->allHuisdieren;
                if ($huisdieren_gebruiker){
                    foreach ($huisdieren_gebruiker as $huisdier){
                        $aanvragen_huisdier = $huisdier->allAanvragen;
                        if ($aanvragen_huisdier){
                            foreach ($aanvragen_huisdier as $aanvraag){
                                if ($aanvraag->beschikbaar){
                                    array_push($aanvragen, $aanvraag);
                                }
                            }
                        }
                    }
                }
            }
        }
        $soorten = Soort::all();
        
        $role = User::where('email', $currentUserEmail)->first()->role;
        
        $reviewsAlsHuisdierEigenaarGegeven = ReviewOppasser::where('email_van', $currentUserEmail)->get();
        $ReviewsAlsOppasGekregen = ReviewOppasser::where('email_voor', $currentUserEmail)->get();
        $ReviewsAlsOppasGegeven = ReviewHuisdier::where('email_van', $currentUserEmail)->get();
        $huisdieren = User::where('email', $currentUserEmail)->first()->allHuisdieren;

        
        //HuisdierBenodigdheden
        $eersteHuisdier = User::where('email', $currentUserEmail)->first()->allHuisdieren->first();
        $padVoorFoto = $eersteHuisdier->allFotosHuisdier()->first()->path;
        $naamVanFoto = $eersteHuisdier->allFotosHuisdier()->first()->filename;


    
        return view('dashboard',[
            //Generieke Benodigdheden
            'role' => $role,
            'eigen_aanvragen'=> $eigen_aanvragen,
            // HuisdierBenodigdheden
            'eersteHuisdier'=> $eersteHuisdier,
            'padVoorFoto' => $padVoorFoto,
            'naamVanFoto' => $naamVanFoto,


            'huisdieren' => $huisdieren,
            'soorten' => $soorten,

            'currentUserEmail'=> $currentUserEmail,
            'aanvragen' => $aanvragen,
            'reacties' => $reacties,
            'reviewsAlsHuisdierEigenaarGegeven' => $reviewsAlsHuisdierEigenaarGegeven,
            'ReviewsAlsOppasGekregen' => $ReviewsAlsOppasGekregen,
            'ReviewsAlsOppasGegeven' => $ReviewsAlsOppasGegeven,
        ]);
    }
}
