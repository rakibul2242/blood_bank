var a = 1;
function passHide(){
    if(a == 1){
        document.getElementById("form3Example4cg").type="text";
        document.getElementById("form3Example4cdg").type="text";
        document.getElementById("passhide").src="assets/images/pass-show.png";
        a = 0;
    }
    else{
        document.getElementById("form3Example4cg").type="password";
        document.getElementById("form3Example4cdg").type="password";
        document.getElementById("passhide").src="assets/images/pass-hide.png";
        a = 1;
    }
}
function passHideLogin(){
    if(a == 1){
        document.getElementById("form3Example4cg").type="text";
        // document.getElementById("form3Example4cdg").type="text";
        document.getElementById("passhide").src="assets/images/pass-show.png";
        a = 0;
    }
    else{
        document.getElementById("form3Example4cg").type="password";
        // document.getElementById("form3Example4cdg").type="password";
        document.getElementById("passhide").src="assets/images/pass-hide.png";
        a = 1;
    }
}
$(document).ready(function(){
    $('#loginForm').submit(function(event){
        event.preventDefault();
        var email = $('#form3Example1cg').val();
        var password = $('#form3Example4cg').val();
        
        $.ajax({
            url:'ajax.php',
            method:'POST',
            data:{email:email,password:password},
            success: function(response){
                if (response.includes("success")) {
                  // Redirect to dashboard page
                    $('#responseMessage').removeClass("text-danger");
                    $('#responseMessage').addClass("text-success"); // Add this line
                    $('#responseMessage').html("&nbsp &nbsp Login Successfull"); // Update the message text
                  window.location.href = 'index.php';
                } else {
                  // Display error message
                  $('#responseMessage').html(response);
                  // window.location.href = 'logout.php';
                }
              }
        });
    });
});

