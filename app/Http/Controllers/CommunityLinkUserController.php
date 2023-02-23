<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CommunityLink;
use App\Models\CommunityLinkUser;
use Illuminate\Support\Facades\Auth;

class CommunityLinkUserController extends Controller
{
    public function store(CommunityLink $link)
    {
        //dd($link);
        //Recupera el voto del usuario, o crea uno nuevo si no existe.
        $vote = CommunityLinkUser::firstOrNew(['user_id' => Auth::id(), 'community_link_id' => $link->id]);

        if ($vote->id) { // si el voto existe lo elimina
            $vote->delete();
        } else { // guarda el nuevo voto
            $vote->save();
        }
        // devuelve al usuario a la pagina anterior
        return back();
    }
}
