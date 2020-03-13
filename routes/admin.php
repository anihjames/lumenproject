<?php

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the admin routes for helpdesk.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->group(['prefix'=> 'api/v1/admin', 'middleware'=> 'auth'], function() use ($router) {

    $router->get('/agent/{id}', 'AgentsController@show');
    $router->post('/agent', 'AgentsController@store');
    $router->put('/agent/{id}', 'AgentsController@update');
    $router->delete('/agent/{id}', 'AgentsController@delete');
    
    //agent grouping


    //ticket survey


    //ratings management

    

   
    $router->post('/source', 'SourceController@store');
    $router->put('/source/{id}', 'SourceController@update');
    $router->delete('/source/{id}', 'SourceController@delete');

    
    $router->post('/level', 'LevelController@store');
    $router->put('/level/{id}', 'LevelController@update');
    $router->delete('/level/{id}', 'LevelController@delete');

    
    $router->post('/priority', 'PriorityController@store');
    $router->put('/priority/{id}', 'PriorityController@update');
    $router->delete('/priority/{id}', 'PriorityController@delete');


    $router->get('/typeofissue', 'IssueController@index');
    $router->get('/typeofissue/{id}', 'IssueController@show');

    $router->get('/status', 'AgentsController@getstatus');


    $router->delete('/ticket/{id}', 'TicketController@delete');

});


