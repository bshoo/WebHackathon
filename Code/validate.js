function validate_branch(that){
    if (that.value == "Electronic City"){
        document.getElementById("ee").style.visibility = "hidden";
        document.getElementById("bt").style.visibility = "hidden";
        document.getElementById("le").style.visibility = "hidden";
        document.getElementById("lb").style.visibility = "hidden";
    }
    else{
        document.getElementById("ee").style.visibility = "visible";
        document.getElementById("bt").style.visibility = "visible";
        document.getElementById("le").style.visibility = "visible";
        document.getElementById("lb").style.visibility = "visible";
    }
}