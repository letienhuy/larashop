<!DOCTYPE html>
<html lang="en" style="width:100%;height:100%">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('assets/styles/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/styles/bootstrap.css')}}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>404 Not Found</title>
</head>
<body>
    <div id="content">
        <div class="container">
            <div class="err-404">
            <span>404</span>
            <span>Not Found</span>
            <div class="err-desc">{{__('messages.errors.404')}}</div>
            </div>
        </div>
    </div>
</body>
</html>