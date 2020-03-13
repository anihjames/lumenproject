<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\interfaces\Level;


class LevelController extends Controller
{

    protected $level;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Level $level)
    {
        $this->level = $level;
    }

    public function index()
    {
        $res = $this->level->getLevel();
        return response()->json($res);
    }

    public function store(Request $request)
    {   
        $this->validate($request, [
            'level_name'=> 'required',
        ]);
       $res =  $this->level->create($request->all());
       return response()->json($res);
      
    }

    public function update(Request $request, $id)
    {
        $res =  $this->level->update($request->all(), $id);
        return response()->json($res);

       
    }

    public function show($id)
    {
       $res = $this->level->findbyId($id);
       return response()->json($res);
    }

    public function delete($id)
    {
        $res = $this->level->delete($id);
        return response()->json($res);
    }

    
}