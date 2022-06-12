
function validaPhone(cadena)
{
    var reg = "/[0-9]g";
    console.log(cadena);
    console.log(reg.test(cadena));
    return reg.test(cadena);
}
function validaMail(value){
    var nameregex = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
    var resp = nameregex.test( value );
    return resp;
}
$(document).ready(function(){
    $(".divBody").on("keyup",".phoneNumber",function(){      
        var val = $(this).val();
        if(isNaN(val)){
             val = val.replace(/[^0-9\+]/g,'');            
        }
       // $(this).val(val).trim();
    });
    $(".divBody").on("keyup",".mail",function(){  
        var value = $(this).val();
        if(validaMail(value)==true)
        {
            $(this).addClass('is-valid');
            $(this).removeClass('is-invalid');
        }else{
            $(this).addClass('is-invalid');
            $(this).removeClass('is-valid');
        }
    });
    $('.divBody').on("keypress",".numeric",function (e) {    
    
        var charCode = (e.which) ? e.which : event.keyCode    
    
        if (String.fromCharCode(charCode).match(/[^0-9]/g))    
    
            return false;                        
    
    });   

});
