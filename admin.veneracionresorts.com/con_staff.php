<?php
include("weblock.php");
?>
         <center><h2 style="font-size:30px">Add Staff Account</h2></center>
			
			
			    	<?php
					  if(isset($_GET["message"])){
						?>
				  <div class="alert alert-success alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <center><strong><?php echo $_GET["message"]; ?></strong></center>
                  </div>
				  <script src="../vendors/jquery/dist/jquery.min.js"></script>	
					<script>
						history.pushState(null, '', '/staffs.php');
					</script>
					  <?php
					  }
					?>
					
				<div class="x_panel">
                  <div class="x_content">
                  <style type="text/css">#form_fill label {padding-top:10px;}</style>   
			           <form action = "AddAccountConfig.php?addstaff" method = "Post" id = 'form_fill' enctype = "multipart/form-data">
                      <div class = "form-group">
                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback" style = "line-height:15px;">
                      <label>Image</label><br>
                    <label id = 'file'><i class = "fa fa-file-image-o"></i><a id = "a"> Choose Image</a><input type = 'file' id = 'imFile' accept="image/*"  name = "image" onchange = 'fileName();' style = "display:none"></label> <label id = 'imagename'>No image...</label><Br>
                      <label>Username</label>
                        <input type="text" class="form-control" id="input_uname" name="input_uname" placeholder="Username" required="required" maxlength='100'>
                        <span id = "uname-error" style = "color:#a94442;"></span>
                        <div id = "displayuname"></div>
                      <label>Password</label>
                        <input type="Password" class="form-control" id="input_pass" name="input_pass" placeholder="Password" required="required" maxlength='10'>
                        <span id = "pass-error" style = "color:#a94442;"></span>
                      <label>Full name</label>
                        <input type="text" class="form-control" id="name" name="name" maxlength="50" placeholder="Name" required="required">
                        <span id = "fname-error" style = "color:#a94442;"></span>
                        <label>Position</label>
                      <select class="select2_group form-control" id= "option_postion" name= "option_postion" required="required">
                            <option></option>
                            <option value='Staff'>Staff</option>
                            <option value='Admin'>Admin</option>
                      </select>
                         <span id = "position-error" style = "color:#a94442;"></span>
                      </div>
                      </div>

                    <div class = "form-group">
                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback" style = "line-height:15px;"><br></br><br><br>
                       <label>E-mail</label>
                          <input type="text" class="form-control" id="input_email" name="input_email" maxlength='100' placeholder="Email" required="required">
                          <span id = "email-error" style = "color:#a94442;"></span>
                        <label>Contact Number</label>
                          <input type="text" class="form-control" id="phone" name="input_contact" maxlength="15" placeholder="Contact Number" required="required">
                          <span id = "contact-error" style = "color:#a94442;"></span>
                          <label>Address</label>
                          <input type="text" class="form-control" id="input_address" name="input_address" placeholder="Address" required="required" maxlength='100'>
                          <span id = "address-error" style = "color:#a94442;"></span>
                      </div>
                      </div>
					  <div style="height: 30px; clear:both">
					  </div>
					  	          <button type="submit" name="submit" id = "btn-save"  style="float:right" class="btn btn-success">Save now</button>
								  <button class="btn btn-danger" type="reset" style="float:right">Reset</button>
								  <br><br>
                         </form>
                  </div>
                </div>
        <!-- /page content -->
    
    <script type="text/javascript">

      $(function(){

        $("#uname-error").hide();
        $("#pass-error").hide();
        $("#email-error").hide();
        $("#contact-error").hide();

        var uname = false;
        var pass = false;
        var email = false;
        var contact = false;

        $("#input_uname").focusout(function(){
        check_uname();
        });
        $("#input_pass").focusout(function(){
          check_pass();
        });
        $("#input_email").focusout(function(){
          check_email();
        });
        $("#input_contact").focusout(function(){
          check_contact();
        });



        function check_uname(){

          var data = $("#input_uname").val();

          $.ajax({
            type:"post",
            data:{data:data},
            url:"Javascript/Account.php?checkUname",
            success:function(data){
                $("#displayuname").html(data);
            }
          });

          if(data.length != 0 && data.length < 5)
          {
              $("#uname-error").html("Username must be 5 or more characters");
              $("#uname-error").show();
              uname = true;
          }
          else if($("#unameex").val() == "yes")
          {
              $("#uname-error").html("Username already exist");
              $("#uname-error").show();
              uname = true;
          }
          else
          {
              $("#uname-error").html("");
              $("#uname-error").hide();
          }
        }

        function check_pass(){

          var data = $("#input_pass").val();
          if(data.length != 0 && data.length < 8)
          {
              $("#pass-error").html("Password must contain 8 to 16 characters long");
              $("#pass-error").show();
              pass = true;
          }
          else
          {
              $("#pass-error").html("");
              $("#pass-error").hide();
          }
        }

        function check_contact(){
        var contacts = $("#input_contact").val();
        
        if(contacts.length < 7 && contacts.length != 0)
        {
          $("#contact-error").html("Plese enter a valid contact number");
          $("#contact-error").show();
          contact = true;
        }
        else
        {
          $("#contact-error").html("");
          $("#contact-error").hide();
        }
      }

        function check_email(){

          var emails = $("#input_email").val();
          var number = emails.charAt(0);

          if (!isValidEmailAddress(emails) && emails.length != 0)
          {
                $("#email-error").html("Invalid email address"); 
                $("#email-error").show();
                email = true;
                return false;  
          }
          else
          {
              $("#email-error").html(""); 
              $("#email-error").hide();
          }
        }

        function isValidEmailAddress(emailAddress){
        var pattern = new RegExp(/^(("[\w-+\s]+")|([\w-+]+(?:\.[\w-+]+)*)|("[\w-+\s]+")([\w-+]+(?:\.[\w-+]+)*))(@((?:[\w-+]+\.)*\w[\w-+]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][\d]\.|1[\d]{2}\.|[\d]{1,2}\.))((25[0-5]|2[0-4][\d]|1[\d]{2}|[\d]{1,2})\.){2}(25[0-5]|2[0-4][\d]|1[\d]{2}|[\d]{1,2})\]?$)/i);
         return pattern.test(emailAddress);
        }

        $("#btn-save").click(function(){

         uname = false;
         pass = false;
         email = false;
         contact = false;

        check_uname();
        check_pass();
        check_contact();
        check_email();
        
        if(uname == false && pass == false && email == false && contact == false)
        {       
          return true;
          
        }
        else
        {
          return false;
        }
        
      });

      });

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
    </script>
    	<script>
	document.addEventListener("DOMContentLoaded", function() {
	document.getElementById("name").onkeypress = function(e) { //ID NG TEXT INPUT NA PAGGAMITAN MO
		var chr = String.fromCharCode(e.which);
	if ("ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz .".indexOf(chr) < 0) //DITONG PART YUNG ILALAGAY MO KUNG ANO YUNG PWEDENG GAMITIN
		return false;
	};

	document.querySelector("name").onkeypress = function(e) {
	return "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz .".indexOf(String.fromCharCode(e.which)) >= 0; //DITONG PART YUNG ILALAGAY MO KUNG ANO YUNG PWEDENG GAMITIN
	};
	});
	</script>
	
		<script>
	document.addEventListener("DOMContentLoaded", function() {
	document.getElementById("phone").onkeypress = function(e) { //ID NG TEXT INPUT NA PAGGAMITAN MO
		var chr = String.fromCharCode(e.which);
	if ("0123456789".indexOf(chr) < 0) //DITONG PART YUNG ILALAGAY MO KUNG ANO YUNG PWEDENG GAMITIN
		return false;
	};

	document.querySelector("phone").onkeypress = function(e) {
	return "0123456789".indexOf(String.fromCharCode(e.which)) >= 0; //DITONG PART YUNG ILALAGAY MO KUNG ANO YUNG PWEDENG GAMITIN
	};
	});
	</script>