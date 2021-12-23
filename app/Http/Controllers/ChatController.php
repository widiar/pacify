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
        if (!Auth::check()) {
            return redirect()->route('home')->with('login', 'Perlu Login');
        }
        $id = Auth::user()->id;
        Room::where('user1', $id)->where('user2', NULL)->delete();
        $rooms = Room::where('user1', $id)->orWhere('user2', $id)->get();
        $rooms->load(['chat' => function ($q) {
            $q->orderBy('updated_at', 'desc');
        }]);

        //load chatnya, cari chat nya yg paling akhir , cek created_at nya, jika lebih dari sehari disabled
        foreach ($rooms as $room) {
            $chat = $room->chat;
            if ($chat->count() > 0) {
                $now = new DateTime('now');
                if ($now->diff($chat[0]->updated_at)->days >= 1) {
                    $room->is_disabled = 1;
                    $room->save();
                }
            }
        }
        // tambahin foreign key, di table chat, biar ketika room di delete chatnya otomatis ke delete.

        // cek updated_at di room, jika lebih dari 3 hari, delete dia

        $hitungRoom = $rooms->count();
        return view('chat', compact('rooms', 'hitungRoom'));
    }

    /*
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
                ['found_chat', NULL],
                ['is_searching', 1]
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
    */

    public function search(Request $request)
    {
        try {
            $user = User::find(Auth::user()->id);
            $param = $request->room;
            $room = Room::where('user2', NULL)->where('user1', '!=', $user->id)->first();
            if ($room && !isset($param)) {
                $room->user2 = $user->id;
                $room->save();
                return response()->json([
                    'room' => $room
                ]);
            }
            $cekRoom = Room::where('user1', $user->id)->where('user2', NULL)->first();
            if (!isset($param) && !$cekRoom) {
                $chat = Room::create([
                    'nama' => strtoupper(uniqid()),
                    'user1' => $user->id,
                ]);
            } else {
                $chat = Room::where('nama', $param)->first();
            }
            return response()->json([
                'room' => $chat
            ]);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }

    public function verif($nama)
    {
        try {
            $cekRoom = Room::where('nama', $nama)->first();
            $user = User::find(Auth::user()->id);
            if ($cekRoom->user2 != NULL) {
                if ($cekRoom->user1 == $user->id || $cekRoom->user2 == $user->id) {
                    return response()->json([
                        'status' => 'success',
                        'room' => $cekRoom
                    ]);
                }
            }
            return response()->json([
                'status' => 'deny'
            ]);
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
