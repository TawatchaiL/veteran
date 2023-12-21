@php
    $detect = new Detection\MobileDetect();
@endphp
<script>
    $(document).ready(function() {




        var startDate;
        var endDate;

        function datesearch() {
            var currentDate = moment();
            startDate = moment(currentDate).subtract(30, 'days').startOf('day').format('YYYY-MM-DD HH:mm:ss');
            endDate = moment(currentDate).endOf('month').endOf('day').format('YYYY-MM-DD HH:mm:ss');
        }


        function storeFieldValues() {
            var dateStart = $('#reservation').val();
            var searchText = $('#searchtext').val();

            // Store values in local storage
            localStorage.setItem('dateStart', dateStart);
            localStorage.setItem('searchText', searchText);
        }

        function retrieveFieldValues() {
            var saveddateStart = localStorage.getItem('dateStart');
            var savedKeyword = localStorage.getItem('searchText');
            // Set field values from local storage
            if (saveddateStart) {
                var dateParts = saveddateStart.split(' - ');
                startDate = dateParts[0];
                endDate = dateParts[1];
            } else {
                datesearch();
            }

            $('#reservation').val(`${startDate} - ${endDate}`)


            if (savedKeyword) {
                $('#searchText').val(savedKeyword);
            }

        }


        let daterange = () => {
            moment.locale('th');

            var startTime = '00:00:00';
            var endTime = '23:59:59';

            var todayRange = [moment(startTime, 'HH:mm:ss'), moment(endTime, 'HH:mm:ss')];
            var yesterdayRange = [moment().subtract(1, 'days').startOf('day').set('hour', 0).set('minute',
                0).set('second', 0), moment().subtract(1, 'days').endOf('day').set('hour', 23).set(
                'minute', 59).set('second', 59)];
            var last7DaysRange = [moment().subtract(6, 'days').startOf('day').set('hour', 0).set('minute',
                0).set('second', 0), moment(endTime, 'HH:mm:ss')];
            var last30DaysRange = [moment().subtract(29, 'days').startOf('day').set('hour', 0).set('minute',
                0).set('second', 0), moment(endTime, 'HH:mm:ss')];

            $('#reservation').daterangepicker({
                timePicker: true,
                timePicker24Hour: true,
                timePickerSeconds: true,
                //timePickerIncrement: 5,
                startDate: startDate,
                endDate: endDate,
                ranges: {
                    'วันนี้': todayRange,
                    'เมื่อวานนี้': yesterdayRange,
                    'ย้อนหลัง 7 วัน': last7DaysRange,
                    'ย้อนหลัง 30 วัน': last30DaysRange,
                    'เดือนนี้': [moment().startOf('month'), moment().endOf('month')],
                    'เดือนที่แล้ว': [moment().subtract(1, 'month').startOf('month'), moment()
                        .subtract(1, 'month').endOf('month')
                    ]
                },
                locale: {
                    format: 'YYYY-MM-DD HH:mm:ss',
                    applyLabel: 'ตกลง',
                    cancelLabel: 'ยกเลิก',
                    fromLabel: 'จาก',
                    toLabel: 'ถึง',
                    customRangeLabel: 'เลือกวันที่เอง',
                    daysOfWeek: ['อา', 'จ', 'อ', 'พ', 'พฤ', 'ศ', 'ส'],
                    monthNames: [
                        'มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน',
                        'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'
                    ],
                    firstDay: 1
                }
            });
            // Apply the custom date range filter on input change
            $('#reservation').on('apply.daterangepicker', function() {
                console.log($('#reservation').val())
                table.draw();
                storeFieldValues();
            });
        }


        retrieveFieldValues();
        daterange();


        //$.noConflict();
        var token = ''
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        const table_option = {
            ajax: {
                data: function(d) {
                    d.sdate = $('#reservation').val();
                    d.searchtext = $('#searchtext').val();
                    //d.search = $('input[type="search"]').val();
                }
            },
            dom: 'Bfrtip',
            paging: true,
            searching: true,
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
            iDisplayLength: 5,
            lengthMenu: [5, 10, 25, 50, 75, 100],
            stateSave: true,
            autoWidth: false,
            fixedHeader: true,
            @if ($detect->isMobile())
                responsive: true,
            @else
               /*  responsive: {
                    details: {
                        type: 'column',
                        target: 'tr'
                    }
                },
                columnDefs: [{
                    className: 'control',
                    orderable: false,
                    targets: -1
                }], */
            @endif
            sPaginationType: "full_numbers",
            dom: 'T<"clear">lfrtip',
            columns: [{
                    data: 'checkbox',
                    name: 'checkbox',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'calldate',
                    name: 'calldate'
                },
                {
                    data: 'src',
                    name: 'src'
                },
                {
                    data: 'dst',
                    name: 'dst'
                },
                {
                    data: 'disposition',
                    name: 'disposition'
                },
                {
                    data: 'billsec',
                    name: 'billsec'
                },

            ]
        };


        var table = $('#Listview').DataTable(table_option);

        $('#btnsearch').on('click', function() {
            storeFieldValues();
            //var telp = $('#telp').val();
            table.search('').draw();
            $.fn.dataTable.ext.search.pop();
            /* if (telp !== '') {
                table.column(3).search(telp).draw();
            } */
        });


        $('#btnreset').on('click', async function() {
            localStorage.removeItem('dateStart');
            localStorage.removeItem('searchText');

            // Set field values to empty
            $('#searchtype').val(0);
            $('#Listview').html('');

            // Clear DataTable state
            if (table) {
                table.state.clear();
                await table.destroy();
            }
            // Set the date range back to its default
            var currentDate = moment();
            var startDate = moment(currentDate).subtract(30, 'days').startOf('day').format(
                'YYYY-MM-DD HH:mm:ss');
            var endDate = moment(currentDate).endOf('month').endOf('day').format(
                'YYYY-MM-DD HH:mm:ss');

            daterange();
            table = $('#Listview').DataTable(table_option);
            table.draw();
        });

    });
</script>
