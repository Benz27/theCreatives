var usertype="<?php echo $ui_utype;?>";
if (usertype=="user"){
    document.getElementById("artlist2").hidden=true;
    document.getElementById("artlist3").hidden=true;
    document.getElementById("artlist4").hidden=true;
    document.getElementById("artlist5").hidden=true;
    }else{
    document.getElementById("artlist2").hidden=false;
    document.getElementById("artlist3").hidden=false;
    document.getElementById("artlist4").hidden=false;
    document.getElementById("artlist5").hidden=false;
    
}