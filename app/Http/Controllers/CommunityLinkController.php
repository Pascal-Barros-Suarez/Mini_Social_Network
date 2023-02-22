<?php

namespace App\Http\Controllers;

// request siempre al princio

use App\Http\Requests\CommunityLinkForm;
use App\Models\Channel;
use App\Models\CommunityLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommunityLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Channel $channel = null)
    {
        //ordenamos la lista de chanels del
        $channels = Channel::orderBy('title', 'asc')->get();

        if ($channel === null) {
            $links = CommunityLink::where('approved', true)->latest('updated_at')->paginate(25);
        } else {
            $links = $channel->communitylinks()->where('approved', true)->latest('updated_at')->paginate(25);
        }

        return view('community/index', compact('links', 'channels', 'channel'));
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
