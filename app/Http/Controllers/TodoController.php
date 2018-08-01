<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\SoftDeletes;

use Auth ;
use Session;

use App\Todolist as todo;

class TodoController extends Controller
{
    
    public function index()
    {
        //
        
        $currentUser = Auth::user();
        if($currentUser->todolists->count() === 0){
            
            Session::flash('info','no todos enjoy your day');
            
            return redirect()->route('todo.create');
        
        }
        return view('todo.index',['todos'=>$currentUser]);
    }

    public function create()
    {
        //
    return view('todo.create');
    }

    public function store(Request $request)
    {
        
            $request->validate([
               
                'todo'=>'required|max:200'
            
            ]);
        
        $user_id = Auth::user()->id;
        
        
        todo::create([
            'todo'=>$request->todo,
            'user_id'=>$user_id
        ]);
        
        
        Session::flash('success','todo \"'. $request->todo. '\" created successfully');
        
        return redirect()->route('todo.all');
    }

   public function edit($id)
    {
                
        $currentTodo = Auth::user()->todolists->where('id',$id)->where('user_id',Auth::user()->id)->first();
        
        
        return view('todo.edit',['todo'=>$currentTodo]);
    }

    public function update(Request $request, $id)
    {
        //
        
        $request->validate([
            
           'todo'=>'required' 
        ]);
        
        $currentTodo = Auth::user()->todolists->find($id);
        
        $currentTodo->todo = $request->todo;
        
        $currentTodo->save();
        Session::flash('success'," \"$request->todo\" updated successfully" );
        return redirect()->route('todo.all');
    }
   
    public function destroy($id)
    {
        $currentTodo = Auth::user()->todolists->find($id);
        
        $currentTodo->delete();
        
        Session::flash('success' , 'Congrates! todo finished');
        
        return redirect()->route("todo.finished");

    }
    
    public function trash()
    {
        
        $user_id = Auth::user()->id;
        
        $trashed=todo::onlyTrashed()->where('user_id',$user_id)->get();
         if($trashed->count() === 0){
    
             Session::flash('info','no finshed todos');
            return redirect()->route('todo.create');
            
        }
        
        return view('todo.trash',['trashs'=>$trashed]);
        
        
    }
    
    public function kill($id)
    {
        
        $currentTodo = todo::withTrashed()->find($id);
        
        $currentTodo->forceDelete();
        
        Session::flash('success','todo deleted for ever');
   
        return redirect()->back();
        
    }
    
    public function restore($id)
    {
        
        $currentTodo = todo::withTrashed()->find($id);
        
        $currentTodo->restore();
        
        Session::flash('info','todo restored');
        return redirect()->back();
        
    }
    
}
