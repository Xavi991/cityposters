@extends('layouts.app')

@section('content')
<div class="container">

    @if(Auth::user()->isAdmin())
      @if(Session::has('status'))
           <div class="alert alert-success text-center notification">
  	         {{Session::get('status')}}
  	     </div>
      @endif

      <div class="row justify-content-center">       
          <div class="col-md-8">
             <h3 class="display-5 text-center">Crear una Oferta</h3>

             @include('inc.form_offer_header')

             <h3 class="display-5 text-center mt-3">Importar ofertas en Oferta</h3>

             @include('inc.form_import_offer')

             <h3 class="display-5 text-center mt-3">Levantar Cartel(opcional)</h3>

             @include('inc.form_design')
          </div>
      </div>

    @endif
</div>

@include('inc.modal_add')

@endsection
