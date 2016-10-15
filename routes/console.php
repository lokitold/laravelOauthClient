<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Http\Request;
use App\User;

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




Artisan::command('email:laravel', function (Request $request) {

  $usuariosRegistrados = User::get(); 
  //dd($usuariosRegistrados);

	$data = [
		'motivational' => Inspiring::quote(),
    'users' => $usuariosRegistrados
	];

  foreach ($usuariosRegistrados as $key => $miembroDeLaComunidad) {
    \Mail::send('emails.message', $data, function($message) use ($miembroDeLaComunidad)
      {
           //remitente
           $message->from(env('CONTACT_MAIL'), env('CONTACT_NAME'));
          
           //asunto
           $message->subject('Bienvenido a la comunidad de Laravel Peru');
 
           //receptor
           $message->to($miembroDeLaComunidad->email,$miembroDeLaComunidad->name);
 
      });   
  }
  
})->describe('enviar Email a la comunidad de laravel Peru');
