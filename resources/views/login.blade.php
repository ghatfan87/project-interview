<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="assets/css/login.css">
  <title>Login</title>
</head>
<body>
  <div class="container">
    <div class="header">
      <h2>Login</h2>
    </div>
    <form action={{route('auth')}} method="POST" class="form">
      @csrf
      <div class="form-control">
        <label for="username">Email</label>
        <input type="email" placeholder="Email" id="email" name="email" />
        <i class="fas fa-check-circle"></i>
        <i class="fas fa-exclamation-circle"></i>
        <small>Error message</small>
      </div>
      <div class="form-control">
        <label for="username">Password</label>
        <input type="password" placeholder="Password" id="password" name="password"/>
        <i class="fas fa-check-circle"></i>
        <i class="fas fa-exclamation-circle"></i>
        <small>Error message</small>
      </div>
      <button type="submit">Submit</button>
    </form>
  </div>
  
  
</html>