<?php

namespace App\Http\Controllers;

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
        $todos = Todos::where('created_by', $user->id)->orderBy('id', 'asc')->paginate(5);

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
}
