<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <h1>Buat akun baru</h1>
    <form action="/register/store" method="post">
        <label for="">Nama</label> 
         <input type="text" name="username"> <br>
        <label for="">Password</label>
         <input type="password" name="password"> <br>
        <label for="">Email</label>
         <input type="email" name="email"> <br>
         <input type="submit">
    </form>
</body>
</html>