@include('front_end.layouts.header')

<style>
    body{
        background-image: url({{asset('storage/images/slide1.png')}});
        background-repeat: no-repeat;
        background-size: cover;
    }
    .card{

        opacity: 0.9;
    }
</style>
<div class="container">
    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-login-image"><img src="{{asset('storage/images/asc.JFIF')}}" alt="" width="500" height="440"></div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Đăng nhập</h1>
                                </div>
                                @if (session('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('success') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                                @if (session('error'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ session('error') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                                <form action="{{ route('login') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <input type="email" name="email" value="{{ old('email') }}" required class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }} form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Vui lòng nhập email...">
                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" required class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }} form-control-user" id="exampleInputPassword" placeholder="Password">
                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox small">
                                            <input type="checkbox" name="remember" class="custom-control-input" id="customCheck" {{ old('remember') ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="customCheck">Remember Me</label>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                       Đăng nhập
                                    </button>
                                </form>
                                <hr>
                                <div class="text-center">
                                    @if (Route::has('password.request'))
                                            <a class="small" href="{{ route('password.request') }}">Quên mật khẩu?</a>
                                    @endif
                                </div>
                                <div class="text-center">
                                    <a class="small" href="{{ route('register')  }}">Tạo tài khoản!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>

{{--{{dd($errors)}}--}}

@include('front_end.layouts.footer')