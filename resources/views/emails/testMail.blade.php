<!DOCTYPE html>
<html lang="en">
<head>
    <title>AllPHPTricks.com</title>
</head>
<body>
<h1>{{ $testMailData['title'] }}</h1>
<div style="width:100px ;hight:100px" >
    <img src={{$message->embed(public_path().'/assets/app_img/logo_image.png')}} ; alt="">
</div>
{{--<img src={{$message->embed(public_path().'/assets/app_img/logo_image.png')}} ; alt="">--}}
<p>{{ $testMailData['body'] }}</p>

</body>
</html>
