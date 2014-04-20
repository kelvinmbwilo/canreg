$(document).ready(function(){
    $("#registerpat").click(function (){
        $('#maincontents').html("<div class='text-center'><i class='fa fa-spinner fa-spin fa-5x'></i></div>");
        $.ajax({
        type: "GET",
        url:'patient/add/basic',
        data: { id: "userId" }
      }).done(function( msg ) {
        $('#maincontents').html(msg);
      });
    });
})
