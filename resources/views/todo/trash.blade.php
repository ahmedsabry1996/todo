@extends('layouts.app')


@section('content')

<div class="panel panel-info">
	  <div class="panel-heading">
			<h3 class="panel-title">Finsished todos</h3>
	  </div>
	  <div class="panel-body">
	        <table class="table table-hover text-center">
            <tr>
                <th>Todo</th>
                <th>Restore</th>
                <th>Delete</th>
                <th>Finished at</th>
            </tr>
            

	    @foreach($trashs as $trash)
                <tr>
                    <td>{{$trash->todo}}</td>
        <td><a href="{{route('todo.restore',['id'=>$trash->id])}}" class="btn btn-success">Restore</a></td>
        <td><a href="{{route('todo.kill',['id'=>$trash->id])}}" class="btn btn-danger">Delete</a></td>
               <td>
                   {{$trash->deleted_at->diffForHumans()}}
               </td>
                </tr>
	    @endforeach            
    </table>

      

      
	  	  </div>
</div>

@endsection