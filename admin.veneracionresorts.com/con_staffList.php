<?php
include("weblock.php");
?>

          
			
			<center><h2 style="font-size:30px">List of Staff Accounts</h2></center>

                <div class="x_panel">
                  <div class="x_content">
                  
							<div class="x_content" style = "overflow-x: auto;height:470px">
							   <table id="datatables" class="table table-striped table-bordered ">
								<thead>
								<tr>
									<th>Profile Picture</th>
								  <th>Username</th>
								  <th>Position</th>
								  <th>Name</th>
								  <th>Email</th>
								  <th>Address</th>
								  <th>Contact number</th>
								  <th>Action</th>
								</tr>
							  </thead>
							   <tbody id = "customer"></tbody>
							  </table>
						  </div>
                  </div>
                </div>
              
            
		 
		
		<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true" id = "Modal_Image">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel2"  ><i class = "fa fa-image"></i> Upload Picture</h4>
                        </div>
                        <div class="modal-body">
                       
                       <form enctype = "multipart/form-data" action = "Account.php?wew" method="Post">
                      <div id = "DivImage"></div>

              
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <input type="submit" class="btn btn-success" id = "Button_save" value = "Save">
                          </form>
                        </div>

                      </div>
                    </div>
                  </div>
				  
				  <!--Modal for delete confirmation-->
		 <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true" id = "Modal_Delete">
                    <div class="modal-dialog">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Delete <i class = "fa fa-question-circle"></i></h4>
                        </div>
                        <div class="modal-body">
                          <h5>Are you sure you want to delete  <span id = "name_del"></span> ?</h5>
                          <input type ="hidden" id = "AccUser" >
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                          <button type="button" class="btn btn-danger" id = 'btnDel' data-dismiss="modal">Delete</button>
                        </div>

                      </div>
                    </div>
                  </div>
		<!--end-->
		
		<form action="updateAccount.php">
			<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true" id = "Modal_Edit">
                    <div class="modal-dialog">
                      <div class="modal-content">
							
                        <div class="modal-header">
                        <ul class="nav navbar-right panel_toolbox">
						<li>
						<button type="button" class="btn btn-primary btn-xs" id = 'btnEdit'><i class = "fa fa-edit"></i> Edit Profile</button>
						<button type="button" class="btn btn-danger btn-xs" id = 'btn_cancel' style = "display:none"><i class = "fa fa-times"></i> Cancel Editing</button>
						</li>
						</ul>
                          <h4 class="modal-title" id="myModalLabel"> Profile <i class = "fa fa-info-circle"></i></h4>
                        </div>
                        <div class="modal-body">
						<div class="form-group"><label>Username</label>
                        <input type="text" class="form-control" id="text_uname" placeholder="Username" disabled>
                      </div>
					  
                      <div class="form-group"><label>Full name</label>
                        <input type="text" class="form-control" id="text_name" placeholder="Full Name" disabled>
                      </div>
					  
					  <div class="form-group"><label>Position</label>
                        <select id="select_position" class="form-control" required disabled>
                            <option >Staff</option>
                            <option >Admin</option>
                        </select>
                      </div>
						
						<div class="form-group"><label>Email</label>
                        <input type="text" class="form-control" id="text_email" placeholder="Email" disabled>
                      </div>
					   
                     <div class="form-group"><label>Contact Number</label>
                        <input type="text" class="form-control" id="text_contact" placeholder="Contact Number" disabled>
                      </div>
					  
					   <div class="form-group"><label>Password</label>
                        <input type="password" class="form-control" id="text_conpass" placeholder="Confirm Password" disabled>
                      </div>
					  <div class="form-group"><label>Address</label>
                        <input type="text" class="form-control" id="text_address" placeholder="Address" disabled>
                      </div>
						
						</div>
						<input type ="hidden" id = "custid">
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <button type="submit" name="btnUpdate" class="btn btn-success" id ='btnUpsave' data-dismiss="modal" style = "display:none;">Update</button>
                        </div>
						
						</div></div>
                  </div>
				  </form>
				 
		<!--end-->	
<script src="Confirm/jquery.confirm.js"></script>
    <script>
    $(".confirm").confirm();
    </script>
	
