<?php

namespace App\Traits;

use App\Friendship;
trait Friendable
{
    public function add_friend($user_requested_id)
    {
        if($this->id == $user_requested_id)
        {
            return 0;
        }

        if($this->has_pending_friend_request_sent_to($user_requested_id) === 1)
        {
            return "already sent a friend request";
        }

        if($this->has_pending_friend_request_from($user_requested_id) === 1)
        {
            return $this->accept_friend($user_requested_id);
        }


        $Friendship = Friendship::create([

            'requester' => $this->id,
            'user_requested' => $user_requested_id

        ]);

        If ($Friendship) {

            /*return response()->json($Friendship, 200);*/
            return 1;
        }
        /*return reponse()->json('fail', 501);*/
        return 0;

    }

    public function unfriend_friend($user_requested_id)
    {
        if($this->id == $user_requested_id)
        {
            return 0;
        }



        $Friendship = Friendship::where('requester', $user_requested_id)
            ->where('user_requested', $this->id)
            ->first();

        if ($Friendship === null)
        {
            $Friendship = Friendship::where('requester',  $this->id)
                ->where('user_requested', $user_requested_id)
                ->first();
        }
        $Friendship->delete();


       /* $Friendship = Friendship::create([

            'requester' => $this->id,
            'user_requested' => $user_requested_id

        ]);*/

        If ($Friendship) {

            /*return response()->json($Friendship, 200);*/
            return 1;
        }
        /*return reponse()->json('fail', 501);*/
        return 0;

    }

    Public function accept_friend($requester)
    {

        if($this->has_pending_friend_request_from($requester) === 0)
        {
            return 0;
        }

        $Friendship = Friendship::where('requester', $requester)
            ->where('user_requested', $this->id)
            ->first();

        if ($Friendship) {
            $Friendship->update([
                'status' => 1


            ]);
            /*return response()->json($Friendship, 200);*/
            return 1;


        }

        /*return response()->json('fail', 501);*/
        return 0;
    }

    public function friends()
    {
        $friends = array();

        $f1 = Friendship::where('status', 1)
            ->where('requester', $this->id)
            ->get();

        foreach ($f1 as $friendship):
            array_push($friends, \App\User::find($friendship->user_requested));
        endforeach;

        $friends2 = array();

        $f2 = Friendship::where('status', 1)
            ->where('user_requested', $this->id)
            ->get();

        foreach ($f2 as $friendship2):
            array_push($friends, \App\User::find($friendship2->requester));
        endforeach;

        return array_merge($friends, $friends2);
    }

    public function pending_friend_requests()
    {
        $users = array();

        $friendships = Friendship::where('status', 0)
            ->where('user_requested', $this->id)
            ->get();

        foreach ($friendships as $friendship):
            array_push($users, \App\User::find($friendship->requester));
        endforeach;

        return $users;
    }

    public function friends_ids()
    {
        return collect($this->friends())->pluck('id')->toArray();
    }

    public function is_friends_with($user_id)
    {
        if(in_array($user_id,$this->friends_ids()))
        {
            /*return response()->json('true',200);*/
            return 1;
        }
        else
        {
            /*return response()->json('false',200);*/
            return 0;
        }
    }

    public function pending_friend_requests_ids()
    {
        return collect($this->pending_friend_requests())->pluck('id')->toArray();
    }

    public function pending_friend_requests_sent()
    {
        $users=array();

        $friendships= Friendship::where('status',0)
                                ->where('requester',$this->id)
                                ->get();

        foreach($friendships as $friendship):
            array_push($users,\App\User::find($friendship->user_requested));
        endforeach;

        return $users;
    }

    public function pending_friend_requests_sent_ids()
    {
        return collect($this->pending_friend_requests_sent())->pluck('id')->toArray();
    }

    public function has_pending_friend_request_from($user_id)
    {
        if(in_array($user_id,$this->pending_friend_requests_ids()))
        {
            return 1;
        }
        else
        {
            return 0;
        }
    }

    public function has_pending_friend_request_sent_to($user_id)
    {
        if(in_array($user_id,$this->pending_friend_requests_sent_ids()))
        {
            return 1;
        }
        else
        {
            return 0;
        }
    }

}