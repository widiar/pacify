<?php

namespace App\Http\Controllers;

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
            $userId = Auth::user()->id;
            if ($room->user1 == $userId) $id = $room->user2;
            else $id = $room->user1;

            //load chatnya, itudah pokoknya


            return response()->json([
                'room' => $room->id,
                'id' => $id
            ]);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }

    public function listen(Request $request)
    {
        $chat = Chat::where([
            ['room_id', $request->roomId],
            ['user_id', $request->userId],
            ['updated_at', '>', $request->waktu]
        ])->get();
        return response()->json([
            'chat' => $chat,
            'uId' => $request->userId,
            'w' => $request->waktu
        ]);
    }

    public function post(Request $request)
    {
        try {
            $userId = Auth::user()->id;
            Chat::create([
                'room_id' => $request->roomId,
                'body' => $request->msg,
                'user_id' => $userId
            ]);
            return response()->json('Submitted');
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }

    public function dev()
    {
        $r = Room::where('updated_at', '>', '2021-12-14 9:5:4')->first();
        dd($r);
        $c = new DateTime($r->updated_at);
        $d = new DateTime('2021-12-14 9:5:4');
        dd($d, $c);
    }
}
