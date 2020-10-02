@if(isset($offersDescription[1]))
										
 	<span class="offer-description">
 		{{$offersDescription[1]}}
 	</span>

 	@if($offersDesign[1] === 1)	<!--DISEÑO 1-->
	 	<span class="offer-description offer-price-1 first-design">
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

	@elseif($offersDesign[1] === 4)<!--DISEÑO 4-->

		<div class="descount-container-fourth-design">
			<span class="descount-body-fourth-design">2X1</span>
		</div>

		<span class="quantity-promo-container-fourth-design">
			2 X
		</span>

		<span class="offer-description offer-price-2 offer-price-2-fourth-design">
	 		<span class="guaranies">Gs</span>
	 		<span>{{number_format($offersPrice[1], 0, "", ".")}}</span>
	 	</span>

	 	<div class="offer-descount-fourth-design">

			<span style="display: block;"> 
				ANTES:
			</span>
			<span class="text-cross before-price-fourth-design">
				<span class="guaranies-before">2X Gs</span>
				{{number_format($offersBefore[1], 0, "", ".")}}
			</span>
			<span class="promo-fourth-design">
				(LA PROMO APLICA A 2 DEL MISMO CÓDIGO)
			</span>

		</div>

	@elseif($offersDesign[1] === 5)<!--DISEÑO 5-->

		<?php
			$cincuentaPorciento= $offersBefore[1] / 2;
			$precioFinal= $cincuentaPorciento + $offersBefore[1];
		?>

		<div class="descount-container-fifth-design">
			<span class="descount-title-fifth-design">2DO AL</span>
			<span class="descount-body-fifth-design">50%</span>
		</div>

		<span class="offer-description offer-price-2 offer-price-2-fifth-design">
			<span style="font-size: 15px;">1 UNIDAD:</span>
	 		<span class="guaranies">Gs</span>
	 		<span>{{number_format($offersBefore[1], 0, "", ".")}}</span>
	 	</span>

	 	<span class="unit-fifth-design">2DA. UNIDAD</span>

	 	<span class="offer-description offer-price-2 fifty-porcent-fifth-design">
	 		<span class="guaranies">Gs</span>
	 		<span>{{number_format($cincuentaPorciento, 0, "", ".")}}</span>
	 	</span>

	 	<span class="take-two-fifth-design">
	 		LLEVA LAS DOS POR:
	 		<span final-price-fifth-design>
		 		GS. {{number_format($precioFinal, 0, "", ".")}}
		 	</span>
		 	<span class="promo-fourth-design">
				(LA PROMO APLICA A 2 DEL MISMO CÓDIGO)
			</span>
	 	</span>
	
	 @elseif($offersDesign[1] === 6)<!--DISEÑO 6-->

		<?php
			$SetentaPorciento= ($offersBefore[1] * 70) / 100;
			$precioFinal= $SetentaPorciento + $offersBefore[1];
		?>

		<div class="descount-container-fifth-design">
			<span class="descount-title-fifth-design">2DO AL</span>
			<span class="descount-body-fifth-design">70%</span>
		</div>

		<span class="offer-description offer-price-2 offer-price-2-fifth-design">
			<span style="font-size: 15px;">1 UNIDAD:</span>
	 		<span class="guaranies">Gs</span>
	 		<span>{{number_format($offersBefore[1], 0, "", ".")}}</span>
	 	</span>

	 	<span class="unit-fifth-design">2DA. UNIDAD</span>

	 	<span class="offer-description offer-price-2 fifty-porcent-fifth-design">
	 		<span class="guaranies">Gs</span>
	 		<span>{{number_format($SetentaPorciento, 0, "", ".")}}</span>
	 	</span>

	 	<span class="take-two-fifth-design">
	 		LLEVA LAS DOS POR:
	 		<span final-price-fifth-design>
		 		GS. {{number_format($precioFinal, 0, "", ".")}}
		 	</span>
		 	<span class="promo-fourth-design">
				(LA PROMO APLICA A 2 DEL MISMO CÓDIGO)
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
		<span class="offer-footer-content date-format"> 
			DEL {{date_format(new DateTime($offersFrom[1]),"d/m")}} AL {{date_format(new DateTime($offersTo[1]),"d/m")}} 
		</span>
		<span class="offer-footer-content until-done"> 
			O HASTA AGOTAR EXISTENCIA
		</span>
	</div>
@endif