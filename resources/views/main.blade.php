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
            <div id='divMenu'>@include("layouts.Menu")</div>
        </div>
        <div class='row'> 
            <div class='col'> 
                <div id='divBody'>
                    @include("Components/mainCcosto")
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>