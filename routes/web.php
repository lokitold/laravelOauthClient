<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/redirect', function () {

    $query = http_build_query([
        'client_id' => '4',
        'redirect_uri' => 'http://localhost:8080/callback',
        'response_type' => 'code',
        'scope' => ''
    ]);

    return redirect('http://localhost:8000/oauth/authorize?'.$query);
});

Route::get('/callback', function (Illuminate\Http\Request $request) {
    $http = new \GuzzleHttp\Client;

    $response = $http->post('http://localhost:8000/oauth/token', [
        'form_params' => [
            'client_id' => '4',
            'client_secret' => 'AW7uJfhH6UOU3OFxvlzw5XlsMfMurSexStgB5CYs',
            'grant_type' => 'authorization_code',
            'redirect_uri' => 'http://localhost:8080/callback',
            'code' => $request->code,
        ],
    ]);
    return json_decode((string) $response->getBody(), true);
});


Route::get('/get/client', function (Illuminate\Http\Request $request) {
    $accessToken= 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImEyZjQ1ZTJjYjY0YWM3YWU3ZmRjMzVhOTY0OTgwMmE5ZWMzMDMzODAxZjQ1NGNkYzkzYjY1NWM2ZGQzNjhhODY5ZjE2ZTAzY2FhMjc3ZGY2In0.eyJhdWQiOiI0IiwianRpIjoiYTJmNDVlMmNiNjRhYzdhZTdmZGMzNWE5NjQ5ODAyYTllYzMwMzM4MDFmNDU0Y2RjOTNiNjU1YzZkZDM2OGE4NjlmMTZlMDNjYWEyNzdkZjYiLCJpYXQiOjE0NzUwODQzMzAsIm5iZiI6MTQ3NTA4NDMzMCwiZXhwIjo0NjMwNzU3OTMwLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.SCG9NiyHCq7D9Li41nFBxp31xDp9A0Q8YD1DyuYMKyO2QAIrm7COEfnOipUAnLXGv8baWvqOOHzn7oKrrbToSbuGN2R2SSbLbUlrVg5m9Hs1GXuvXSsnTpHoe4XmcfQKGvdcjFG9TAP9qedmCMZIvknmtZ8p67958Nn2r7NJJhdABdczkwTy-tZbAmyNLs-xtQmcRcuV7DJ86GSrllFQZHp_pFrX8ZDoljs9h8nXniZEBl9rzOZ1YnDpijYeAXw4PuiWkbwmHKLskOOYj28N7VFwiwPZeL7UnfQVPUsjYt3-uIo_pKYJHI2jeCWYgN9uDK10mmDP3YL5RVFwN7C26vCeDCR5D7zS0rqwhMULw7t9-DGV4Blx5AE--yBDReWvo_TGfQXqsZ7GY_KqQ2WkQCo5WFrkmPAurA7BSx05AQWPNP7Z89HKN6AAZ0VAH2o_b4oPRI1WE818YjWZSAdcxLkvwbwIgLlX--KzZji7HzjBf-vowXzVxO5v3yyMLbEXK3YFXoR65GyqiYjnnTBTTBROukDhz5KYidJVy_rjfd_bDbGntCXPEDVR_J_CigQPYx8QMVeRlSuMyNrMxGOX1MnWrBIPCxp_F04SQJgpOZmeVvW8fAAF4XIVaCu4JI6NH337eFj1FgnbGoM2eIvPcclmqAIBh4HGaptk2gxOE7w"';

    $http = new \GuzzleHttp\Client;

    $response = $http->get('http://localhost:8000/api/user/2', [
        'headers' => [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$accessToken,
        ],
    ]);
    dd((string)$response->getBody()->getContents());
    return json_decode((string) $response->getBody(), true);
});


