@extends('web::character.layouts.view', ['viewname' => 'notes'])

@section('title', 'Notes')
@section('page_header', 'Notes')

@inject('carbon', 'Carbon\Carbon')

@section('character_content')

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Notes</h3>
        </div>
        <div class="panel-body">

            <table class="table table-condensed table-hover table-responsive">
                <tbody>
                <tr>
                    <th>Title</th>
                    <th>Details</th>
                    <th>Created By</th>
                    <th>Updated</th>
                    <th></th>
                    <th></th>
                </tr>

                @foreach($notes as $note)

                    <tr>
                        <td>{{ $note->title }}</td>
                        <td>{{ str_limit($note->details, 50, '...') }}</td>

                        <td>
                            <a href="{{ route('character.view.sheet', ['character_id' => $note->created_by]) }}">
                                {!! img('character', $note->created_by, 64, ['class' => 'img-circle eve-icon small-icon']) !!}
                                <span rel="id-to-name">{{ $note->created_by }}</span>
                            </a>
                        </td>
                        <td>
                          <span data-toggle="tooltip" title="" data-original-title="{{ $note->updated_at }}">
                            {{ human_diff($note->updated_at) }}
                          </span>
                        </td>
                        <td>
                            @if($note->private)
                                <i class="fa fa-lock" ></i>
                            @endif
                        </td>
                        <td> EDIT </td> //TODO: Link to Edit Note
                    </tr>

                @endforeach

                </tbody>
            </table>

        </div>
    </div>

@stop
