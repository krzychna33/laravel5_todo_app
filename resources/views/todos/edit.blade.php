@extends('layouts.app')

@section('content')

<form>

    <div class="form-group">
        <input type="text" class="form-control" value="{{ $todo->title }}"/>
    </div>
    <div class="form-group">
        <textarea  class="form-control">{{ $todo->body }}</textarea>
    </div>

</form>

@endsection