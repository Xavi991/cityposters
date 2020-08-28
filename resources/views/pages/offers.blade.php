@extends('layouts.app')

@section('content')
<div class="container">

	@if($offer)
		<h2 class="display-5 text-center mt-1">
	       Ofertas del {{ date_format(new DateTime($offer->date_from),"d/m/Y") }} 
	       al {{ date_format(new DateTime($offer->date_to),"d/m/Y") }}
	    </h2>
	@endif
</div>

@if($offer)
	@if(Auth::user()->isAdmin())
		<table-component parent-route="{{ route('stream.poster') }}"></table-component>
	@else
		<guest-table-component parent-route="{{ route('stream.poster') }}"></guest-table-component>
	@endif
@else
	<div class="container">
		
		<div class="no-offers-container">
	        <img src="{{ asset('img/discount.png') }}">
		</div>
		 <h2 class="display-5 text-center no-offers-msg">NO HAY OFERTAS PARA MOSTRAR</h2>
	</div>
@endif

@endsection