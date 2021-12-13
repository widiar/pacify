<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index()
    {
        return view('chat');
    }

    public function search()
    {
        try {
            $user = User::find(Auth::user()->id);
            $user->need_chat = 1;
            $user->found_chat = 0;
            $user->save();

            //seacrhing
            $user2 = User::where([
                ['id', '!=', $user->id],
                ['need_chat', 1],
                ['found_chat', 0]
            ])->first();

            if ($user2) {
                $user->found_chat = 1;
                $user2->found_chat = 1;
                $user->save();
                $user2->save();

                //buat rooms pake firstorcreate

                //return 
                return response()->json([
                    'status' => 'Found User',
                    'user' => $user2
                ]);
            } else {
                return response()->json([
                    'status' => 'Not Found'
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }
}
