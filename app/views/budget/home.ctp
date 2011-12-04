		<center>
			<h1 style="margin: 40px 0px;">
				<img src="/img/logo.png" alt="Presupuestate beta"/><br/>
				<small style="font-size:15px;">Ingresa los siguientes datos para generar tu <b>presupuesto</b></small>
			</h1>
		</center>
		<form id="principalForm" class="span10" action="budget/dataProcess" method="post">
			<div id="monthlyIncome" class="clearfix">
            	<label for="xlInput">Ingreso mensual</label>
            	<div class="input">
            	  <input type="text" size="30" name=""  placeholder="Ingreso mensual" class="xlarge" rel="monthlyIncome"  name="data[Recipe][budget]">
            	</div>
          	</div>	
			<div id="family" class="clearfix">
            	<label for="xlInput">Integrantes de la familia</label>
            	<div class="input">
					<select class="xlarge" rel="family"  name="data[Recipe][family_nr]">
						<option value="0">Ingresa los integrantes de tu familia</option>
						<option value="2">holi</option>
					</select>
            	</div>
          	</div>	
			<div id="unication" class="clearfix">
            	<label for="xlInput">Selecciona ubicación</label>
            	<div class="input">
					<select class="xlarge" rel="ubication" name="data[Recipe][location]">
						<option value="0">Selecciona ubicación</option>
						<option value="2">holi</option>
					</select>
            	</div>
          	</div>	
			<div id="university" class="clearfix">
            	<label for="">Selecciona universidad</label>
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
            	<label for="">Selecciona carrera</label>
            	<div class="input">
					<select rel="degree" id="degree_select" class="xlarge" name="data[Recipe][degree]">
						<option value="0">Selecciona carrera</option>
						<option value="2">holi</option>
					</select>
            	</div>
          	</div>	

          	<input type="submit" id="sendRequest" value="Presupuestate" class="btn large info"/>
		</form>

		
		
		
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

		$('#college').change(function(){
			getDegree($('#college').val());
		});

	});
	
	function getDegree(id) {
		$.ajax({
				url: "/budget/getDegree/" + id,
				type: "POST",
				dataType: "json",
				success: function(data) {
					$('#degree_select').html("");
					$('#degree_select').append($("<option></option>").attr("value",0).text('Selecciona una carrera'));
					$.each(data, function(key, value) {
			            $('#degree_select').append($("<option></option>").attr("value",key).text(value));
			        });

				}
			});
	}
</script>
