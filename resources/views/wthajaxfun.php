<?php

namespace App\Http\Controllers;
use App\Models\todolist;
use Illuminate\Http\Request;
use View, Input, Redirect;
class TodoController extends Controller
{
    public function addlist(){
        return view('add_list');
    }
    public function add(Request $request){
        // dd($request);
        $todolist= new todolist();
        $todolist->name = "avinash";
    	$todolist->list = $request->list;
        $todolist->save();
        return response()->json([
    		'status'=>200,
    		'todolist' => $todolist,

    	]);
    }
    public function display(){
        
        $todolist= todolist::all();
    	return view('display',compact('todolist'));
    }
    public function edit($id)
    {
    	$todolist=todolist::find($id);
    	return response()->json([
    		'status'=>200,
    		'todolist' => $todolist,

    	]);
    }
    public function update(Request $request)
    {
    	$list_id=$request->input('list_id'); 
    	$todolist=todolist::find($list_id);
    	$todolist->list = $request->input('list');
    	$todolist->save();
    	return back()->with('update','List Record Updated Successfully!');
    }
     public function delete($id)
    {
    	$todolist=todolist::find($id);
    	$todolist->delete();
    }
}