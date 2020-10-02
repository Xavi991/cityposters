<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	 <link rel="shortcut icon" type="image/x-icon" href="{{asset('img/citymarket.ico')}}">

	<title>OFERTAS</title>

	<style  type = "text/css">
		@font-face { 
		  font-family: 'roboto-medium';
		  src: url("{{storage_path('fonts/Roboto-Medium.woff2')}}") format('woff2'), /* Super Modern Browsers */
		       url("{{storage_path('fonts/Roboto-Medium.woff')}}") format('woff'), /* Pretty Modern Browsers */
		       url("{{storage_path('fonts/Roboto-Medium.ttf')}}")  format('truetype'); /* Safari, Android, iOS */
		}

		@font-face {
			font-family: 'gotham-bold';
			src: url("{{storage_path('fonts/GothamRoundedBold.eot')}}");
			src: local('☺'), url("{{storage_path('fonts/GothamRoundedBold.woff')}}") format('woff'), 
				url("{{storage_path('fonts/GothamRoundedBold.ttf')}}") format('truetype'), 
				url("{{storage_path('fonts/GothamRoundedBold.svg')}}") format('svg');
			font-weight: normal;
			font-style: normal;
		}

		@font-face {
			font-family: 'gotham-medium';
			src: url("{{storage_path('fonts/GothamRoundedMedium.eot')}}");
			src: local('☺'), url("{{storage_path('fonts/GothamRoundedMedium.woff')}}") format('woff'), 
				 url("{{storage_path('fonts/GothamRoundedMedium.ttf')}}") format('truetype'), 
				 url("{{storage_path('fonts/GothamRoundedMedium.svg')}}") format('svg');
			font-weight: normal;
			font-style: normal;
		}

		@font-face {
			font-family: 'gotham-light';
			src: url("{{storage_path('fonts/GothamRoundedLight.eot')}}");
			src: local('☺'), url("{{storage_path('fonts/GothamRoundedLight.woff')}}") format('woff'), 
				 url("{{storage_path('fonts/GothamRoundedLight.ttf')}}") format('truetype'), 
				 url("{{storage_path('fonts/GothamRoundedLight.svg')}}" format('svg');
			font-weight: normal;
			font-style: normal;
		}

		@font-face {
			font-family: 'calibri-lite';
			src: url("{{storage_path('fonts/calibril.eot')}}");
			src: local('☺'), url("{{storage_path('fonts/calibril.woff')}}") format('woff'), 
				url("{{storage_path('fonts/calibril.ttf')}}") format('truetype'), 
				url("{{storage_path('fonts/calibril.svg')}}") format('svg');
			font-weight: normal;
			font-style: normal;
		}

		*{
			box-sizing: border-box;
		}

		html{
			width: 100%;
			height: 100%;
			padding: 0;
			margin: 0;
		}

		body{
			font-family: 'gotham-bold';
		}

		.poster{
			position: absolute;
			top:0; 
			left: 0;
			/*width: 595px;
			height: 842px;*/
			width: 100%;
			height: 100%;
			/*background-color: red;*/
		}

		img{
			width: 100%;
		}

		.offer-container{
			position: absolute;
			top: 0;
			left: 0;
			z-index: 10;
			width: 395px;
			height: 560px;
			/*background-color: rgba(0,0,0,.5);*/
		}

			.offer{
				position: absolute;
				top: 204px;
				left: 27px;
				z-index: 15;
				width: 340px;
				height: 300px;
				/*background-color: rgba(255,255,255,.5);*/
			}

				.offer-description{
					display: block; 
					width: 100%; 
					text-align: center; 
					/*background-color: red; */
					margin-top: 20px;
					padding-left: 10px;
					padding-right: 10px;
					font-size: 15px;
				}

				.offer-ean{
					position: absolute;
					top: 280px;
					left: 0;	
					font-family: 'calibri-lite';
					font-size: 10px; /*7pts*/
				}

				.offer-ean-group{
					position: absolute;
					top: 250px;
					left: 0;	
					font-family: 'calibri-lite';
					font-size: 9px; /*7pts*/
					word-wrap: break-word;
				}

				.descount-container{
					position: absolute; 
					top: 180px; 
					left: 10px; 
					z-index: 20; 
					background-color: rgb(237, 22, 28);  
					width: 70px; 
					height: 70px; 
					border-radius: 35px;
				}
					.descount-title{
						display: block; 
						font-size: .8rem; 
						color:#FFF; 
						margin-top: 11px; 
						margin-left: 6px;
					}

					.descount-body{
						display: block; 
						color: #FFF; 
						margin-left: 10px; 
						margin-top: -7px; 
						font-size: 1.5rem; 
					}

				.quantity-promo-container{
					display: block; 
					font-size: 3rem; 
					text-align: center; 
					margin-top: 25px;
				}

				.offer-price-1{
					font-size: 37px; /*28 pts*/
					margin-top: 60px;
				}

				.offer-price-2{
					font-family:  'gotham-bold';
					font-size: 50px;
					margin-top: 25px;
					width: 90%;
					margin-left: auto;
					margin-right: auto;
					border-bottom: 2px solid #000;
				}

				.offer-price-2-fourth-design{
					margin-top: -20px;
				}

					.guaranies{
						font-weight: normal;
						font-size: 1.5rem;
					}

					.guaranies-before{
						font-weight: normal;
					}

				.offer-price-3{
					font-size: 65px;
					margin-top: -30px;
				}

			.offer-descount{
				display: block;
				/*background-color: red;*/
				text-align: center;
				margin-top: 10px;
				font-size: 1.2rem;
			}

			.offer-footer{
				position: absolute;
				top: 295px;
				left: 0;
				width: 340px;
				height: 32px;
				/*background-color: yellow;*/
			}

				.offer-footer-content{
					display: block;
					text-align: center;
					font-size: .8rem;
					text-transform: uppercase;
				}

			.offer-container.second{
				left: 397px;
			}

			.offer-container.third{
				top: 561px;
			}

			.offer-container.fourth{
				top: 561px;
				left: 397px;
			}

			.text-cross{
				text-decoration: line-through;
			}

			.page-break {
				/*background-color: red;*/
			    page-break-after: always;
			}

		.first-design{
			font-size: 65px;
		}

		.until-done{
			font-family: 'gotham-light';
			font-size: 11px; /*8pts*/
		}

		.date-format{
			font-family: 'gotham-medium';
			font-size: 13px; /*10pts*/

		}

		.quantity-promo-container-fourth-design{
			display: block; 
			font-size: 37px; 
			text-align: center; 
			margin-top: -5px;
		}

		.descount-container-fourth-design{
			position: absolute; 
			top: 50px; 
			right: 10px; 
			z-index: 20; 
			background-color: rgb(237, 22, 28);  
			width: 70px; 
			height: 70px; 
			border-radius: 35px;
		}
			.descount-body-fourth-design{
				display: block; 
				color: #FFF; 
				margin-left: -4px; 
				margin-top: -4px; 
				font-size: 2.7rem;
				transform: rotate(-10deg); 
			}

		.offer-descount-fourth-design{
			display: block;
			/*background-color: red;*/
			text-align: center;
			margin-top: 0;
			font-size: 1.2rem;
		}

		.before-price-fourth-design{
			margin-top: -10px; 
			display: block;
		}

		.offer-price-2-fifth-design{
			margin-top: 10px;
			display: block;
			font-size: 25px;
		}

		.fifty-porcent-fifth-design{
			margin-top: -20px;
			display: block;
			font-size: 60px;
		}

		.promo-fourth-design{
			display: block; 
			font-family: 'gotham-medium';
			font-size: 8px; 
		}

		.descount-container-fifth-design{
			position: absolute; 
			top: 40px; 
			right: 2px; 
			z-index: 20; 
			background-color: rgb(237, 22, 28);  
			width: 60px; 
			height: 60px; 
			border-radius: 30px;
		}
			.descount-title-fifth-design{
				display: block; 
				font-size: 11.2px; 
				color:#FFF; 
				margin-top: 8px; 
				margin-left: 8px;
				transform: rotate(-5deg);
			}

			.descount-body-fifth-design{
				display: block; 
				color: #FFF; 
				margin-left: 0; 
				margin-top: -15px; 
				font-size: 27.2px;
				transform: rotate(-5deg); 
			}

		.unit-fifth-design{
			display:block; 
			padding-left: 180px; 
			font-size: 15px;
		}

		.take-two-fifth-design{
			display:block; 
			text-align: center; 
			font-family: 'gotham-medium'; 
			font-size: 12px;
		}

		.final-price-fifth-design{
			font-family: 'gotham-bold'; 
			font-size: 17px;
		}

	</style>
</head>
<body>

		
		<?php 
			$offersDescription=[]; //contiene los elementos separados
			$offersPrice=[]; //contiene los elementos separados
			$offersBefore=[]; //contiene los elementos separados
			$offersFrom=[]; //contiene los elementos separados
			$offersTo=[]; //contiene los elementos separados
			$offersDesign=[]; //contiene los elementos 
			$productEans=[];
			$groups=[];
			$descountPorcentage= [];
			$quantityPromo= [];

			$j=0;	//contador para separar de 4
			$i=0; //indice del for para tocar de forma global
		?>

		@for($i=0; $i < count($collection); $i++)

				@if($j <= 3)
					<?php
						
						array_push($offersDescription, $collection[$i]->description);
						array_push($offersPrice, $collection[$i]->after_price);
						array_push($offersBefore, $collection[$i]->before_price);
						array_push($offersFrom, $collection[$i]->date_from);
						array_push($offersTo, $collection[$i]->date_to);
						array_push($offersDesign, $collection[$i]->design_type);
						array_push($groups, $collection[$i]->group_tittle);
						array_push($descountPorcentage, $collection[$i]->descount_porcentage);
						array_push($quantityPromo, $collection[$i]->quantity_promo);

						if($collection[$i]->group_tittle == 'N'){ //VERIFICA SI HAY GRUPOS
							array_push($productEans, $collection[$i]->ean);
						}else{
							for($k=0; $k<count($ean_group); $k++){
								array_push($productEans, $ean_group[$k]->ean);
							}
						}

						$j++;	

					?>

					@if(count($offersDescription)>0 && count($offersDescription)<5)
						<div class="poster">

							@if( count($image) >0 )
								<img src="{{ asset('storage/'.$image[0]->image_path_name) }}">
							@endif
						
							<div class="offer-container">
								<div class="offer">
									
									@include('inc.box_first_price')
									
								</div>
							</div>

							<div class="offer-container second">
								<div class="offer">

									@include('inc.box_second_price')

								</div>
							</div>

							<div class="offer-container third">
								<div class="offer">

									@include('inc.box_third_price')
									
								</div>
							</div>

							<div class="offer-container fourth">
								<div class="offer">										
									
									@include('inc.box_fourth_price')
									
								</div>
							</div>
					
						</div>

					@endif


				@else
					<div class="page-break"></div>
					<?php
						$offersDescription = [];
						$offersPrice=[];
						$offersBefore=[];
						$offersFrom=[];
						$offersTo=[];
						$offersDesign=[];
						$productEans=[];
						$groups=[];
						$descountPorcentage=[];
						$quantityPromo=[];

						$j=0;
						$i= $i-1;
					?>
				@endif

				
		@endfor
		
		
</body>
</html>