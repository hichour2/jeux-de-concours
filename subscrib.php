<html>
	<head>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
		<link rel="icon" type="image/x-icon" href="favicon.ico" />

		
	</head>
	<body>
				<div class="container" style="margin-top:10%;">
					

					
					<div class="row">
						<div class="col-md-6 well col-md-offset-3">
							<form class="form-horizontal" action="service.php" method="post" id="user_form" >
								<fieldset>
									<div class="form-group">
										<div class="col-md-12">
											<div class="input-group">
												<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
												<input name="lastname" placeholder="Nom *" class="form-control asterisk" type="text" required="required">
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="col-md-12">
											<div class="input-group">
												<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
												<input name="firstname" placeholder="Prenom *" class="form-control asterisk" type="text" required="required">
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="col-md-12">
											<div class="input-group">
												<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
												<input name="email" placeholder="E-Mail *" class="form-control asterisk" type="email"  required="required" >
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="col-md-12">
											<div class="input-group">
												<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
												<input name="age" placeholder="Age" class="form-control " type="text">
											</div>
										</div>
									</div>
									<div class="form-group">

										<div class="col-md-12 inputGroupContainer">
											<div class="input-group">
												<span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>
												<select class="form-control city" name="city">
												  <option value="0">Ville</option>
												  
												</select>
											</div>
											
										</div>
									</div>

									<div class="form-group">

										<div class="col-md-12">
											<input type="button" class="btn btn-info pull-right" value="S'inscrire" id="subscribe">
										</div>
									</div>
									<input type="hidden" name="action" value="save"/>
								</fieldset>
								
							</form> 
						</div>
					</div>
				</div>
	
	</body>
	
	<script>
				
				
				var is_valid_email=false;
				
				$("input[name='email']").focusout(function() {
					var myRegex = /^[a-z0-9._-]+@[a-z0-9._-]+\.[a-z]{2,6}$/;

					if(!myRegex.test(this.value)){
						$( "input[name='email']" ).css('border','1px solid red');
							is_valid_email=false
							return is_valid_email;
					}else{
						$( "input[name='email']" ).css('border','1px solid #1ad81a');
						is_valid_email=true
							return is_valid_email;
					}
				});
				
				var data_exec_file ='action=get_city'
											   ;		
				$.ajax({
				   type: "POST",
				   url: "./service.php",
				   data: data_exec_file,
				   success: function(msg){
				   		var data = JSON.parse(msg);
						if(data.msg=="OK"){
							$.each(data.result, function( key, value ) {
							  $('.city').append('<option value='+value["Id"]+'>'+value["City"]+'</option>');
							});
														
													
							}else{
							
						}
						console.log(msg);				
				  }
				});	
				
				$('.asterisk').keyup(function() {
					  if($(this).val().replace(/ /g,"")!=""){
						  $(this).css('border','1px solid #1ad81a');
					  }else{
						   $(this).css('border','1px solid red');
					  }
				})
				
				$( "#subscribe" ).click(function() {
					var firstname=$( "input[name='firstname']" ).val().replace(/ /g,"");
					var lastname=$( "input[name='lastname']" ).val().replace(/ /g,"");
					var email=$( "input[name='email']" ).val().replace(/ /g,"");
					if(firstname==""){
						$( "input[name='firstname']" ).css('border','1px solid red');
					}
					if(lastname==""){
						$( "input[name='lastname']" ).css('border','1px solid red');
					}
					if(email=="" || is_valid_email==false){
						$( "input[name='email']" ).css('border','1px solid red');
					}
					
					if(firstname!="" && lastname!="" && email!="" && is_valid_email==true){
						$( "#user_form" ).submit();
					}
				});
	</script>
</html>
