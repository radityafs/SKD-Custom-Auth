@include('partials.header', ['title' => 'Login Page - Kelompok 2'])

<body class="hold-transition login-page">

    <div class="custom-control custom-switch mb-3">
        <input type="checkbox" class="custom-control-input" id="customSwitch1">
        <label class="custom-control-label" for="customSwitch1">Dark Mode</label>
    </div>

    <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="{{ url('/') }}" class="h1"><b>Kelompok 2</b></a>
            </div>
            <div class="card-body">

                <p class="login-box-msg">Masuk dan akses semua fitur yang tersedia</p>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <form action="{{ url('/login') }}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" name="email" placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="password" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Masuk</button>
                        </div>
                    </div>
                </form>


                <div class="social-auth-links text-center mb-3">
                    <a href="{{ url('/auth/twitter') }}" class="btn btn-block btn-primary">
                        <i class="fab fa-twitter mr-2"></i> Sign In using Twitter (USER ONLY)
                    </a>
                </div>
                <!-- /.social-auth-links -->

                <p class="mt-3">
                    <a href="{{ url('register') }}" class="text-center">Belum punya akun ?</a>
                </p>
            </div>
        </div>
    </div>

    @include('partials.footer')
</body>
