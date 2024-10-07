<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <link href="{{asset('https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css')}}" rel="stylesheet"
        crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('assets/login-petugas-admin/style.css')}}" />
    <title>Sign in / Sign up Form</title>
    <link rel="icon" href="{{asset('assets/landing-page/assets/img/favicon.png')}}" type="image/png">
</head>

<body>
    <div class="kontent">
        <div class="forms-container">
            <div class="signin-signup">
                <form action="{{route('prosesLoginPetugas')}}" method="POST" class="sign-in-form">
                    @if (session()->has('failed'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-octagon me-1"></i>
                            {{session('failed')}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @csrf
                    <h2 class="title">PETUGAS</h2>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" name="username" class="form-control @error('username') is-invalid @enderror"
                            placeholder="Masukan Username" value="{{old('username')}}" />
                        @error('username')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password"
                            class="form-control @error('password') is-invalid @enderror"
                            placeholder="Masukan password anda" />
                        @error('password')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                        <br>
                    </div>
                    <input type="submit" class="btn solid" />
                </form>

                <form action="{{route('prosesLoginAdmin')}}" method="POST" class="sign-up-form">
                    @if (session()->has('failed'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-octagon me-1"></i>
                            {{session('failed')}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @csrf
                    <h2 class="title">ADMIN</h2>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" name="username" class="form-control @error('username') is-invalid @enderror"
                            placeholder="Masukan Username" value="{{old('username')}}"/>
                        @error('username')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password"
                            class="form-control @error('password') is-invalid @enderror"
                            placeholder="Masukan password anda" />
                        @error('password')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <input type="submit" class="btn solid" />
                </form>

            </div>
        </div>

        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3>Bukan PETUGAS?</h3>
                    <p>
                        Silahkan klik button dibawah ini jika anda bukan PETUGAS
                    </p>
                    <button class="btn transparent" id="sign-up-btn">
                        ADMIN
                    </button>
                </div>
            </div>
            <div class="panel right-panel">
                <div class="content">
                    <h3>Bukan ADMIN?</h3>
                    <p>
                        Silahkan klik button dibawah ini jika anda bukan ADMIN
                    </p>
                    <button class="btn transparent" id="sign-in-btn">
                        PETUGAS
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="{{asset('https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js')}}" crossorigin="anonymous"></script>
    <script src="{{asset('assets/login-petugas-admin/app.js')}}"></script>
</body>

</html>
