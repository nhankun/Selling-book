<?php

namespace App\Http\Controllers;

use App\TacGia;
use Illuminate\Http\Request;

class TacGiaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tacgias = TacGia::all();
        return view('admin.tacgia.list',compact('tacgias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tacgia.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'tenTG' => 'required|unique:tacgia|max:155',
            'diaChi' => 'required|max:155',
            'sDT' => 'required|max:15',
        ];
        $customMessages = [
            'required' => 'Bạn phải nhập :attribute!',
            'unique' => ':attribute không được trùng nhau!',
            'max' => ':attribute không được dài quá :max ký tự !',
        ];
        $customValidationAttributes = [
            'tenTG' => 'Tên tác giả',
            'diaChi' => 'Địa chỉ',
            'sDT' => 'Số điện thoại'
        ];
        $this->validate($request, $rules, $customMessages,$customValidationAttributes);
        $tacgia = new TacGia();
        $tacgia->TenTG = $request->tenTG;
        $tacgia->DiaChi = $request->diaChi;
        $tacgia->SDT = $request->sDT;
        $tacgia->GioiThieu = $request->gioiThieu;
        $tacgia->save();
        return redirect()
            ->route('tacgia.create')
            ->with('success','Thêm tác giả thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TacGia  $tacGias
     * @return \Illuminate\Http\Response
     */
    public function show(TacGia $tacGias)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TacGia  $tacGias
     * @return \Illuminate\Http\Response
     */
    public function edit($MaTG)
    {
        $tacgia = TacGia::find($MaTG);
        return view('admin.tacgia.edit',compact('tacgia'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TacGia  $tacGias
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $MaTG)
    {
        $rules = [
            'tenTG' => 'required|unique:tacgia|max:155',
            'diaChi' => 'required|max:155',
            'sDT' => 'required|max:15',
        ];
        $customMessages = [
            'required' => 'Bạn phải nhập :attribute!',
            'unique' => ':attribute không được trùng nhau!',
            'max' => ':attribute không được dài quá :max ký tự !',
        ];
        $customValidationAttributes = [
            'tenTG' => 'Tên tác giả',
            'diaChi' => 'Địa chỉ',
            'sDT' => 'Số điện thoại'
        ];
        $this->validate($request, $rules, $customMessages,$customValidationAttributes);
        $tacgia = TacGia::find($MaTG);
        $tacgia->TenTG = $request->tenTG;
        $tacgia->DiaChi = $request->diaChi;
        $tacgia->SDT = $request->sDT;
        $tacgia->GioiThieu = $request->gioiThieu;
        $tacgia->save();
        return redirect()
            ->route('tacgia.index')
            ->with('success','Bạn đã sửa thành công tác giả số '.$tacgia->MaTG.'!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TacGia  $tacGias
     * @return \Illuminate\Http\Response
     */
    public function destroy($MaTG)
    {
        $tacgia = TacGia::find($MaTG);
        if(count($tacgia->sanPhams)>0){
            return redirect()
                ->route('tacgia.index')
                ->with('error','Khổng thể xóa tác giả "'.$tacgia->TenTG.'"!');
        }
        $tacgia->delete();
        return redirect()
            ->route('tacgia.index')
            ->with('success','Xóa thành công '.$tacgia->TenTG.'!');
    }
}
