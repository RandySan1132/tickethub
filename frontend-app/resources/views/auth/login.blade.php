<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - TicketHub</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
        }

        .Group14 {
            width: 395px;
            height: 630px;
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .Group11 {
            width: 395px;
            height: 630px;
            position: absolute;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .Rectangle2 {
            width: 383px;
            height: 618.84px;
            background: #00911E;
            border-radius: 20px;
            position: absolute;
            display: flex;
            margin-left: 25px;
            margin-top: 25px;
        }

        .Rectangle3 {
            width: 383px;
            height: 618.84px;
            background: white;
            border-radius: 20px;
            position: absolute;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .Group12 {
            width: 340px;
            height: 462px;
            position: absolute;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            margin-top: 130px;
        }

        .Rectangle4,
        .Rectangle5,
        .Rectangle6 {
            width: 340px;
            height: 50px;
            border-radius: 10px;
            border: 1px solid black;
            margin-bottom: 23px;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        .Rectangle4 {
            background: #E1F3F3;
        }

        .Rectangle5 {
            background: #E1F3F3;
        }

        .Rectangle6 {
            background: #00911E;
            margin-bottom: 0;
        }

        .input-field {
            width: 90%;
            height: 100%;
            border: none;
            outline: none;
            padding-left: 10px;
            background: transparent;
            font-size: 16px;
            font-family: 'Inter', sans-serif;
            color: #000;
        }

        .password-toggle {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
        }

        .invalid-feedback {
            position: absolute;
            bottom: -20px;
            left: 10px;
            font-size: 12px;
            color: red;
            display: none;
        }

        .is-invalid + .invalid-feedback {
            display: block;
        }

        .SignInButton {
            color: white;
            font-size: 16px;
            font-weight: 700;
            word-wrap: break-word;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 100%;
            text-decoration: none;
            background: none;
            border: none;
            cursor: pointer;
        }

        .ForgetPasswordClickHere {
            font-size: 14px;
            font-weight: 500;
            margin-top: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .ForgetPasswordClickHere span {
            margin-right: 4px;
        }

        .ForgetPasswordClickHere span:last-child {
            color: #00911E;
            cursor: pointer;
            margin-right: 0;
        }

        .DonTHaveAnAccountSignUpNow {
            font-size: 14px;
            margin-top: 150px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .DonTHaveAnAccountSignUpNow span {
            margin-right: 4px;
        }

        .DonTHaveAnAccountSignUpNow span:last-child {
            color: #00911E;
            cursor: pointer;
            margin-right: 0;
        }

        .Group13 {
            width: 250px;
            height: 100px;
            position: absolute;
            top: 28px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            margin-top: 30px;
        }

        .TickethubLogo2 {
            width: 250px;
            height: 35px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 10px;
            margin-bottom: 10px;
        }

        .SignInToYourAccount {
            margin-top: 10px;
            margin-bottom: 10px;
            color: #121212;
            font-size: 20px;
            font-weight: 700;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="Group14">
            <div class="Group11">
                <div class="Rectangle2"></div>
                <div class="Rectangle3"></div>
            </div>
            <div class="Group12">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="Rectangle4">
                        <input id="email" type="email" class="input-field @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="Rectangle5">
                        <input id="password" type="password" class="input-field @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
                        <span class="password-toggle" onclick="togglePasswordVisibility('password')">👁️</span>
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="Rectangle6">
                        <button type="submit" class="SignInButton">Sign In</button>
                    </div>
                    <div class="ForgetPasswordClickHere">
                        <span>Forget password?</span><span><a style="color: #00911E; text-decoration: none;">Click here</a></span>
                    </div>
                    <div class="DonTHaveAnAccountSignUpNow">
                        <span>Don’t have an account?</span><span><a href="{{ route('register') }}" style="color: #00911E; text-decoration: none;">Create account</a></span>
                    </div>
                </form>
            </div>
            <div class="Group13">
                <img class="TickethubLogo2" src="{{ asset('images/tickethub logo.png') }}" alt="Tickethub Logo" />
                <div class="SignInToYourAccount">Sign in to your account</div>
            </div>
        </div>
    </div>
    <script>
        function togglePasswordVisibility(id) {
            const field = document.getElementById(id);
            const type = field.getAttribute('type') === 'password' ? 'text' : 'password';
            field.setAttribute('type', type);
        }
    </script>
</body>

</html>
