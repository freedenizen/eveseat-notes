<?php
/*
This file is part of a SeAT Add-on

Copyright (C) 2015 Asher Schaffer

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

namespace Seat\Notes\Repositories\Notes;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Seat\Notes\Models\Notes;

use Seat\Services\Helpers\Filterable;

/**
 * Class NotesRepository
 * @package Seat\Notes\Repositories
 */
trait NotesRepository
{

    use Filterable;


    /**
     * Get the notes about a specific reference
     *
     * @param $character_id
     *
     * @return mixed
     */
    public function getAllNotes($character_id)
    {
        $user = auth()->user();

        $public_notes = Notes::where('character_id',$character_id)
            ->leftJoin('users','notes.updated_by','=','users.id')
            ->where('private',false)
            ->select('notes.*','users.name');

        // Get Private Notes
        if(!$user->hasSuperUser()) {
            $private_notes = Notes::where('character_id', $character_id)
                ->leftJoin('users','notes.updated_by','=','users.id')
                ->where('private', true)->where('updated_by', $user->id)
                ->select('notes.*','users.name');
        }else{
            $private_notes = Notes::where('character_id', $character_id)
                ->leftJoin('users','notes.updated_by','=','users.id')
                ->where('private', true)
                ->select('notes.*','users.name');
        }

        return $public_notes->union($private_notes)->get();

    }

    /**
     * @param $note_id
     *
     * @return mixed
     */
    public function getNote($note_id)
    {

        return Notes::findOrFail($note_id);
    }
}
