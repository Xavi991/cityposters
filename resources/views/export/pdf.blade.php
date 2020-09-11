<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	 <link rel="shortcut icon" type="image/x-icon" href="{{asset('img/citymarket.ico')}}">

	<title>OFERTAS</title>

	<style>
		@font-face {
		  font-family: 'roboto-medium';
		  src: url('/public/fonts/Roboto-Medium.woff2")') format('woff2'), /* Super Modern Browsers */
		       url('/public/fonts/Roboto-Medium.woff")') format('woff'), /* Pretty Modern Browsers */
		       url('/public/fonts/Roboto-Medium.ttf")')  format('truetype'), /* Safari, Android, iOS */
		}

		@font-face {
		  font-family: 'roboto-bold';
		  src: url('/public/fonts/Roboto-Bold.woff2")') format('woff2'), /* Super Modern Browsers */
		       url('/public/fonts/Roboto-Bold.woff")') format('woff'), /* Pretty Modern Browsers */
		       url('/public/fonts/Roboto-Bold.ttf")')  format('truetype'), /* Safari, Android, iOS */
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
			font-family: 'roboto-bold', sans-serif;
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
				}

				.offer-ean{
					position: absolute;
					top: 280px;
					left: 0;	
					font-size: .8rem;
				}

				.offer-ean-group{
					position: absolute;
					top: 250px;
					left: 0;	
					font-size: .8rem;
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
						font-size: 1.5rem; 
						font-weight: bold;
					}

				.quantity-promo-container{
					display: block; 
					font-size: 3rem; 
					font-weight:bold; 
					text-align: center; 
					margin-top: 40px;
				}

				.offer-price-1{
					/*font-family: 'roboto-bold';*/
					font-weight: bold;
					font-size: 5rem;
					margin-top: 60px;
				}

				.offer-price-2{
					/*font-family: 'roboto-bold';*/
					font-weight: bold;
					font-size: 5rem;
					margin-top: 25px;
					width: 90%;
					margin-left: auto;
					margin-right: auto;
					border-bottom: 2px solid #000;
				}
					.guaranies{
						font-weight: normal;
						font-size: 1.5rem;
					}

					.guaranies-before{
						font-weight: normal;
					}

				.offer-price-3{
					font-weight: bold;
					font-size: 5rem;
					margin-top: 0;
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
				top: 300px;
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
									@if(isset($offersDescription[0]))
										
									 	<span class="offer-description">
									 		{{$offersDescription[0]}}
									 	</span>

									 	@if($offersDesign[0] === 1)	<!--DISEÑO 1-->
										 	<span class="offer-description offer-price-1">
										 		<span>
										 			<span class="guaranies">Gs</span>
										 			{{number_format($offersBefore[0], 0, "", ".")}}
										 		</span>
										 	</span>

										@elseif($offersDesign[0] === 2) <!--DISEÑO 2-->
											<div class="descount-container">
												<span class="descount-title">AHORRE</span>
												<span class="descount-body">{{$descountPorcentage[0]}}%</span>
											</div>

											<span class="offer-description offer-price-2">
										 		<span class="guaranies">Gs</span>
										 		<span>{{number_format($offersPrice[0], 0, "", ".")}}</span>
										 	</span>

										 	<div class="offer-descount">
												<span style="display: block;"> 
													ANTES:
												</span>
												<span class="text-cross">
													<span class="guaranies-before">Gs</span>
													{{number_format($offersBefore[0], 0, "", ".")}}
												</span>
											</div>

										@elseif($offersDesign[0] === 3)<!--DISEÑO 3-->
											<span class="quantity-promo-container">
												{{ $quantityPromo[0] }} X
											</span>

											<span class="offer-description offer-price-3">
										 		<span>
										 			<span class="guaranies">Gs</span>
										 			{{number_format($offersBefore[0], 0, "", ".")}}
										 		</span>
										 	</span>
										@endif

									 	@if($groups[0] == 'N')<!--TIPO EAN NORMAL O GRUPO-->
										 	<span class="offer-description offer-ean">
										 		@if( isset($productEans[0]) )
										 			{{ 'COD.: '.$productEans[0] }}
										 		@endif
										 	</span>
										@else
									 		<span class="offer-description offer-ean-group">
										 		@if( isset($productEans[0]) )
										 			{{ 'COD.: '.$productEans[0] }}
										 		@endif
										 	</span>
										@endif


									 	<div class="offer-footer">
											<span class="offer-footer-content"> 
												DEL {{date_format(new DateTime($offersFrom[0]),"d/m")}} AL {{date_format(new DateTime($offersTo[0]),"d/m")}} 
											</span>
											<span class="offer-footer-content"> 
												O HASTA AGOTAR EXISTENCIA
											</span>
										</div>
									@endif
									
								</div>
							</div>

							<div class="offer-container second">
								<div class="offer">

									@if(isset($offersDescription[1]))
										
									 	<span class="offer-description">
									 		{{$offersDescription[1]}}
									 	</span>

									 	@if($offersDesign[1] === 1)	<!--DISEÑO 1-->
										 	<span class="offer-description offer-price-1">
										 		<span>
										 			<span class="guaranies">Gs</span>
										 			{{number_format($offersBefore[1], 0, "", ".")}}
										 		</span>
										 	</span>

										@elseif($offersDesign[1] === 2) <!--DISEÑO 2-->
											<div class="descount-container">
												<span class="descount-title">AHORRE</span>
												<span class="descount-body">{{$descountPorcentage[1]}}%</span>
											</div>

											<span class="offer-description offer-price-2">
										 		<span class="guaranies">Gs</span>
										 		<span>{{number_format($offersPrice[1], 0, "", ".")}}</span>
										 	</span>

										 	<div class="offer-descount">
												<span style="display: block;"> 
													ANTES:
												</span>
												<span class="text-cross">
													<span class="guaranies-before">Gs</span>
													{{number_format($offersBefore[1], 0, "", ".")}}
												</span>
											</div>
										@elseif($offersDesign[1] === 3)<!--DISEÑO 3-->
											<span class="quantity-promo-container">
												{{ $quantityPromo[1] }} X
											</span>

											<span class="offer-description offer-price-3">
										 		<span>
										 			<span class="guaranies">Gs</span>
										 			{{number_format($offersBefore[1], 0, "", ".")}}
										 		</span>
										 	</span>
										@endif

										@if($groups[1] == 'N')<!--TIPO EAN NORMAL O GRUPO-->
										 	<span class="offer-description offer-ean">
										 		@if( isset($productEans[1]) )
										 			{{ 'COD.: '.$productEans[1] }}
										 		@endif
										 	</span>
										@else
									 		<span class="offer-description offer-ean-group">
										 		@if( isset($productEans[1]) )
										 			{{ 'COD.: '.$productEans[1] }}
										 		@endif
										 	</span>
										@endif

									 	<div class="offer-footer">
											<span class="offer-footer-content"> 
												DEL {{date_format(new DateTime($offersFrom[1]),"d/m")}} AL {{date_format(new DateTime($offersTo[1]),"d/m")}} 
											</span>
											<span class="offer-footer-content"> 
												O HASTA AGOTAR EXISTENCIA
											</span>
										</div>
									@endif

								</div>
							</div>

							<div class="offer-container third">
								<div class="offer">
									@if(isset($offersDescription[2]))
										
									 	<span class="offer-description">
									 		{{$offersDescription[2]}}
									 	</span>

									 	@if($offersDesign[2] === 1)	<!--DISEÑO 1-->
										 	<span class="offer-description offer-price-1">
										 		<span>
										 			<span class="guaranies">Gs</span>
										 			{{number_format($offersBefore[2], 0, "", ".")}}
										 		</span>
										 	</span>

										@elseif($offersDesign[2] === 2) <!--DISEÑO 2-->
											<div class="descount-container">
												<span class="descount-title">AHORRE</span>
												<span class="descount-body">{{$descountPorcentage[2]}}%</span>
											</div>

											<span class="offer-description offer-price-2">
										 		<span class="guaranies">Gs</span>
										 		<span>{{number_format($offersPrice[2], 0, "", ".")}}</span>
										 	</span>

										 	<div class="offer-descount">
												<span style="display: block;"> 
													ANTES:
												</span>
												<span class="text-cross">
													<span class="guaranies-before">Gs</span>
													{{number_format($offersBefore[2], 0, "", ".")}}
												</span>
											</div>

										@elseif($offersDesign[2] === 3)<!--DISEÑO 3-->
											<span class="quantity-promo-container">
												{{ $quantityPromo[2] }} X
											</span>

											<span class="offer-description offer-price-3">
										 		<span>
										 			<span class="guaranies">Gs</span>
										 			{{number_format($offersBefore[2], 0, "", ".")}}
										 		</span>
										 	</span>
										@endif

									 	@if($groups[2] == 'N')<!--TIPO EAN NORMAL O GRUPO-->
										 	<span class="offer-description offer-ean">
										 		@if( isset($productEans[2]) )
										 			{{ 'COD.: '.$productEans[2] }}
										 		@endif
										 	</span>
										@else
									 		<span class="offer-description offer-ean-group">
										 		@if( isset($productEans[2]) )
										 			{{ 'COD.: '.$productEans[2] }}
										 		@endif
										 	</span>
										@endif


									 	<div class="offer-footer">
											<span class="offer-footer-content"> 
												DEL {{date_format(new DateTime($offersFrom[2]),"d/m")}} AL {{date_format(new DateTime($offersTo[2]),"d/m")}} 
											</span>
											<span class="offer-footer-content"> 
												O HASTA AGOTAR EXISTENCIA
											</span>
										</div>
									@endif
								</div>
							</div>

							<div class="offer-container fourth">
								<div class="offer">										
									@if(isset($offersDescription[3]))
										
									 	<span class="offer-description">
									 		{{$offersDescription[3]}}
									 	</span>

									 	@if($offersDesign[3] === 1)	<!--DISEÑO 1-->
										 	<span class="offer-description offer-price-1">
										 		<span>
										 			<span class="guaranies">Gs</span>
										 			{{number_format($offersBefore[3], 0, "", ".")}}
										 		</span>
										 	</span>

										@elseif($offersDesign[3] === 2) <!--DISEÑO 2-->

											<div class="descount-container">
												<span class="descount-title">AHORRE</span>
												<span class="descount-body">{{$descountPorcentage[3]}}%</span>
											</div>

											<span class="offer-description offer-price-2">
										 		<span class="guaranies">Gs</span>
										 		<span>{{number_format($offersPrice[3], 0, "", ".")}}</span>
										 	</span>

										 	<div class="offer-descount">
												<span style="display: block;"> 
													ANTES:
												</span>
												<span class="text-cross">
													<span class="guaranies-before">Gs</span>
													{{number_format($offersBefore[3], 0, "", ".")}}
												</span>
											</div>
										@elseif($offersDesign[3] === 3)<!--DISEÑO 3-->
											<span class="quantity-promo-container">
												{{ $quantityPromo[3] }} X
											</span>

											<span class="offer-description offer-price-3">
										 		<span>
										 			<span class="guaranies">Gs</span>
										 			{{number_format($offersBefore[3], 0, "", ".")}}
										 		</span>
										 	</span>
										@endif

									 	@if($groups[3] == 'N')<!--TIPO EAN NORMAL O GRUPO-->
										 	<span class="offer-description offer-ean">
										 		@if( isset($productEans[3]) )
										 			{{ 'COD.: '.$productEans[3] }}
										 		@endif
										 	</span>
										@else
									 		<span class="offer-description offer-ean-group">
										 		@if( isset($productEans[3]) )
										 			{{ 'COD.: '.$productEans[3] }}
										 		@endif
										 	</span>
										@endif


									 	<div class="offer-footer">
											<span class="offer-footer-content"> 
												DEL {{date_format(new DateTime($offersFrom[3]),"d/m")}} AL {{date_format(new DateTime($offersTo[3]),"d/m")}} 
											</span>
											<span class="offer-footer-content"> 
												O HASTA AGOTAR EXISTENCIA
											</span>
										</div>
									@endif
									<div class="offer-footer"></div>
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