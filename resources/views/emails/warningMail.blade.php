<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{ $testMailData['title'] }}</title>
</head>
<body>
<img src="{{ $message->embed($testMailData['img-path']) }}" alt="Warning Image" width="100"/>
<h1>{{ $testMailData['title'] }}</h1>
<p>{{ $testMailData['body'] }}</p>

@if(!empty($similarImages))
    <h2>Similar Images:</h2>
    <ul>
        @foreach($similarImages as $image)
            <li>{{ $image }}</li> <!-- You may want to include a link to the images if they are accessible -->
        @endforeach
    </ul>
@endif
</body>
</html>
