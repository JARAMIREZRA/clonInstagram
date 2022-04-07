<?php

namespace App\Http\Controllers\Admin;

use App\Models\Like;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('like.index', [
            'likes' => Like::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->paginate(5)
        ]);
    }
    public function store($id)
    {
        $user = Auth::user()->id;
        $isset_like = Like::where('user_id', $user)
                          ->where('image_id', $id)
                          ->count();

        if ($isset_like == 0) {
            $like = new Like();
            $like->user_id = $user;
            $like->image_id = (int)$id;
            $like->save();
            return response()->json([
                'like' => $like
            ]);
        } else {
            return response()->json([
                'message' => 'Ya creado'
            ]);
        }              
    }

    public function delete($id)
    {
        $user = Auth::user()->id;
        $like = Like::where('user_id', $user)
                          ->where('image_id', $id)
                          ->first();

        if ($like) {
            $like->delete();
            return response()->json([
                'like' => $like,
                'message' => 'Has dado un dislike'
            ]);
        } else {
            return response()->json([
                'message' => 'El like no existe'
            ]);
        }       
    }
}
