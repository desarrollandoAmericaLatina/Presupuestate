<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE8" >
	<?php echo $this->Html->charset(); ?>
	<title>Presupuestate</title>

	<link rel="shortcut icon" href="/img/favicon.ico" type="image/x-icon">
	
	<!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	
	<!-- Le styles -->
	<?
	$this->Html->css('bootstrap', null, array("inline" => false));
	$this->Html->css('style', null, array("inline" => false));
	$this->Html->css('smoothness/jquery-ui-1.8.16.custom', null, array("inline" => false));
	
	$this->Javascript->link('jquery-1.7.1.min', false);
	$this->Javascript->link('jquery-ui-1.8.16.custom.min', false);
	$this->Javascript->link('bootstrap-dropdown', false);
	$this->Javascript->link('bootstrap-modal', false);
	$this->Javascript->link('bootstrap-twipsy', false);
	$this->Javascript->link('bootstrap-alerts', false);
	$this->Javascript->link('bootstrap-popover', false);
	$this->Javascript->link('modernizr.custom.87614', false);
	
	echo $asset->scripts_for_layout();
	?>

    <script>
	var isIE = navigator.appName === 'Microsoft Internet Explorer';
    </script>
	
</head>

<body>
	<div class="container">
		<center>
			<h1 style="margin: 40px 0px;">
				<img src="/img/logo.png" alt="Presupuestate beta"/><br/>
				<small style="font-size:15px;">Ingresa los siguientes datos para generar tu <b>presupuesto</b></small>
			</h1>
		</center>
		<form id="principalForm" class="span10">
			<div id="monthlyIncome" class="clearfix">
            	<label for="xlInput">Ingreso mensual</label>
            	<div class="input">
            	  <input type="text" size="30" name=""  placeholder="Ingreso mensual" class="xlarge" rel="monthlyIncome">
            	</div>
          	</div>	
			<div id="family" class="clearfix">
            	<label for="xlInput">Integrantes de la familia</label>
            	<div class="input">
					<select class="xlarge" rel="family">
						<option value="0">Ingresa los integrantes de tu familia</option>
						<option value="2">holi</option>
					</select>
            	</div>
          	</div>	
			<div id="unication" class="clearfix">
            	<label for="xlInput">Selecciona ubicación</label>
            	<div class="input">
					<select class="xlarge" rel="ubication">
						<option value="0">Selecciona ubicación</option>
						<option value="2">holi</option>
					</select>
            	</div>
          	</div>	
			<div id="university" class="clearfix">
            	<label for="">Selecciona universidad</label>
            	<div class="input">
					<select class="xlarge" rel="university">
						<option value="0">Selecciona universidad</option>
						<option value="2">holi</option>
					</select>
            	</div>
          	</div>	
			<div id="degree" class="clearfix">
            	<label for="">Selecciona carrera</label>
            	<div class="input">
					<select rel="degree" class="xlarge">
						<option value="0">Selecciona carrera</option>
						<option value="2">holi</option>
					</select>
            	</div>
          	</div>	

          	<input type="button" id="sendRequest" value="Presupuestate" class="btn large info"/>
		</form>
	</div>
	
<script type="text/javascript">
	$(document).ready(function(){
		$('input[type="text"]').val('');
		$('select').val('0');
		
		$('#principalForm input[type="text"],#principalForm select').focusin(function(){
			$('#'+$(this).attr('rel')+' label').fadeIn();
		});	

		$('#principalForm input[type="text"]').focusout(function(){
			if($(this).val()==""){
				$('#'+$(this).attr('rel')+' label').fadeOut();
			}
		});	

		$('#principalForm select').click(function(){
			if($(this).val()=="0"){
				$('#'+$(this).attr('rel')+' label').fadeOut();
			}else{
				$('#'+$(this).attr('rel')+' label').fadeIn();
			}
		});	

	});
</script>
	<?// echo $content_for_layout; ?>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>
