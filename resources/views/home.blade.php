@extends('layouts.app')


@section('content')

<div class="panel panel-info">
	  <div class="panel-heading">
			<h3 class="panel-title">Your todos</h3>
	  </div>
	  <div class="panel-body">
	        <table class="table table-hover">
            <tr>
                <th>Todo</th>
                <th>Edit</th>
                <th>Delete</th>
                <th>Created at</th>
            </tr>
            

	    @foreach($todos->todolists as $todo)
                <tr>
                    <td>{{$todo->todo}}</td>
        <td><a href="{{route('todo.edit',['id'=>$todo->id])}}" class="btn btn-primary">Edit</a></td>
        <td><a href="{{route('todo.trash',['id'=>$todo->id])}}" class="btn btn-success">Finisih</a></td>
                    <td>{{$todo->created_at->diffForHumans()}}</td>
                </tr>
	    @endforeach            
    </table>

      

      
	  	  </div>
</div>

@endsection