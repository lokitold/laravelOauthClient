@extends('layouts.app-mail')
@section('content')
<div class="container">
   <div class="row">
       <div class="col col-md-6 col-md-offset-3"   >
           <div class="panel panel-default">
             <div class="panel-heading"><h3 class="panel-title">Bienvenidos!!!</h3></div>
             <div class="panel-body">
               <h4>La Comunidad de Laravel Perú te comparte este mensaje</h4>
               <h3>{{$motivational}}</h3>
             </div>
             <div class="panel-footer">
                 <a href="" class="btn btn-primary btn-xs">Comunidad de laravel Perú</a>
                 <ul>
                 @foreach($users as $user)
                    <li>{{$user->email}}</li>
                 @endforeach
                 </ul>
             </div>
           </div>
        </div>
   </div>
</div>
@endsection