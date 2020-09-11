@extends('layouts.app')

@section('content')
	<div class="container">
		@if(count($collection)>0)
			<h2 class="display-5 text-center mt-1">
		       Ofertas de la Semana
		    </h2>

		     <!-- CARD-->
		    @foreach($collection as $item)
		    	<div class="card mb-3 card-custom">
			    	<a href="{{ route('show.detail',['headerId'=>$item['slug']]) }}" class="offers-week-link">
						<div class="row no-gutters">

							@if(count($images) == 0)
							    <div class="card-img-container">
							      <img src="{{asset('img/folder.png')}}" class="card-img" alt="Oferta">
							    </div>
							@else
							 	@foreach($images as $image)
						          @if($image->active)
						          	<div class="card-img-container card-img-container-guest">
								      <img src="{{ route('get.image', ['filename' => $image->image_path_name]) }}" class="card-img" alt="Oferta">
								    </div>
						          @endif
						        @endforeach
							@endif

						    <div class="card-body-container">
						      <div class="card-body card-body-custom">

						      	<p class="card-text"><strong>Nombre: </strong>{{$item["description"]}}</p>
								
						        <p class="card-text">
						        	<strong>Tienda:</strong>
						        	{{$item["site"]}}
						        </p>
						        <p class="card-text">
						        	<strong>Duración: </strong>
						        	<small class="text-muted">
						        		Del {{ date_format(new DateTime($item["date_from"]),"d/m/Y") }}
						        		al {{ date_format(new DateTime($item["date_to"]),"d/m/Y") }} 
						        	</small>
						        </p>
						      </div>
						    </div>
						</div>
					</a>

					<a href="{{ route('download.poster',['offer_id' => $item['id']]) }}">
						<div class=".delete-offer-container delete-offer-container-pdf">
					    	<img src="{{ asset('img/pdf.png') }}">
					    </div>
					</a>
				</div>
		    @endforeach

		@else
			@include('inc.no_offer_img')
		@endif
	</div>
@endsection
