@extends('web::character.layouts.view', ['viewname' => 'notes'])

@section('title', trans('notes::seat.add_new_note')  )
@section('page_header', trans('notes::seat.add_new_note'))


@section('character_content')

    <div class="panel panel-default" xmlns="http://www.w3.org/1999/html">
        <div class="panel-heading">
            <h3 class="panel-title">{{ trans_choice('notes::seat.add_new_note',1) }}</h3>
        </div>
        <div class="panel-body">
            <form role="form" action="{{ route('notes.add') }}" method="post">
                {{ csrf_field() }}
                <div class="box-body">

                    <div class="form-group">
                        <label for="character">{{ trans_choice('web::seat.character',1) }}</label>
                        <a href="{{ route('character.view.sheet', ['character_id' => $character_id]) }}">
                            {!! img('character', $character_id, 64, ['class' => 'img-circle eve-icon small-icon']) !!}
                            <span rel="id-to-name">{{ $character_id }}</span>
                        </a>
                        <input type="hidden" name="character_id" value="{{ $character_id }}">
                    </div>

                    <div class="form-group">
                        <label for="title">{{ trans_choice('web::seat.title',1) }}</label>
                        <input type="text" name="title" class="form-control" placeholder="{{ trans_choice('web::seat.title',1) }}"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="Details">{{ trans_choice('web::seat.detail', 2) }}</label>
                        <textarea name="details" class="form-control" placeholder="{{ trans_choice('web::seat.detail', 2) }}"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="Private">{{ trans('notes::seat.private') }}</label>
                        <input type="checkbox" name="private" value="1">
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

@section('javascript')

    @include('web::includes.javascript.id-to-name')

@stop
