<?php

namespace App\Http\Controllers;

// request siempre al princio

use App\Http\Requests\CommunityLinkForm;
use App\Models\Channel;
use App\Models\CommunityLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Queries\CommunityLinksQuery;

class CommunityLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Channel $channel = null)
    {
        $linksQuery = new CommunityLinksQuery();
        $channels = Channel::orderBy('title', 'asc')->get();
        $search = '';

        if (request()->exists('search')) {
            $search = htmlspecialchars(trim($_GET['search']));
            $consult = explode(" ", $search);

            if (request()->exists('popular')) {
                $links = $linksQuery->getSearch($consult, true);
            } else {
                $links = $linksQuery->getSearch($consult);
            }
        } else {
            if ($channel === null) {

                if (request()->exists('popular')) {
                    $links = $linksQuery->getMostPopular();
                } else {
                    $links = $linksQuery->getAll();
                }
            } else {

                if (request()->exists('popular')) {
                    $links = $linksQuery->getByChannelMostPopular($channel);
                } else {
                    $links = $linksQuery->getByChannel($channel);
                }
            }
        }


        return view('community/index', compact('links', 'channels', 'channel', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    public function store(CommunityLinkForm $request)
    {
        //dd($request);

        $approved = Auth::user()->trusted ? true : false;
        $request->merge(['user_id' => Auth::id(), 'approved' => $approved]);

        if ($approved) {
            $link = new CommunityLink();
            $link->user_id = Auth::id();

            if ($link->hasAlreadyBeenSubmitted($request->link)) {
                $link->hasAlreadyBeenSubmitted($request->link);
                return back()->with('success', 'Link update successfully!');
            } else {
                CommunityLink::create($request->all());
                return back()->with('success', 'Link created successfully!');
            }
        } else {
            CommunityLink::create($request->all());
            return back()->with('warning', 'Link created successfully but you don´t are approved!');
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CommunityLink  $communityLink
     * @return \Illuminate\Http\Response
     */
    public function show(CommunityLink $communityLink)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CommunityLink  $communityLink
     * @return \Illuminate\Http\Response
     */
    public function edit(CommunityLink $communityLink)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CommunityLink  $communityLink
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CommunityLink $communityLink)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CommunityLink  $communityLink
     * @return \Illuminate\Http\Response
     */
    public function destroy(CommunityLink $communityLink)
    {
        //
    }
}
