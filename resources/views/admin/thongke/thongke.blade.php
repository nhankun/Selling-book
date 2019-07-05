@extends('admin.layouts.master')
@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Admin</a></li>
            <li class="breadcrumb-item active text-dark" aria-current="page">Thống kê</li>
        </ol>
    </nav>

    <!-- Page Heading -->
    <div class="text-center">
        <h1 class="h3 mb-2 text-dark">Thống kê doanh thu đơn hàng</h1>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row justify-content-center">
                <script src="https://code.jquery.com/jquery-latest.js"></script>
                <script>
                    $(function(){
                        //Năm tự động điền vào select
                        var seYear = $('#year');
                        var date = new Date();
                        var cur = date.getFullYear();

                        seYear.append('<option value="">-- Year --</option>');
                        for (i = cur; i >= 1900; i--) {
                            seYear.append('<option value="'+i+'">'+i+'</option>');
                        };

                        //Tháng tự động điền vào select
                        var seMonth = $('#month');
                        var date = new Date();

                        var month=new Array();
                        month[1]="1";
                        month[2]="2";
                        month[3]="3";
                        month[4]="4";
                        month[5]="5";
                        month[6]="6";
                        month[7]="7";
                        month[8]="8";
                        month[9]="9";
                        month[10]="10";
                        month[11]="11";
                        month[12]="12";

                        seMonth.append('<option value="">-- Month --</option>');
                        for (i = 12; i > 0; i--) {
                            seMonth.append('<option value="'+i+'">'+month[i]+'</option>');
                        };

                        //Ngày tự động điền vào select
                        function dayList(month,year) {
                            var day = new Date(year, month, 0);
                            return day.getDate();
                        }

                        $('#year, #month').change(function(){
                            //Đoạn code lấy id không viết bằng jQuery để phù hợp với đoạn code bên dưới
                            var y = document.getElementById('year');
                            var m = document.getElementById('month');
                            var d = document.getElementById('day');

                            var year = y.options[y.selectedIndex].value;
                            var month = m.options[m.selectedIndex].value;
                            var day = d.options[d.selectedIndex].value;
                            if (day == ' ') {
                                var days = (year == ' ' || month == ' ')? 31 : dayList(month,year);
                                d.options.length = 0;
                                d.options[d.options.length] = new Option('-- Day --',' ');
                                for (var i = 1; i <= days; i++)
                                    d.options[d.options.length] = new Option(i,i);
                            }
                        });
                    });
                </script>
                <form class="form-inline" {{--action="{{route('thongke.thongke')}}" method="post"--}}>
                    @csrf
                    <label for="email2" class="mb-2 mr-sm-2">Ngày:</label>
                    <select  class="form-control mb-2 mr-sm-2" name="day" id="day"  >
                        <option value=" " selected="selected">-- Day --</option>
                    </select>

                    <label for="email2" class="mb-2 mr-sm-2">Tháng:</label>
                    <select  class="form-control mb-2 mr-sm-2" name="month" id="month"  ></select>

                    <label for="email2" class="mb-2 mr-sm-2">năm:</label>
                    <select class="form-control mb-2 mr-sm-2" name="year" id="year" ></select>

                    <button type="submit" class="btn btn-primary mb-2 thongke">Thống kê</button>
                </form>
            </div>
            <script src={{asset('admin/vendor/jquery/jquery.min.js')}}></script>
            <script type="text/javascript">
                $(document).ready(function () {
                    $(".thongke").click(function(e) {
                        e.preventDefault();
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        var _token = $('input[name="_token"]').val();
                        var day = $('select[name="day"]').val();
                        var month = $('select[name="month"]').val();
                        var year = $('select[name="year"]').val();
                        console.log(day, month, year);
                        $.ajax(
                            {
                                url: "{{route('thongke.thongke')}}",
                                method: "POST",
                                data: {'day': day,'month': month,'year': year, '_token': _token},
                                datatype: "html",
                            }).done(function (data) {
                            // alert('Thêm thành công!');
                            // console.log(data);
                            $('.result').empty().html(data);
                        }).fail(function (jqXHR, ajaxOptions, thrownError) {
                            // alert('No response from server');
                            console.log(jqXHR);
                        })
                    });
                });
            </script>

        </div>
        <div class="card-body result">
                @include('admin.thongke.partials.nam')
        </div>
    </div>

@endsection
