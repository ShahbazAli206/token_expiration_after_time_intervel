<!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test mail</title>
    <style>
     body{
            background: radial-gradient(#fff,#967b7b);
            text-align: center;
        }
        .email-body
    {
        color:black;
        width:60%;
        margin: 20px auto;
        background-color: #BBA7A3;
        text-align:center;
        font-size:10px;
    }
    </style>

</head>
<body>
    <div class="email-body">
    <p>{{$details["body"]}}</p>
    </div>
    <div class="email-signature">
    <p>Regards: <br>Admin<br>Gharbaar Services</p>
    </div>

</body>
</head>
