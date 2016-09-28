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

# clublectordev.us-east-1.elasticbeanstalk.com
#Client ID: 3
#Client secret: YbK0IQwM8ueI1L35gr86enZrifyyR0ysmiTXmOPt

Route::get('/redirect', function () {

    $query = http_build_query([
        'client_id' => '3',
        'redirect_uri' => 'http://localhost:8080/callback',
        'response_type' => 'code',
        'scope' => ''
    ]);

    return redirect('http://clublectordev.us-east-1.elasticbeanstalk.com/oauth/authorize?'.$query);
});


Route::get('/callback', function (Illuminate\Http\Request $request) {
    $http = new \GuzzleHttp\Client;

    $response = $http->post('http://clublectordev.us-east-1.elasticbeanstalk.com/oauth/token', [
        'form_params' => [
            'client_id' => '3',
            'client_secret' => 'YbK0IQwM8ueI1L35gr86enZrifyyR0ysmiTXmOPt',
            'grant_type' => 'authorization_code',
            'redirect_uri' => 'http://localhost:8080/callback',
            'code' => $request->code,
        ],
    ]);
    return json_decode((string) $response->getBody(), true);
});


Route::get('/get/client', function (Illuminate\Http\Request $request) {
    $accessToken= 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImFmNzgzNjY1NTVjZjdmNWFkMzIxOGExNTI5ZGI4ZjRjMDAwMWRhNDZjODA4NGQzZTFlNmYxOGFiMjc0MDc5MDcyZGMxNzVmZTgyYTEzMGM4In0.eyJhdWQiOiIzIiwianRpIjoiYWY3ODM2NjU1NWNmN2Y1YWQzMjE4YTE1MjlkYjhmNGMwMDAxZGE0NmM4MDg0ZDNlMWU2ZjE4YWIyNzQwNzkwNzJkYzE3NWZlODJhMTMwYzgiLCJpYXQiOjE0NzUxMDIyOTIsIm5iZiI6MTQ3NTEwMjI5MiwiZXhwIjo0NjMwNzc1ODkyLCJzdWIiOiI3Iiwic2NvcGVzIjpbXX0.YK5ZHtCKW-Sc-ZBawaUgI9lPpAdEZg9W8IVWwiHC66el4j6zWHwY-q9smCVgsnQG2oNUlqYM04neO7j7Gvm8GAn7Nrwv872j89r89yqYR3iUPJUXVdl-GMyXXcdp0dAaW51N30enREbCAz8VZqCJKwv1J1_VBFRpD2RSslB8IQogsccS-YHRUNXERPmtbXgM9ouEJsxLJgTnRDUzAMhGqMMZ6-esg736_V8eIwa_t8bpLGG2L9gUaRAi3K4H9yMHMFgHrWeYgd039paKyNU9_F5hHCP7A97FSf_mdow9u1uJtQpT1Z4X8tyCMadn1PJynR_M-HgVA2ZdrkPjbFDhogVjH2EYeOK8JUcHihVPLraNmVchetbcL7ge7CYSGNwUt1yVEc_6gJ6a8S_JTkR7LjvX0_Uc2R3FN2mnUOsuQpIGmu3RT_0yOhciUjbsmccPiTdcx7SSOMPisGkg9B2g7feGGoJLxZDw2-KaDdzARF1lJwTH5pdoaqu24RJcsLIBbofqEPW9GDwaUTUsLlWRnoPbfmAKjBsP7b_bWacxPUUo3k7QITenXLkVvp6PiQ0uFE8bvCj2JUrsOP3DXRkggc3XhGyLLT9A-vv9uBE4IT5GyjDjpDu473g5kVo1SQaUBS9AmXn_PODMK23qXYIbF79Em_lSgHkrVOQZ-dsNX8U"';

    $http = new \GuzzleHttp\Client;

    $response = $http->get('http://clublectordev.us-east-1.elasticbeanstalk.com/api/user/2', [
        'headers' => [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$accessToken,
        ],
    ]);
    dd((string)$response->getBody()->getContents());
    return json_decode((string) $response->getBody(), true);
});


