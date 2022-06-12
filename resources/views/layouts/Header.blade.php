<meta name="viewport" content="width=device-width, initial-scale=1">

<?php
use Firebase\JWT\JWT;

if(!isset($_SESSION)) 
            { 
                session_start(); 
            } 
$uri = $_SERVER['REQUEST_URI'];

if(isset($_SESSION["menuItems"])){
  header('Location: '.env("APP_URL").'public/');
}
$path = trim(parse_url($uri, PHP_URL_PATH), '/');
$level = count(explode('/', $path));
//echo $level;
switch($level)
{
    case 1;
        $bpath = "";
        $_SESSION["MUrl"] = "/public";
        break;
    case 2;
        $bpath = "..";
        break;    
    case 3;
        $bpath = "..";
        break;   
    case 4;
        $bpath = "../";
        break;   
    case 5;
        $bpath = "..";
        break;   
    case 6;
        $bpath = "..";
        break;   
    default; 
        $bpath = ".";
        break;

}
?>

<script>var bpath ='{{$bpath}}';
 var urlLogn = "{{URL::asset($bpath.'/public/login/normalLogin/')}}";
 var urlMain = "{{URL::asset($bpath.'/public/main')}}";
</script>

<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="{{URL::asset($bpath.'/resources/js/popper.min.js')}}" ></script> 
<script src="{{URL::asset($bpath.'/resources/js/jquery-3.5.1.min.js')}}"></script> 
<link rel="stylesheet" href="{{URL::asset($bpath.'/resources/css/main.css?v=4.3').rand()}}" >
<link rel="stylesheet" href="{{URL::asset($bpath.'/resources/js/bootstrap-5.1.3-dist/css/bootstrap.min.css')}}">
<script src="{{URL::asset($bpath.'/resources/js/bootstrap-5.1.3-dist/js/bootstrap.bundle.min.js')}}" ></script>	
<script src="{{URL::asset($bpath.'/resources/js/viewsJs/demostry.js?v=1').rand()}}"></script>
<script src="{{URL::asset($bpath.'/resources/js/formatvalids.js?v=1.2').rand()}}"></script>

<div class="modal" tabindex="-1" id='advModal'>
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id='advModalTitle'>Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" >
        <p id='advModalMsg'>Modal body text goes here.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"  id='advModalClose'>Aceptar</button>
     
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"  id='advModalCancel'>Cancelar</button>
      </div>
    </div>
  </div>
</div>
<div class="modal" tabindex="-1" id='modalForm'>
  <div class="modal-dialog modal-fullscreen">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id='modalFormTitle'>Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id='modalFormBody' >
        
      </div>
      <div class="modal-footer">
      
     
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"  id='modalFormCancel'>Volver</button>
      </div>
    </div>
  </div>
</div>


<div class="modal" tabindex="-1" id='msgModal' >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id='msgModalTitle'>Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" >
        <p id='msgModalMsg'>Modal body text goes here.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"  id='msgModalClose'>OK</button>
      </div>
    </div>
  </div>
</div>
<script>

$(document).on('show.bs.modal', '.modal', function() {
    const zIndex = 1040 + 10 * $('.modal:visible').length;
    $(this).css('z-index', zIndex);
    setTimeout(() => $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack'));
  });
</script>