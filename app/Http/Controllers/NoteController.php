<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Comment;
use Illuminate\Http\Request;
use DB;
use Session;

class NoteController extends Controller
{
    //Displaying the Notes the home page
    public function index()
    {  
        $notes = Note::orderBy('created_at','desc')->get();
        date_default_timezone_set('Asia/Kolkata');
        return view('note.index',compact('notes'));
    }

    // Show the form for creating a new note.
    public function create()
    {
        return view('note.create');
    }

   
    //Store a newly created note in the database.
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);
      
        Note::create($request->all());
        return redirect()->route('notes.index')
                        ->with('success','Note created successfully.');
    }

    
    //Display the specified note.
    public function show(Note $note)
    {
        // fetching comments for this specific note and attaching the comments to it
        $results = Comment::where('noteid',$note->id)->orderBy('created_at','desc')->get();
        $note->comments = $results;
        return view('note.show',compact('note'));
    }

    
    //Show the form for editing the specified note.
    public function edit(Note $note)
    {
        return view('note.edit',compact('note'));
    }

    
    //Update the specified note in the database.
    public function update(Request $request, Note $note)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);
        $note->update($request->all());
        return redirect()->route('notes.show',[$note])
                        ->with('success','Note updated successfully');
    }

    
    // Remove the specified note from the database.
    public function destroy($id)
    {
        // first deleting all the comments of this specified note
        Comment::where('noteid',$id)->delete();
        //then deleting the note itself
        Note::where('id',$id)->delete();
        return redirect()->route('notes.index')
                        ->with('success','Note deleted successfully');
    }
}
