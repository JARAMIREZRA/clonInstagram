<?php

namespace App\Http\Controllers\Admin;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        $validate = $this->validate($request, [
            'image_id' => 'required|int',
            'content' => 'required|string|max:255'
        ]);

        if ($validate) {
            Comment::create([
                'user_id' => Auth::user()->id,
                'image_id' => $request->input('image_id'),
                'content' => $request->input('content')
            ]);

            return redirect()->route('image.show', ['id' => $request->input('image_id')])->with('message', 'success');
        } else {
            return redirect()->route('image.show', ['id' => $request->input('image_id')])->with('message', 'error');
        }
    }

    public function delete($id)
    {
        $user = Auth::user();
        $comment = Comment::findOrFail($id);
        if ($user && ($comment->user_id == $user->id || $comment->image->user_id == $user->id)) {
            $comment->delete();
            return redirect()->route('image.show', ['id' => $comment->image->id])->with('message', 'success');
        } else {
            return redirect()->route('image.show', ['id' => $comment->image->id])->with('message', 'error');
        }
    }
}