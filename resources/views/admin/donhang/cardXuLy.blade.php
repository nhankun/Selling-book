@extends('admin.layouts.master')
@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Admin</a></li>
            <li class="breadcrumb-item active text-dark" aria-current="page">danh sách đơn hàng cần xử lý ({{$donhangs->count()}})</li>
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

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row justify-content-center">
                    @if(isset($title))
                        <h5 class="mb-0 text-dark">{!! $title !!}</h5>
                    @endif
            </div>
        </div>
        <div class="card-body result">
            <div class="table-responsive">
                <table class="table table-bordered text-dark" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Mã đơn hàng</th>
                        <th>Tên người dùng</th>
                        <th>Tên người nhận</th>
                        <th>Địa chỉ</th>
                        <th>Số điện thoại</th>
                        <th>Ngày đặt</th>
                        <th>Tổng tiền</th>
                        <th>Trạng thái</th>
                        <th>Thao tác</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($donhangs as $dh)
                        <tr>
                            <th>{{$dh->MaDH}}</th>
                            <th>{{$dh->nguoidung->TenND}}</th>
                            <th>{{$dh->TenKH}}</th>
                            <th>{{$dh->DiaChi}}</th>
                            <th>{{$dh->SDT}}</th>
                            <th>{{$dh->NgayDat}}</th>
                            <th>{{ number_format($dh->TongTien) }}đ</th>
                            <th>{{$dh->trangthai->TenTT}}</th>
                            <th>
                                <a href="{{route('donhang.ctdonhang',$dh->MaDH)}}">Chi tiết</a>
                                <a href="" class="btn btn-primary" data-toggle="modal" data-target="#myModal-{{$dh->MaDH}}">Xử lý</a>
                                <!-- The Modal -->
                                <div class="modal fade" id="myModal-{{$dh->MaDH}}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title">Xử lý đơn hàng số: {{$dh->MaDH}}</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <form action="{{route('donhang.xuly',$dh->MaDH)}}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <!-- Modal body -->
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="nvgh" class="col-6">Chọn nhân viên giao đơn hàng:</label>
                                                        <select name="MaNVGH" id="nvgh" class="form-control col-6">
                                                            @foreach($nhanviengiaohangs as $nvgh)
                                                                <option value="{{$nvgh->MaND}}">{{$nvgh->TenND}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <!-- Modal footer -->
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">Xử lý</button>
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
                                                </div>

                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- END Modal -->
                            </th>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection