<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<!doctype html>
<html lang="en">
<head>
@include("layouts.Header")  
</head>
<body>
<div class=''>
<div class='row'> 
    <div class='col col-6' id='menudiv'> 
        <div id='divMenu'>@include("layouts.Menu")</div>
    </div>

    <div class='col'> 
        <div id='divBody'>
            


        
        </div>
    </div>
</div>



</div>
</body>
</html>

