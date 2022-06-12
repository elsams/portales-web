
<?php
$menuitems="";

  if( !isset($_SESSION["menuItems"]) ){
    header('Location: '.env("APP_URL").'public/');
 }else{
  $idPerfil = $_SESSION["role"];

  $cliente = curl_init();
  $url = env("APP_URL")."public/menu/getMenuJson/".$idPerfil;

	curl_setopt($cliente, CURLOPT_URL, env("APP_URL")."public/menu/getMenuJson/".$idPerfil);
	curl_setopt($cliente, CURLOPT_HEADER, 0);
  curl_setopt($cliente, CURLOPT_RETURNTRANSFER, true); 
  curl_setopt($cliente, CURLOPT_HEADER, 0); 
  $menuitems = json_decode(curl_exec($cliente));
  //$itemsPadre new Arrat();
//var_dump( $menuitems );
//  exit();
  curl_close($cliente); 
 }
?>
<nav class="navbar navbar-expand-lg navbar-light bg-primary" id='navMenu'>
  <!-- Navbar content -->
<div class="container-fluid">
<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navToggle" aria-controls="navToggle" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

  <div class="collapse navbar-collapse"  id='navToggle'>

    
  <ul class="navbar-nav me-auto mb-2 mb-lg-0">
  <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="{{ URL::to('/main') }}">Inicio</a>
      </li>
  @foreach($menuitems as $menu)
  
          <li class="nav-item">
            <a class="nav-link dropdown-toggle" aria-current="page" href="#" id="navbarScrollingDropdown"  role="button"  data-bs-toggle="dropdown" aria-expanded="false">{{ $menu->cod_menu}}</a>
              <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                @if(property_exists($menu,"hijos")) 
                  @foreach($menu->hijos as $item)

                  <li class="nav-item ">
                    <a class="nav-link dpItem" aria-current="page"  href="{{URL::to('/').$item->url}}">{{ $item->cod_menu}}</a>
                  </li>  
                              
                  @endforeach 
                @endif
              </ul>      
          </li>

      @endforeach
      <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="{{ URL::to('/salir') }}">Salir</a>
      </li>
    
  </ul>
  
</div>
</div>
</nav>

