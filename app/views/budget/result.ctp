<center>
	<h1 style="margin: 40px 0px;">
		<img src="/img/logo.png" alt="Presupuestate beta"/><br/>
	</h1>
</center>

<div class="span9" style="float: left;margin-right: 5px;padding-right: 9px;width: 510px !important;">
	<h3>Presupuesto educacional</h3>
	<div class="incomeBox">
		<b>El arancel estimado es de <span class="income pull-right">$14.450.078</span> </b>
	</div>
	<div class="incomeBox">
		<b>Para alcanzar esta meta debes ahorrar mensualmente<span class="save pull-right">$1.000.000</span> </b>
	</div>
	<div class="clearfix">
		<div class="clearfix" id="incomeInformationChart" style="display:none;">
			<img src="https://chart.googleapis.com/chart?cht=s&chd=t:12,16,16,24,26,28,41,51,66,68,13,45,81|16,14,1973,34,22,31,31,48,71,120,15,38,84&chxt=x,y&chs=500x125&chm=o,0000FF,0,-1,0,0|o,f9b103,0,0:9:,5,0.1|D,999999,1,10:,1,1"/>
			<img src="/img/indice.png"/>
		</div>
		<a href="#" style="font-weight: normal;" id="viewChart" class="pull-right btn secondary small">Ver analisis de presupuesto</a>
	</div>

	<div id="universityInfo">
		<h5>Medicina / Universidad de Chile</h5>
		<div class="itemData big clearfix">
			<span class="content">$427.000</span>		
			<span class="title">Arancel Estimado</span>
		</div>
		<div class="itemData big clearfix">
			<span class="content">650</span>		
			<span class="title">Estimado PSU</span>
		</div>
		<div class="itemData big clearfix">
			<span class="content">650</span>		
			<span class="title">Estimado PSU</span>
		</div>
		
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
		});
				
		$('#viewChart').click(function(){
			$('#incomeInformationChart').slideToggle();
			
		});
	});
</script>