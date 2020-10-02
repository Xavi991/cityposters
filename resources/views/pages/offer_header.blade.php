@extends('layouts.app')

@section('content')
<div class="container">
	
	@if(Session::has('status'))
       <div class="alert alert-success text-center notification">
	         	{{Session::get('status')}}
  	    </div>
    @endif

	@if(count($collection)>0)
		<h2 class="display-5 text-center mt-3 mb-3">
	       Ofertas de la Semana
	    </h2>

	    <!-- CARD-->
	    @foreach($collection as $item)
	    	
		    <div class="card mb-3 card-custom">
		    	<a href="{{ route('show.detail',['headerId'=>$item['slug']]) }}" class="offers-week-link">
					<div class="row no-gutters">

					    <div class="card-img-container">
					      <img src="{{asset('img/folder.png')}}" class="card-img" alt="Oferta">
					    </div>

					    <div class="card-body-container">
					      <div class="card-body card-body-custom">

					      	<p class="card-text"><strong>Nombre: </strong>{{$item["description"]}}</p>
							
					        <p class="card-text">
					  
					        	<div style="width:100%; height: 40px;" class="overflow-auto">
					        		<strong>Tienda/s:</strong>
					        		{{$item["sites"]}} 
					        	</div>

					        </p>

					        <p class="card-text">
					        	<strong>Vigencia: </strong>
					        	<small class="text-muted">
					        		Del {{ date_format(new DateTime($item["date_from"]),"d/m/Y") }}
					        		al {{ date_format(new DateTime($item["date_to"]),"d/m/Y") }} 
					        	</small>
					        </p>
					      </div>
					    </div>
					</div>
				</a>
				<a href="{{ route('destroy.header',['headerId'=>$item['id']]) }}">
					<div class="delete-offer-container">
				    	<img src="{{ asset('img/delete.png') }}">
				    </div>
				</a>
			</div>
			
		@endforeach
	@else
		@include('inc.no_offer_img')
	@endif
</div>
@endsection