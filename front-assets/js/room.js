
$(document).ready(function(){
  $(".js-room_moreinfo_btn").click(function(){
     $(this).closest(".room_information").next().toggle();
  });
});