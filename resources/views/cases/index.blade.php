@extends('layouts.app')

@section('style')
    <style>
        .disabled-select {
            background-color: #d5d5d5;
            opacity: 0.5;
            border-radius: 3px;
            cursor: not-allowed;
            position: absolute;
            top: 0;
            bottom: 0;
            right: 0;
            left: 0;
        }

        select[readonly].select2-hidden-accessible+.select2-container {
            pointer-events: none;
            touch-action: none;
        }

        select[readonly].select2-hidden-accessible+.select2-container .select2-selection {
            background: #eee;
            box-shadow: none;
        }

        select[readonly].select2-hidden-accessible+.select2-container .select2-selection__arrow,
        select[readonly].select2-hidden-accessible+.select2-container .select2-selection__clear {
            display: none;
        }

        .modal-xxl {
            max-width: 1500px !important;
        }
    </style>
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">


            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>{{-- จำนวนสินค้าคงเหลือทั้งหมดในคลัง --}}</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        {{-- <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Users Management</li> --}}
                        <a class="btn btn-success" id="CreateButton" {{-- data-toggle="modal" data-target="#CreateModal" --}}{{-- href="{{ route('cases.create') }}" --}}>
                            <i class="fas fa-truck"></i> สร้าง เรื่องที่ติดต่อ</a> &nbsp;
                        <a class="btn btn-danger delete_all_button" href="#"><i class="fa fa-trash"></i> ลบทั้งหมด</a>
                    </ol>

                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-truck"></i> เรื่องที่ติดต่อ</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                {{-- <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                    <i class="fas fa-times"></i>
                                </button> --}}
                            </div>
                        </div>

                        <div class="card-body">
                            @if ($message = Session::get('success'))
                                {{--  <div class="alert alert-success">
                                    <p>{{ $message }}</p>
                                </div> --}}
                                <script>
                                    toastr.success('{{ $message }}', {
                                        timeOut: 5000
                                    });
                                </script>
                            @endif
                            <form method="post" action="{{ route('cases.destroy_all') }}" name="delete_all"
                                id="delete_all">
                                @csrf
                                @method('POST')
                                <table id="Listview" class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th><input type="checkbox" id="check-all" class="flat"></th>
                                            <th>HN</th>
                                            <th>ชื่อสกุล</th>
                                            <th>เบอร์โทร</th>
                                            <th>วันที่ทำรายการ</th>
                                            <th>ประเภทเคส</th>
                                            <th>สถานะเคส</th>
                                            <th>สถานะการโอนสาย</th>
                                            <th>Agent</th>
                                            <th width="180px"></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </form>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

    <div class="modal fade" id="CreateModal">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h4 class="modal-title">เพิ่ม เรื่องที่ติดต่อ</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{-- @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong>Something went wrong.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif --}}
                    <div class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none;">
                        <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;">

                        <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true"></span>
                        </button>
                    </div>


                    {{-- 'route' => 'users.store', --}}
                    {!! Form::open(['method' => 'POST', 'class' => 'form']) !!}
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>HN : 99999</strong>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>ชื่อ-สกุล : นายสมมุติ ไม่สบาย</strong>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>ประเภทเคส:</strong>
                                <select style="width: 100%;" class="select2 select2_casetype1 form-control" id="casetype1"
                                    name="casetype1" multiple="multiple">
                                    <!-- <option value="" selected>Select Student</option>
                                                                                                                                                                                                                                                                                                                                                                                        <option value="" selected>Select Parent</option>-->
                                    @foreach ($casetype as $key2)
                                        <option value="{{ $key2->id }}">{{ $key2->name }}
                                        </option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>รายละเอียดเคส:</strong>
                                <select style="width: 100%;" class="select2 select2_casetype2 form-control" id="casetype2"
                                    name="casetype2" multiple="multiple">
                                    <!-- <option value="" selected>Select Student</option>
                                                                                                                                                                                                                                                                                                                                                                                        <option value="" selected>Select Parent</option>-->

                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>รายละเอียดเคสย่อย:</strong>
                                <select style="width: 100%;" class="select2 select2_casetype3 form-control" id="casetype3"
                                    name="casetype3" multiple="multiple">
                                    <!-- <option value="" selected>Select Student</option>
                                                                                                                                                                                                                                                                                                                                                                                        <option value="" selected>Select Parent</option>-->

                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>รายละเอียดเคส เพิ่มเติม 1:</strong>
                                <select style="width: 100%;" class="select2 select2_casetype4 form-control"
                                    id="casetype4" name="casetype4" multiple="multiple">
                                    <!-- <option value="" selected>Select Student</option>
                                                                                                                                                                                                                                                                                                                                                                                        <option value="" selected>Select Parent</option>-->

                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>รายละเอียดเคส เพิ่มเติม 2:</strong>
                                <select style="width: 100%;" class="select2 select2_casetype5 form-control"
                                    id="casetype5" name="casetype5" multiple="multiple">
                                    <!-- <option value="" selected>Select Student</option>
                                                                                                                                                                                                                                                                                                                                                                                        <option value="" selected>Select Parent</option>-->

                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>รายละเอียดเคส เพิ่มเติม 3:</strong>
                                <select style="width: 100%;" class="select2 select2_casetype6 form-control"
                                    id="casetype6" name="casetype6" multiple="multiple">
                                    <!-- <option value="" selected>Select Student</option>
                                                                                                                                                                                                                                                                                                                                                                                        <option value="" selected>Select Parent</option>-->

                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>รายละเอียด:</strong>
                                {!! Form::textarea('detail', null, [
                                    'rows' => 4,
                                    'id' => 'AddDetail',
                                    'class' => 'form-control',
                                ]) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>สถานะการโอนสาย :</strong>
                                <select style="width: 100%;" class="select2 select2_tranfer form-control"
                                    id="tranferstatus" name="tranferstatus" multiple="multiple">
                                    <option value="1">รับสาย</option>
                                    <option value="2">ไม่รับสาย</option>
                                    <option value="3">สายไม่ว่าง</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>สถานะการเคส :</strong>
                                <select style="width: 100%;" class="select2 select2_casestatus form-control"
                                    id="casestatus" name="casestatus" multiple="multiple">
                                    <option value="1">ปิดเคส</option>
                                    <option value="2">กำลังดำเนินการ</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
                <div class="modal-footer {{-- justify-content-between --}}">
                    <button type="button" class="btn btn-success" id="SubmitCreateForm">บันทึก</button>
                    <button type="button" class="btn btn-danger modelClose" data-dismiss="modal">ปิด</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit  Modal -->
    <div class="fade modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true"
        id="EditModal">
        <div class="modal-dialog modal-xl" role="document">
            <form id="editdata" class="form" action="" method="POST">
                <div class="modal-content">
                    <div class="modal-header bg-info">
                        <h4 class="modal-title" id="exampleModalLongTitle">แก้ไข รายการขาย</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert"
                            style="display: none;">
                            <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="alert alert-success alert-dismissible fade show" role="alert"
                            style="display: none;">
                            <strong>Success!</strong> Product was edit successfully.
                            <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true"></span>
                            </button>
                        </div>
                        <div id="EditModalBody">
                            {!! Form::open(['method' => 'POST', 'class' => 'form']) !!}
                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <strong>ประเภทเรื่องติดต่อ:</strong>
                                        {!! Form::text('lot', null, ['id' => 'EditLot', 'placeholder' => 'Order Number', 'class' => 'form-control']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>รายละเอียด:</strong>
                                        {!! Form::textarea('detail', null, [
                                            'rows' => 4,
                                            'id' => 'EditDetail',
                                            'class' => 'form-control',
                                        ]) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <strong>สถานะการโอนสาย:</strong>
                                        {!! Form::text('lot', null, ['id' => 'EditLot', 'placeholder' => 'Order Number', 'class' => 'form-control']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <strong>สถานะการเคส:</strong>
                                        {!! Form::text('amount', null, [
                                            'id' => 'EditAmount',
                                            'placeholder' => 'Amount',
                                            'class' => 'form-control',
                                            'readonly' => 'true',
                                        ]) !!}
                                    </div>
                                </div>

                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" id="SubmitEditForm">บันทึก</button>
                        <button type="button" class="btn btn-danger modelClose" data-dismiss="modal">ปิด</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    {{--  log modal --}}
    <div class="modal fade" id="LogModal">
        <div class="modal-dialog modal-xxl">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h4 class="modal-title">Log</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="log_table">

                </div>
                <div class="modal-footer {{-- justify-content-between --}}">
                    <button type="button" class="btn btn-danger modelClose" data-dismiss="modal">ปิด</button>
                </div>
            </div>
        </div>
    </div>

    <div class="js-event-log">

    </div>
    {{--  {!! $data->render() !!} --}}
@endsection

@section('script')
    <script>
        var $eventLog = $(".js-event-log");
        let fatotal = () => {
            let atotal = 0;
            let aamount = 0;
            $("input[name='total[]']").each(function() {
                let value = parseFloat(this.value);
                if (!isNaN(value)) {
                    atotal += value;
                }
            });
            $("input[name='amount[]']").each(function() {
                let value = parseFloat(this.value);
                if (!isNaN(value)) {
                    aamount += value;
                }
            });
            //alert(atotal);
            $('#AddTotalCost').val(atotal);
            $('#AddAmount').val(aamount);
        }

        let efatotal = () => {
            let atotal = 0;
            let aamount = 0;
            $("input[name='etotal[]']").each(function() {
                let value = parseFloat(this.value);
                if (!isNaN(value)) {
                    atotal += value;
                }
            });
            $("input[name='eamount[]']").each(function() {
                let value = parseFloat(this.value);
                if (!isNaN(value)) {
                    aamount += value;
                }
            });
            //alert(atotal);
            $('#EditTotalCost').val(atotal);
            $('#EditAmount').val(aamount);
        }

        let log = (name, evt) => {
            if (!evt) {
                var args = "{}";
            } else {
                var args = JSON.stringify(evt.params, function(key, value) {
                    if (value && value.nodeName) return "[DOM node]";
                    if (value instanceof $.Event) return "[$.Event]";
                    return value;
                });
            }
            var $e = $("<li>" + name + " -> " + args + "</li>");
            $eventLog.append($e);
            $e.animate({
                opacity: 1
            }, 10000, 'linear', function() {
                $e.animate({
                    opacity: 0
                }, 2000, 'linear', function() {
                    $e.remove();
                });
            });
        }

        $(document).ready(function() {

            $(".delete_all_button").click(function() {
                var len = $('input[name="table_records[]"]:checked').length;
                if (len > 0) {

                    if (confirm("ยืนยันการลบข้อมูล?")) {
                        $('form#delete_all').submit();
                    }
                } else {
                    alert("กรุณาเลือกรายการที่จะลบ");
                }

            });

            $('#check-all').click(function() {
                $(':checkbox.flat').prop('checked', this.checked);
            });

            $(".select2_tranfer").select2({
                maximumSelectionLength: 1,
                allowClear: true,
                //theme: 'bootstrap4'
                placeholder: 'กรุณาเลือกประเภทการโอนสาย'
            });

            $(".select2_single").on("select2:unselect", function(e) {
                //log("select2:unselect", e);
                $('.products').html('');
            });

            $(".select2_casestatus").select2({
                maximumSelectionLength: 1,
                allowClear: true,
                //theme: 'bootstrap4'
                placeholder: 'กรุณาเลือกสถานะเคส'
            });

            $(".select2_singlec").select2({
                maximumSelectionLength: 1,
                allowClear: true,
                //theme: 'bootstrap4'
                placeholder: 'กรุณาเลือกประเภทการติดต่อ'
            });


            $(".select2_casetype1").select2({
                maximumSelectionLength: 1,
                allowClear: true,
                //theme: 'bootstrap4'
                placeholder: 'กรุณาเลือกประเภทการติดต่อ'
            });
            $(".select2_casetype2").select2({
                maximumSelectionLength: 1,
                allowClear: true,
                //theme: 'bootstrap4'
                placeholder: 'รายละเอียดเคส'
            });
            $(".select2_casetype3").select2({
                maximumSelectionLength: 1,
                allowClear: true,
                //theme: 'bootstrap4'
                placeholder: 'รายละเอียดเคสย่อย'
            });
            $(".select2_casetype4").select2({
                maximumSelectionLength: 1,
                allowClear: true,
                //theme: 'bootstrap4'
                placeholder: 'รายละเอียดเคส เพิ่มเติม 1'
            });
            $(".select2_casetype5").select2({
                maximumSelectionLength: 1,
                allowClear: true,
                //theme: 'bootstrap4'
                placeholder: 'รายละเอียดเคส เพิ่มเติม 2'
            });
            $(".select2_casetype6").select2({
                maximumSelectionLength: 1,
                allowClear: true,
                //theme: 'bootstrap4'
                placeholder: 'รายละเอียดเคส เพิ่มเติม 3'
            });


            $("#price,#amount,#stock").on("change", function() {
                var parent = $(this).parent().parent().parent();

                var amount = parent.find('#amount').val();
                var price = parent.find('#price').val();
                var sid = parent.find('#stock').val();

                let total_cost = amount * price;
                parent.find('#total').val(total_cost)

                fatotal();
                if (sid !== null) {
                    $.ajax({
                        type: "GET",
                        dataType: 'JSON',
                        async: false,
                        url: "stocks/find/price/" + sid,
                        success: function(res) {
                            //console.log(res);
                            parent.find('#lot_price').html(
                                `***ควรขายที่ราคา ${res.cost} - ${res.price} บาท `);
                            if (parseInt(amount) > parseInt(res.remaining)) {
                                toastr.error('จำนวนที่จะขายมากกว่าจำนวนที่เหลือในล๊อต', {
                                    timeOut: 5000
                                });
                                parent.find('#lot_error').html(
                                    '***จำนวนที่จะขายมากกว่าจำนวนที่เหลือในล๊อต');
                                parent.find('#amount').val('')
                            } else {
                                parent.find('#lot_error').html('');
                            }
                        }
                    });
                }
            });

            $(document).on('change', '#eprice,#eamount,#estock', function(e) {
                var parent = $(this).parent().parent().parent();

                var amount = parent.find('#eamount').val();
                var amounth = parent.find('#eamounth').val();
                var price = parent.find('#eprice').val();
                var sid = parent.find('#estock').val();

                let total_cost = amount * price;
                parent.find('#etotal').val(total_cost)

                //alert(amounth);
                if (isNaN(parseInt(amounth))) {
                    amounth = 0;
                }

                efatotal();
                if (sid !== null) {
                    $.ajax({
                        type: "GET",
                        dataType: 'JSON',
                        async: false,
                        url: "stocks/find/price/" + sid,
                        success: function(res) {
                            //console.log(res);

                            //alert(parseInt(amounth));
                            //alert(parseInt(res.remaining)+parseInt(amounth));
                            parent.find('#elot_price').html(
                                `***ควรขายที่ราคา ${res.cost} - ${res.price} บาท `);
                            if (parseInt(amount) > (parseInt(res.remaining) + parseInt(
                                    amounth))) {
                                toastr.error('จำนวนที่จะขายมากกว่าจำนวนที่เหลือในล๊อต', {
                                    timeOut: 5000
                                });
                                parent.find('#elot_error').html(
                                    '***จำนวนที่จะขายมากกว่าจำนวนที่เหลือในล๊อต');
                                parent.find('#eamount').val('')
                            } else {
                                parent.find('#elot_error').html('');
                            }
                        }
                    });
                }
            });


            $("#EditCost,#EditAmount").on("keyup", function() {
                let cost = $("#EditCost").val();
                let amount = $("#EditAmount").val();

                let total_cost = amount * cost;
                $("#EditTotalCost").val(total_cost);

            });



            $(".productl").change(function() {
                let product = $('#AddProduct').val();
                //console.log(product);
                //alert(product);
                $('#AddStock').html('');
                if (product.length !== 0) {
                    $.ajax({
                        method: "GET",
                        url: "stocks/find/add/" + product,
                        success: function(res) {

                            //$('#AddStock').html(res.html);
                            $('.products').html(res.html);
                            //console.log(res);

                        }
                    });
                }

            })

            $(".producte").change(function() {
                let product = $('#EditProduct').val();
                //console.log(product);
                //alert(product);
                $('#EditStock').html('');
                if (product.length !== 0) {
                    $.ajax({
                        method: "GET",
                        url: "stocks/find/edit/" + product,
                        async: false,
                        success: function(res) {
                            $('#EditStock').html(res.html);
                            //console.log(res);

                        }
                    });
                }

            })

            //$.noConflict();
            var token = ''
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            var table = $('#Listview').DataTable({
                /*"aoColumnDefs": [
                {
                'bSortable': true,
                'aTargets': [0]
                } //disables sorting for column one
                ],
                "searching": false,
                "lengthChange": false,
                "paging": false,
                'iDisplayLength': 10,
                "sPaginationType": "full_numbers",
                "dom": 'T<"clear">lfrtip',
                    */
                ajax: '',
                serverSide: true,
                processing: true,
                language: {
                    loadingRecords: '&nbsp;',
                    processing: `<div class="spinner-border text-primary"></div>`,
                    "sProcessing": "กำลังดำเนินการ...",
                    "sLengthMenu": "แสดง_MENU_ แถว",
                    "sZeroRecords": "ไม่พบข้อมูล",
                    "sInfo": "แสดง _START_ ถึง _END_ จาก _TOTAL_ รายการ",
                    "sInfoEmpty": "แสดง 0 ถึง 0 จาก 0 รายการ",
                    "sInfoFiltered": "(กรองข้อมูล _MAX_ ทุกแถว)",
                    "sInfoPostFix": "",
                    "sSearch": "ค้นหา:",
                    "sUrl": "",
                    "oPaginate": {
                        "sFirst": "เริ่มต้น",
                        "sPrevious": "ก่อนหน้า",
                        "sNext": "ถัดไป",
                        "sLast": "สุดท้าย"
                    }
                },
                aaSorting: [
                    [0, "desc"]
                ],
                iDisplayLength: 10,
                lengthMenu: [10, 25, 50, 75, 100],
                stateSave: true,
                autoWidth: false,
                responsive: true,
                sPaginationType: "full_numbers",
                dom: 'T<"clear">lfrtip',
                columns: [{
                        data: 'checkbox',
                        name: 'checkbox',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'order_number',
                        name: 'order_number'
                    },
                    {
                        data: 'pid',
                        name: 'pid'
                    },
                    {
                        data: 'lot',
                        name: 'lot'
                    },
                    {
                        data: 'cid',
                        name: 'cid'
                    },
                    {
                        data: 'amount',
                        name: 'amount'
                    },
                    {
                        data: 'cost',
                        name: 'cost'
                    },
                    {
                        data: 'total_cost',
                        name: 'total_cost'
                    },

                    {
                        data: 'action',
                        name: 'action'
                    },
                ]
            });


            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });


            let lid;
            $(document).on('click', '#getLogData', function(e) {
                e.preventDefault();
                lid = $(this).data('id');
                $.ajax({
                    url: "orders/log/" + lid,
                    method: 'GET',
                    success: function(res) {
                        $('#log_table').html(res.html);
                        $('#LogModal').modal('show');
                    }
                });


            })


            $(document).on('click', '#CreateButton', function(e) {
                e.preventDefault();
                $('.alert-danger').html('');
                $('.alert-danger').hide();
                $('.alert-success').html('');
                $('.alert-success').hide();
                $('#CreateModal').modal('show');
            });


            $('#SubmitCreateForm').click(function(e) {
                e.preventDefault();
                $('.alert-danger').html('');
                $('.alert-danger').hide();
                $('.alert-success').html('');
                $('.alert-success').hide();

                var stockValues = [];
                var amountValues = [];
                var priceValues = [];
                var isValid = true;

                // Initializing array values
                $("select[name='stock[]']").each(function() {
                    stockValues.push(this.value);
                });

                // Check for duplicates in stock values
                var duplicateValues = stockValues.filter(function(value, index, self) {
                    return self.indexOf(value) !== index;
                });

                if (duplicateValues.length > 0) {
                    toastr.error('ไม่สามารถเลือกสินค้าล็อตเดียวกันในรายการขาย', {
                        timeOut: 5000
                    });
                    return false;
                }

                // Validate stock select
                var stockSelects = $("select[name='stock[]']");
                stockSelects.each(function() {
                    var stockSelect = $(this);
                    var selectedValue = stockSelect.val();

                    if (selectedValue === null || selectedValue.trim() === '') {
                        stockSelect.addClass("is-invalid");
                        stockSelect.removeClass("is-valid");
                        toastr.error('กรุณาเลือกสินค้าในคลังสินค้า', {
                            timeOut: 5000
                        });
                        isValid = false;
                    } else {
                        stockSelect.removeClass("is-invalid");
                        stockSelect.addClass("is-valid");
                    }
                });

                if (!isValid) {
                    return false;
                }

                // Collect amount values and validate
                $("input[name='amount[]']").each(function() {
                    var amountInput = $(this);
                    var value = parseFloat(amountInput.val());

                    if (isNaN(value) || value % 0.5 !== 0) {
                        // Invalid amount input
                        amountInput.addClass("is-invalid");
                        amountInput.removeClass("is-valid");
                        amountInput.siblings(".error-message").text(
                            "กรุณาระบุจำนวนที่จะขาย");
                        toastr.error('กรุณาระบุจำนวนที่จะขาย', {
                            timeOut: 5000
                        });
                        isValid = false;
                    } else {
                        // Valid amount input
                        amountInput.removeClass("is-invalid");
                        amountInput.addClass("is-valid");
                        amountValues.push(value);
                    }
                });

                if (!isValid) {
                    return false;
                }

                // Collect price values and validate
                $("input[name='price[]']").each(function() {
                    var priceInput = $(this);
                    var value = parseFloat(priceInput.val());

                    if (isNaN(value) || value <= 0) {
                        // Invalid price input
                        priceInput.addClass("is-invalid");
                        priceInput.removeClass("is-valid");
                        priceInput.siblings(".error-message").text(
                            "กรุณาระบุราคาที่จะขาย");
                        toastr.error('กรุณาระบุราคาที่จะขาย', {
                            timeOut: 5000
                        });
                        isValid = false;
                    } else {
                        // Valid price input
                        priceInput.removeClass("is-invalid");
                        priceInput.addClass("is-valid");
                        priceValues.push(value);
                    }
                });

                if (!isValid) {
                    return false;
                }

                if ($('#AddCompany').val()[0] !== undefined) {
                    var formData = {
                        order_number: $('#AddLot').val(),
                        sid: stockValues, // Only consider the first selected stock value
                        cid: $('#AddCompany').val()[0],
                        pid: $('#AddProduct').val()[0],
                        amount: amountValues,
                        price: priceValues,
                        tamount: $('#AddAmount').val(),
                        //cost: $('#AddCost').val(),
                        total_cost: $('#AddTotalCost').val(),
                        detail: $('#AddDetail').val(),
                        _token: token
                    };

                    $.ajax({
                        url: "{{ route('cases.store') }}",
                        method: 'post',
                        data: formData,
                        success: function(result) {
                            if (result.errors) {
                                $('.alert-danger').html('');
                                $.each(result.errors, function(key, value) {
                                    $('.alert-danger').show();
                                    $('.alert-danger').append('<strong><li>' + value +
                                        '</li></strong>');
                                });
                            } else {
                                $('.alert-danger').hide();
                                $('.alert-success').show();
                                $('.alert-success').text(result.success);
                                toastr.success(result.success, {
                                    timeOut: 5000
                                });
                                $('#Listview').DataTable().ajax.reload();
                                $("#AddProduct").val(null).trigger("change")
                                $("#AddStock").val(null).trigger("change")
                                $("#AddCompany").val(null).trigger("change")
                                $('.form').trigger('reset');
                                $('#CreateModal').modal('hide');
                            }
                        }
                    });

                } else {
                    toastr.error('กรุณากรอกข้อมูลให้ครบ', {
                        timeOut: 5000
                    });
                }
            });


            let id;
            $(document).on('click', '#getEditData', function(e) {
                e.preventDefault();


                $('.alert-danger').html('');
                $('.alert-danger').hide();
                $('.alert-success').html('');
                $('.alert-success').hide();




                id = $(this).data('id');
                $.ajax({
                    url: "orders/edit/" + id,
                    method: 'GET',
                    success: function(res) {
                        console.log(res);
                        $('#EditLot').val(res.data.order_number);
                        $('#EditProduct').val(res.data.pid).change();
                        $("select[name=eproduct]").attr("readonly", "readonly");
                        $('#EditStock').val(res.data.sid).change();
                        $("select[name=estock]").attr("readonly", "readonly");
                        $('#EditCompany').val(res.data.cid).change();
                        $('#EditAmount').val(res.data.amount);
                        $('#EditCost').val(res.data.cost);
                        $('#EditTotalCost').val(res.data.total_cost);
                        $('#EditDetail').val(res.data.detail);
                        $('#EditModalBodyTable').html(res.table_html);
                        $('#EditModal').modal('show');
                    }
                });

            })

            $('#SubmitEditForm').click(function(e) {
                if (!confirm("ยืนยันการทำรายการ ?")) return;
                e.preventDefault();

                $('.alert-danger').html('');
                $('.alert-danger').hide();
                $('.alert-success').html('');
                $('.alert-success').hide();

                var stockValues = [];
                var amountValues = [];
                var priceValues = [];
                var isValid = true;

                // Initializing array values
                $("select[name='estock[]']").each(function() {
                    stockValues.push(this.value);
                });

                // Check for duplicates in stock values
                var duplicateValues = stockValues.filter(function(value, index, self) {
                    return self.indexOf(value) !== index;
                });

                if (duplicateValues.length > 0) {
                    toastr.error('ไม่สามารถเลือกสินค้าล็อตเดียวกันในรายการขาย', {
                        timeOut: 5000
                    });
                    return false;
                }

                // Validate stock select
                var stockSelects = $("select[name='estock[]']");
                stockSelects.each(function() {
                    var stockSelect = $(this);
                    var selectedValue = stockSelect.val();

                    if (selectedValue === null || selectedValue.trim() === '') {
                        stockSelect.addClass("is-invalid");
                        stockSelect.removeClass("is-valid");
                        toastr.error('กรุณาเลือกสินค้าในคลังสินค้า', {
                            timeOut: 5000
                        });
                        isValid = false;
                    } else {
                        stockSelect.removeClass("is-invalid");
                        stockSelect.addClass("is-valid");
                    }
                });

                if (!isValid) {
                    return false;
                }

                // Collect amount values and validate
                $("input[name='eamount[]']").each(function() {
                    var amountInput = $(this);
                    var value = parseFloat(amountInput.val());

                    if (isNaN(value) || value % 0.5 !== 0) {
                        // Invalid amount input
                        amountInput.addClass("is-invalid");
                        amountInput.removeClass("is-valid");
                        amountInput.siblings(".error-message").text(
                            "กรุณาระบุจำนวนที่จะขาย");
                        toastr.error('กรุณาระบุจำนวนที่จะขาย', {
                            timeOut: 5000
                        });
                        isValid = false;
                    } else {
                        // Valid amount input
                        amountInput.removeClass("is-invalid");
                        amountInput.addClass("is-valid");
                        amountValues.push(value);
                    }
                });

                if (!isValid) {
                    return false;
                }

                // Collect price values and validate
                $("input[name='eprice[]']").each(function() {
                    var priceInput = $(this);
                    var value = parseFloat(priceInput.val());

                    if (isNaN(value) || value <= 0) {
                        // Invalid price input
                        priceInput.addClass("is-invalid");
                        priceInput.removeClass("is-valid");
                        priceInput.siblings(".error-message").text(
                            "กรุณาระบุราคาที่จะขาย");
                        toastr.error('กรุณาระบุราคาที่จะขาย', {
                            timeOut: 5000
                        });
                        isValid = false;
                    } else {
                        // Valid price input
                        priceInput.removeClass("is-invalid");
                        priceInput.addClass("is-valid");
                        priceValues.push(value);
                    }
                });

                if (!isValid) {
                    return false;
                }

                if ($('#EditCompany').val()[0] !== undefined) {
                    var formData = {
                        order_number: $('#EditLot').val(),
                        sid: stockValues, // Only consider the first selected stock value
                        cid: $('#EditCompany').val()[0],
                        pid: $('#EditProduct').val()[0],
                        amount: amountValues,
                        price: priceValues,
                        tamount: $('#EditAmount').val(),
                        //cost: $('#AddCost').val(),
                        total_cost: $('#EditTotalCost').val(),
                        detail: $('#EditDetail').val(),
                        _token: token
                    };

                    $.ajax({
                        url: "orders/save/" + id,
                        method: 'PUT',
                        data: formData,

                        success: function(result) {
                            //console.log(result);
                            if (result.errors) {
                                $('.alert-danger').html('');
                                $.each(result.errors, function(key, value) {
                                    $('.alert-danger').show();
                                    $('.alert-danger').append('<strong><li>' + value +
                                        '</li></strong>');
                                });
                            } else {
                                $('.alert-danger').hide();
                                $('.alert-success').show();
                                $('.alert-success').append('<strong><li>' + result.success +
                                    '</li></strong>');
                                $('#EditModal').modal('hide');
                                toastr.success(result.success, {
                                    timeOut: 5000
                                });
                                $('#Listview').DataTable().ajax.reload();
                                //setTimeout(function() {
                                //$('.alert-success').hide();

                                //}, 10000);

                            }
                        }
                    });
                } else {
                    toastr.error('กรุณากรอกข้อมูลให้ครบ', {
                        timeOut: 5000
                    });
                }
            });

            $(document).on('click', '.btn-delete', function() {
                if (!confirm("ยืนยันการทำรายการ ?")) return;

                var rowid = $(this).data('rowid')
                var el = $(this)
                if (!rowid) return;


                $.ajax({
                    type: "POST",
                    dataType: 'JSON',
                    url: "orders/destroy/",
                    data: {
                        id: rowid,
                        _method: 'delete',
                        _token: token
                    },
                    success: function(data) {
                        console.log(data);
                        if (data.success) {
                            toastr.success(data.message, {
                                timeOut: 5000
                            });
                            table.row(el.parents('tr'))
                                .remove()
                                .draw();
                        }
                    }
                }); //end ajax
            })


        });

        $(function() {

            $("#addRow").click(function() {
                // ส่วนของการ clone ข้อมูลด้วย jquery clone() ค่า true คือ
                // การกำหนดให้ ไม่ต้องมีการ ดึงข้อมูลจากค่าเดิมมาใช้งาน
                // รีเซ้ตเป็นค่าว่าง ถ้ามีข้อมูลอยู่แล้ว ทั้ง select หรือ input
                // $(".firstTr1:eq(0)").clone(true)
                //     .find("input").attr("value", "").end()
                //     .find("select").attr("value", "").end()
                //     .appendTo($("#myTbl"));
                $(".firstTr:eq(0)").clone(true)

                    .find("input").attr("value", "").end()
                    .find("select").attr("value", "").end()
                    .appendTo($("#myTbl"));


                efatotal();

            });
            $("#removeRow").click(function() {
                // // ส่วนสำหรับการลบ
                if ($("#myTbl tr").length > 2) { // จะลบรายการได้ อย่างน้อย ต้องมี 1 รายการ
                    $("#myTbl tr:last").remove(); // ลบรายการสุดท้าย
                    efatotal();
                } else {
                    // เหลือ 1 รายการลบไม่ได้
                    if ($("#myTbl tr").length > 1) {
                        //alert("ต้องมีรายการข้อมูลอย่างน้อย 1 รายการ");
                        toastr.success('ต้องมีรายการข้อมูลอย่างน้อย 1 รายการ', {
                            timeOut: 5000
                        });
                    }
                }
            });
            $(document).on('click', '.btnRemoveg', function() {
                // // ส่วนสำหรับการลบ
                if ($("#myTbl tr").length > 2) { // จะลบรายการได้ อย่างน้อย ต้องมี 1 รายการ
                    //$("#myTbl tr:last").remove(); // ลบรายการสุดท้าย
                    $(this).closest("tr").remove();
                    efatotal();
                } else {
                    // เหลือ 1 รายการลบไม่ได้
                    if ($("#myTbl tr").length > 1) {
                        //alert("ต้องมีรายการข้อมูลอย่างน้อย 1 รายการ");
                        toastr.success('ต้องมีรายการข้อมูลอย่างน้อย 1 รายการ', {
                            timeOut: 5000
                        });
                    }
                }
            });

            $("#addRow2").click(function() {
                // ส่วนของการ clone ข้อมูลด้วย jquery clone() ค่า true คือ
                // การกำหนดให้ ไม่ต้องมีการ ดึงข้อมูลจากค่าเดิมมาใช้งาน
                // รีเซ้ตเป็นค่าว่าง ถ้ามีข้อมูลอยู่แล้ว ทั้ง select หรือ input
                $(".firstTr3:eq(0)").clone(true)

                    .find("input").attr("value", "").end()
                    .find("select").attr("value", "").end()
                    .appendTo($("#myTbl3"));

                fatotal();
            });
            $("#removeRow2").click(function() {
                // // ส่วนสำหรับการลบ
                if ($("#myTbl3 tr").length > 2) { // จะลบรายการได้ อย่างน้อย ต้องมี 1 รายการ
                    $("#myTbl3 tr:last").remove(); // ลบรายการสุดท้าย
                    fatotal();
                } else {
                    // เหลือ 1 รายการลบไม่ได้
                    if ($("#myTbl3 tr").length > 1) {
                        //alert("ต้องมีรายการข้อมูลอย่างน้อย 1 รายการ");
                        toastr.success('ต้องมีรายการข้อมูลอย่างน้อย 1 รายการ', {
                            timeOut: 5000
                        });
                    }
                }
            });
            $(".btnRemoveg2").click(function() {
                // // ส่วนสำหรับการลบ
                if ($("#myTbl3 tr").length > 2) { // จะลบรายการได้ อย่างน้อย ต้องมี 1 รายการ
                    //$("#myTbl tr:last").remove(); // ลบรายการสุดท้าย
                    $(this).closest("tr").remove();
                    fatotal();
                } else {
                    // เหลือ 1 รายการลบไม่ได้
                    if ($("#myTbl3 tr").length > 1) {
                        //alert("ต้องมีรายการข้อมูลอย่างน้อย 1 รายการ");
                        toastr.success('ต้องมีรายการข้อมูลอย่างน้อย 1 รายการ', {
                            timeOut: 5000
                        });
                    }
                }
            });

            $(this).closest(".abcd").remove();

        });
    </script>
@endsection
