<center>
	<h1 style="margin: 40px 0px;">
		<a href="/"><img src="/img/logo.png" alt="Presupuestate beta"/></a><br/>
	</h1>
</center>
<!--<? pr($college);?>-->
<div class="span9" style="border-right:1px dotted #ccc; float: left;margin-right: 5px;padding-right: 9px;width: 510px !important;">
	<h3><img src="/img/161-calculator.png"/>Presupuesto educacional</h3>
	<div class="incomeBox dark">
		<b>El costo estimado de la carrera <span class="income pull-right">$<?=number_format($college['degree_total_price_projected'], 0, ",", ".");?></span> </b>
	</div>
	<div class="incomeBox">
		<b>Para alcanzar esta meta debes ahorrar mensualmente<span class="save pull-right">$<?=number_format($college['monthly_save'], 0, ",", ".");?></span> </b>
	</div>
	<div class="clearfix">
		<div class="clearfix" id="incomeInformationChart">
			<h5>Gráfico de proyección</h5><br/>
			<img src="<?=$college['chart_img'];?>"/>
			<img src="/img/indice.png"/>
		</div>
		<a href="#" style="font-weight: normal;" id="viewChart" class="pull-right btn secondary small">Gráfico de proyección</a>
	</div>

	<div id="universityInfo">
		<h5><img src="/img/140-gradhat.png"/><?=$college['degree']['Degree']['name'];?> / <?=$college['degree']['College']['name']?></h5>
		<div class="itemData big clearfix">
			<span class="content"><?=$college['year_join'];?></span>		
			<span class="title">Año de ingreso</span>
		</div>
		<div class="itemData big clearfix">
			<span class="content" style="font-size:23px;">$<?=number_format(($college['degree_total_price_projected'] / $college['degree']['Degree']['duration']), 0, ",", ".");?></span>		
			<span class="title">Costo estimado</span>
		</div>
		<div class="itemData big clearfix">
			<span class="content"><?=round($college['last_entered_projection']);?></span>		
			<span class="title">PSU estimado</span>
		</div>
		<div class="itemData big clearfix">
			<span class="content"><?=$college['degree']['Degree']['duration']?></span>		
			<span class="title">Años de duración</span>
		</div>
		
	</div>

</div>

<div class="span7" style="float:left;">
	<h3><img src="/img/28-star.png"/>Colegios recomendados</h3>
	<?if(!empty($schools)): ?>
	<?foreach($schools as $s): ?>
	<div class="educationItem clearfix">
		<?=$s['data']['School']['name']?> - <small><?=$s['data']['School']['city']?></small>
		<div class="indicator"></div>
	</div>	
	<div class="itemContainer clearfix">
		<div class="ubication">
			<img class="mapa" src="http://maps.google.com/maps/api/staticmap?center=<?=$s['data']['School']['address']?>,<?=$s['data']['School']['city']?>,chile&zoom=15&size=100x100&sensor=false&markers=color:blue|<?=$s['data']['School']['address']?>,<?=$s['data']['School']['city']?>,chile"/>
			<div class="information">
				<span class="ubicationItem"><?=$s['data']['School']['address']?></span>
			</div>
			<div class="information">
				<span class="ubicationItem">Teléfono : <?=$s['data']['School']['phone']?></span>
			</div>
			<div class="information">
				<span class="ubicationItem">Email : <a style="text-decoration: none; color:#666;" href="mailto:<?=$s['data']['School']['email']?>" alt="contactar"><?=$s['data']['School']['email']?></a></span>
			</div>
			<div class="information">
				<span class="ubicationItem">Dependencia : <?=$s['data']['School']['dependency']?></span>
			</div>
		</div>
		<div class="itemData clearfix">
			<span class="content" style="font-size:25px;">$<?=round($s['price'])?></span>		
			<span class="title">Mensualidad</span>
		</div>
		<div class="itemData clearfix">
			<span class="content"><?=round($s['simce_average_projection'])?></span>		
			<span class="title">Promedio SIMCE</span>
		</div>
		<div class="itemData clearfix">
			<span class="content"><?=round($s['psu_average_projection'])?></span>		
			<span class="title">Puntaje PSU</span>
		</div>
	</div>
	<?endforeach;?>
	<?else:?>
	<p>No hemos encontrado un establecimiento acorde con los criterios de busqueda.</p>
	<?endif;?>
	<div id="colofon">
		<h2><img src="/img/09-chat-2.png"/>¿Necesitas ayuda?</h2>
		<p> Cualquier duda o consulta contactate al correo <b>contacto[at]presupuestate[dot]com</b></p>
	</div>
</div>


<script type="text/javascript">
	$(document).ready(function(){
		$('.itemContainer:first').show();
		$('.educationItem:first').addClass('active');
		$('.educationItem').click(function(){
			$('.itemContainer').slideUp('fast');
			$(this).next().slideDown('fast');
			$('.educationItem').removeClass('active');
			$(this).addClass('active');
		});
				
		$('#viewChart').live("click",function(event){
			event.preventDefault();

			$('#incomeInformationChart').slideToggle();
			
		});
	});
</script>
