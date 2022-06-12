$(document).ready(function(){
    $("#btnLogIn").on("click",function(){
        var inpUsername =$("#inpUsername").val();
        var InpPassword =$("#InpPassword").val();
        var urlPst = urlLogn+"/"+inpUsername+"/"+InpPassword;
        console.log(urlPst);
        //var urlPst =  bpath+"/public/login/normalLogin/"+inpUsername+"/"+InpPassword; 
        $.ajax(urlPst,{
                    cache:false,
                    global: false,
                    type: "POST",
                    dataType: "html",
                    data: {
                        "_token": $("meta[name='csrf-token']").attr("content")
                    },
                    async:false,
                    beforeSend: function(){
                    },
                    success: function(data){                    
                        if(isNaN(data))
                        {
                            sw2=1;msg2="Ha ocurrido un error, favor contactar al administrador";
                        }else{
                            if(parseInt(data)==1){
                              //  alert("Usuario encontrado");
                                var urlPst = urlMain;
                              //  alert(urlPst);
                                window.location.replace(urlPst);
                            }else{
                                alert("Usuario o contraseña incorrecta / Incorrect password");                               
                            }                           
                        }                                      
                    }
                });  
    });    
    $("#InpPassword").on("keyup",function(event){
        if ( event.which == 13 ) {
            //console.log("presionado enter");
            $("#btnLogIn").trigger("click");
          }
    });
});