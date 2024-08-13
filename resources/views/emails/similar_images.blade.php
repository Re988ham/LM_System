<!DOCTYPE html>
<html>
<head>
    <title>Similar Images Found</title>
</head>
<body>
<h1>Similar Images Found</h1>
<p>Here are the images that were found to be similar:</p>
<ul>
    @foreach ($similarImages as $image)
        <li>
            Uploaded Image: {{ $image['uploaded_image'] }}<br>
            Uploaded User: {{ $image['uploaded_image_user'] }}<br>
            Similar Image: <a href="{{ url($image['similar_image']) }}">{{ $image['similar_image'] }}</a><br>
            Similar User: {{ $image['similar_image_user']->implode(', ') }}<br>
            Similarity: {{ $image['similarity'] }}%
        </li>
    @endforeach
</ul>
</body>
</html>
