@extends('layouts.app')

@section('content')
<div class="offer-detail-container">
	<div class="container">

		@if($offerHeader)
			@if(Auth::user()->isAdmin())
				<h2 class="display-5 text-center">{{$offerHeader->description}}</h2>
				<p class="text-center">
					<strong>
						Del {{ date_format(new DateTime($offerHeader->date_from),"d/m/Y") }} 
			       		al {{ date_format(new DateTime($offerHeader->date_to),"d/m/Y") }}
					</strong>
				</p>
			@else
				<h2 class="display-5 text-center">
			       Ofertas del {{ date_format(new DateTime($offerHeader->date_from),"d/m/Y") }} 
			       al {{ date_format(new DateTime($offerHeader->date_to),"d/m/Y") }}
			    </h2>
				
			@endif
		@endif
	</div>

	@if($offerHeader)
		@if(Auth::user()->isAdmin())
			<table-component parent-route="{{ route('stream.poster',['offer_id' => $offerHeader->id]) }}" 
				offer-id="{{ $offerHeader->id }}"
				img-pdf= "{{ asset('img/pdf.png') }}"
				img-add= "{{ asset('img/add.png') }}"
				img-Empty= "{{ asset('img/cart.png') }}"
			>
				
			</table-component>
		@else
			<guest-table-component 
				offer-id="{{ $offerHeader->id }}" 
				img-Empty= "{{ asset('img/cart.png') }}"
			>
				
			</guest-table-component>
		@endif
	@else
		<div class="container">
			
			<div class="no-offers-container">
		        <img src="{{ asset('img/cart.png') }}">
			</div>
			 <h2 class="display-5 text-center no-offers-msg">AÚN NO SE HA IMPORTADO NADA</h2>
		</div>
	@endif
</div>
@endsection