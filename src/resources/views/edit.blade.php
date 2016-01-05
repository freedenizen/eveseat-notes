@extends('web::character.layouts.view', ['viewname' => 'notes'])

@section('title', trans_choice('notes::seat.edit_note',1) . " :: $note->title" )
@section('page_header', trans_choice('notes::seat.edit_note',1))


@section('character_content')

    <div class="panel panel-default" xmlns="http://www.w3.org/1999/html">
        <div class="panel-heading">
            <h3 class="panel-title">{{ trans_choice('notes::seat.note',1) }}</h3>
        </div>
        <div class="panel-body">
            <form role="form" action="{{ route('notes.update') }}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="note_id" value="{{ $note->id }}">
                <div class="box-body">

                    <div class="form-group">
                        <label for="title">{{ trans_choice('web::seat.title',1) }}</label>
                        <input type="text" name="title" class="form-control" value="{{ $note->title }}">
                    </div>

                    <div class="form-group">
                        <label for="Details">{{ trans_choice('web::seat.detail', 2) }}</label>
                        <textarea name="details" class="form-control">{{ $note->details }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="Private">{{ trans('notes::seat.private') }}</label>
                        <input type="checkbox" name="private" value="1" {{ $private }}>
                    </div>

                </div><!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-right">
                        {{ trans('notes::seat.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

@stop

