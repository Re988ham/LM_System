<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate of Completion</title>
</head>
<body style="padding: 20px 0; background: #ccc;">
<table width="800" cellpadding="0" cellspacing="0" border="0" style="margin: 0 auto; background-color: #fff600; position: relative; color: #333; font-family: 'Open Sans', sans-serif;">
    <tr>
        <td style="padding: 30px; box-shadow: 0 0 5px rgba(0, 0, 0, .5); background: repeating-linear-gradient(90deg, #015a1a, #619782 1px, #ffffff 1px, #b2cad6 2px);">
{{--        <td style="text-align:center;">--}}
{{--            <a href="https://rakeshmandal.com" title="logo" target="_blank">--}}
{{--                <img width="60" src="public/assets/app_img/logo_image.png" title="logo" alt="logo">--}}
{{--            </a>--}}
{{--        </td>--}}
            <div style="border: 2px solid #fff; margin: 0 auto; padding: 20px;">
                <h2 style="text-align: center; font-family: 'Pinyon Script', cursive; font-size: 34px;">Certificate of Completion</h2>
                <div style="text-align: center; margin: 20px 0;">
                    <span style="font-size: 20px; font-weight: bold;">{{ $data['user'] }}</span>
                </div>
                <div style="text-align: center;">
                    <span style="font-family: 'Pinyon Script', cursive;">Has completed the Course:</span>
                    <span style="font-weight: bold; font-family: 'Open Sans', sans-serif;">{{ $data['course'] }}</span>
                </div>
                <div style="text-align: center;">
                    <span style="font-family: 'Pinyon Script', cursive;">In {{ $data['specialization'] }} specialization</span>
                </div>
                <div style="text-align: center;">
                    <span style="font-weight: bold; font-family: 'Open Sans', sans-serif;">Which Created by: {{ $data['by creator'] }}</span>
                </div>
                <div style="margin-top: 40px; text-align: center;">
                    <span style="font-family: 'Open Sans', sans-serif;">EDUspark</span><br>
                    <span style="border-bottom: 1px solid #777; display: inline-block; width: 100%; height: 40px;"></span><br>
                    <span style="font-weight: bold;">The Management Office</span>
                </div>
                <div style="text-align: center; margin-top: 20px;">
                    <span style="font-family: 'Open Sans', sans-serif;">Final Result:</span><br>
                    <span style="border-bottom: 1px solid #777; display: inline-block; width: 100%; height: 40px;">{{ $data['final mark'] }}%</span>
                </div>
            </div>
        </td>
    </tr>
</table>
</body>
</html>
