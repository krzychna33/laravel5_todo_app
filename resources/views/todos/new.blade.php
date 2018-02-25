@extends('layouts.app')

@section('content')

<div class="edit_form">

    @if($errors->any())
        @foreach($errors->all() as $error)
            <div class="alert alert-danger" role="alert">
                    {{
                        $error
                    }}
            </div>
        @endforeach
    @endif

    <form method="POST" action="{{ route('todos.add') }}">
            {{ csrf_field() }}
        <div class="form-group">
            <label>Tytuł</label>
            <input type="text" name="title" class="form-control" placeholder="Tytuł"/>
        </div>
        <div class="form-group">
            <label>Treść</label>
            <textarea  class="form-control" name="body"></textarea>
        </div>
        <div class="form-group">
            <input type="submit" value="Dodaj" class="btn btn-success"/>
            <a href="{{ route('todos.index') }}" role="button" class="btn btn-primary">Powrót</a>
        </div>
    </form>
</div>

@endsection