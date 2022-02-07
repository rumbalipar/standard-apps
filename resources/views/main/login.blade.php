<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Cafe</title>
    <link rel="shortcut icon" href="{{ url('/') }}/assets/images/favicon.ico">
    <link rel="stylesheet" href="{{ url('/') }}/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ url('/') }}/assets/fonts/font-awesome.min.css">
    <style>
        .main-content {
            width: 50%;
            border-radius: 20px;
            box-shadow: 0 5px 5px rgba(0, 0, 0, .4);
            margin: 5em auto;
            display: flex;
        }

        .company__info {
            background-image: linear-gradient(to bottom right, white, #17a2b8);
            border-top-left-radius: 20px;
            border-bottom-left-radius: 20px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            color: #fff;
        }

        .fa-android {
            font-size: 3em;
        }

        @media screen and (max-width: 640px) {
            .main-content {
                width: 90%;
            }

            .company__info {
                display: none;
            }

            .login_form {
                border-top-left-radius: 20px;
                border-bottom-left-radius: 20px;
            }
        }

        @media screen and (min-width: 642px) and (max-width:800px) {
            .main-content {
                width: 70%;
            }
        }

        .row>h2 {
            color: #00CCC4;
        }

        .login_form {
            background-color: #fff;
            border-top-right-radius: 20px;
            border-bottom-right-radius: 20px;
            border-top: 1px solid #ccc;
            border-right: 1px solid #ccc;
        }

        form {
            padding: 0 2em;
        }

        .form__input {
            width: 100%;
            border: 0px solid transparent;
            border-radius: 0;
            border-bottom: 1px solid #aaa;
            padding: 1em .5em .5em;
            padding-left: 2em;
            outline: none;
            margin: 1.5em auto;
            transition: all .5s ease;
        }

        .form__input:focus {
            border-bottom-color: #008080;
            box-shadow: 0 0 5px rgba(0, 80, 80, .4);
            border-radius: 4px;
        }

        .btn {
            transition: all .5s ease;
            width: 70%;
            border-radius: 30px;
            color: #008080;
            font-weight: 600;
            background-color: #fff;
            border: 1px solid #008080;
            margin-top: 1.5em;
            margin-bottom: 1em;
        }

        .btn:hover,
        .btn:focus {
            background-color: #008080;
            color: #fff;
        }
    </style>
</head>

<body class="bg-info">
    <!-- Main Content -->
    <div class="container-fluid">
        <div class="row main-content bg-success text-center">
            <div class="col-md-4 text-center company__info">
                <span class="company__logo">
                    <h2><span class="fa fa-android">
                </span>
                <h4 class="company_title">Cafe</h4>
            </div>
            <div class="col-md-8 col-xs-12 col-sm-12 login_form ">
                <div class="container-fluid">
                    <div class="row">
                        <h2>Log In</h2>
                    </div>
                    <div class="row">
                        @if (Session::has('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ Session::get('error') }}
                        </div>
                        @endif
                    </div>
                    <div class="row">
                        <form action="" method="POST" class="form-group">
                            @csrf
                            <div class="row">
                                <input type="text" name="username" id="username" class="form__input"
                                    placeholder="Username" value="{{ old('username') }}">
                                @error('username')
                                <div class="text text-danger">
                                    <small>{{ $message }}</small>
                                </div>
                                @enderror
                            </div>
                            <div class="row">
                                <input type="password" name="password" id="password" class="form__input"
                                    placeholder="Password" value="{{ old('password') }}">
                                @error('password')
                                <div class="text text-danger">
                                    <small>{{ $message }}</small>
                                </div>
                                @enderror
                            </div>
                            <div class="row">
                                <input type="submit" value="Submit" class="btn">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <div class="container-fluid text-center footer text-white font-weight-bold">
        Copyright &copy; by <a class="text-white" href="#">Soleh</a></p>
    </div>
    <script src="{{ url('/') }}/assets/js/jquery.min.js"></script>
    <script src="{{ url('/') }}/assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="{{ url('/') }}/assets/js/lib.js"></script>
</body>

</html>
