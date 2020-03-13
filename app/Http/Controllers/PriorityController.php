<?php

namespace App\Http\Controllers;

use App\interfaces\Priority;
use Illuminate\Http\Request;

class PriorityController extends Controller
{

    protected $priority;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Priority $priority)
    {
        $this->priority = $priority;
    }

    public function index()
    {
        $res = $this->priority->getpriorities();
        return response()->json($res);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'priority_name'=> 'required',
            'resolution_time'=> 'required'
        ]);
        $res = $this->priority->create($request->all());
        return response()->json($res);
    }

    public function update(Request $request, $id)
    {
        $res = $this->priority->update($request->all(), $id);
        if($res == ''){
            return response()->json(['msg'=> 'update not successfull']);
        }
        return response()->json($res);
    }

    public function show($id)
    {
        $res = $this->priority->findbyId($id);
        if($res == ''){
            return response()->json(['msg'=> 'priority not found']);
        }
        return response()->json($res);
    }

    public function delete($id)
    {
        $res = $this->priority->delete($id);
        return response()->json($res);
    }
}
