<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <p>
        Thank you {{ ucfirst($fname) }} for contacting our support team. A support ticket has been opened for you. You will be notified when a response is made by email. The details of your ticket are shown below:
    </p>

    <p>Title: {{ $subject }}</p>
    <p>Priority: {{ $priority }}</p>
    <p>Status: {{ $status }}</p>
</body>
</html>