<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodosRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Todos;

class TodosController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){

        $user = Auth::user();
        $todos = Todos::where('created_by', $user->id)->orderBy('created_at', 'desc')->paginate(5);

        $total_todos = Todos::where('created_by', $user->id)->get();
        $total_todos_num = count($total_todos);

        $completed_todos = 0;

        foreach($total_todos as $todo){
            if($todo->completed_at){
                $completed_todos++;
            }
        }

        $todos_to_do = $total_todos_num-$completed_todos;

        return view('todos.index', [
            'user' => $user,
            'todos' => $todos,
            'total_todos_num' => $total_todos_num,
            'completed_todos' => $completed_todos,
            'todos_to_do' => $todos_to_do
        ]);
    }

    public function destroy(Todos $todo){
        $todo->delete();
        return redirect()->route('todos.index');
    }

    public function update(Todos $todo){
        $todo->completed_at = date('Y-m-d H:i:s');
        $todo->save();
        return redirect()->route('todos.index');
    }

    public function edit(Todos $todo){
        return view('todos.edit', [
            'todo' => $todo
        ]);
    }

    public function save(TodosRequest $request, Todos $todo){
        $todo->update($request->all());

        $test = $request->completed_at;
        if(isset($request->completed_at)){
            if(!$todo->completed_at){
                $todo->completed_at = date('Y-m-d H:i:s');
                $todo->save();
            }
        } else {
            $todo->completed_at = NULL;
            $todo->save();
        }

        return redirect()->route('todos.index');
    }

    public function new(){
        return view('todos.new');
    }

    public function add(TodosRequest $request){
        $todo = new Todos;
        $todo->title = $request->title;
        $todo->body = $request->body;
        $todo->created_by = Auth::id();
        $todo->save();
        return redirect()->route('todos.index');
    }

}
