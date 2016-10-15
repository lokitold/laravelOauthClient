<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Foundation\Inspiring;

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

    public function callback(Request $request){

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

	    $responseAuthorization = json_decode((string) $response->getBody(), true);

	    $accessToken = $responseAuthorization['access_token'];

    	$responseDataUser = $http->get($this->serverOauth.'api/user', [
	        'headers' => [
	            'Accept' => 'application/json',
	            'Authorization' => 'Bearer '.$accessToken,
	        ],
	    ]);

	    $dataUser = json_decode((string)$responseDataUser->getBody(),true);

	    $request->session()->put('user', $dataUser);

	    return redirect('/');

    }

    public function callbackShow(Request $request)
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

	    $http = new \GuzzleHttp\Client;

	    $response = $http->get($this->serverOauth.'api/user', [
	        'headers' => [
	            'Accept' => 'application/json',
	            'Authorization' => 'Bearer '.$request->token,
	        ],
	    ]);
	    //dd((string)$response->getBody()->getContents());
	    return json_decode((string) $response->getBody(), true);
    }

    public function logout(Request $request){
    	$request->session()->forget('user');
    	return redirect('/');
    }

    public function test(Request $request){

    	$data = [
		'motivational' => Inspiring::quote()
	];
    	\Mail::send('emails.message', $data, function($message) use ($request)
       {
           //remitente
       	   $message->from(env('CONTACT_MAIL'), env('CONTACT_NAME'));
           
 
           //asunto
           $message->subject('hola');
 
           //receptor
           $message->to('vico.16c@gmail.com',"victor");
 
       });
    }
}
