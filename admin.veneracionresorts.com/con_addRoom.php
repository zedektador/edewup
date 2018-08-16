<?php
include("weblock.php");
            
            
            	  if(isset($_GET["message"])){
						?>
				  <div class="alert alert-success alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <center><strong><?php echo $_GET["message"]; ?></strong></center>
                  </div>
				    <script src="../vendors/jquery/dist/jquery.min.js"></script>	<script>
					  	history.pushState(null, '', '/add_room.php');
					</script>
					  <?php
					  }
					?>
<!-- page content -->
    	   <center><h2 style="font-size:30px">Add Room Type</h2></center>
                  <div id = "Message"></div>
                  <div id = 'checkTypeR'></div>
					           <form action = "AddRoomConfig.php?RoomType" method="Post" enctype = "multipart/form-data">
                <div style="height:410px">
                  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback" style = "line-height:22px;">
                     <label>Room Type</label>
                          <input type="text" class="form-control" id="RoomType" name="RoomType" required>
                          <span id = "RoomType-error" style = "color:#a94442;"></span>
                          <label>TV</label>
                          <input type="number" min="1" max="5" class="form-control" id="TV" name="TV" required>
                          <label>Beds</label>
                          <input type="number" min="1" max="5" class="form-control" id="Beds" name="Beds" required>
                          <label>Price</label>
                          <input type="number" step="any" min="1" max="1000000" class="form-control" id="Price" name="Price" required>
                     <label>Room Capacity</label>
                     <input type="number" class="form-control" id="Capacity" name="Capacity" required min = '1' max="100">
                  </div>  
                  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback"  style = "line-height:22px;">
                     <label>Image</label><br>
                    <label id = 'file'><i class = "fa fa-file-image-o"></i><a id = "a"> Choose Image</a><input type = 'file' id = 'imFile' accept="image/*" required name = "image" onchange = 'fileName();' style = "display:none"></label> <label id = 'imagename'>No image...</label><Br>
                     <label>Room Description</label>
                     <textarea id="Desc" name="Desc" style="resize:none; width:100%" rows="8" required maxlength="500"></textarea>
                    <ul class="nav navbar-right panel_toolbox">
                      <li>
                      <br><br>
                      <button type = "reset" class = "btn btn-danger">Reset</button>
                      <button type = "submit" class = "btn btn-success" id = 'saveT' name = "save">Save </button>
                      
              </form>
              <br>
               <button type='button' id = 'addnew' class = "btn btn-primary" data-toggle="modal" data-target="#Modal_AddRoom"><i class="fa fa-plus-circle"></i> Add new Room</button>
                     
                      <br><br>
                      </li>
                    </ul>
                </div>
              </div>
        <!-- /page content -->




         <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="false" id = "Modal_AddRoom">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel2"  ><i class = "fa fa-plus-circle"></i> Add new Room</h4>
                        </div>
                        <div class="modal-body">
               <label>Room Name</label>          
              <input type = "text" id = "Room_Name" class = "form-control" onchange="disableR();"><br>
              <label>Room Type</label> 
              <select class="select2_group form-control" id= "option_type" required="required" name = "option_type" onchange="disableR();">
                                <option></option>
                                <?php
                                $query = mysqli_query($conn,"SELECT * FROM `room_type`");
                                if(mysqli_num_rows($query)> 0 )
                                {
                                  while($row=mysqli_fetch_array($query)):
                                    echo "<option>".$row['Description']."</option>";
                                  endwhile;
                                }
                                else
                                {
                                  echo "<option>No records found</option>";
                                }
                                ?>
                            </select>
                    
                    <br>
                    <label>Room Description</label>
                    <textarea name="adddesc" id="adddesc" required maxlength="150" style="resize:none" rows="5" class="form-control"></textarea>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <button type="button" class="btn btn-success" id = "Button_save" data-dismiss="modal" disabled>Save</button>
                        </div>

                      </div>
                    </div>
                  </div>
				  
   
    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>
    <script type="text/javascript">
    function fileName(){
    var NameFile = $("#imFile").val();
    var SubName = NameFile.substr(0, 25);

    if(NameFile.length > 0)
    {
      $("#imagename").text(SubName);
    }
    else
    {
      $("#imagename").text('No image..'); 
    }
  }

  function disableR(){
    var option = $("#option_type").val();
    var text = $("#Room_Name").val();

    if(option.length == 0 || text.length == 0)
    {
        $("#Button_save").attr("disabled",true);
    }
    else
    {
        $("#Button_save").attr("disabled",false);
    }
  }

  $(function(){

     $("#RoomType-error").hide();
     var RoomT = false;

     $("#RoomType").focusout(function(){
        check_Type();
        });

     function check_Type(){
      var Text = $("#RoomType").val();
      $.ajax({
        url:"AddRoomConfig.php?CheckType",
        method:"Post",
        data:{Text:Text},
        success:function(data){
          $("#checkTypeR").html(data);
        }
      });


      if($("#Check").val().length > "0")
     {
        $("#RoomType-error").html("Room Type already exist");
              $("#RoomType-error").show();
              RoomT = true;
     }
     else
     {
         $("#RoomType-error").html("");
              $("#RoomType-error").hide();
     }

     }

     
      $("#saveT").click(function(){

         RoomT = false;

        check_Type();
        
        if(RoomT == false)
        {       
          return true;
          
        }
        else
        {
          return false;
        }
        
      });
  });

  $("#Button_save").click(function(){
    var option = $("#option_type").val();
    var text = $("#Room_Name").val();
    var adddesc = $("#adddesc").val();
      $.ajax({
        type:"POST",
        url:"AddRoomConfig.php?RoomAdd",
        data:{option:option,text:text,adddesc:adddesc},
        success:function(data){
          $("#Message").html(data);
          $( "#Message" ).fadeIn( 1000 ).delay( 4000 ).fadeOut( 1000 );
        }
      });
  });
 
    </script>