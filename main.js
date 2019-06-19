$(document).ready(function(){
	var DOMAIN = "http://localhost/inventory_management_system";
	$("#register_form").on("submit",function(){
		var status = false;
		var name = $("#username");
		var email = $("#email");
		var pass1 = $("#password1");
		var pass2 = $("#password2");
		var type = $("#usertype");
		
		var e_patt = new RegExp(/^[a-z0-9_-]+(\.[a-z0-9_-]+)*@[a-z0-9_-]+(\.[a-z0-9_-]+)*(\.[a-z]{2,4})$/);
		if(name.val() == "" || name.val().length < 6){
			name.addClass("border-danger");
			$("#u_error").html("<span class='text-danger'>Please Enter Name and Name should be more than 6 char</span>");
			status1 = false;
		}else{
			name.removeClass("border-danger");
			$("#u_error").html("");
			status1 = true;
		}
		if(!e_patt.test(email.val())){
			email.addClass("border-danger");
			$("#e_error").html("<span class='text-danger'>Please Enter Valid Email Address</span>");
			status2 = false;
		}else{
			email.removeClass("border-danger");
			$("#e_error").html("");
			status2 = true;
		}
		if(pass1.val() == "" || pass1.val().length < 9){
			pass1.addClass("border-danger");
			$("#p1_error").html("<span class='text-danger'>Please Enter more than 9 digit password</span>");
			status3 = false;
		}else{
			pass1.removeClass("border-danger");
			$("#p1_error").html("");
			status3 = true;
		}
		if(pass2.val() == "" || pass2.val().length < 9){
			pass2.addClass("border-danger");
			$("#p2_error").html("<span class='text-danger'>Please Enter more than 9 digit password</span>");
			status4 = false;
		}else{
			pass2.removeClass("border-danger");
			$("#p2_error").html("");
			status4 = true;
		}
		
		if ((pass1.val() == pass2.val()) && status1 == true && status2== true && status3== true && status4==true) {
			//$(".overlay").show();
			$.ajax({
				url : DOMAIN+"/process.php",
				method : "POST",
				data : $("#register_form").serialize(),
				success : function(data){
					if (data == "EMAIL_ALREADY_EXISTS") {
						//$(".overlay").hide();
						alert("It seems like you email is already used");
					}else if(data == "SOME_ERROR"){
						alert("Something Wrong");
					}else{
						//$(".overlay").hide();
						window.location.href = encodeURI(DOMAIN+"/index.php?msg=You are registered Now you can login");
					}
				}
			})
		}else{
			pass2.addClass("border-danger");
			$("#p2_error").html("<span class='text-danger'>Password is not matched</span>");
			status = true;
		}
	})

	//For Login Part
	$("#form_login").on("submit",function(){
		var email = $("#log_email");
		var pass = $("#log_password");
		var status = false;
		if (email.val() == "") {
			email.addClass("border-danger");
			$("#e_error").html("<span class='text-danger'>Please Enter Email Address</span>");
			status1 = false;
		}else{
			email.removeClass("border-danger");
			$("#e_error").html("");
			status1 = true;
		}
		if (pass.val() == "") {
			pass.addClass("border-danger");
			$("#p_error").html("<span class='text-danger'>Please Enter Password</span>");
			status2 = false;
		}else{
			pass.removeClass("border-danger");
			$("#p_error").html("");
			status2 = true;
		}
		if (status1 && status2 ) {
			$.ajax({
				url : DOMAIN+"/process.php",
				method : "POST",
				data : $("#form_login").serialize(),
				success : function(data){
					if (data == "NOT_REGISTERED") {
				
						email.addClass("border-danger");
						$("#e_error").html("<span class='text-danger'>It seems like you are not registered</span>");
					}else if(data == "PASSWORD_NOT_MATCHED"){
					
						pass.addClass("border-danger");
						$("#p_error").html("<span class='text-danger'>Please Enter Correct Password</span>");
						status = false;
					}else{
						console.log(data);
						//var x = document.getElementsByTagName("form")[0];
                        //console.log(x);
                        if ($('form').attr('type')== "admin") { 
                             window.location.href = DOMAIN+"/admin_dashboard.php";;
                         }
                        else if ($('form').attr('type')=="employee")
                        {
                        	window.location.href = DOMAIN+"/employee_dashboard.php";
                        }
                        else
                        {
                        	window.location.href = DOMAIN+"/engineer_dashboard.php";
                        }

						
					}
				}
			})
		}
	})

	//Add Inventory
	$("#inventory_form").on("submit",function(){
		if ($("#inventory_type").val() == "") {
			$("#inventory_type").addClass("border-danger");
			$("#type_error").html("<span class='text-danger'>Please Enter Inventory Type</span>");
			status1=false;
		}else{
            $("#inventory_type").removeClass("border-danger");
			$("#type_error").html("");
			status1 = true;
		 }

		 if ($("#brand").val() == "") {
			$("#brand").addClass("border-danger");
			$("#brand_error").html("<span class='text-danger'>Please Enter Brand</span>");
			status2=false;
		}else{
            $("#brand").removeClass("border-danger");
			$("#brand_error").html("");
			status2 = true;
		 }

		if ($("#serial_no").val() == "") {
			$("#serial_no").addClass("border-danger");
			$("#serialno_error").html("<span class='text-danger'>Please Enter Serial Number</span>");
			status3=false;
		}else{
            $("#serial_no").removeClass("border-danger");
			$("#serialno_error").html("");
			status3 = true;
		 }

        if (status1==true && status2==true && status3==true)
        {
			$.ajax({
				url : DOMAIN+"/process.php",
				method : "POST",
				data : $("#inventory_form").serialize(),
				success : function(data){
					if (data == "INVENTORY_ADDED") {
					
						alert("New Inventory Added Successfully..!");
						$("#inventory_type").val("");
						$("#brand").val("");
						$("#serial_no").val("");
					
						

					
						
					}else{
						alert(data);
					}
						
				}
			})
		}
	})
    $("#employee_form").on("submit",function(){
		
		var name = $("#employee_name");
		var email = $("#email");
		var pass1 = $("#password1");
		var pass2 = $("#password2");
		var type = $("#usertype");
		
		var e_patt = new RegExp(/^[a-z0-9_-]+(\.[a-z0-9_-]+)*@[a-z0-9_-]+(\.[a-z0-9_-]+)*(\.[a-z]{2,4})$/);
		if(name.val() == "" || name.val().length < 6){
			name.addClass("border-danger");
			$("#n_error").html("<span class='text-danger'>Please Enter Name and Name should be more than 6 char</span>");
			status1 = false;
		}else{
			name.removeClass("border-danger");
			$("#n_error").html("");
			status1 = true;
		}
		if(!e_patt.test(email.val())){
			email.addClass("border-danger");
			$("#e_error").html("<span class='text-danger'>Please Enter Valid Email Address</span>");
			status2 = false;
		}else{
			email.removeClass("border-danger");
			$("#e_error").html("");
			status2 = true;
		}
		if(pass1.val() == "" || pass1.val().length < 9){
			pass1.addClass("border-danger");
			$("#p_error").html("<span class='text-danger'>Please Enter more than 9 digit password</span>");
			status3 = false;
		}else{
			pass1.removeClass("border-danger");
			$("#p_error").html("");
			status3 = true;
		}
		if(pass2.val() == "" || pass2.val().length < 9){
			pass2.addClass("border-danger");
			$("#p2_error").html("<span class='text-danger'>Please Enter more than 9 digit password</span>");
			status4 = false;
		}else{
			pass2.removeClass("border-danger");
			$("#p2_error").html("");
			status4 = true;
		}
		
		if ((pass1.val() == pass2.val()) && status1 == true && status2== true && status3== true && status4==true) {
			//$(".overlay").show();
			$.ajax({
				
				url : DOMAIN+"/process.php",
				method : "POST",
				data : $("#employee_form").serialize(),
				success : function(data){
					if (data == "EMAIL_ALREADY_EXISTS") {
						//$(".overlay").hide();
						alert("It seems like this email is already used");
					}else if(data == "SOME_ERROR"){
						alert("Something Wrong");
					}else{
						//$(".overlay").hide();window.location.href = encodeURI(DOMAIN+"/index.php?msg=You are registered Now you can login");
						alert("New Employee Added Successfully..!");
						$("#employee_name").val("");
						$("#email").val("");
						$("#password1").val("");
						$("#password2").val(""); 
						//$("#usertype").val("");
					
					}
						
				}
			})
		}else{
			pass2.addClass("border-danger");
			$("#p2_error").html("<span class='text-danger'>Password is not matched</span>");
			status = true;
		}
	})




})

