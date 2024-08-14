<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Similar Images Found</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f9f9f9; margin: 0; padding: 20px;">
<div style="max-width: 600px; margin: 0 auto; background-color: #ffffff; padding: 20px; border-radius: 8px;">
    <h1 style="text-align: center; color: #f00;">Similar Images Found</h1>

    <p style="font-size: 16px; color: #555555;">
        We have found some images that are similar to the one you uploaded. Below are the details:
    </p>

    @foreach($similarImages as $comparison)
        <div style="margin-bottom: 20px; border-bottom: 1px solid #e0e0e0; padding-bottom: 15px;">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <!-- Display Uploaded Image -->
                <div style="text-align: center;">
                    <h4 style="margin: 10px 0; color: #333333;">Uploaded Image</h4>
                    <img src="{{ $message->embed(public_path($comparison['uploaded_image'])) }}" alt="Uploaded Image"
                         style="max-width: 150px; max-height: 150px; object-fit: cover; border-radius: 8px; border: 1px solid #ddd; margin-right: 10px;">
                    <p style="margin: 5px 0; color: #777777;">User: {{ $comparison['uploaded_image_user'] }}</p>
                </div>

                <!-- Display Similar Image -->
                <div style="text-align: center;">
                    <h4 style="margin: 10px 0; color: #333333;">Similar Image</h4>
                    <img src="{{ $message->embed(public_path($comparison['similar_image'])) }}" alt="Similar Image"
                         style="max-width: 150px; max-height: 150px; object-fit: cover; border-radius: 8px; border: 1px solid #ddd; margin-left: 10px;">
                    <p style="margin: 5px 0; color: #777777;">User: {{ $comparison['similar_image_user']->join(', ') }}</p>
                </div>
            </div>

            <!-- Display Similarity Percentage -->
            <div style="text-align: center; margin-top: 10px; font-size: 18px; font-weight: bold; color: #333333;">
                Similarity: {{ $comparison['similarity'] }}%
            </div>
        </div>
    @endforeach

    <p style="font-size: 16px; color: #555555;">
        If you have any questions or concerns, please contact us.
    </p>
</div>
</body>
</html>
