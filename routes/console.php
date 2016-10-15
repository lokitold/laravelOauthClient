<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');

Artisan::command('email', function (Request $request) {

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

})->describe('Display an inspiring quote');
