<div class="row justify-content-center">
    <p>
        @if(isset($date))
            <span>Thống kê theo: </span> {{$date}}
        @endif
    </p>
</div>
<div class="table-responsive">
    <table class="table table-bordered text-dark"  width="100%" cellspacing="0">
        <thead>
        <tr>
            <th class="text-center">Số thứ tự</th>
            <th class="text-center">Thống kê theo</th>
            <th class="text-center">Tổng đơn hàng</th>
            <th class="text-center">Tổng tiền</th>
        </tr>
        </thead>
        <tbody>

        @foreach($results as $key => $rs)
            <tr>
                <td class="text-center">{{$key}}</td>
                @if(isset($rs->NgayGiao))
                    <td class="text-center">{{date('d/m/Y',strtotime($rs->NgayGiao))}}</td>
                @else
                    <th></th>
                @endif
                <td class="text-center">{{$rs->TongDH}}</td>
                <td class="text-center">{{number_format($rs->doanhthu)}} đ</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="2" class="text-center">Tổng Cộng</td>
            <td class="text-center">{{$countDHByMonth[0]->TongDH}}</td>
            <td class="text-center">{{number_format($countDHByMonth[0]->doanhthu)}} đ</td>
        </tr>

        </tbody>
    </table>
</div>