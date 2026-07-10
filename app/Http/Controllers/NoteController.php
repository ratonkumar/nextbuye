<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;

class NoteController extends Controller
{
    public function store(Request $request)
    {  
        $request->validate([
          
            'content' => 'required|string',
        ]);

        Note::create([
           
            'content' => $request->content,
        ]);
        
      

        return redirect()->back()->with('success', 'Note added successfully!');
    }

    public function index()
    {
        $notes = Note::all();
        return view('notes.index', compact('notes'));
    }
    
    
    
    public function destroy($id)
    {
        $note = Note::findOrFail($id);
        $note->delete();
        return redirect('admin/dashboard')->with('success', 'Note deleted successfully.');
    }
}
