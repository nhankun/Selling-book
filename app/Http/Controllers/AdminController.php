<?php

namespace App\Http\Controllers;

use App\DonHang;
use App\NguoiDung;
use App\NhaCungCap;
use App\SanPham;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index()
    {
        $ngdungs = NguoiDung::all();
        $donhangs = DonHang::all();
        $sanphams = SanPham::all();
        $nhacungcaps = NhaCungCap::all();

//        $something = DB::table('donhang')->where('MaTT','=',4)
//            ->whereRaw('Year(NgayGiao)= 2019')
//            ->get(['MaDH','TongTien', 'NgayGiao'])
//            ->groupBy(function($date) {
//            return Carbon::parse(strtotime($date->NgayGiao))->format('m');
//        });
        //Lấy Tổng tiền đơn hàng của tất cả các tháng trong năm hiện tại
        $something = DB::table('donhang')
            ->select(DB::raw('Month(NgayGiao) as month,Sum(TongTien) as doanhthu, NgayGiao'))
            ->where('MaTT','=',4)
            ->whereRaw('Year(NgayGiao)= Year(CURDATE())')
            ->groupBy(DB::Raw('Month(NgayGiao)'))
            ->orderBy('month','desc')
            ->get();
//        dd($something);
        $tongDoanhThuTheoNam = DB::table('donhang')
            ->select(DB::raw('Sum(TongTien) as doanhthu'))
            ->where('MaTT','=',4)
            ->whereRaw('Year(NgayGiao)= Year(CURDATE())')
            ->first();
        return view('admin.dashboard',
            compact(['ngdungs','donhangs','sanphams','nhacungcaps','tongDoanhThuTheoNam','something']));
    }

    public function getthongke()
    {
        $results = DB::table('donhang')
            ->select(DB::raw('Count(MaDH) as TongDH,Sum(TongTien) as doanhthu, NgayGiao'))
            ->whereRaw('MaTT = 4 and Year(NgayGiao)= Year(CURDATE())')
            ->groupBy(DB::Raw("Month(NgayGiao)"))
            ->get();
        $date = 'Năm '.date('Y',strtotime(now()));
        $countDHByYear = DB::table('donhang')
            ->select(DB::raw('Count(MaDH) as TongDH,Sum(TongTien) as doanhthu'))
            ->where('MaTT','=',4)
            ->whereRaw('Year(NgayGiao)= Year(CURDATE())')
            ->get();
        return view('admin.thongke.thongke',compact(['results','date','countDHByYear']));
    }

    public function thongke(Request $request)
    {
        if (!empty($request->day) && !empty($request->month)&& !empty($request->year))
        {
            $date = $request->day.'/'.$request->month.'/'.$request->year;
            $results = DB::table('donhang')
                ->select(DB::raw('Count(MaDH) as TongDH,Sum(TongTien) as doanhthu, NgayGiao'))
                ->whereRaw('MaTT = 4 and Year(NgayGiao)= ? and Month(NgayGiao) = ? and Day(NgayGiao) = ?',
                    [$request->year,$request->month,$request->day])
                ->get();
            $countDHByDay = DB::table('donhang')
                ->select(DB::raw('Count(MaDH) as TongDH,Sum(TongTien) as doanhthu'))
                ->whereRaw('MaTT = 4 and Year(NgayGiao)= ? and Month(NgayGiao) = ? and Day(NgayGiao) = ?',
                    [$request->year,$request->month,$request->day])
                ->get();
            return view('admin.thongke.partials.ngay',compact(['results','date','countDHByDay']));
        }
        if (!empty($request->month)&& !empty($request->year))
        {
            $date = $request->month.'/'.$request->year;
            $results = DB::table('donhang')
                ->select(DB::raw('Count(MaDH) as TongDH,Sum(TongTien) as doanhthu, NgayGiao'))
//            ->where('MaTT','=',4)
                ->whereRaw('MaTT = 4 and Year(NgayGiao)= ? and Month(NgayGiao) = ?',
                    [$request->year,$request->month])
                ->groupBy(DB::Raw('Day(NgayGiao)'))
//            ->orderBy('month','asc')
                ->get();
            $countDHByMonth = DB::table('donhang')
                ->select(DB::raw('Count(MaDH) as TongDH,Sum(TongTien) as doanhthu'))
                ->whereRaw('MaTT = 4 and Year(NgayGiao)= ? and Month(NgayGiao) = ?',
                    [$request->year,$request->month])
                ->get();
            return view('admin.thongke.partials.thang',compact(['results','date','countDHByMonth']));
        }
        if (!empty($request->month)&& !empty($request->day))
        {
            $date = $request->day.'/'.$request->month;
            $results = DB::table('donhang')
                ->select(DB::raw('Count(MaDH) as TongDH,Sum(TongTien) as doanhthu, NgayGiao'))
//            ->where('MaTT','=',4)
                ->whereRaw('MaTT = 4 and Day(NgayGiao)= ? and Month(NgayGiao) = ? and Year(CURDATE())',
                    [$request->day,$request->month])
//                ->groupBy(DB::Raw('Day(NgayGiao)'))
//            ->orderBy('month','asc')
                ->get();
            $countDHByDay = DB::table('donhang')
                ->select(DB::raw('Count(MaDH) as TongDH,Sum(TongTien) as doanhthu'))
                ->whereRaw('MaTT = 4 and Day(NgayGiao)= ? and Month(NgayGiao) = ? and Year(CURDATE())',
                    [$request->day,$request->month])
                ->get();
            return view('admin.thongke.partials.ngay',compact(['results','date','countDHByDay']));
        }
        if (!empty($request->month))
        {
            $date = 'Tháng '.$request->month.'/'.date('Y',strtotime(now()));
            $results = DB::table('donhang')
                ->select(DB::raw('Month(NgayGiao) as month,Count(MaDH) as TongDH,Sum(TongTien) as doanhthu, NgayGiao'))
                ->where('MaTT','=',4)
                ->whereRaw('Month(NgayGiao) = ? and Year(NgayGiao)= Year(CURDATE())',[$request->month])
                ->groupby(DB::raw('Day(NgayGiao)'))
                ->orderBy('month','desc')
                ->get();
            $countDHByMonth =  DB::table('donhang')
                ->select(DB::raw('Count(MaDH) as TongDH,Sum(TongTien) as doanhthu'))
                ->where('MaTT','=',4)
                ->whereRaw('Month(NgayGiao) = ? and Year(NgayGiao)= Year(CURDATE())',[$request->month])
                ->get();
            return view('admin.thongke.partials.thang',compact(['results','date','countDHByMonth']));
        }
        if (!empty($request->year))
        {
            $results = DB::table('donhang')
                ->select(DB::raw('Month(NgayGiao) as month,Count(MaDH) as TongDH,Sum(TongTien) as doanhthu, NgayGiao'))
                ->whereRaw('MaTT = 4 and Year(NgayGiao)= ?',[$request->year])
                ->groupBy(DB::Raw("Month(NgayGiao)"))
                ->orderBy('month','desc')
                ->get();
            $countDHByYear =  DB::table('donhang')
                ->select(DB::raw('Count(MaDH) as TongDH,Sum(TongTien) as doanhthu'))
                ->whereRaw('MaTT = 4 and Year(NgayGiao)= ?',[$request->year])
                ->get();
            $date = 'Năm '.$request->year;
            return view('admin.thongke.partials.nam',compact(['results','date','countDHByYear']));
        }

        $results = DB::table('donhang')
            ->select(DB::raw('Count(MaDH) as TongDH,Sum(TongTien) as doanhthu, NgayGiao'))
            ->whereRaw('MaTT = 4 and Year(NgayGiao)= Year(CURDATE())')
            ->groupBy(DB::Raw("Month(NgayGiao)"))
            ->get();
        $date = 'Năm '.date('Y',strtotime(now()));
        $countDHByYear = DB::table('donhang')
            ->select(DB::raw('Count(MaDH) as TongDH,Sum(TongTien) as doanhthu'))
            ->where('MaTT','=',4)
            ->whereRaw('Year(NgayGiao)= Year(CURDATE())')
            ->get();
        return view('admin.thongke.partials.nam',compact(['results','date','countDHByYear']));
    }

//    public function tongDoanhThuHangThangCuaNam($year)
//    {
//        $donhangdtthang = DonHang::where('MaTT','=',4)->orderby('NgayGiao')->get();
//        $something = DB::table('donhang')
//            ->select(DB::raw('Month(NgayGiao) as month,Sum(TongTien) as doanhthu, NgayGiao'))
////            ->where('MaTT','=',4)
//            ->whereRaw('MaTT = 4 and Year(NgayGiao)= :year)',[$year])
//            ->groupBy(DB::Raw('Month(NgayGiao)'))
////            ->orderBy('month','asc')
//            ->get();
//
//    }
//    public function tongDoanhThuHangNgayCuaThangNamHienTai($month)
//    {
//        $something = DB::table('donhang')
//            ->select(DB::raw('Day(NgayGiao) as day,Sum(TongTien) as doanhthu, NgayGiao'))
////            ->where('MaTT','=',4)
//            ->whereRaw('MaTT = 4 and Year(NgayGiao)= Year(CURDATE())) and Month(NgayGiao) = :month',[$month])
//            ->groupBy(DB::Raw('Day(NgayGiao)'))
////            ->orderBy('month','asc')
//            ->get();
//    }
}
