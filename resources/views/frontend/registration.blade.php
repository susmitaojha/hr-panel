<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/login.css">
    <title>Login-Signup</title>
</head>
<body>
    <div class="wrapper">
        <div class="login-site">
        <form action="/post-registration" method="post">
        @csrf
                <div class="form-upper">
                    <div>
                        <h4>Digital</h4>
                    </div>
                    <div class="text-gaps">
                        <h2>Artificial Intelligence Driving Results For The Travel Industry</h2>
                        <p>Welcome back please login to your account</p>
                    </div>
                </div>
                
                <div class="login-form">
                        <div class="name-part">
                            <div class="labels">name</div>
                            <div><input  class="form-control" type="text" name="name" placeholder="abc"></div>
                        </div>
                        @if($errors->has('name'))
                                <span class="formError">{{$errors->first('name')}}</span>
                        @endif
                        <div class="email-part">
                            <div class="labels">Email address</div>
                            <div><input  class="form-control" type="email" name="email" placeholder="abc@gmail.com"></div>
                        </div>
                        @if($errors->has('email'))
                                <span class="formError">{{$errors->first('email')}}</span>
                        @endif
                        <div class="password-part">
                            <div class="labels">Password</div>
                            <div><input  class="form-control" type="password" name="password" placeholder="*********"></div>
                        </div> 
                        @if($errors->has('password'))
                                <span class="formError">{{$errors->first('password')}}</span>
                        @endif  
                   
                </div>
             
                <div class="form-buttons">
                 
                    <div class="signup-btn"><input type="submit" name="Signup-btn" value="Sign Up"></div>
                </div>
                </form>
        </div>
        <div class="image-site">
            <img src="assets/img/desktop.jpg"/>
        </div>
    </div>
</body>
</html>