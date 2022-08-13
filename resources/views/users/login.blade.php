<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
    integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer"
    />        <link rel="stylesheet" href="css/style.css">
    <title>System Dashboard</title>
</head>
<body>
    <div class="container login">
        
        <div class="default-login">
            <span>
                <img src="img/default-img-dark.png" alt="">
                <h3>Log into your Account</h3>
            </span>
            <form method="POST" action="/users/authenticate">
                @csrf
                <div class="field-area">
                    <label for="email">Email Address*</label>
                    <input type="text" name="email" id="email" value="{{old('email')}}">
                    @error('email')
                        <small style="color: brown">{{$message}}</small>
                    @enderror
                </div>
                <div class="field-area">
                    <label for="password">Password*</label>
                    <input type="password" name="password" id="password" value="{{old('password')}}">
                    @error('password')
                        <small style="color: brown">{{$message}}</small>
                    @enderror
                </div><br>
                <input type="submit" value="Login"><br>
                <small>Don't have an account? <a href="/register"><small>Register</small> </a></small>
            </form>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>