@extends('web::character.layouts.view', ['viewname' => 'list'])

@section('title', trans_choice('notes::seat.note',2))
@section('page_header', trans_choice('notes::seat.note',2))

@inject('carbon', 'Carbon\Carbon')

@section('character_content')

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">
                {{trans_choice('notes::seat.note',2)}}
                <a href="{{ route('notes.create', ['characterID' => $ref_id]) }}"
                   class="btn btn-xs btn-success pull-right"><i class="fa fa-plus" style="color:white"></i></a>
            </h3>
        </div>
        <div class="panel-body">

            <table class="table table-condensed table-hover table-responsive">
                <tbody>
                <tr>
                    <th></th>
                    <th>{{ trans_choice('web::seat.title',1) }}</th>
                    <th>{{ trans_choice('web::seat.detail', 2) }}</th>
                    <th>{{ trans('notes::seat.updated_by') }}</th>
                    <th>{{ trans('web::seat.updated') }}</th>
                    <th></th>
                </tr>

                @foreach($notes as $note)

                    <tr>
                        <td>
                            @if($note->private)
                                <i class="fa fa-lock" ></i>
                            @endif
                        </td>
                        <td>{{ $note->title }}</td>
                        <td>{{ str_limit($note->details, 50, '...') }}</td>

                        <td>{{ $note->name }}</td>
                        <td>
                          <span data-toggle="tooltip" title="" data-original-title="{{ $note->updated_at }}">
                            {{ human_diff($note->updated_at) }}
                          </span>
                        </td>

                        <td><a href="{{ route('notes.edit', ['characterID' => $note->ref_id,'note' => $note->id ]) }}"
                               class="btn btn-xs btn-primary"><i class="fa fa-pencil"></i> {{ trans('web::seat.edit') }}</a></td>
                    </tr>

                @endforeach

                </tbody>
            </table>

        </div>
    </div>

@stop
