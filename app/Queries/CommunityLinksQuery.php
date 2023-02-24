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
