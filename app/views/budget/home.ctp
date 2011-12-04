		<center>
			<h1 style="margin: 40px 0px;">
				<a href="/"><img src="/img/logo.png" alt="Presupuestate beta"/></a><br/>
				<small style="font-size:15px;">Ingresa los siguientes datos para generar tu <b>presupuesto</b></small>
			</h1>
		</center>
		<form id="principalForm" class="span10" action="budget/dataProcess" method="post">
			<div id="monthlyIncome" class="clearfix">
            	<label for="xlInput" class="label notice">Ingreso mensual</label>
            	<div class="input">
            	  <input type="text" size="30" name="data[Recipe][budget]"  placeholder="Ingreso mensual" class="xlarge" rel="monthlyIncome"  >
            	</div>
          	</div>	
			<div id="family" class="clearfix">
            	<label for="xlInput" class="label notice">Integrantes de la familia</label>
            	<div class="input">
					<select class="xlarge" rel="family"  name="data[Recipe][family_nr]">
						<option value="0">Ingresa los integrantes de tu familia</option>
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
					</select>
            	</div>
          	</div>	
			<div id="ubication" class="clearfix">
            	<label for="xlInput" class="label notice">Ubicación</label>
            	<div class="input">
					<select class="xlarge" rel="ubication" name="data[Recipe][location]">
						<option value="0">Selecciona ubicación</option>
						<?foreach($location as $k => $v):?>
						<option value="<?=$k?>"><?=$v?></option>
						<?endforeach;?>
					</select>
            	</div>
          	</div>	
			<div id="university" class="clearfix">
            	<label for="" class="label notice">Universidad</label>
            	<div class="input">
					<select class="xlarge" id="college" rel="university" name="data[Recipe][college]">
						<option value="0">Selecciona universidad</option>
						<?foreach($college as $k => $v):?>
						<option value="<?=$k?>"><?=$v?></option>
						<?endforeach;?>
					</select>
            	</div>
          	</div>	
			<div id="degree" class="clearfix">
            	<label for="" class="label notice">Carrera</label>
            	<div class="input">
					<select rel="degree" id="degree_select" class="xlarge clearfix" name="data[Recipe][degree]">
						<option value="0">Selecciona carrera</option>
					</select>
					<img style="display:none;" src="/img/loader.gif" id="loader"/>
            	</div>
          	</div>	

          	<input type="submit" id="sendRequest" value="Presupuestate" class="btn large info"/>
			<img style="margin-left:270px; display: none;" src="/img/loader_.gif" id="loader_"/>

		</form>

		
		
		
<script type="text/javascript">

	$(document).ready(function(){
	function getDegree(id) {
		$('#loader').show();
		$('#degree_select').attr('disabled','disabled')
		$.ajax({
				url: "/budget/getDegree/" + id,
				type: "POST",
				dataType: "json",
				success: function(data) {
					$('#degree_select').html("");
					$('#degree .input').html('<select id="degree_select"></select><img style="display:none;" src="/img/loader.gif" id="loader"/>');
					$('#degree_select').append($("<option> </option>").attr("value",0).text('Selecciona una carrera'));
					$.each(data, function(key, value) {
						$('#degree_select').attr('rel','degree');
			 			$('#degree_select').attr('name','data[Recipe][degree]');
			            $('#degree_select').append($("<option> </option>").attr("value",key).text(value));
						$('#degree_select').attr('disabled',false)
				       	$('#loader').fadeOut();
			        });
				}
			});

	}
	
		$('input[type="text"]').val('');
		$('select').val('0');
		
		$('#principalForm input[type="text"],#principalForm select').focusin(function(){
			$('#'+$(this).attr('rel')+' label').fadeIn();
		});	
		
		$('#principalForm select').click(function(){
			$('#'+$(this).attr('rel')+' label').fadeIn();
		});	

/*		$('#principalForm input[type="text"]').focusout(function(){
			if($(this).val()==""){
				$('#'+$(this).attr('rel')+' label').fadeOut();
			}
		});	
*/

		$('#college').change(function(){
			getDegree($('#college').val());
		});

		$('#principalForm input[type="submit"]').live('click',function(e){
			e.preventDefault();
			if($('#principalForm input[type="text"]').val()==""){
				$('#monthlyIncome').addClass('error_form');
				$('#monthlyIncome label').removeClass('notice').addClass('important');
				$('#monthlyIncome input').addClass('error');
				return false;
			}else{
				$('#monthlyIncome').removeClass('error_form');
				$('#monthlyIncome input').removeClass('error');
				$('#monthlyIncome label').removeClass('important').addClass('notice');

			}
			
			if($('#principalForm select[rel="family"]').val()=="0"){
				$('#family').addClass('error_form');
				$('#family select').addClass('error');
				$('#family label').removeClass('notice').addClass('important');
				return false;
			}else{
				$('#family').removeClass('error_form');
				$('#family select').removeClass('error');
				$('#family label').removeClass('important').addClass('notice');
			}
			
			if($('#principalForm select[rel="ubication"]').val()=="0"){
				$('#ubication').addClass('error_form');
				$('#ubication select').addClass('error');
				$('#ubication label').removeClass('notice').addClass('important');
				return false;
			}else{
				$('#ubication').removeClass('error_form');
				$('#ubication select').removeClass('error');
				$('#ubication label').removeClass('important').addClass('notice');
			}
			
			if($('#principalForm select[rel="university"]').val()=="0"){
				$('#university').addClass('error_form');
				$('#university select').addClass('error');
				$('#university label').removeClass('notice').addClass('important');
				return false;
			}else{
				$('#university').removeClass('error_form');
				$('#university select').removeClass('error');
				$('#university label').removeClass('important').addClass('notice');
			}
						
			if($('#principalForm #degree_select').val()=="0"){
				$('#degree').addClass('error_form');
				$('#degree select').addClass('error');
				$('#degree label').removeClass('notice').addClass('important');
				return false;
			}else{
				$('#degree').removeClass('error_form');
				$('#degree select').removeClass('error');
				$('#degree label').removeClass('important').addClass('notice');
			}
			
			$('#principalForm ').submit();
			$('#sendRequest').hide();
			$('#loader_').show();
					
		});

	});
	

</script>
