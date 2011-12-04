<center>
	<h1 style="margin: 40px 0px;">
		<img src="/img/logo.png" alt="Presupuestate beta"/><br/>
		<small style="font-size:15px;">Ingresa los siguientes datos para generar tu <b>presupuesto</b></small>
	</h1>
</center>

<div class="span9" style="float: left;margin-right: 5px;padding-right: 9px;width: 510px !important;">
	<h3>Presupuesto educacional</h3>
	<div class="incomeBox">
		<b>El presupuesto aproximado de educacion es de <span class="income pull-right">$14.450.078</span> </b>
	</div>
	<div class="incomeBox">
		<b>Para alcanzar esta meta debes ahorrar mensualmente <span class="save pull-right">$1.000.000</span> </b>
	</div>
	
	<div id="universityInfo">
		<h5>Medicina / Universidad de Chile</h5>
		
	</div>

</div>

<div class="span7" style="float:left;">
	<h3>Colegios recomendados</h3>
	<div class="educationItem active clearfix">
		Nombre del colegio
	</div>	
	<div class="itemContainer clearfix">
		<div class="ubication">
			<img class="mapa" src="http://maps.google.com/maps/api/staticmap?center=Williamsbur&zoom=13&size=100x100&markers=color:blue&sensor=false"/>
			<div class="information">
				<span class="ubicationItem">Av. Grecia 22, Peñalolen</span>
			</div>
		</div>
		<div class="itemData clearfix">
			<span class="content" style="font-size:25px;">$120.000</span>		
			<span class="title">Mensualidad</span>
		</div>
		<div class="itemData clearfix">
			<span class="content">400</span>		
			<span class="title">% SIMCE</span>
		</div>
		<div class="itemData clearfix">
			<span class="content">950</span>		
			<span class="title">Puntaje PSU</span>
		</div>
		<hr/>
	</div>
	<div class="educationItem clearfix">
		Nombre del colegio
	</div>	
	<div class="itemContainer clearfix">
		<div class="ubication">
			<img class="mapa" src="http://maps.google.com/maps/api/staticmap?center=Williamsbur&zoom=13&size=100x100&markers=color:blue&sensor=false"/>
			<div class="information">
				<span class="ubicationItem">Av. Grecia 22, Peñalolen</span>
			</div>
			<div class="information">
				<span class="ubicationItem">Av. Grecia 22, Peñalolen</span>
			</div>
			<div class="information">
				<span class="ubicationItem">Av. Grecia 22, Peñalolen</span>
			</div>
		</div>
		<div class="itemData clearfix">
			<span class="content" style="font-size:25px;">$120.000</span>		
			<span class="title">Mensualidad</span>
		</div>
		<div class="itemData clearfix">
			<span class="content">400</span>		
			<span class="title">% SIMCE</span>
		</div>
		<div class="itemData clearfix">
			<span class="content">950</span>		
			<span class="title">Puntaje PSU</span>
		</div>
		<hr/>
	</div>
	<div class="educationItem clearfix">
		Nombre del colegio
	</div>	
	<div class="itemContainer clearfix">
		<div class="ubication">
			<img class="mapa" src="http://maps.google.com/maps/api/staticmap?center=Williamsbur&zoom=13&size=100x100&markers=color:blue&sensor=false"/>
			<div class="information">
				<span class="ubicationItem">Av. Grecia 22, Peñalolen</span>
			</div>
		</div>
		<div class="itemData clearfix">
			<span class="content" style="font-size:25px;">$120.000</span>		
			<span class="title">Mensualidad</span>
		</div>
		<div class="itemData clearfix">
			<span class="content">400</span>		
			<span class="title">% SIMCE</span>
		</div>
		<div class="itemData clearfix">
			<span class="content">950</span>		
			<span class="title">Puntaje PSU</span>
		</div>
		<hr/>
	</div>
</div>


<script type="text/javascript">
	$(document).ready(function(){
		$('.itemContainer:first').show();
		$('.educationItem').click(function(){
			$('.itemContainer').slideUp('fast');
			$(this).next().slideDown('fast');
			$('.educationItem').removeClass('active');
			$(this).addClass('active');
		})		
	});
</script>