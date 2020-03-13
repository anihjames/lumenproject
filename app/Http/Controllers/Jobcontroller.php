<?php

namespace App\Http\Controllers;

use App\Jobs\Queuetestmail;
use Illuminate\Http\Request;

class JobController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function enqueue(Request $request)
    {
        $emails = explode(',', $request['emails']);
        //dd($emails);
        //Queuetestmail::dispatch($details);
        dispatch(new Queuetestmail($emails));

        return "test done";
    }

    //
}
