<!DOCTYPE html>
<html>
  <head>
    <title>Welcome Email</title>
  </head>
  <body>
    <h2>Welcome to the site {{$user->customer_name}}</h2>
    <br/>
    Your registered email-id is {{$user->customer_email}} , Please click on the below link to verify your email account
    <br/>
    <a href="{{url('/verify', $user->verifyUser->token)}}">Verify Email</a>
  </body>
</html>