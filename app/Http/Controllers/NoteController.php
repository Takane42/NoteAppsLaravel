<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    public function index()
    {
        $notes = Note::where('user_id', Auth::id())->latest()->get();
        return view('notes.index', compact('notes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'nullable'
        ]);

        Note::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return back()->with('success', 'Catatan berhasil ditambahkan!');
    }

    public function destroy(Note $note)
    {
        $note->delete();
        return back()->with('success', 'Catatan berhasil dihapus!');
    }

    public function update(Request $request, Note $note)
    {
        $note->update($request->all());
        return redirect()->route('notes.index', ['menu' => 'lihat'])->with('success', 'Catatan berhasil diperbarui.');
    }
}
