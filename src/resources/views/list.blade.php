@extends('web::character.layouts.view', ['viewname' => 'notes'])

@section('title', trans_choice('notes::seat.note',2))
@section('page_header', trans_choice('notes::seat.note',2))

@section('character_content')

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">
                {{trans_choice('notes::seat.note',2)}}
                @if($can_create)
                    <a href="{{ route('notes.create', ['characterID' => $character_id]) }}"
                    class="btn btn-xs btn-success pull-right"><i class="fa fa-plus" style="color:white"></i></a>
                @endif
            </h3>
        </div>
        <div class="panel-body">

            <table class="table datatable compact table-condensed table-hover table-responsive">
                <thead>
                    <tr>
                        <th></th>
                        <th>{{ trans_choice('web::seat.title',1) }}</th>
                        <th>{{ trans_choice('web::seat.detail', 2) }}</th>
                        <th>{{ trans('notes::seat.updated_by') }}</th>
                        <th>{{ trans('web::seat.updated') }}</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>

                @foreach($notes as $note)

                    <tr>
                        <td>
                            @if($note->private)
                                <i class="fa fa-lock" ></i>
                            @endif
                        </td>
                        <td>{{ $note->title }}</td>
                        <td data-search="{{ $note->details }}">{{ str_limit($note->details, 50, '...') }}</td>

                        <td>{{ $note->name }}</td>
                        <td data-order="{{ $note->updated_at }}">
                          <span data-toggle="tooltip" title="" data-original-title="{{ $note->updated_at }}">
                            {{ human_diff($note->updated_at) }}
                          </span>
                        </td>

                        <td>
                            @if($can_edit)
                                <a href="{{ route('notes.edit', ['characterID' => $note->character_id,'note' => $note->id ]) }}"
                                   class="btn btn-xs btn-primary">
                                    <i class="fa fa-pencil"></i>
                                    {{ trans('web::seat.edit') }}
                                </a>
                            @endif
                        </td>
                    </tr>

                @endforeach

                </tbody>
            </table>

        </div>
    </div>

@stop
