<?php

namespace App\Http\Controllers;

use App\interfaces\issuesType;
use Illuminate\Http\Request;

class IssueController extends Controller
{
    protected $issueType;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(issuesType $issues)
    {
        $this->issueType = $issues;
    }

    public function index()
    {
        $res = $this->issueType->getIssuesType();
        if($res == '') {
            return response()->json(['msg'=> 'No record found']);
        }
        return response()->json($res);

    }


    public function show($id)
    {
        $res = $this->issueType->findbyId($id);
        if($res == ''){
            return response()->json(['msg'=> 'No data found']);
        }
        return response()->json($res);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'=> 'required',
        ]);
        $res = $this->issueType->create($request->all());
        // if($res == 0){
        //     return response()->json(['msg'=> ''])
        // }
        return response()->json($res);
    }

    public function update(Request $request, $id)
    {
        $res = $this->issueType->update($request->all(), $id);
        return response()->json($res);
    }

    public function delete($id)
    {
        $res = $this->issueType->delete($id);
        return response()->json($res);
    }
}
