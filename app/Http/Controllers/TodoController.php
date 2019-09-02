<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo;

class TodoController extends Controller
{
    public function index(){
        return Todo::all();
    }

    public function create(Request $request){
        $todo = new Todo();
        $todo->title = $request->title;

        if($todo->save()){
            return Response(['success' => true])->header('Content-Type','application/json');
        } else {
            return Response(['success' => false])->header('Content-Type','application/json');
        }
    }

    public function update(Request $request, $id){
        $todo = Todo::find($id);

        $todo->title = $request->title;

        if($todo->save()){
            return Response(['success' => true])->header('Content-Type','application/json');
        } else {
            return Response(['success' => false])->header('Content-Type','application/json');
        }
    }

    public function delete($id){
        $todo = Todo::find($id);

        if($todo->delete()){
            return Response(['success' => true])->header('Content-Type','application/json');
        } else {
            return Response(['success' => false])->header('Content-Type','application/json');
        }
    }
}
