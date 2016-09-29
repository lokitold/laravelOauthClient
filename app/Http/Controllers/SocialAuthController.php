<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class SocialAuthController extends Controller
{
    //

	#Server : clublectordev.us-east-1.elasticbeanstalk.com
	#Client ID: 3
	#Client secret: YbK0IQwM8ueI1L35gr86enZrifyyR0ysmiTXmOPt
	#redirect : http://localhost:8080/callback

	public $serverOauth = 'http://clublectordev.us-east-1.elasticbeanstalk.com/';
	public $clientSecret = 'YbK0IQwM8ueI1L35gr86enZrifyyR0ysmiTXmOPt';
	public $clientId = '3';
	public $redirectUri = 'http://localhost:8080/callback';

	public function init(Request $request){
		$host = $request->getHost();
		if($host == 'laravel-oauth-client.herokuapp.com'):

			#Server : clublectordev.us-east-1.elasticbeanstalk.com
			#Client ID: 8
			#Client secret: cVBNUwTST4nUDn3m5PRAotFvpdCRryGArfUJRSMH
			#redirect : https://laravel-oauth-client.herokuapp.com/callback

			$this->serverOauth = 'http://clublectordev.us-east-1.elasticbeanstalk.com/';
			$this->clientSecret = 'cVBNUwTST4nUDn3m5PRAotFvpdCRryGArfUJRSMH';
			$this->clientId = '8';
			$this->redirectUri = 'https://laravel-oauth-client.herokuapp.com/callback';
		endif;
	}


    public function redirect(Request $request)
    {	
    	$this->init($request);
        $query = http_build_query([
		    'client_id' => $this->clientId,
		    'redirect_uri' => $this->redirectUri,
		    'response_type' => 'code',
		    'scope' => ''
		]);

		return redirect($this->serverOauth.'oauth/authorize?'.$query);
    }

    public function callback(Request $request)
    {
    	$this->init($request);
    	$http = new \GuzzleHttp\Client;

	    $response = $http->post($this->serverOauth.'oauth/token', [
	        'form_params' => [
	            'client_id' => $this->clientId,
	            'client_secret' => $this->clientSecret,
	            'grant_type' => 'authorization_code',
	            'redirect_uri' => $this->redirectUri,
	            'code' => $request->code,
	        ],
	    ]);
	    return json_decode((string) $response->getBody(), true);

        #$user = $service->createOrGetUser(Socialite::driver($provider),$request);
        #auth()->login($user);
        #return redirect()->to('/home');
    }

    public function getClient(Request $request){

    	$this->init($request);

    	$accessToken= 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImFmNzgzNjY1NTVjZjdmNWFkMzIxOGExNTI5ZGI4ZjRjMDAwMWRhNDZjODA4NGQzZTFlNmYxOGFiMjc0MDc5MDcyZGMxNzVmZTgyYTEzMGM4In0.eyJhdWQiOiIzIiwianRpIjoiYWY3ODM2NjU1NWNmN2Y1YWQzMjE4YTE1MjlkYjhmNGMwMDAxZGE0NmM4MDg0ZDNlMWU2ZjE4YWIyNzQwNzkwNzJkYzE3NWZlODJhMTMwYzgiLCJpYXQiOjE0NzUxMDIyOTIsIm5iZiI6MTQ3NTEwMjI5MiwiZXhwIjo0NjMwNzc1ODkyLCJzdWIiOiI3Iiwic2NvcGVzIjpbXX0.YK5ZHtCKW-Sc-ZBawaUgI9lPpAdEZg9W8IVWwiHC66el4j6zWHwY-q9smCVgsnQG2oNUlqYM04neO7j7Gvm8GAn7Nrwv872j89r89yqYR3iUPJUXVdl-GMyXXcdp0dAaW51N30enREbCAz8VZqCJKwv1J1_VBFRpD2RSslB8IQogsccS-YHRUNXERPmtbXgM9ouEJsxLJgTnRDUzAMhGqMMZ6-esg736_V8eIwa_t8bpLGG2L9gUaRAi3K4H9yMHMFgHrWeYgd039paKyNU9_F5hHCP7A97FSf_mdow9u1uJtQpT1Z4X8tyCMadn1PJynR_M-HgVA2ZdrkPjbFDhogVjH2EYeOK8JUcHihVPLraNmVchetbcL7ge7CYSGNwUt1yVEc_6gJ6a8S_JTkR7LjvX0_Uc2R3FN2mnUOsuQpIGmu3RT_0yOhciUjbsmccPiTdcx7SSOMPisGkg9B2g7feGGoJLxZDw2-KaDdzARF1lJwTH5pdoaqu24RJcsLIBbofqEPW9GDwaUTUsLlWRnoPbfmAKjBsP7b_bWacxPUUo3k7QITenXLkVvp6PiQ0uFE8bvCj2JUrsOP3DXRkggc3XhGyLLT9A-vv9uBE4IT5GyjDjpDu473g5kVo1SQaUBS9AmXn_PODMK23qXYIbF79Em_lSgHkrVOQZ-dsNX8U"';

	    $http = new \GuzzleHttp\Client;

	    $response = $http->get($this->serverOauth.'api/user/2', [
	        'headers' => [
	            'Accept' => 'application/json',
	            'Authorization' => 'Bearer '.$accessToken,
	        ],s
	    ]);
	    dd((string)$response->getBody()->getContents());
	    return json_decode((string) $response->getBody(), true);
    }
}
