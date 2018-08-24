<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        
    </head>
    <body>
        <div class="welcome-container"> 
            <div class="art"></div>
            <div class="auth-container">
                <div class="login-form">
                    <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                        @csrf
                        <div class="form-element">
                            <input placeholder="Email" class="cool-input {{ $errors->has('email') ? ' is-invalid' : '' }}" type="email" name="email" value="{{ old('email') }}" required autofocus>
                            @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-element">
                            <input placeholder="Password" class="cool-input{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required type="password">
                            @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </div>
                        <input type="hidden" name="location" id="location_log">
                        <div class="form-element">
                            <button type="submit">Log in</button>
                            <a class="password-forgotten" href="{{ route('password.request') }}">Forgot Your Password?</a>
                        </div>
                    </form>
                </div>
                <div class="signup-form">
                    <h1>Create an account</h1>
                    <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
                        @csrf
                        <div class="form-element">
                            <label for="name">Name:</label>
                            <input class="cool-input {{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required type="text">
                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-element">
                            <label for="email">Email:</label>
                            <input class="cool-input{{ $errors->has('email_reg') ? ' is-invalid' : '' }}" name="email_reg" value="{{ old('email') }}" required type="email">
                            @if ($errors->has('email_reg'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email_reg') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-element">
                            <label for="password">Password:</label>
                            <input class="cool-input{{ $errors->has('password_reg') ? ' is-invalid' : '' }}" name="password_reg" required type="password">
                            @if ($errors->has('password_reg'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password_reg') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-element">
                            <label for="confirm">Confirm password:</label>
                            <input class="cool-input" type="password" name="password_reg_confirmation">
                        </div>
                        <input type="hidden" name="location" id="location_reg">
                        <div class="form-element">
                            <button type="submit">Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <script>
            //get the user's location 
            (
                function getLocation() {
                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(showPosition);
                    } else {
                        //
                    }
                }
            )();

            function showPosition(position) {
                //making coordinates into a json string, which will be sent through a hidden field 
                let loc={
                    lat : position.coords.latitude,
                    lon : position.coords.longitude
                }

                document.getElementById('location_log').value=JSON.stringify(loc);
                document.getElementById('location_reg').value=JSON.stringify(loc);
            }
        </script>
    </body>
</html>
