<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class CommunityLinkUser extends Model
{
    use HasFactory;

    protected $table = 'community_link_users';

    protected $fillable = [
        'user_id',
        'community_link_id',
    ];

    public function toggleVote(CommunityLink $link)
    {
        //Recupera el voto del usuario, o crea uno nuevo si no existe.
        $vote = $this->firstOrNew(['user_id' => Auth::id(), 'community_link_id' => $link->id]);
        if ($vote->id) { // si el voto existe lo elimina
            $vote->delete();
        } else { // guarda el nuevo voto
            $vote->save();
        }
        // devuelve al usuario a la pagina anterior
        return back();
    }
}
