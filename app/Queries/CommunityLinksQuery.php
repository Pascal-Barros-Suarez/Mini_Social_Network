<?php

namespace App\Queries;

use App\Models\CommunityLink;
use App\Models\Channel;

class CommunityLinksQuery
{
    public function getByChannel(Channel $channel)
    {
        return $channel->communitylinks()->where('approved', true)->latest('updated_at')->paginate(25);
    }

    public function getAll()
    {
        return CommunityLink::where('approved', true)->latest('updated_at')->paginate(25);
    }

    public function getSearch($value, $popular = null)
    {
        if ($popular) {
            /*El siguiente paso en la query es establecer una expression de comparación dinámica. Esto se logra con una factory function "use" en lugar de un objeto concreto. La variable $value contiene los argumentos similares a los esperados en una tradiccional sentencia SQL como un array.*/
            $query = CommunityLink::where('approved', true)->where(function ($q) use ($value) {
                foreach ($value as $word) {
                    $q = $q->orWhere('title', 'LIKE', '%' . $word . '%');
                }
            });
            return $query->withCount('votes')->orderBy('votes_count', 'desc')->paginate(15);
        } else {
            $query = CommunityLink::where('approved', true)->where(function ($q) use ($value) {
                foreach ($value as $word) {
                    $q = $q->orWhere('title', 'LIKE', '%' . $word . '%');
                }
            });
            return $query->paginate(15);
        }
    }


    public function getMostPopular()
    {
        $query = CommunityLink::where('approved', true)->withCount('votes')->orderBy('votes_count', 'desc')->paginate(25);
        return $query;
    }

    public function getByChannelMostPopular(Channel $channel)
    {
        $query = $channel->communitylinks()->where('approved', true)->withCount('votes')->orderBy('votes_count', 'desc')->paginate(25);
        return $query;
    }
}
