<?php
include("weblock.php");
?>
<!-- page content --> 
        
         
		  
		  <center><h2 style="font-size:30px">List of Room Types</h2></center>
		  
                <div class="x_panel">
                  <div class="x_content" style="overflow-y: auto;height: 800px;">
					   
					     <div class="panel-body">

            <div class="table-responsive">  
			<table class="table table-hover">
              <thead>
                <tr>
                  <th>Image</th>
                  <th>Room Name</th>
                  <th>Price</th>
                  <th>Capacity</th>
                  <th>Description</th>
                  <th>Quantity</th>
                  <th>Manage</th>
                </tr>
              </thead>

              <tbody>
              </tbody>
            </table>
            </div>
             </div>
              </div>
        </div>
		
		
		<!-- /page content -->
		
		<!--modal-->
        <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true" id = "Modal_Edit">
                    <div class="modal-dialog">
                      <div class="modal-content">
              
                        <div class="modal-header">
                        <ul class="nav navbar-right panel_toolbox">
            <li>
            <button type="button" class="btn btn-primary btn-xs" id = 'btnEdit'><i class = "fa fa-edit"></i> Edit Room Type</button>
            <button type="button" class="btn btn-danger btn-xs" id = 'btn_cancel' style = "display:none"><i class = "fa fa-times"></i> Cancel Editing</button>
            </li>
            </ul>
                          <h4 class="modal-title" id="myModalLabel"> Room Type <i class = "fa fa-info-circle"></i></h4>
                        </div>
                        <input type = "hidden" id = "text_RoomTypeID">
                        <div class="modal-body">
            <div class="form-group"><label>Room Type</label>
                        <input type="text" class="form-control" id="text_Type"  disabled>
                      </div>
            
                      <div class="form-group"><label>Price</label>
                        <input type="number" step="any" min="1" max="1000000" class="form-control" id="text_Price" disabled>
                      </div>
            
            <div class="form-group"><label>Description</label>
                         <input type="text" class="form-control" id="text_Desc" disabled>
                      </div>
            
            <div class="form-group"><label>Capacity</label>
                        <input type="number" min="1" max="1000" class="form-control" id="text_Capacit"  disabled>
                      </div>
             
                     <div class="form-group"><label>TV</label>
                        <input type="number" min="1" max="10" class="form-control" id="text_Add"  disabled>
                      </div>
                      <div class="form-group"><label>Beds</label>
                        <input type="number" min="1" max="100" class="form-control" id="text_Beds"  disabled>
                      </div>
                    </form>
                        </div>
            <input type ="hidden" id = "custid">
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <button type="submit" name="btnUpdate" class="btn btn-success" id ='btnUpsave' data-dismiss="modal" style = "display:none;">Update</button>
                        </div>
            
  
                      </div>
                    </div>
                  </div>

                  <!--end-->

				  <!--Modal for delete confirmation-->
     <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true" id = "Modal_Conf">
                    <div class="modal-dialog">
                      <div class="modal-content">

                        <div class="modal-header">
                          <h4 class="modal-title" id="myModalLabel">Delete <i class = "fa fa-question-circle"></i></h4>
                        </div>
                        <div class="modal-body">
                          <h5>Are you sure you want to delete  <span id = "text_DelType"></span> ?</h5>
                          <input type ="hidden" id = "text_DelTypeID" >
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <button type="button" class="btn btn-danger" id = 'btnDelType' data-dismiss="modal">Delete</button>
                        </div>

                      </div>
                    </div>
                  </div>
    <!--end-->	

    <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true" id = "Modal_AddRoom">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel2"  ><i class = "fa fa-image"></i> Upload Picture</h4>
                        </div>
                        <div class="modal-body">
                       
                        <form enctype = "multipart/form-data" action = "AddRoomConfig.php?imageRoom" method="Post">
                      <div id = "DivImage"></div>

                      <input type = "hidden" id = "idRoomT">
              
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <input type="submit" class="btn btn-success" id = "Button_save" value = "Save">
                          </form>
                        </div>

                      </div>
                    </div>
                  </div>
				  
	
    <script src="Confirm/jquery.confirm.js"></script>
    <script>
    $(".confirm").confirm();
    </script>
    <script type="text/javascript">
    	
    	$(document).ready(function (){
    		ViewDate();
    	});
    
      function ViewDate(){
        $.ajax({
        url:"Account.php?RoomType",
        method:"get",
        success:function(data){
          $('tbody').html(data);
        }
      });
      }
        $(document).on("click","#editRoomT",function(){
 $("#Modal_Edit").modal('show');
          var ID = $(this).val();
          $("#btnEdit").css("display","inline");
           $("#btn_cancel").css("display","none");
           $("#text_Type").attr("disabled",true);
           $("#text_Price").attr("disabled",true);
           $("#text_Desc").attr("disabled",true);
           $("#text_Capacit").attr("disabled",true);
           $("#text_Add").attr("disabled",true);
           $("#text_Beds").attr("disabled",true);
           $("#btnUpsave").css("display","none");


            $.ajax({
              method:"post",
              url:"Account.php?RoomTinfo",
              data:{ID:ID},
              dataType:"json",
              success:function(result){
                $("#text_Type").val(result.Description);
                $("#text_Price").val(result.Price);
                $("#text_Desc").val(result.AboutRoom);
                $("#text_RoomTypeID").val(result.RoomTypeID);
                $("#text_Capacit").val(result.Capacity);
                $("#text_Add").val(result.TV);
                $("#text_Beds").val(result.Beds);
               
              }
            });

        });

        $(document).on("click","#DelRoomT",function(){
          
          var ID = $(this).val();
  $("#Modal_Conf").modal('show');
          $.ajax({
              method:"post",
              url:"Account.php?RoomTinfoConf",
              data:{ID:ID},
              dataType:"json",
              success:function(result){
                
                
                $("#text_DelType").text(result.Description);
                $("#text_DelTypeID").val(result.RoomTypeID);
                
               
                
              }
            });
        });

        $("#btnDelType").click(function(){
          var Rid = $("#text_DelTypeID").val();

          $.ajax({
            type:"post",
            url:"Account.php?DelRot",
            data:{Rid:Rid},
            success:function(data){
              ViewDate();
            }
          });
        });

        $("#btnEdit").click(function(){
           $("#btnEdit").css("display","none");
           $("#btn_cancel").css("display","inline");
           $("#text_Type").attr("disabled",false);
           $("#text_Price").attr("disabled",false);
           $("#text_Desc").attr("disabled",false);
           $("#text_Capacit").attr("disabled",false);
           $("#text_Add").attr("disabled",false);
            $("#text_Beds").attr("disabled",false);
           $("#btnUpsave").css("display","inline");
        });

         $("#btn_cancel").click(function(){
            $("#btnEdit").css("display","inline");
           $("#btn_cancel").css("display","none");
           $("#text_Type").attr("disabled",true);
           $("#text_Price").attr("disabled",true);
           $("#text_Desc").attr("disabled",true);
           $("#text_Capacit").attr("disabled",true);
           $("#text_Add").attr("disabled",true);
           $("#text_Beds").attr("disabled",true);
           $("#btnUpsave").css("display","none");
         });

         $("#btnUpsave").click(function(){
            var RoomType = $("#text_Type").val();
            var Price = $("#text_Price").val();
            var Desc=$("#text_Desc").val();
            var ID = $("#text_RoomTypeID").val();
            var Capacity = $("#text_Capacit").val();
            var Add = $("#text_Add").val();
            var Beds = $("#text_Beds").val();

            $.ajax({
              type : "Post",
              data:{RoomType:RoomType,Price:Price,Desc:Desc,ID:ID,Capacity:Capacity,Add:Add,Beds:Beds},
              url:"Account.php?updateRoomType",
              success:function(aata){
                ViewDate();
              }
            });
         });

         $(document).on("click","#ImageRoomT",function(){
          var ID = $(this).val();
          $("#Modal_AddRoom").modal('show');
          $.ajax({
            type:"Post",
            data:{ID:ID},
            url:"Account.php?ImageR",
            success:function(data){
              $("#DivImage").html(data);
            }
          });
         });
    </script>