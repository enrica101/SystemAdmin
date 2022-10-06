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
            {{-- <form method="POST" action="/users" enctype="multipart/form-data"> --}}
                <form method="POST" action="/users">
                @csrf
                <div class="field">
                    <label for="accountType">Account Type*</label>
                    <input type="text" name="accountType" id="accountType" value="Admin" readonly>
                </div>
                <div class="field">
                    <label for="email">Email Address*</label>
                    <input type="email" name="email" id="email" value="{{old('email')}}" placeholder="user@email.com">
                    @error('email')
                            <small style="color: brown">{{$message}}</small>
                    @enderror
                </div>
                <div class="field">
                    <label for="password">Password*</label>
                    <input type="password" name="password" id="password" value="{{old('password')}}" placeholder="Enter password">
                    @error('password')
                            <small style="color: brown">{{$message}}</small>
                    @enderror
                </div>
                <div class="field">
                    <label for="password_confirmation">Confirm Password*</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" value="{{old('password_confirmation')}}" placeholder="Confirm password">
                    @error('password_confirmation')
                            <small style="color: brown">{{$message}}</small>
                    @enderror
                </div>
                <div class="field">
                    <label for="fname">First Name*</label>
                    <input type="text" name="fname" id="fname" value="{{old('fname')}}" placeholder="Enter your first name">
                    @error('fname')
                            <small style="color: brown">{{$message}}</small>
                    @enderror
                </div>
                <div class="field">
                    <label for="mname">Middle Name</label>
                    <input type="text" name="mname" id="mname" value="{{old('mname')}}" placeholder="Enter your middle name">
                    @error('mname')
                            <small style="color: brown">{{$message}}</small>
                    @enderror
                </div>
                <div class="field">
                    <label for="lname">Last Name*</label>
                    <input type="text" name="lname" id="lname" value="{{old('lname')}}"  placeholder="Enter your last name">
                    @error('lname')
                            <small style="color: brown">{{$message}}</small>
                    @enderror
                </div>
                <div class="field">
                    <label for="Gender">Gender*</label>
                    <select name="gender" id="gender" value="{{old('gender')}}">
                        <option value="male" @if (old('gender') == 'male') selected="selected" @endif>Male</option>
                        <option value="female" @if (old('gender') == 'female') selected="selected" @endif>Female</option>
                    </select>
                </div>
                <div class="field">
                    <label for="birthdate">Birthdate*</label>
                    <input type="date" name="birthdate" id="birthdate" value="{{old('birthdate')}}">
                    @error('birthdate')
                            <small style="color: brown">{{$message}}</small>
                    @enderror
                </div>

                <div class="field">
                    <label for="contactNumber">Contact Number <small>[Optional]</small> </label>
                    <input type="text" name="contactNumber" id="contactNumber" value="{{old('contactNumber')}}" placeholder="+639 / 09*********">
                    @error('contactNumber')
                            <small style="color: brown">{{$message}}</small>
                    @enderror
                </div>
                
                {{-- <div class="field">
                    <label for="avatar">
                        Upload Profile Picture <small>[Optional]</small>
                    </label><br>
                    <input 
                        type="file" 
                        name="avatar" 
                        {{-- accept="image/*" --}}
                    {{-- /><br>
                    @error('avatar')
                    <p>{{$message}}</p>
                    @enderror
                </div> --}}
                <input type="submit" value="Register"><br>
                <small>Already have an account? <a href="/login">Login </a></small>
            </form>
        </div>
    </div>
    {{-- <script src="script.js"></script> --}}
</body>
</html>