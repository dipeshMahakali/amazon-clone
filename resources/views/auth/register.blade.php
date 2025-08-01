<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Register</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(to bottom right, #d376f2, #e2d9fc);
            height: 100vh;
        }

        .login-box {
            max-width: 800px;
            background: #fff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        .form-control::placeholder {
            color: #999;
        }

        .input-group-text {
            background-color: transparent;
            border-right: none;
        }

        .form-control {
            border-left: none;
        }

        .input-group .form-control:focus {
            box-shadow: none;
            border-color: #7e57c2;
        }

        .divider {
            text-align: center;
            margin: 20px 0;
            position: relative;
        }

        .divider::before,
        .divider::after {
            content: "";
            height: 1px;
            background: #ddd;
            position: absolute;
            top: 50%;
            width: 35%;
        }

        .divider::before {
            left: 0;
        }

        .divider::after {
            right: 0;
        }

        .divider span {
            background: white;
            padding: 0 10px;
            font-size: 14px;
            color: #555;
        }

        .social-login a {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            color: #fff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin: 0 10px;
        }

        .social-login a.facebook {
            background-color: #3b5998;
        }

        .social-login a.google {
            background-color: #db4437;
        }

        .social-login a.github {
            background-color: #333;
        }

        .fa-eye {
            cursor: pointer;
        }
    </style>
</head>

<body class="d-flex align-items-center justify-content-center">
    <div class="login-box text-center">
        <h3 class="mb-4 fw-bold">Register</h3>
        <form method='POST' action="{{route('register')}}">
            @csrf
            <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text"><i class="fa fa-user text-purple"></i></span>
                    <input type="text" class="form-control @error('username') is-invalid @enderror" name='username'
                        placeholder="Enter Username">
                </div>
                @error('username')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text"><i class="fa fa-user text-purple"></i></span>
                    <input type="text" class="form-control @error('userEmail') is-invalid @enderror" name='userEmail'
                        placeholder="Enter Email">
                </div>
                @error('userEmail')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text"><i class="fa fa-lock text-purple"></i></span>
                    <input type="password" id="password" name='pasword'
                        class="form-control @error('pasword') is-invalid @enderror" placeholder="Enter your Password">
                    <span class="input-group-text"><i class="fa fa-eye" id="togglePassword"></i></span>
                </div>
                @error('pasword')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa fa-lock text-purple"></i></span>
                    <input type="password" id="confirm-password" name='confirmPasword'
                        class="form-control @error('confirmPasword') is-invalid @enderror"
                        placeholder="Confirm your Password">
                    <span class="input-group-text"><i class="fa fa-eye" id="toggleConfirmPassword"></i></span>
                </div>
                @error('confirmPasword')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            {{--
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="rememberMe">
                    <label class="form-check-label" for="rememberMe">Remember me</label>
                </div>
                <a href="#" class="text-decoration-none">Forgot password?</a>
            </div> --}}

            <div class="d-grid mb-3">
                <button class="btn btn-primary" type="submit">Sign Up</button>
            </div>

            <p class="mb-3">Already have an account? <a href="#" class="text-decoration-none">Sign in</a></p>

            <div class="divider"><span>or connect with</span></div>

            <div class="social-login d-flex justify-content-center">
                <a href="#" class="facebook"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="google"><i class="fab fa-google"></i></a>
                <a href="#" class="github"><i class="fab fa-github"></i></a>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        document.getElementById("togglePassword").addEventListener("click", function () {
            const passwordField = document.getElementById("password");
            const type = passwordField.type === "password" ? "text" : "password";
            passwordField.type = type;
            this.classList.toggle("fa-eye-slash");
        });
        document.getElementById("toggleConfirmPassword").addEventListener("click", function () {
            const passwordField = document.getElementById("confirm-password");
            const type = passwordField.type === "password" ? "text" : "password";
            passwordField.type = type;
            this.classList.toggle("fa-eye-slash");
        });
    </script>
</body>

</html>