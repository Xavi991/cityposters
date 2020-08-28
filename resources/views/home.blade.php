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
             @include('inc.form_offer')

             @include('inc.form_design')
          </div>
      </div>
    @else
      @if(count($images) == 0)
        <div style="width: 300px; height: 200px; margin-left: auto; margin-right: auto">
          <img src="{{ asset('img/add-image.png') }}" style="width: 100%">
        </div>
        <h2 class="display-5 text-center" style="margin-top: 18vh">NO HAY CARTEL PARA IMPRIMIR</h2>
      @else

        @foreach($images as $image)
          @if($image->active)
            <div class="no-offers-container sign">
              <img  src="{{ route('get.image', ['filename' => $image->image_path_name]) }}">
            </div>
            <div class="btn-download-container">
              <a href="{{ route('download.poster') }}" target="_blank" class="btn btn-custom">Descargar</a>
            </div>
          @endif
        @endforeach

      @endif

    @endif
</div>

@include('inc.modal_add')

@endsection
