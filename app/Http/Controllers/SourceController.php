<?php

namespace App\Http\Controllers;

use App\interfaces\Source;
use Illuminate\Http\Request;

class SourceController extends Controller
{
    protected $sources, $msg, $msgcode;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Source $sourceservices)
    {
        $this->sources = $sourceservices;
    }

    public function index()
    {
        //displays all the avaliable sources
        return $this->sources->getsources();
    }

    public function store(Request $request)
    {
        //create a new source 
        $this->validate($request, [
            'name'=> 'required',
        ]);     
        $res = $this->sources->create($request->all());
        if($res == '1'){
            $this->msg = "successfull";
            $this->msgCode = "1";
        }else{
            $this->msg = "failed";
            $this->msgCode = "0";
        }
        return response()->json(['status'=> $this->msg, 'statusCode'=> $this->msgCode]);
    }

    public function show($id)
    {
        //find a source based on id
        $res = $this->sources->findbyId($id);
        if($res == ''){
           $this->msg = 'no data found';
        }
        return response()->json(['data'=> $res]);
    }

    public function update(Request $request, $id)
    {
        //update a source
        $res = $this->sources->update($request->all(), $id);
        if($res == '1'){
            $this->msg = "successfull";
            $this->msgCode = "1";
        }else{
            $this->msg = "failed";
            $this->msgCode = "0";
        }

        return response()->json(['status'=> $this->msg, 'statusCode'=> $this->msgCode]);
    }

    public function delete($id)
    {
        $res = $this->sources->delete($id);
        if($res == '0'){
            $this->msg = 'No data found for deleting';
        }else{
            $this->msg = 'successfull';
        }
        return response()->json(['status'=> $this->msg, 'msgcode'=> $res]);
    }



    
}
