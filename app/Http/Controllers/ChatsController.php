<?php

namespace App\Http\Controllers;
use DB;
use App\Chats;
use Illuminate\Http\Request;

class ChatsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request['chat']) {
           DB::insert("call storeChat( '".$request['from']."','".$request['to']."' ,'".$request['chat']." ') ");
        }
        $usersFromSerach = DB::select("call finduser('" . $request['toUserName'] . "')");
        $reuslts = [];
        foreach ($usersFromSerach as $searchUser) {
            $messages= DB::select("call findChats('".$request['from']."','". $searchUser->id."')");
            array_push($reuslts, (object) array("user" => $searchUser, "messages" => $messages, "count" => count(DB::select("call findChats_unlimited('".$searchUser->id."','".$request['from']. "')"))));
        }
        return view('userSearch', ['results' => $reuslts, 'user' => $request['from'], 'userNo' => 0]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Chats  $chats
     * @return \Illuminate\Http\Response
     */
    public function show(Chats $chats)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Chats  $chats
     * @return \Illuminate\Http\Response
     */
    public function edit(Chats $chats)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Chats  $chats
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Chats $chats)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Chats  $chats
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chats $chats)
    {
        //
    }
}
