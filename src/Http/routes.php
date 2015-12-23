<?php
/*
This file is part of a SeAT add-on

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

Route::group([
    'namespace' => 'Seat\Notes\Http\Controllers',
], function () {

    Route::get('/view/notes/{character_id}', [
        'as'         => 'notes.list',
        'middleware' => 'notesbouncer:view',
        'uses'       => 'NotesController@getNotes'
    ]);

    Route::get('/view/notes/{character_id}/edit/{note_id}', [
        'as'         => 'notes.edit',
        'middleware' => 'notesbouncer:view',
        'uses'       => 'NotesController@getEditNote'
    ]);

    Route::get('/view/notes/{character_id}/create', [
        'as'   => 'notes.create',
        'uses' => 'NotesController@getCreateNote'
    ]);

    Route::post('/notes/update', [
        'as'   => 'notes.update',
        'uses' => 'NotesController@postUpdateNote'
    ]);

    Route::post('/notes/add', [
        'as'   => 'notes.add',
        'uses' => 'NotesController@postAddNote'
    ]);
});