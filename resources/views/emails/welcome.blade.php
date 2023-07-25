<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Welcome {{ $user->name }}</h1>
    <h1> You are succefully registered as a 
        @if ($user->role === '1')
            Admin
            
        @elseif ($user->role === '2')
            Resident
        @elseif ($user->role === '3')
            Technician
        @endif
    </h1>
    <p>Your Email is:  &nbsp; {{ $user->email }}</p>
    <p>Your Name is:  {{ $user->name }}</p>
</body>
</html>