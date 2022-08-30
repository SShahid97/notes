<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Http\Controllers\NoteController;
use Illuminate\Http\Request;
use Session;
class CommentController extends Controller
{

    //Store a newly created comment in the database.
    public function store(Request $request)
    {
        $comment = new Comment;
        $comment->message = $request->message;
        $comment->noteid = $request->noteid;
        $comment->save();
        return back();
    } 

    public function update(Request $request, $id)
    {
        $updatedComment = Comment::find($id);
        $updatedComment->message = $request->message;
        $updatedComment->save();
        //removing the session variables on updation
        Session::remove('editcommentId');
        Session::remove('editcommentNoteId');
        return back();
    }

    
     // Remove the comment from database.
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();
        return back();
    }


    // this function is used for setting the session variables for updating a comment for a specific note
    public function change(Request $request, $id, $noteid)
    {
        Session::put('editcommentId', $id);
        Session::put('editcommentNoteId', $noteid);
        return back();
    }
}
