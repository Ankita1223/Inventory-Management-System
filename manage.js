$(document).ready(function(){
	var DOMAIN = "http://localhost/inventory_management_system";

	//Mange Category
	manageInventory();
	function manageInventory(){
		$.ajax({
			url : DOMAIN+"/process.php",
			method : "POST",
			data : {manageInventory:1},
			success : function(data){
				$("#get_inventory").html(data);		
			}
		})
	}
	manageEmployees();
	function manageEmployees(){
		$.ajax({
			url : DOMAIN+"/process.php",
			method : "POST",
			data : {manageEmployee:1},
			success : function(data){
				$("#get_employee").html(data);
						
			}
		})
	}
    
    manageLocations();
	function manageLocations(){
		$.ajax({
			url : DOMAIN+"/process.php",
			method : "POST",
			data : {manageLocation:1},
			success : function(data){
				$("#get_locations").html(data);
						
			}
		})
	}
    
    getRequests();
	function getRequests(){
		$.ajax({
			url : DOMAIN+"/process.php",
			method : "POST",
			data : {getRequest:1},
			success : function(data){
				$("#get_requests").html(data);
						
			}
		})
	}

	getApprovedRequests();
	function getApprovedRequests(){
		$.ajax({
			url : DOMAIN+"/process.php",
			method : "POST",
			data : {getApprovedRequest:1},
			success : function(data){
				$("#approved_request").html(data);
						
			}
		})
	}

	getPendingRequests();
	function getPendingRequests(){
		$.ajax({
			url : DOMAIN+"/process.php",
			method : "POST",
			data : {getPendingRequest:1},
			success : function(data){
				$("#pending_request").html(data);
						
			}
		})
	}
    
    getNotApprovedRequests();
	function getNotApprovedRequests(){
		$.ajax({
			url : DOMAIN+"/process.php",
			method : "POST",
			data : {NotApprovedRequest:1},
			success : function(data){
				$("#not_approved_request").html(data);
						
			}
		})
	}


    


    
   
	$("body").delegate(".del_cat","click",function(){
		var did = $(this).attr("did");
		if (confirm("Are you sure ? You want to delete..!")) {
			$.ajax({
				url : DOMAIN+"/process.php",
				method : "POST",
				data : {deleteInventory:1,id:did},
				success : function(data){
					if (data == "DEPENDENT_CATEGORY") {
						alert("Sorry ! this Category is dependent on other sub categories");
					}else if(data == "CATEGORY_DELETED"){
						alert("Category Deleted Successfully..! happy");
						manageCategory(1);
					}else if(data == "DELETED"){
						alert("Deleted Successfully");
					}else{
						alert(data);
					}
						
				}
			})
		}else{

		}
	})



})

