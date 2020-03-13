<?php

namespace App\Http\Controllers;

use App\interfaces\agents;
use App\Repositories\Ticketservices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AgentsController extends Controller
{
    protected $ticket, $agent;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Ticketservices $ticketservices, agents $agentsRepo)
    {
        $this->ticket = $ticketservices;
        $this->agent = $agentsRepo;
        $this->middleware('auth', ['expect'=> 'login']);
    }

    public function index()
    {
       //echo "something about happen";
       dd(Auth::user());
    }

    public function getstatus()
    {
        $res = $this->agent->getstatus();
        if($res == ''){
            return response()->json(['message'=> 'no data found'], 201);
        }else{
            return response()->json($res);
        }
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required|max:255',
            'last_name'=> 'required|max:255',
            'phone'=> 'required|max:11',
            'email'=> 'required|unique:agents|max:255',
            'program'=> 'required',
        ]);

        $res = $this->agent->create($request->all());
        if($res){
            return response()->json(['status'=> 'success'], 200);
        }
    }

    public function login(Request $request)
    {
        $agentexist = $this->agent->login($request->only(['email']));
        if($agentexist){
            $data['token'] = $request->header('token');
            $storetoken = $this->agent->update($data, $request['email']);
            $agent = $this->agent->agentdetails($request->all());
            return response()->json(['status'=>'success', 'agent'=>$agent], 200);
        }else{
            return response()->json(['status'=>'error', 'message'=>'Invalid domain name'], 401);
        }

       
    }


    public function show($id)
    {

    }

    public function update(Request $request,  $id)
    {

    }

    public function logout(Request $request)
    {
        //dd($request->all());
        $res = $this->agent->logout($request->all());
        if($res){
            return response()->json(['msg'=> 'Logged out'], 200);
        }else{
            return response()->json(['msg'=> 'Incorrect token'], 401);
        }
    }

    public function removeAgent($id)
    {
        
    }
}
