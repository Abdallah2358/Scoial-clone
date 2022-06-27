<?php

namespace App\Http\Controllers;

use App\Users;
use DB;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    protected $user;
    public function setUser(Type $user = null)
    {
        $this->user = $user;
    }
    public function getUser()
    {
        return $this->user;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('register', ['genders' => DB::select('call allGenders()')]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $username = $request['userName'];

        foreach (DB::select('call Allusers()') as $user) {
            if ($username === $user->username) {

                return \view('register', ['userExist' => 'yes'], ['genders' => DB::select('call allGenders()')]);
            }
        }
        $firstName = $request['firstName'];
        $email = $request['email'];
        $password = $request['password'];
        $lastName = $request['lastName'];
        $gender = $request['gender'];
        $address = $request['address'];
        $bio = $request['bio'];
        $date = $request['year'] . '-' . $request['month'] . '-' . $request['day'];

        if ($username && $email && $firstName && $password) {
            $user = new Users();
            $user->username = $username;
            $user->first_name = $firstName;
            $user->email = $email;
            $user->password = $password;
            if ($lastName) {
                $user->last_name = $lastName;
            }

            if ($gender) {
                $user->gender_id = $gender;
            }
            if ($address) {
                $user->address = $address;
            }

            if ($bio) {
                $user->bio = $bio;
            }

            if ($request['year'] && $request['month'] && $request['day']) {
                $user->birth_date = $date;
            }

            $user->save();
            return \view('landing', ['register' => 'success']);
        } else {
            return \view('register', ['register' => 'failed'], ['genders' => DB::select('call allGenders()')]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Users  $users
     * @return \Illuminate\Http\Response
     */
    public function show(Users $users, Request $request)
    {
        //serach result arry
        $usersFromSerach = DB::select("call finduser('" . $request['search'] . "')");

        $reuslts = [];
        foreach ($usersFromSerach as $searchUser) {
            $messages = DB::select("call findChats('" . $request['user'] . "','" . $searchUser->id . "')");
            array_push($reuslts, (object) array("user" => $searchUser, "messages" => $messages, "count" => count(DB::select("call findChats_unlimited('".$searchUser->id."','".$request['user']. "')"))));
        }

        return view('userSearch', ['results' => $reuslts, 'user' => $request['user'], 'userNo' => 0]);

    }
    public function friends($id)
    {
        $set_of_friends = new \Ds\Set();
        $friends_chat_array = [];
        $who_i_chated_with = DB::select("call who_i_chated_with('$id')");
        $who_chated_with_me = DB::select("call who_chated_with_me('$id')");
        //get who_i_chated_with
        foreach ($who_i_chated_with as $friend) {
            $set_of_friends->add($friend->to_user_id);
        }
        //get who_chated_with_me
        foreach ($who_chated_with_me as $friend) {
            $set_of_friends->add($friend->from_user_id);
        }
        //count all chats
        $reuslts = [];
        foreach ($set_of_friends as $friend) {
            $messages = DB::select("call findChats('$friend','$id')");
            array_push($reuslts, (object) array("user" => DB::select("call userById('$friend')")[0], "messages" => $messages
                , "count" => count(DB::select("call findChats_unlimited('$friend','$id')")),
            ));
        }
        return view('userSearch', ['results' => $reuslts, 'user' => $id, 'userNo' => 0]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Users  $users
     * @return \Illuminate\Http\Response
     */
    public function edit(Users $users)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Users  $users
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Users $users)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Users  $users
     * @return \Illuminate\Http\Response
     */
    public function destroy(Users $users)
    {
        //
    }
}
