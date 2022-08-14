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
    /> 
    <link rel="stylesheet" href="css/style.css">
    <title>System Dashboard</title>
</head>
<body>
    <div class="container register">
        <div class="default-register">
            <span>
                <img src="img/default-img-dark.png" alt="">
                <h3>Register for an Admin Account</h3>
            </span>
            <form method="POST" action="/users">
                @csrf
                <div class="field-area">
                    <label for="firstName">First Name*</label>
                    <input type="text" name="firstName" id="firstName" value="{{old('firstName')}}">
                    @error('firstName')
                        <small style="color: brown">{{$message}}</small>
                    @enderror
                </div>
                <div class="field-area">
                    <label for="lastName">Last Name*</label>
                    <input type="text" name="lastName" id="lastName" value="{{old('lastName')}}">
                    @error('lastName')
                        <small style="color: brown">{{$message}}</small>
                    @enderror
                </div>
                <div class="field-area">
                    <label for="email">Email Address*</label>
                    <input type="email" name="email" id="email" value="{{old('email')}}">
                    @error('email')
                        <small style="color: brown">{{$message}}</small>
                    @enderror
                </div>
                <div class="field-area">
                    <label for="password">Password*</label>
                    <input type="password" name="password" id="password"  value="{{old('password')}}">
                    @error('password')
                        <small style="color: brown">{{$message}}</small>
                    @enderror
                </div>
                <div class="field-area">
                    <label for="password">Confirm Password*</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" value="{{old('password_confirmation')}}">
                    @error('password_confirmation')
                        <small style="color: brown">{{$message}}</small>
                    @enderror
                </div><br>
                <input type="submit" value="Register"><br>
                <small>Already have an account? <a href="/login"><small>Login</small> </a></small>
            </form>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>