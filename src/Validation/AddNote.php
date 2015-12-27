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

namespace Seat\Notes\Validation;

use App\Http\Requests\Request;

/**
 * Class AddNote
 * @package Seat\Notes\Validation
 */
class AddNote extends Request
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            'character_id'  => 'required',
            'title'   => 'required',
            'details' => 'required',
            'private' => 'boolean',
        ];
    }
}
