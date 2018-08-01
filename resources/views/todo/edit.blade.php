@extends('layouts.app')

@section('content')

   @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{route('todo.update',['id'=>$todo->id])}}" method="POST" role="form">
	<legend>Add todo</legend>
	{{ csrf_field() }}
	<div class="form-group">
		<input type="text" class="form-control" name="todo" placeholder="todo" value="{{$todo->todo}}">
	</div>
	<button type="submit" class="btn btn-primary">Edit</button>
</form>


@endsection