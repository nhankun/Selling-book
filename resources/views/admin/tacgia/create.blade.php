@extends('admin.layouts.master')
@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Admin</a></li>
            <li class="breadcrumb-item"><a href="{{route('tacgia.index')}}">Tác giả</a></li>
            <li class="breadcrumb-item active text-dark" aria-current="page">Thêm mới</li>
        </ol>
    </nav>

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

    <!-- Page Heading -->
    <div class="text-center">
        <h1 class="h3 mb-2 text-dark">Thêm mới tác giả</h1>
    </div>

    <div class="row">
        <div class="col-md-6 offset-md-3">
            <form action="{{route('tacgia.store')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="text" class="text-dark">Tên tác giả:</label>
                    <input required type="text" class="form-control {{ $errors->has('tenTG') ? ' is-invalid' : '' }}" id="text" name="tenTG">
                    @if ($errors->has('tenTG'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('tenTG') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="text" class="text-dark">Địa chỉ:</label>
                    <input required type="text" class="form-control {{ $errors->has('diaChi') ? ' is-invalid' : '' }}" id="text" name="diaChi">
                    @if ($errors->has('diaChi'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('diaChi') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="text" class="text-dark">Số điện thoại:</label>
                    <input required type="text" class="form-control {{ $errors->has('sDT') ? ' is-invalid' : '' }}" id="text" name="sDT">
                    @if ($errors->has('sDT'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('sDT') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="text" class="text-dark">Giới thiệu:</label>
                    <textarea name="gioiThieu" class="form-control" cols="30" rows="10"></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Thêm</button>
                <a href="{{ route('tacgia.index')}}" class="text-blue-800">Quay lại</a>
            </form>
        </div>
    </div>

@endsection
