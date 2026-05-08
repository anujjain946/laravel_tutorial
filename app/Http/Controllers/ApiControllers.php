<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ApiControllers extends Controller
{
    public function UserList()
    {
        $users = User::whereNotNull('email')->get();

        return response()->json([
            'success' => true,
            'message' => 'User list fetched successfully',
            'data' => $users
        ], 200);
    }
}
