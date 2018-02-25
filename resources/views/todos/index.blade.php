@extends('layouts.app')

@section('content')

<div class="stats border-secondary row">
    <div class="stats-left col">
            <p>Witaj <strong>{{ $user->name }}</strong>!</p>
            <p>Twoje zadania: <strong>{{ $total_todos_num }}</strong></p>
            <p>Do zrobienia: <strong>{{ $todos_to_do }}</strong></p>
            <p>Zrobione: <strong>{{ $completed_todos }}</strong></p>
    </div>
    <div class="stats-right col d-flex justify-content-center align-items-center">
        <a href="{{ route('todos.new') }}" role="button" class="btn btn-primary btn-lg">Dodaj nowe zadanie</a>
    </div>
</div>


<section class="todos">
    @foreach($todos as $todo)
        <div class="todo_item"
        @if($todo->completed_at)
            style="background-color: #F0F2EF"
        @endif>
            <h2>{{ $todo->title }}</h2>
            <div class="todo_body">
                {{ $todo->body }}
            </div>
            <div class="todo_times">
                <p>
                    @if($todo->completed_at)
                        <strong><span class="text-success"> Wykonane: {{$todo->completed_at}}</span></strong>
                    @else 
                        <strong> <span class="text-danger"> Do zrobienia <span> </strong>
                    @endif
                </p>
                <p>Utworzone: {{ $todo->created_at }}</p>
            </div>
            <div class="todo_menage">
                <form method="POST" action="{{ route('todos.update', $todo) }}">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <button class="btn btn-success"
                        @if($todo->completed_at)
                            disabled
                        @endif
                    >Oznacz jako wykonane</button>
                </form>
                <a class="btn btn-info text-light" href="{{ route('todos.edit', $todo) }}">Edytuj</a>
                <form method="POST" action="{{ route('todos.delete', $todo)}}">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button class="btn btn-danger">Usuń</button>
                </form>
            </div>
            <div style="clear:both"></div>
        </div>
    @endforeach

    {{ $todos->links() }}
</section>
@endsection