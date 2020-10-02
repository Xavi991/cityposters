@extends('layouts.app')

@section('content')

<div class="offer-form-box">
    <div class="container">

        @if(Auth::user()->isAdmin())
          @if(Session::has('status'))
               <div class="alert alert-success text-center notification">
                 {{Session::get('status')}}
             </div>
          @endif

        @endif
    </div>
    
    <div class="container"> 
      <div class="row justify-content-center">
        <div class="col-md-8" >
           <h3 class="display-5 text-center mt-3 mb-3 text-white">Crear una Oferta</h3>
           @include('inc.form_offer_header')
        </div>
      </div>
    </div>
</div>

<div class="import-form-box">
    <div class="container"> 
      <div class="row justify-content-center">
        <div class="col-md-8" >
           <h3 class="display-5 text-center mt-3 text-black">Importar datos en Oferta</h3>
           @include('inc.form_import_offer')
        </div>
      </div>
    </div>
</div>

<div class="sign-form-box">
    <div class="container"> 
      <div class="row justify-content-center">
        <div class="col-md-8" >
           <h3 class="display-5 text-center mt-3 text-white">Levantar Cartel(opcional)</h3>
            @include('inc.form_design')
        </div>
      </div>
    </div>
</div>

@include('inc.modal_add')

@endsection
