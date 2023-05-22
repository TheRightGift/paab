<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body style="font-family: 'Poppins', sans-serif;">
    <h2>Hello,</h2>
    <p class="lead">You received an email from <b>{{ $data['names'] }}</b></p>
    <p class="lead">Here are the details:</p>
    <p>Name: {{ $data['names'] }}</p>
    <p>Email: {{ $data['email'] }}</p>
    <p>Phone: {{ $data['phone'] }}</p>
    <p>Message: <blockquote>{{ $data['message'] }}</blockquote></p>
    <p>Thank You</p>
</body>
</html>