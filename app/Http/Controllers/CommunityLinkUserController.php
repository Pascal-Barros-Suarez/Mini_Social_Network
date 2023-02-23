<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CommunityLink;
use App\Models\CommunityLinkUser;
use Illuminate\Support\Facades\Auth;

class CommunityLinkUserController extends Controller
{
    public function store(CommunityLink $link, CommunityLinkUser $communityLinkUser)
    {
        $communityLinkUser->toggleVote($link);
        return back();
    }
}
