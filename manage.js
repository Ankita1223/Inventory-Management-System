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

