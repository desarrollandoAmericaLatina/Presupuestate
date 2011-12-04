<center>
	<h1 style="margin: 40px 0px;">
		<img src="/img/logo.png" alt="Presupuestate beta"/><br/>
		<small style="font-size:15px;">Ingresa los siguientes datos para generar tu <b>presupuesto</b></small>
	</h1>
</center>

<div class="span9" style="float:left;">
	sdfds
</div>

<div class="span7" style="float:left;">
	<h3>Educacion secundario</h3>
	<div class="educationItem active">
		Nombre del colegio
	</div>	
	<div class="itemContainer">
		holi
	</div>
	<div class="educationItem">
		Nombre del colegio
	</div>	
	<div class="itemContainer">
		holi
	</div>
	<div class="educationItem">
		Nombre del colegio
	</div>	
	<div class="itemContainer">
		holi
	</div>
</div>


<script type="text/javascript">
	$(document).ready(function(){
		$('.educationItem').click(function(){
			$('.itemContainer').slideUp('fast');
			$(this).next().slideDown('fast');
		})		
	});
</script>