<?php

namespace App\Http\Controllers;
use App\Models\todolist;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
class TodoController extends Controller
{
    public function add(Request $request){
        // dd($request);
        $todolist= new todolist();
        $todolist->name = "avinash";
    	$todolist->list = $request->list;
        $todolist->save();
        return response()->json([
    		'status'=>200,
    	]);
    }
    public function display(Request $request){
        if ($request->ajax()) {
            $data = todolist::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '<button  type="button" id="' .$row->id. '" class="fa fa-edit btn-info edit"></button> <button  type="button" id="' .$row->id. '" class="fa fa-trash btn-danger delete"></button>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
            
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
    	return response()->json([
    		'status'=>200,
    	]);
    }
     public function delete($id)
    {
    	$todolist=todolist::find($id);
    	$todolist->delete();
    }
}