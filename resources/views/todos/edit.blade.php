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

    <form method="POST" action="{{ route('todos.save', $todo) }}">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <div class="form-group">
            <label>Tytuł</label>
            <input type="text" name="title" class="form-control" value="{{ $todo->title }}"/>
        </div>
        <div class="form-group">
            <label>Treść</label>
            <textarea  class="form-control" name="body">{{ $todo->body }}</textarea>
        </div>
        <div class="form-group">
            <input type="checkbox" class="form-check-input" value="done" name="completed_at" 
            @if($todo->completed_at)
                checked
            @endif
            />
            <label class="form-check-label">Zrobione</label>
        </div>

        <div class="form-group">
            <input type="submit" value="Zapisz" class="btn btn-success"/>
            <a href="{{ route('todos.index') }}" role="button" class="btn btn-primary">Powrót</a>
        </div>
    </form>
</div>

@endsection