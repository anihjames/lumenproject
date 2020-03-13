<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

//agent routes



$router->group(['prefix'=> 'api/v1', 'middleware'=> 'auth'], function() use ($router) {

    

    $router->get('/token', 'TicketController@gettoken');
    $router->get('/dashboard', 'DashboardController@index');
    //endpoints for logging tickets
    $router->get('/ticket', 'TicketController@index');
    $router->get('/ticket/{id}', 'TicketController@show');
    $router->post('/ticket', 'TicketController@store');
    $router->put('/ticket/{id}', 'TicketController@update');
    $router->get('/ticket/reopen/{id}', 'TicketController@reopen');//reopen ticket

     //escalate ticket
     $router->put('/ticket/escalate/{id}', 'EscalationController@store');
 
     //id - the id of the ticket
     $router->put('/addnote/{id}', 'TicketController@Addnote');//adding a note to a ticket
     $router->put('/replytocustomer/{id}', 'TicketController@ReplytoCustomer');// reply the customer 

    
     

    //endpoints for getting sources for the issue
    $router->get('/source', 'SourceController@index');
    $router->get('/source/{id}', 'SourceController@show');

    //endpoints for getting system levels
    $router->get('/level', 'LevelController@index');
    $router->get('/level/{id}', 'LevelController@show');
    
    //endpoints for getting priority
    $router->get('/priority', 'PriorityController@index');
    $router->get('/priority/{id}', 'PriorityController@show');
   

    //endpoints for getting issuetypes
    $router->get('/typeofissue', 'IssueController@index');
    $router->get('/typeofissue/{id}', 'IssueController@show');
    

    //endpoints for agents
     $router->post('/agent/access', 'AgentsController@login');
    //$router->put('/agent/{id}', 'AgentsController@update');
    $router->post('/agent/logout', 'AgentsController@logout');

    $router->get('/status', 'AgentsController@getstatus');

    $router->post('/test-email', 'JobController@enqueue');

    
   
    

   
    
});

