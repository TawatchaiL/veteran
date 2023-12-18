<script src="dist/js/html2canvas.min.js"></script>
<script src='dist/js/jspdf.min.js'></script>
<script src="dist/js/jspdf.plugin.autotable.min.js"></script>
<script src='dist/js/logo.js'></script>
<script>
    pdfMake.fonts = {
        THSarabun: {
            normal: '{{ asset('fonts/THSarabunNew.ttf') }}',
            bold: '{{ asset('fonts/THSarabunNew Bold.ttf') }}',
            italics: '{{ asset('fonts/THSarabunNew Italic.ttf') }}',
            bolditalics: '{{ asset('fonts/THSarabunNew BoldItalic.ttf') }}'
        }
    }
    $(document).ready(function() {
        $('#download_bar').click(function(event) {

            var pdfWidth = 595.28;
            var pdfHeight = 841.89;
            var pdf = new jsPDF({
                unit: 'pt',
                format: [pdfWidth, pdfHeight]
            });
            
            pdf.text('Crm Report', 40, 15, { baseline: 'top' });

            var chartContainer = document.querySelector("#bar_graph");

            html2canvas(chartContainer).then(canvas => {
                var imgData = canvas.toDataURL("image/png");

                var imgWidth = pdfWidth;
                var imgHeight = (canvas.height * imgWidth) / canvas
                    .width;
                
                pdf.addImage(imgData, 'PNG', 0, 60, imgWidth,
                    imgHeight);
                
            });
            pdf.save("bar_chart.pdf");
        });

        $('#download_bar_img').click(function(event) {
            var chartContainer = document.querySelector("#bar_graph");

            html2canvas(chartContainer).then(canvas => {
                var imgData = canvas.toDataURL("image/png"); // แปลงเป็นข้อมูล URI ของรูปภาพ

                // สร้างลิงก์สำหรับการดาวน์โหลดภาพ
                var link = document.createElement('a');
                link.href = imgData;
                link.download = 'bar_chart.png'; // ชื่อไฟล์ที่จะบันทึก
                link.click();
            });
        });

        $('#print_bar').click(function(event) {
            var chartContainer = document.querySelector("#bar_graph");

            html2canvas(chartContainer).then(canvas => {
                var imgData = canvas.toDataURL("image/png");

                var printWindow = window.open('', '_blank');
                printWindow.document.open();
                printWindow.document.write('<img src="' + imgData + '">');


                // Add an event listener for afterprint to close the print window
                printWindow.addEventListener('afterprint', function() {
                    printWindow.close();
                });

                setTimeout(function() {
                    printWindow.focus();
                    printWindow.print();
                }, 1000); // Adjust the delay as needed
            });
        });

        $('#download_line').click(function(event) {

            var pdfWidth = 595.28; // Width of A4 in points (1 point = 1/72 inch)
            var pdfHeight = 841.89; // Height of A4 in points
            var pdf = new jsPDF({
                unit: 'pt', // Use points as the unit for measurements
                format: [pdfWidth, pdfHeight] // Set the format to A4 size
            });

            var chartContainer = document.querySelector("#line_graph");

            html2canvas(chartContainer).then(canvas => {
                var imgData = canvas.toDataURL("image/png");

                var imgWidth = pdfWidth; // Use the same width as PDF
                var imgHeight = (canvas.height * imgWidth) / canvas
                    .width; // Calculate proportional height

                    pdf.addImage(imgData, 'PNG', 0, 60, imgWidth,
                    imgHeight);
                pdf.save("line_chart.pdf");
            });

        });

        $('#download_line_img').click(function(event) {
            var chartContainer = document.querySelector("#line_graph");

            html2canvas(chartContainer).then(canvas => {
                var imgData = canvas.toDataURL("image/png"); // แปลงเป็นข้อมูล URI ของรูปภาพ

                // สร้างลิงก์สำหรับการดาวน์โหลดภาพ
                var link = document.createElement('a');
                link.href = imgData;
                link.download = 'line_chart.png'; // ชื่อไฟล์ที่จะบันทึก
                link.click();
            });
        });

        $('#print_line').click(function(event) {
            var chartContainer = document.querySelector("#line_graph");

            html2canvas(chartContainer).then(canvas => {
                var imgData = canvas.toDataURL("image/png");

                var printWindow = window.open('', '_blank');
                printWindow.document.open();
                printWindow.document.write('<img src="' + imgData + '">');
                // Add an event listener for afterprint to close the print window
                printWindow.addEventListener('afterprint', function() {
                    printWindow.close();
                });

                setTimeout(function() {
                    printWindow.focus();
                    printWindow.print();
                }, 1000); // Adjust the delay as needed
            });
        });

        $('#download_pie').click(function(event) {

            var pdfWidth = 595.28; // Width of A4 in points (1 point = 1/72 inch)
            var pdfHeight = 841.89; // Height of A4 in points
            var pdf = new jsPDF({
                unit: 'pt', // Use points as the unit for measurements
                format: [pdfWidth, pdfHeight] // Set the format to A4 size
            });

            var chartContainer = document.querySelector("#pie_graph");

            html2canvas(chartContainer).then(canvas => {
                var imgData = canvas.toDataURL("image/png");

                var imgWidth = pdfWidth; // Use the same width as PDF
                var imgHeight = (canvas.height * imgWidth) / canvas
                    .width; // Calculate proportional height

                    pdf.addImage(imgData, 'PNG', 0, 60, imgWidth,
                    imgHeight);
                pdf.save("pie_chart.pdf");
            });

        });

        $('#download_pie_img').click(function(event) {
            var chartContainer = document.querySelector("#pie_graph");

            html2canvas(chartContainer).then(canvas => {
                var imgData = canvas.toDataURL("image/png"); // แปลงเป็นข้อมูล URI ของรูปภาพ

                // สร้างลิงก์สำหรับการดาวน์โหลดภาพ
                var link = document.createElement('a');
                link.href = imgData;
                link.download = 'pie_chart.png'; // ชื่อไฟล์ที่จะบันทึก
                link.click();
            });
        });

        $('#print_pie').click(function(event) {
            var chartContainer = document.querySelector("#pie_graph");

            html2canvas(chartContainer).then(canvas => {
                var imgData = canvas.toDataURL("image/png");

                var printWindow = window.open('', '_blank');
                printWindow.document.open();
                printWindow.document.write('<img src="' + imgData + '">');
                printWindow.document.close(); // Close the document for writing

                // Add an event listener for afterprint to close the print window
                printWindow.addEventListener('afterprint', function() {
                    printWindow.close();
                });

                setTimeout(function() {
                    printWindow.focus();
                    printWindow.print();
                }, 1000); // Adjust the delay as needed
            });
        });




        $(".delete_all_button").click(function() {
            var len = $('input[name="table_records[]"]:checked').length;
            if (len > 0) {

                if (confirm("ยืนยันการลบข้อมูล ?")) {
                    $('form#delete_all').submit();
                }
            } else {
                alert("กรุณาเลือกรายการที่จะลบ");
            }

        });

        $('#check-all').click(function() {
            $(':checkbox.flat').prop('checked', this.checked);
        });

        $(".select2_single").select2({
            maximumSelectionLength: 1,
            allowClear: false,
            //theme: 'bootstrap4'
            placeholder: 'กรุณาเลือก'
        });

        $(".select2_single").on("select2:unselect", function(e) {
            //log("select2:unselect", e);
            //$('.products').html('');
        });

        $(".select2_singles").select2({
            maximumSelectionLength: 1,
            allowClear: false,
            //theme: 'bootstrap4'
            placeholder: 'กรุณาเลือก'
        });

        $(".select2_singlec").select2({
            maximumSelectionLength: 1,
            allowClear: false,
            //theme: 'bootstrap4'
            placeholder: 'กรุณาเลือก'
        });

        $(".select2_city").select2({
            maximumSelectionLength: 1,
            allowClear: false,
            //theme: 'bootstrap4'
            placeholder: 'กรุณาเลือกจังหวัด'
        });
        $(".select2_am").select2({
            maximumSelectionLength: 1,
            allowClear: false,
            //theme: 'bootstrap4'
            placeholder: 'กรุณาเลือกอำเภอ'
        });
        $(".select2_tm").select2({
            maximumSelectionLength: 1,
            allowClear: false,
            //theme: 'bootstrap4'
            placeholder: 'กรุณาเลือกตำบล'
        });

        $(".select2_multiple").select2({
            maximumSelectionLength: 2,
            //placeholder: "With Max Selection limit 4",
            allowClear: false,
            //theme: 'bootstrap4'
            placeholder: 'กรุณาเลือก'
        });

        $(".SDate").datepicker({
            dateFormat: "yy-mm-dd"
        });
        $(".EDate").datepicker({
            dateFormat: "yy-mm-dd"
        });


        //$.noConflict();
        var token = ''
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var startDate;
        var endDate;

        function datesearch() {
            //.add(1, 'month').add(543, 'year').format('LLLL')
            var currentDate = moment();
            console.log(currentDate)
            startDate = moment(currentDate).subtract(30, 'days').startOf('day').format('YYYY-MM-DD HH:mm:ss');
            endDate = moment(currentDate).endOf('month').endOf('day').format('YYYY-MM-DD HH:mm:ss');
        }


        function storeFieldValues() {
            var dateStart = $('#reservation').val();
            var sagent = $('#agen').val();
            var stelp = $('#telp').val();
            var sctype = $('#ctype').val();

            // Store values in local storage
            localStorage.setItem('dateStart', dateStart);
            localStorage.setItem('sagent', sagent);
            localStorage.setItem('stelp', stelp);
            localStorage.setItem('sctype', sctype);
        }

        function retrieveFieldValues() {
            var saveddateStart = localStorage.getItem('dateStart');
            var savedsagent = localStorage.getItem('sagent');
            var savedstelp = localStorage.getItem('stelp');
            var savedctype = localStorage.getItem('sctype');
            // Set field values from local storage
            if (saveddateStart) {
                var dateParts = saveddateStart.split(' - ');
                startDate = dateParts[0];
                endDate = dateParts[1];
            } else {
                datesearch();
            }

            console.log(`${startDate} - ${endDate}`)
            $('#reservation').val(`${startDate} - ${endDate}`)

            if (savedsagent) {
                $('#agen').val(savedsagent);
            }
            if (savedstelp) {
                $('#telp').val(savedstelp);
            }

            if (savedctype) {
                $('#ctype').val(savedctype);
            }

        }


        let daterange = () => {


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

            var currentYear = moment().year();
            var maxYear = moment().year(currentYear).add(1, 'year').format('YYYY-MM-DD');
            var minYear = moment().year(currentYear).subtract(2, 'years').format('YYYY-MM-DD');

            $('#reservation').daterangepicker({
                timePicker: true,
                timePicker24Hour: true,
                timePickerSeconds: true,
                //timePickerIncrement: 5,
                startDate: startDate,
                endDate: endDate,
                showDropdowns: true,
                linkedCalendars: false,
                minDate: minYear,
                maxDate: maxYear,
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
            $('#reservation').on('apply.daterangepicker', function(ev, picker) {
                table.draw();
                storeFieldValues();
            });
        }

        retrieveFieldValues();
        daterange();

        $('#resetSearchButton').on('click', async function() {
            localStorage.removeItem('dateStart');
            localStorage.removeItem('sagent');
            localStorage.removeItem('stelp');
            localStorage.removeItem('sctype');

            // Set field values to empty
            $('#telp').val('');
            $('#agen').val('');
            $('#ctype').val('');

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

        $('#btnsearch').on('click', function() {
            storeFieldValues();
            //var telp = $('#telp').val();
            table.search('').draw();
            $.fn.dataTable.ext.search.pop();
            /* if (telp !== '') {
                table.column(3).search(telp).draw();
            } */
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
            dom: 'Bfrtip',
            paging: true,
            searching: false,
            ajax: {
                data: function(d) {
                    d.sdate = $('#reservation').val();
                },
                complete: function(data) {
                    Loadchart();
                }
            },
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
            lengthMenu: [5, 10, 25, 50, 75, 100],
            stateSave: true,
            autoWidth: false,
            buttons: [
                'copy',
                {
                    extend: 'excel',
                    text: 'Excel',
                    title: '10 อันดับเรื่องที่ติดต่อมากที่สุด',
                    exportOptions: {
                        columns: ':visible:not(.no-print)',
                    },
                    customize: function(xlsx) {
                        var sheet = xlsx.xl.worksheets['sheet1.xml'];

                        // Customize the header style
                        $('row:first c', sheet).each(function(index) {
                            $(this).attr('s',
                                'customHeaderStyle'); // Apply style to header cells
                        });

                        // Define a custom style for the header cells
                        var styles = xlsx.xl['styles.xml'];
                        var headerStyle =
                            '<cellXfs count="1"><xf numFmtId="0" fontId="0" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" applyAlignment="1"><alignment horizontal="center" vertical="center" wrapText="1" /><font /></xf></cellXfs>';

                        // Add the custom style to the styles
                        $('cellXfs', styles).prepend(headerStyle);
                    }
                },
                'csv',
                { // กำหนดพิเศษเฉพาะปุ่ม pdf
                    "extend": 'pdfHtml5', // ปุ่มสร้าง pdf ไฟล์
                    "text": 'PDF', // ข้อความที่แสดง
                    "pageSize": 'A4', // ขนาดหน้ากระดาษเป็น A4
                    "title": '10 อันดับเรื่องที่ติดต่อมากที่สุด',
                    "download": 'open',
                    exportOptions: {
                        columns: ':visible:not(.no-print)',
                    },
                    customize: function(doc) {
                        doc.defaultStyle = {
                            font: 'THSarabun',
                            fontSize: 16
                        };
                        doc.content.splice(0, 1);
                        doc.pageMargins = [20, 150, 20, 30];
                        doc.styles.tableHeader.fontSize = 16;
                        doc.styles.tableBodyOdd.alignment = 'center';
                        doc.styles.tableBodyEven.alignment = 'center';
                        doc.styles.tableFooter.fontSize = 16;
                        doc['header'] = (function() {
                            return {
                                columns: [
                                    {
                                        text: [  
                                                { text: 'CRM REPORT ', alignment: 'right', fontSize: 42, margin: [0, 50, 70, 0] },
                                                '\n',
                                                { text: 'ข้อมูลวันที่ ' + $('#reservation').val(), alignment: 'left', fontSize: 18, margin: [0, 50, 70, 0] },
                                                '\n',
                                                { text: 'Report : Top 10 (10 อันดับเรื่องที่ติดต่อมากที่สุด)', alignment: 'left', fontSize: 18, margin: [0, 50, 70, 0] },
                                                '\n',
                                                { text: 'Report By : {{ Auth::user()->name }}', alignment: 'left', fontSize: 18, margin: [0, 0, 70, 0] }
                                            ]
                                    }
                                ],
                                margin: 20
                            }
                        });

                        doc.content[0].table.widths = [40, 400, '*'];
                        var objLayout = {};
                        objLayout['hLineWidth'] = function(i) {
                            return .5;
                        };
                        objLayout['vLineWidth'] = function(i) {
                            return .5;
                        };
                        objLayout['hLineColor'] = function(i) {
                            return '#bfbfbf';
                        };
                        objLayout['vLineColor'] = function(i) {
                            return '#bfbfbf';
                        };
                        objLayout['paddingLeft'] = function(i) {
                            return 4;
                        };
                        objLayout['paddingRight'] = function(i) {
                            return 4;
                        };
                        objLayout['paddingTop'] = function(i) {
                            return 3;
                        };
                        objLayout['paddingBottom'] = function(i) {
                            return 3;
                        };
                        doc.content[0].layout = objLayout;

                        for (var i = 1; i < doc.content[0].table.body.length; i++) {
                            doc.content[0].table.body[i][0].alignment = 'center';
                            //doc.content[0].table.body[i][0].alignment = 'left';
                            //doc.content[0].table.body[i][2].alignment = 'center';
                        }
                    }
                },
                {
                    extend: 'print',
                    text: 'Print',
                    title: '10 อันดับเรื่องที่ติดต่อมากที่สุด',
                    exportOptions: {
                        columns: ':visible:not(.no-print)',
                        format: {
                            body: function(data, row, column, node) {
                                // You can set your font here
                                $(node).css('font-family', 'THSarabun');
                                return data;
                            }
                        }
                    },
                    customize: function(win) {
                        // Customize the print layout
                        $(win.document.body).prepend('<img style="position:absolute; top:0; left:470;width:100" src='+logobase64+'>')
                        $(win.document.body).find('h1').css('text-align', 'center').css('font-size','16px').css('margin-top','105px');
                        $(win.document.body).find('table').addClass('display').css('font-size','12px')
                                            .removeClass('dataTable').css('margin-top','5px').css('margin-bottom','60px');
                        $(win.document.body).find('table.dataTable th, table.dataTable td').css(
                            'border', '1px solid black');
                        $(win.document.body).find('table.dataTable th').css('background-color',
                            '#f2f2f2');
                        $(win.document.body).find('table.dataTable td:nth-child(0)').css(
                            'width', '50px');
                    }
                }
            ],
            layout: {
                hLineWidth: function(i, node) {
                    return 1; // Border width for horizontal lines
                },
                vLineWidth: function(i, node) {
                    return 1; // Border width for vertical lines
                },
                hLineColor: function(i, node) {
                    return '#bfbfbf'; // Border color for horizontal lines
                },
                vLineColor: function(i, node) {
                    return '#bfbfbf'; // Border color for vertical lines
                }
            },
            responsive: true,
            sPaginationType: "full_numbers",
            dom: 'T<"clear">lfrtip',
            columns: [
                {
                    data: 'rownumber',
                    name: 'rownumber',
                    orderable: false,
                    searchable: false,
//                    className: 'no-print'
                },
                {
                    data: 'casetype1',
                    name: 'casetype1'
                },
                {
                    data: 'sumcases',
                    name: 'sumcases'
                },
            ]
        });
        /*
        table.on('order.dt search.dt', function () {
        let i = 1;
 
        table
            .cells(null, 0, { search: 'applied', order: 'applied' })
            .every(function (cell) {
                this.data(i++);
            });
        }).draw();
        */
        $('#exportPDFButton').on('click', function() {
            /* var doc = new jsPDF();

            doc.setFontSize(12); // Set font size
            doc.setFont('Sarabun'); // Set Google Font family

            doc.text("Table Export", 10, 10);

            var columns = [];
            var data = [];

            // Get column names from DataTable
            table.columns().every(function() {
                columns.push(this.header().textContent.trim());
            });

            // Get data from DataTable
            table.rows({
                selected: true
            }).every(function() {
                var rowData = [];
                var cells = this.nodes().to$();
                cells.find('td').each(function() {
                    rowData.push($(this).text());
                });
                data.push(rowData);
            });

            doc.autoTable({
                head: [columns],
                body: data
            });

            doc.save('table-export.pdf'); */
            table.button('3').trigger();
        });

        $('#exportXLSButton').on('click', function() {
            table.button('1').trigger();
        });

        window.Apex.chart = {
            fontFamily: "Sarabun"
        };
        // Loadchart();
    });

    function Loadchart() {
        let options = {
            series: [{
                name: [],
                data: []
            }, ],
            title: {
                text: '10 อันดับเรื่องที่ติดต่อมากที่สุด',
                align: 'center',
                style: {
                    fontSize: '16px',
                    fontWeight: 'bold',
                    fontFamily: 'Sarabun',
                    color: '#263238'
                },
                margin: 10,
                offsetX: 0,
                offsetY: 0,
                floating: false,
            },
            chart: {
                height: 400,
                type: "line",
                zoom: {
                    enabled: false
                },
                toolbar: {
                    show: false
                }
            },
            markers: {
                show: true,
                size: 6
            },
            dataLabels: {
                enabled: false
            },
            legend: {
                show: false,
                showForSingleSeries: false,
                position: "top",
                horizontalAlign: "right"
            },
            stroke: {
                curve: "smooth",
                linecap: "round"
            },
            grid: {
                row: {
                    colors: ["#f3f3f3", "transparent"],
                    opacity: 0.5
                }
            },
            xaxis: {
                categories: []
            },
            labels: [],
            tooltip: {
                y: {
                    formatter: function(val) {
                        return " จำนวน " + val + "  "
                    }
                }
            }
        };
        let optionsdonut = {

            series: [],
            chart: {
                type: 'donut',
                height: 380,
                toolbar: {
                    show: false
                },
            },
            colors: ['#E91E63', '#2E93fA', '#546E7A', '#66DA26', '#FF9800', '#4ECDC4', '#C7F464', '#81D4FA',
                '#A5978B', '#FD6A6A'
            ],
            fill: {
                type: 'gradient',
            },
            title: {
                text: '10 อันดับเรื่องที่ติดต่อมากที่สุด',
                align: 'center',
                style: {
                    fontSize: '16px',
                    fontWeight: 'bold',
                    fontFamily: 'Sarabun',
                    color: '#263238'
                },
                margin: 10,
                offsetX: 0,
                offsetY: 0,
                floating: false,
            },
            labels: [],
            responsive: [{
                breakpoint: 200,
                options: {
                    chart: {
                        width: 30,
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }]
        };

        var rdate = $('#reservation').val();
        var rstatus = 'report';
        $.ajax({
            url: '{{ route('reportcasetop10') }}',
            data: {
                sdate: rdate,
                rstatus: rstatus
            },
            method: 'GET',
            success: function(res) {
                options.series[0].data = res.datag;
                options.xaxis.categories = res.datal;
                optionsdonut.labels = res.datal;
                optionsdonut.series = res.datag;
                var chart2 = new ApexCharts(document.querySelector("#line_graph"), options);
                chart2.render();

                var chart = new ApexCharts(document.querySelector("#bar_graph"), options);
                chart.render();
                chart.updateOptions({
                    chart: {
                        type: "bar",
                        animate: true
                    },
                    labels: '',
                    stroke: {
                        width: 0
                    }
                });
                options.series = res.datag;
                var chart3 = new ApexCharts(document.querySelector("#pie_graph"), optionsdonut);
                chart3.render();
            }
        });
    }
</script>
