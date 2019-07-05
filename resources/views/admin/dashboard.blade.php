@extends('admin.layouts.master')
@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Người dùng (tất cả)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{count($ngdungs)}} Người dùng</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Đơn hàng (Tất cả)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{count($donhangs)}} đơn</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-shopping-cart fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Sản phẩm</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{count($sanphams)}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-book fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Nhà cung cấp</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{count($nhacungcaps)}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-parachute-box fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">KIẾM TIỀN (THÁNG {{$something[0]->month}})</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{number_format($something[0]->doanhthu)}} đ</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">KIẾM TIỀN (HÀNG NĂM)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{number_format($tongDoanhThuTheoNam->doanhthu)}} đ</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Đơn hàng đang giao</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{count(\App\DonHang::where('MaTT','=',3)->get())}} đơn</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-shopping-cart fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Đơn hàng cần xử lý</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{count(\App\DonHang::where('MaTT','=',1)->get())}} đơn</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-shopping-cart fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->

    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Tổng tiền đơn hàng bán được theo tháng (năm {{date('Y',strtotime($something[0]->NgayGiao))}})</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tr>
                                @foreach($something as $dhdt)
                                <th> Tháng {{$dhdt->month}}</th>
                                @endforeach
                                {{--<th>1</th>--}}
                                {{--<th>2</th>--}}
                                {{--<th>3</th>--}}
                                {{--<th>4</th>--}}
                                {{--<th>5</th>--}}
                                {{--<th>6</th>--}}
                                {{--<th>7</th>--}}
                                {{--<th>8</th>--}}
                                {{--<th>9</th>--}}
                                {{--<th>10</th>--}}
                                {{--<th>11</th>--}}
                                {{--<th>12</th>--}}
                            </tr>
                            <tr>
                                {{--@foreach($something as $key => $dhdt)--}}
                                    {{--@for($thang =1;$thang<=12;$thang++)--}}
                                        {{--@php($tt=0)--}}
                                           {{--@if($key == $thang)--}}
                                               {{--{{dd($something)}}--}}
                                               {{--@foreach($dhdt as $dh1)--}}
                                                    {{--@php($tt += $dh1->TongTien)--}}
                                                {{--@endforeach--}}

                                                {{--<td>{{$tt}}</td>--}}
                                                {{--@php($tt =0)--}}

                                            {{--@break($dh1)--}}

                                            {{--@else--}}
                                               {{--<td>{{$tt=0}}</td>--}}
                                            {{--@endif--}}
                                    {{--@endfor--}}
                                {{--@endforeach--}}
                                {{--@foreach($something as $kt)--}}
                                    {{--@for($thang =1;$thang<12;$thang++)--}}
                                            {{--@if($thang==$kt->month)--}}
                                                {{--@foreach($something as $dhdt)--}}
                                                    {{--<td>{{$dhdt->doanhthu}} đ</td>--}}
                                                {{--@endforeach--}}
                                            {{--@else--}}
                                                {{--<td>0 đ</td>--}}
                                            {{--@endif--}}

                                    {{--@endfor--}}
                                    {{--@break($kt)--}}
                                {{--@endforeach--}}
                                @foreach($something as $dhdt)
                                    <td>{{number_format($dhdt->doanhthu)}} đ</td>
                                @endforeach
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pie Chart -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Đơn hàng</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <table class="table-hover col-12">
                        <tr>
                            <td><span class="p-2 font-weight-bold" style="background-color: #00cc00;color: #ffffff;border-radius: 1em">Chờ xử lý</span></td>
                            <td class="p-2 font-weight-bold">{{count(\App\DonHang::where('MaTT','=',1)->get())}}</td>
                        </tr>
                        <tr>
                            <td><span class="p-2 font-weight-bold" style="background-color: #cc86b7;color: #ffffff;border-radius: 1em">Đã xử lý</span></td>
                            <td class="p-2 font-weight-bold">{{count(\App\DonHang::where('MaTT','=',2)->get())}}</td>
                        </tr>
                        <tr>
                            <td><span class="p-2 font-weight-bold" style="background-color: #719acc;color: #ffffff;border-radius: 1em">Đang giao</span></td>
                            <td class="p-2 font-weight-bold">{{count(\App\DonHang::where('MaTT','=',3)->get())}}</td>
                        </tr>
                        <tr>
                            <td><span class="p-2 font-weight-bold" style="background-color: #64cc2f;color: #ffffff;border-radius: 1em">giao thành công</span></td>
                            <td class="p-2 font-weight-bold">{{count(\App\DonHang::where('MaTT','=',4)->get())}}</td>
                        </tr>
                        {{--<tr>--}}
                            {{--<td class="p-2">Đã hủy</td>--}}
                            {{--<td class="p-2">{{count(\App\DonHang::where('MaTT','=',5)->get())}}</td>--}}
                        {{--</tr>--}}
                        {{--<tr>--}}
                            {{--<td class="p-2">Trả lại</td>--}}
                            {{--<td class="p-2">{{count(\App\DonHang::where('MaTT','=',6)->get())}}</td>--}}
                        {{--</tr>--}}
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection