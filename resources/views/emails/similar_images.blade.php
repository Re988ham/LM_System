<!DOCTYPE html>
<html>
<head>
    <title>Similar Images Found</title>
</head>
<body style="font-family: Arial, sans-serif;">
<div style="width: 80%; margin: auto; text-align: center;">
    <div style="font-size: 20px; color: #e74c3c;">
        <img src="{{ $message->embed(public_path('images/warning.png')) }}" alt="Warning" style="max-width: 50px;">
        <h1 style="color: #e74c3c;">EDUspark</h1>
    </div>
    <p>There is someone trying to make a fuss</p>
    <table style="width: 100%; height:100%; border-collapse: collapse; margin-top: 20px;">
        <thead>
        <tr>
            <th style="padding: 20px; border: 1px solid #ddd; text-align: center; background-color: #f2f2f2;">Uploaded Image</th>
            <th style="padding: 20px; border: 1px solid #ddd; text-align: center; background-color: #f2f2f2;">Uploaded Image User</th>
            <th style="padding: 20px; border: 1px solid #ddd; text-align: center; background-color: #f2f2f2;">Similar Image</th>
            <th style="padding: 20px; border: 1px solid #ddd; text-align: center; background-color: #f2f2f2;">Similar Image User</th>
            <th style="padding: 20px; border: 1px solid #ddd; text-align: center; background-color: #f2f2f2;">Similarity</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($similarImages as $image)
            <tr>
                <td style="padding: 25px; border: 1px solid #ddd; text-align: center;">
                    <img src="{{ $message->embed(public_path(ltrim($image['uploaded_image'], '/'))) }}" alt="Uploaded Image" style="max-width: 150px; border-radius: 8px;">
                </td>
                <td style="padding: 25px; border: 1px solid #ddd; text-align: center;">{{ $image['uploaded_image_user'] }}</td>
                <td style="padding: 25px; border: 1px solid #ddd; text-align: center;">
                    <!-- Use Base64 encoding for embedding -->
                    @php
                        $path = public_path(ltrim($image['similar_image'], '/'));
                        $type = pathinfo($path, PATHINFO_EXTENSION);
                        $data = file_get_contents($path);
                        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                    @endphp
                    <img src="{{ $base64 }}" alt="Similar Image" style="max-width: 150px; border-radius: 8px;">
                </td>
                <td style="padding: 25px; border: 1px solid #ddd; text-align: center;">{{ implode(', ', $image['similar_image_user']) }}</td>
                <td style="padding: 25px; border: 1px solid #ddd; text-align: center;">{{ $image['similarity'] }}%</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
</body>
</html>
