<?php

namespace App\Http\Controllers;

use App\Events\ChatCreated;
use App\Models\Chat;
use App\Models\Room;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index()
    {
        $id = Auth::user()->id;
        $rooms = Room::where('user1', $id)->orWhere('user2', $id)->get();
        return view('chat', compact('rooms'));
    }

    public function search()
    {
        try {
            $user = User::find(Auth::user()->id);
            $user->need_chat = 1;
            if ($user->is_searching != 1)
                $user->found_chat = NULL;
            $user->is_searching = 1;
            $user->save();

            //seacrhing
            $user2 = User::where([
                ['id', '!=', $user->id],
                ['need_chat', 1],
                ['found_chat', NULL]
            ])->first();

            if ($user2) {
                $user->found_chat = $user2->id;
                $user->is_searching = 0;
                $user->save();

                $user2->found_chat = $user->id;
                $user2->save();

                //buat rooms pake firstorcreate
                $room = Room::firstOrCreate([
                    'user1' => $user->id,
                    'user2' => $user2->id
                ]);
                $namaRoom = strtoupper(uniqid());
                if (!$room->nama) {
                    $room->nama = $namaRoom;
                    $room->save();
                } else {
                    $namaRoom = $room->nama;
                }

                //return 
                return response()->json([
                    'status' => 'Found User',
                    'room' => $namaRoom
                ]);
            } else if ($user->found_chat) {
                $user->is_searching = 0;
                $user->save();
                //buat rooms pake firstorcreate
                $room = Room::firstOrCreate([
                    'user1' => $user->found_chat,
                    'user2' => $user->id
                ]);
                $namaRoom = strtoupper(uniqid());
                if (!$room->nama) {
                    $room->nama = $namaRoom;
                    $room->save();
                } else {
                    $namaRoom = $room->nama;
                }

                //return 
                return response()->json([
                    'status' => 'Found User',
                    'room' => $namaRoom
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

    public function show(Request $request)
    {
        try {
            $room = Room::where('nama', $request->nama)->first();
            $room->load('chat');
            $chats = $room->chat;
            $userId = Auth::user()->id;


            return response()->json([
                'room' => $room,
                'chats' => $chats,
                'userId' => $userId
            ]);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }

    public function post(Request $request)
    {
        try {
            $userId = Auth::user()->id;
            $chat = Chat::create([
                'room_id' => $request->roomId,
                'body' => $request->msg,
                'user_id' => $userId
            ]);
            ChatCreated::dispatch($chat);
            return response()->json($chat);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }
}
