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
	$this->Javascript->link('jquerytext', false);
	$this->Javascript->link('modernizr.custom.87614', false);
	
	echo $asset->scripts_for_layout();
	?>

    <script>
	var isIE = navigator.appName === 'Microsoft Internet Explorer';
    </script>
	
</head>

<body>
	<div class="container">
	<? echo $content_for_layout; ?>

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
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>
