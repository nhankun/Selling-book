<?php

namespace App\Http\Controllers;

use App\CTDonHang;
use App\DonHang;
use App\NguoiDung;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DonHangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $MaLND = \auth()->user()->MaLND;
        if ($MaLND == 2 || $MaLND == 3)
        {
            $donhangs = DonHang::orderby('MaDH','desc')->get();
            return view('admin.donhang.cardQLandAD',compact(['donhangs','title']));
        }
        return redirect()->route('admin.404');
    }

    public function locTheoDieuKien(Request $request)
    {
        $key = $request->key;
        //All
        if ($key ==1)
        {
            $donhangs = DonHang::orderby('MaDH','desc')->get();
            if ($request->ajax()) {
                return view('admin.donhang.partials.card',compact('donhangs'))->render();
            }
        }
        //Chờ xử lý
        if ($key ==2)
        {
            $donhangs = DonHang::where('MaTT',1)->orderby('MaDH','desc')->get();
            if ($request->ajax()) {
                return view('admin.donhang.partials.card',compact(['donhangs']))->render();
            }
        }
        //đã xủ lý
        if ($key ==3)
        {
            $donhangs = DonHang::where('MaTT',2)->orderby('MaDH','desc')->get();
            if ($request->ajax()) {
                return view('admin.donhang.partials.card',compact(['donhangs']))->render();
            }
        }
        //đang giao
        if ($key ==4)
        {
            $donhangs = DonHang::where('MaTT', 3)->orderby('MaDH', 'desc')->get();
            if ($request->ajax()) {
                return view('admin.donhang.partials.card',compact('donhangs'))->render();
            }
        }
        //đã giao
        if ($key ==5)
        {
            $donhangs = DonHang::where('MaTT',4)->orderby('MaDH','desc')->get();
            if ($request->ajax()) {
                return view('admin.donhang.partials.card',compact('donhangs'))->render();
            }
        }
        return view('admin.donhang.partials.notfound')->render();
    }

    public function showXulydonhang()
    {
        $MaLND = \auth()->user()->MaLND;
        if ($MaLND == 2 || $MaLND == 3) {
            $donhangs = DonHang::where('MaTT', 1)->orderby('MaDH', 'desc')->get();
            $nhanviengiaohangs = NguoiDung::where('MaLND', 5)->get();
            return view('admin.donhang.cardXuLy', compact(['donhangs', 'nhanviengiaohangs']));
        }
        return redirect()->route('admin.404');
    }
    public function xulydonhang(Request $request, $MaDH)
    {
        $MaNVGH = $request->MaNVGH;
        $donhang = DonHang::find($MaDH);
        $MaLND = \auth()->user()->MaLND;
        if ($donhang && $MaLND == 2)
        {
            $donhang->update(['MaNVGH'=>$MaNVGH,'MaQTV'=> \auth()->user()->MaND,'MaQL'=>null,'MaTT'=>2]);
        }
        if ($donhang && $MaLND == 3)
        {
            $donhang->update(['MaNVGH'=>$MaNVGH,'MaQL'=>\auth()->user()->MaND,'MaQTV'=>null,'MaTT'=>2]);
        }
        $donhangs = DonHang::where('MaTT',1)->orderby('MaDH','desc')->get();
        $nhanviengiaohangs = NguoiDung::where('MaLND',5)->get();
        return redirect()->route('donhang.getxuly',compact(['donhangs','nhanviengiaohangs']))
            ->with('success','Xử lý thành công đơn hàng số '.$donhang->MaDH);
    }

    public function getUpdatexulydonhang()
    {
        $ngdung = \auth()->user();
        $MaLND = $ngdung->MaLND;
        if ($MaLND == 2 || $MaLND == 3) {
            $donhangs = DonHang::where('MaTT', 2)->where('MaQL','=',$ngdung->MaND)
                ->orwhere('MaTT', 2)->where('MaQTV','=',$ngdung->MaND)
                ->orderby('MaDH', 'desc')->get();
            $nhanviengiaohangs = NguoiDung::where('MaLND', 5)->get();
            return view('admin.donhang.cardChinhSua', compact(['donhangs', 'nhanviengiaohangs']));
        }
        return redirect()->route('admin.404');
    }

    public function updatexulydonhang(Request $request, $MaDH)
    {
        $MaNVGH = $request->MaNVGH;
        $donhang = DonHang::find($MaDH);
        $ngnhap = \auth()->user();
        $nhanviengiaohangs = NguoiDung::where('MaLND',5)->get();
        $MaLND = \auth()->user()->MaLND;
        if ($donhang && $MaLND == 2)
        {
            $donhang->update(['MaNVGH'=>$MaNVGH,'MaQTV'=> \auth()->user()->MaND,'MaTT'=>2]);
            $donhangs = DonHang::where('MaTT', 2)->orderby('MaDH', 'desc')->get();
            return redirect()->route('donhang.getupdatexuly', compact(['donhangs', 'nhanviengiaohangs']))
                ->with('success' ,'Thay đổi nhân viên giao hàng thành công!');
        }
        //quản lý chỉ được sửa cái do quản lý xử lý
        if ($ngnhap->canEditGH($donhang)==true)
        {
            $donhang->update(['MaNVGH'=>$MaNVGH,'MaQL'=>\auth()->user()->MaND,'MaTT'=>2]);
            $donhangs = DonHang::where('MaTT',2)->orderby('MaDH','desc')->get();
            return redirect()->route('donhang.getupdatexuly',compact(['donhangs','nhanviengiaohangs']))
                ->with('success' ,'Thay đổi nhân viên giao hàng thành công :)!');
        }
//        dd($ngnhap->canEditGH($donhang));

        $donhangs = DonHang::where('MaTT', 2)->orderby('MaDH', 'desc')->get();
        return redirect()->route('donhang.getupdatexuly', compact(['donhangs', 'nhanviengiaohangs']))
                ->with('error' ,'Bạn không đủ điều kiện để thực hiện quyền này! <br> Vui lòng liên hệ admin!');
    }
    public function getxuathang()
    {
        $NVK = \auth()->user();
        $MaLND = $NVK->MaLND;
        if ($MaLND == 4) {
            $donhangs = DonHang::where('MaTT', 2)->orderby('MaDH', 'desc')->get();
            return view('admin.donhang.cardxuathang', compact('donhangs'));
        }
        return redirect()->route('admin.404');
    }
    public function xuathang($MaDH)
    {
        $donhang = DonHang::find($MaDH);
        $NVK = \auth()->user();
        $MaLND = $NVK->MaLND;
        if ($donhang && $MaLND == 4){
            $donhang->update(['MaTT'=>3,'MaNVK'=>$NVK->MaND]);
        }else{
            return redirect()->route('admin.404');
        }
        return redirect()->back();

    }

    public function getgiaohang()
    {
        $ngdung = \auth()->user();
        $MaLND = $ngdung->MaLND;
        if ($MaLND == 5) {
            $donhangs = DonHang::where('MaTT', 3)
                ->Where('MaNVGH', $ngdung->MaND)
                ->orderby('MaDH', 'desc')
                ->get();
            return view('admin.donhang.cardgiaohang',compact(['donhangs']));
        }

        return redirect()->route('admin.404');
    }
    //sulai
    public function giaohang($MaDH)
    {
        $donhang = DonHang::find($MaDH);
        $ngdung = \auth()->user();
        if ($ngdung->canGiaoHang($donhang)==true) {
            $MaLND = $ngdung->MaLND;
            if ($donhang && $MaLND == 5) {
                $donhang->update(['MaTT' => 4, 'NgayGiao' => date('y-m-d H:i:s')]);
            } else {
                return redirect()->route('admin.404');
            }
            return redirect()->back();
        }
        return redirect()->route('admin.404');
    }

    public function chiTietDonHang($code)
    {
        $donhanged = DonHang::find($code);
        $ctdonhangs = CTDonHang::where('MaDH','=',$donhanged->MaDH)->orderby('MaCTDH','desc')->get();
        $title = 'Chi tiết đơn hàng #'.$donhanged->MaDH;
        return view('admin.donhang.chitietcard',compact(['ctdonhangs','title','donhanged']));
    }
}
