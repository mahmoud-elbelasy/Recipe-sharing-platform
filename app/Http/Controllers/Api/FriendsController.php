<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Friend;
use App\Models\User;
use App\Notifications\FriendRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendsController extends Controller
{
    public function getFriends(){
        $user = Auth::user();
        return $user->friends();
    }

    public function FriendRequest(Request $request){
        $request = $request->validate([
            'id' => 'required|integer|exists:users,id'
        ]);
        $id = $request['id'];
        $user = Auth::user();

        $friend = User::find($id);
        $friends = $user->friends();
        $message = '';

        if ($id == $user->id ){
        return response('forbidden',403);
        }

        $result = collect($friends)->where('id', $id)->first();
        if($result){
            $message = 'you are already friends';
            return response($message,400);
        }else{
            $friendRequest = Friend::create([
                'user_id' => $user->id,
                'friend_id' => $id,
            ]);
            $message = 'friend request was created successfully, id = '.$friendRequest->id;
        }
        $user->notify(new FriendRequest($friendRequest));

        return response($message,200);
    }

    public function acceptFriendRequest(Request $request){
        $requestData = $request->validate([
            'id' => 'required|integer|exists:friends,id'
        ]);
        $requestID = $requestData['id'];
        $friendRequest = Friend::find($requestID);
        $user = Auth::user();
        $message = '';
        if ($user->id == $friendRequest->friend_id) {
            $friendRequest->accepted = true;
            $friendRequest->save();

            $message = 'friend request was accepted successfully, id = '.$friendRequest->id;
        }else{
            $message = 'wrong friend request';
            return response($message, 403);
        }

        return response($message,200);

    }
}
