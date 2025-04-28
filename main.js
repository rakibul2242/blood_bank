var a;
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