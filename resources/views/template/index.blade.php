<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    <link rel="stylesheet" href="asset/css/{{ $css }}.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,500;0,600;0,700;0,800;1,600;1,800&family=Roboto:ital,wght@0,400;0,700;1,700&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="asset/img/minuman.png">
    <script src="asset/library/jquery-3.6.0.js"></script>
    <script>
    url = window.location.origin
    
    </script>
    <style>
        body {
            width: 415px;
            margin: 0px;
            margin: 0px auto;
            border: 1px solid #bbb;
            border-bottom: none;
            height: 100vh;
            position: relative;
            z-index: 9;
            overflow-y: hidden;
        }
        
        .header-home {
            min-height: 140px;
            border-bottom: 1px solid #888; 
            border-radius: 0px 0px 29px 29px;
            display: flex;
            justify-content: center;
        }
        .image-header{
            width: 140px;
            height: 140px;
        }

        .bottom-bar {
            display: flex;
            height: 45px;
            align-items: center;
            justify-content: space-around;
            position: fixed;
            bottom: 0;
            background-color: white;
            box-shadow: 0 -1px 1px 0 #eee;
            width: 100%;
            z-index: 7;
        }
        .bottom-bar li{
            display: flex;
            align-items: center;
        }
        @media screen and (max-width: 435px){
            body {
                width: auto;
            }
        }
        @media screen and (min-width: 433px){
            .bottom-bar {
                width: 415px;
            }
        }
    </style>
</head>
<body>
        <div class="header">@include('template.header')</div>
    
        <div>
            @yield('body')
        </div>

        @include('template.bottomBar')
</body>
</html>