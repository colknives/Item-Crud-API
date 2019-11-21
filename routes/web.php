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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(["prefix" => "item"], function() use ($router){

	//Create item route
	$router->post('create', ["as" => "item.create", "uses" => "ItemController@create"]);
	
	//Mark item as complete route
	$router->put('mark/complete/{id}', ["as" => "item.mark.complete", "uses" => "ItemController@markComplete"]);

	//Delete item route
	$router->delete('delete/{id}', ["as" => "item.delete", "uses" => "ItemController@delete"]);

	//View item route
	$router->get('view/{id}', ["as" => "item.view", "uses" => "ItemController@view"]);

	//List item route
	$router->get('list', ["as" => "item.list", "uses" => "ItemController@list"]);
});
