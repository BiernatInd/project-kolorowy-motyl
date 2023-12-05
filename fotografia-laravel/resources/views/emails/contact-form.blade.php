<!DOCTYPE html>
<html>
<head>
    <title>Nowa wiadomość ze strony internetowej</title>
</head>
<body>
    <p><strong>Imię:</strong> {{ $data['name'] }}</p>
    <p><strong>Nazwisko:</strong> {{ $data['surname'] }}</p>
    <p><strong>Email:</strong> {{ $data['email'] }}</p>
    <p><strong>Numer telefonu:</strong> {{ $data['phone'] }}</p>
    <p><strong>Wiadomość:</strong> {{ $data['message'] }}</p>
</body>
</html>
