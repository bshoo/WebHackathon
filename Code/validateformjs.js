function validateform(){
    flag = true
    for(var i = 0; i<4; i++){
        checkedval = document.getElementsByClassName("chk")[i].checked
        if(!checkedval){
            flag = checkedval
        }
    }
    flag2 = true
    ddamount = document.forms[0]['ddamount'].value
    ddnumber = document.forms[0]['ddnumber'].value
    ddamount = ddamount.search(/^\d+.\d+$/)
    ddnumber = ddnumber.search(/^\d+.\d+$/)
    if(ddamount == -1 || ddnumber == -1)
        flag2 = false
    if(flag && flag2)
        document.querySelector('#sub').disabled = false
    else
        document.querySelector('#sub').disabled = true
}