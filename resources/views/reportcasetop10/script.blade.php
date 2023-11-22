<script src="dist/js/html2canvas.min.js"></script>
<script src='dist/js/jspdf.min.js'></script>
<script src="dist/js/jspdf.plugin.autotable.min.js"></script>
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
            /*  var pdf = new jsPDF();
             var chartContainer = document.querySelector("#bar_chart_div");

             html2canvas(chartContainer).then(canvas => {
                 var imgData = canvas.toDataURL("image/png");

                 pdf.addImage(imgData, 'PNG', 0, 0);
                 pdf.save("chart.pdf");
             });  */
            var pdfWidth = 595.28; // Width of A4 in points (1 point = 1/72 inch)
            var pdfHeight = 841.89; // Height of A4 in points
            var pdf = new jsPDF({
                unit: 'pt', // Use points as the unit for measurements
                format: [pdfWidth, pdfHeight] // Set the format to A4 size
            });

            var chartContainer = document.querySelector("#bar_graph");

            html2canvas(chartContainer).then(canvas => {
                var imgData = canvas.toDataURL("image/png");

                var imgWidth = pdfWidth; // Use the same width as PDF
                var imgHeight = (canvas.height * imgWidth) / canvas
                    .width; // Calculate proportional height

                pdf.addImage(imgData, 'PNG', 0, 0, imgWidth,
                    imgHeight); // Add the resized image
                pdf.save("bar_chart.pdf");
            });

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

                pdf.addImage(imgData, 'PNG', 0, 0, imgWidth,
                    imgHeight); // Add the resized image
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

                pdf.addImage(imgData, 'PNG', 0, 0, imgWidth,
                    imgHeight); // Add the resized image
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
            var currentDate = moment();
            // Set the start date to 7 days before today
            //startDate = moment(currentDate).subtract(15, 'days').format('YYYY-MM-DD');
            // Set the end date to the end of the current month
            //endDate = moment(currentDate).endOf('month').format('YYYY-MM-DD');
            startDate = moment().format('YYYY-MM-DD');
            endDate = moment(currentDate).endOf('month').format('YYYY-MM-DD');
        }
        function datereset() {
            var currentDate = moment();
            startDate = moment().format('YYYY-MM-DD');
            endDate = moment(currentDate).endOf('month').format('YYYY-MM-DD');
        }

        function retrieveFieldValues() {
            var saveddateStart = localStorage.getItem('dateStart');
            var savedSearchType = localStorage.getItem('searchType');
            var savedKeyword = localStorage.getItem('keyword');

            // Set field values from local storage
            if (saveddateStart) {
                var dateParts = saveddateStart.split(' - ');
                startDate = dateParts[0];
                endDate = dateParts[1];
            } else {
                datesearch();
            }
        }

        let daterange = () => {
            moment.locale('th');
            $('#reservation').daterangepicker({
                startDate: startDate,
                endDate: endDate,
                ranges: {
                    'วันนี้': [moment(), moment()],
                    'เมื่อวานนี้': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'ย้อนหลัง 7 วัน': [moment().subtract(6, 'days'), moment()],
                    'ย้อนหลัง 30 วัน': [moment().subtract(29, 'days'), moment()],
                    'เดือนนี้': [moment().startOf('month'), moment().endOf('month')],
                    'เดือนที่แล้ว': [moment().subtract(1, 'month').startOf('month'), moment()
                        .subtract(1, 'month').endOf('month')
                    ]
                },
                locale: {
                    format: 'YYYY-MM-DD',
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
        datesearch();
        daterange();

        $('#btnsearch').click(function(e) {
            $('#Listview').DataTable().ajax.reload();
        });
        $('#btnreset').click(function(e) {
            datereset();
            daterange();
            $('#Listview').DataTable().ajax.reload();
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
                complete: function (data) {
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
            iDisplayLength: 5,
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
                    "extend": 'pdf', // ปุ่มสร้าง pdf ไฟล์
                    "text": 'PDF', // ข้อความที่แสดง
                    "pageSize": 'A4', // ขนาดหน้ากระดาษเป็น A4
                    "title": '10 อันดับเรื่องที่ติดต่อมากที่สุด',
                    exportOptions: {
                        columns: ':visible:not(.no-print)',
                    },
                    customize: function ( doc ) {
                    doc.defaultStyle = {
                            font: 'THSarabun',
                            fontSize: 16
                        };
                        doc.content.splice(0,1);
                        doc.pageMargins = [20,100,20,30];
						doc.styles.tableHeader.fontSize = 16;
                        doc['header']=(function() {
							return {
								columns: [
									{
										image: 'data:image/png;base64,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',
                                        width: 50,
                                        margin: [260, 0, 50, 50],
									},
									{
										alignment: 'left',
										italics: true,
										text: '10 อันดับเรื่องที่ติดต่อมากที่สุด',
										fontSize: 18,
										margin: [20, 50, 20, 0]
									}
								],
								margin:20
							}
						});
                        doc.content[0].table.widths = [400, '*'];
                        var objLayout = {};
						objLayout['hLineWidth'] = function(i) { return .5; };
						objLayout['vLineWidth'] = function(i) { return .5; };
						objLayout['hLineColor'] = function(i) { return '#aaa'; };
						objLayout['vLineColor'] = function(i) { return '#aaa'; };
						objLayout['paddingLeft'] = function(i) { return 4; };
						objLayout['paddingRight'] = function(i) { return 4; };
						doc.content[0].layout = objLayout;
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
                        $(win.document.body).find('h1').css('text-align', 'center');
                        $(win.document.body).find('table').addClass('display').css('font-size',
                            '12px');
                        $(win.document.body).find('table.dataTable th, table.dataTable td').css(
                            'border', '1px solid #ddd');
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
            columns: [{
                    data: 'checkbox',
                    name: 'checkbox',
                    orderable: false,
                    searchable: false,
                    className: 'no-print'
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


        $('#exportPrintButton').on('click', function() {
            table.button('4').trigger();
        });

        window.Apex.chart = {
        fontFamily: "Sarabun"
            };
               // Loadchart();
    });

    function Loadchart(){
        let options = {
                series: [
                        { name: [],
                          data: []
                        },
                ],
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
                colors: ['#E91E63','#2E93fA','#546E7A','#66DA26','#FF9800','#4ECDC4','#C7F464','#81D4FA','#A5978B','#FD6A6A'],
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
                            chart.updateOptions({chart: {type: "bar",animate: true},
                                                labels: '',
                                                stroke: {width: 0}
                            });
                            options.series =  res.datag;
                        var chart3 = new ApexCharts(document.querySelector("#pie_graph"), optionsdonut);
                            chart3.render();
                }
            });
    }
</script>