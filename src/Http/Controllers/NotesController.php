<?php
/*
This file is part of SeAT

Copyright (C) 2015  Asher Schaffer

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License along
with this program; if not, write to the Free Software Foundation, Inc.,
51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA.
*/

namespace Seat\Notes\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Seat\Notes\Models\Notes;
use Seat\Web\Validation\Permission;
use Seat\Notes\Repositories\Notes\NotesRepository;
use Seat\Notes\Validation\UpdateNote;
use Seat\Notes\Validation\AddNote;
use Seat\Web\Acl\Clipboard;

/**
 * Class NotesController
 * @package Seat\Notes\Http\Controllers
 */
class NotesController extends Controller
{
    use NotesRepository, Clipboard;
    /**
     * @param $character_id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getNotes($character_id)
    {
        $can_edit = auth()->user()->has('notes.edit');
        $can_create = auth()->user()->has('notes.create');

        $notes = $this->getAllNotes($character_id);

        return view('notes::list', compact('notes','character_id','can_edit','can_create'));
    }

    public function getEditNote($character_id, $note_id)
    {
        $private = "";
        $note = Notes::findorFail($note_id);
        if ($note->private)
            $private = "checked";


        return view('notes::edit', compact('note','private'));
    }

    public function getCreateNote($character_id)
    {
        return view('notes::create', compact('character_id'));
    }

    public function getDeleteNote($character_id, $note_id)
    {
        $this->getNote($note_id)->delete();

        return redirect()->back()
            ->with('success', trans('notes::note_deleted'));
    }

    public function postUpdateNote(UpdateNote $request)
    {

        $user = auth()->user();

        $note = Notes::find($request->input('note_id'));

        $note->title  = $request->input('title');
        $note->details = $request->input('details');
        $note->private = $request->input('private');
        $note->updated_by = $user->id;

        $note->save();

        return redirect()->back()
            ->with('success', trans('notes::seat.note_updated'));
    }

    public function postAddNote(AddNote $request)
    {
        $private = 0;
        if( $request->input('private') )
            $private = 1;

        $user = auth()->user();
        $note = new Notes;


        $note->character_id = $request->input('character_id');
        $note->title       = $request->input('title');
        $note->details     = $request->input('details');
        $note->private     = $private;
        $note->updated_by  = $user->id;

        $note->save();

        return redirect()->back()
            ->with('success', trans('notes::seat.note_added'));
    }
}