<script>

	$(document).ready(function (){
    		loadData();
    	});
    	
	//customer
	function loadData(){
		$.ajax({
			method:"Get",
			url:"Account.php?account",
			success:function(data)
			{
				$('#customer').html(data);
			}
		});
	}
	//Confirmation delete
	$(document).on("click","#btnDelete",function(){
		var user = $(this).val();
		$.ajax({
			method:"post",
			url:"Account.php?conf",
			data:{user:user},
			dataType:"json",
			success:function(data){
				$("#name_del").text(data.Name);
				$("#AccUser").val(data.Username);
				$("#Modal_Delete").modal("show");
			}
		});
	});
	//Delete
	$("#btnDel").click(function(){
		var accid = $("#AccUser").val();
		$.ajax({
			method:"post",
			url:"Account.php?del",
			data:{accid:accid},
			success:function(data){
				$("#Modal_Delete").modal("hide");
				loadData();
			}
		});
	});
	//Update
	$(document).on("click","#btnUpdate",function(){
		var ID = $(this).val();
		$("#text_name").attr("disabled",true);
		$("#select_position").attr("disabled",true);
		$("#text_email").attr("disabled",true);
		$("#text_contact").attr("disabled",true);
		$("#text_address").attr("disabled",true);
		$("#text_uname").attr("disabled",true);
		$("#select_status").attr("disabled",true);
		$("#text_pass").attr("disabled",true);
		$("#text_conpass").attr("disabled",true);
		$("#btn_cancel").css("display","none");
		$("#btnEdit").css("display","inline");
		$("#btnUpsave").css("display","none");
		$.ajax({
			method:"post",
			url:"Account.php?view",
			data:{ID:ID},
			dataType:"Json",
			success:function(data){
				$("#text_name").val(data.Name);
				$("#text_pass").val(data.Password);
				$("#text_conpass").val(data.Password);
				$("#text_email").val(data.Email);
				$("#text_contact").val(data.ContactNumber);
				$("#text_address").val(data.Address);
				$("#text_uname").val(data.Username);
				$("#select_status").val(data.Status);
				$("#custid").val(data.CustomerID);
				$("#select_position").val(data.Position);
				$("#Modal_Edit").modal("show");
			}
		});
	});
	$("#btnEdit").click(function(){
		$("#text_name").attr("disabled",false);
		$("#text_pass").attr("disabled",false);
		$("#text_conpass").attr("disabled",false);
		$("#select_position").attr("disabled",false);
		$("#text_email").attr("disabled",false);
		$("#text_contact").attr("disabled",false);
		$("#text_address").attr("disabled",false);
		$("#text_uname").attr("disabled",true);
		$("#select_status").attr("disabled",false);
		$("#btn_cancel").css("display","inline");
		$("#btnEdit").css("display","none");
		$("#btnUpsave").css("display","inline");
	});
	//Cancel Editing
	$("#btn_cancel").click(function(){
		$("#text_name").attr("disabled",true);
		$("#text_email").attr("disabled",true);
		
		$("#text_pass").attr("disabled",true);
		$("#text_conpass").attr("disabled",true);
		$("#text_contact").attr("disabled",true);
		$("#text_address").attr("disabled",true);
		$("#text_uname").attr("disabled",true);
		$("#select_status").attr("disabled",true);
		$("#select_position").attr("disabled",true);
		$("#btn_cancel").css("display","none");
		$("#btnEdit").css("display","inline");
		$("#btnUpsave").css("display","none");
	});
	//Update the information 
	$("#btnUpsave").click(function(){
		var Name = $("#text_name").val();
		var Email = $("#text_email").val();
		var ContactNumber = $("#text_contact").val();
		var Address = $("#text_address").val();
		var Username = $("#text_uname").val();
		var Status = $("#select_status").val();
		var Pass1 = $("#text_pass").val();
		var Pass2 = $("#text_conpass").val();
		var Position = $("#select_position").val();
		$.ajax({
			method:"post",
			url:"Account.php?updatenow",
			data:{Email:Email,ContactNumber:ContactNumber,Address:Address,Username:Username,Status:Status,Name:Name,Pass1:Pass1,Pass2:Pass2,Position:Position},
			success:function(data){
				$("#Modal_Edit").modal("hide");
				loadData();
			}
		});
	});

	$(document).on("click","#btnImage",function(){
          var ID = $(this).val();
          $("#Modal_Image").modal('show');
          $.ajax({
            type:"Post",
            data:{ID:ID},
            url:"Account.php?ImageA",
            success:function(data){
              $("#DivImage").html(data);
            }
          });
         });

</script>

