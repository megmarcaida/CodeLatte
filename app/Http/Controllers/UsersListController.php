<?php

namespace App\Http\Controllers;

use App\Friendship;
use App\User;
use App\UsersPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersListController extends Controller
{
    public function index(){
        $userslists = UsersPlan::with(['plans','users'])->paginate(10);
        $response = [
            'pagination' => [
                'total' => $userslists->total(),
                'per_page' => $userslists->perPage(),
                'current_page' => $userslists->currentPage(),
                'last_page' => $userslists->lastPage(),
                'from' => $userslists->firstItem(),
                'to' => $userslists->lastItem()
            ],
            'userslist' => $userslists

        ];

        return response()->json([
            'userslist' => $response
        ]);
    }

}
