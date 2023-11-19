<script src="https://cdn.jsdelivr.net/npm/html2canvas@1.4.1/dist/html2canvas.min.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js'></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.6/jspdf.plugin.autotable.min.js"></script>
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
        $(".select2_casetype3").select2({
            maximumSelectionLength: 1,
            allowClear: true,
            //theme: 'bootstrap4'
            placeholder: 'สถานะเรื่องที่ติดต่อ'
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
            $('#Agent').val("0");
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
                    d.agent = $('#Agent').val();
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
                    title: 'จำนวนสายที่ติดต่อ',
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
                    "title": 'จำนวนสายที่ติดต่อ',
                    exportOptions: {
                        columns: ':visible:not(.no-print)',
                    },
                    "customize": function(doc) { // ส่วนกำหนดเพิ่มเติม ส่วนนี้จะใช้จัดการกับ pdfmake
                        // กำหนด style หลัก
                        doc.defaultStyle = {
                            font: 'THSarabun',
                            fontSize: 16
                        };
                        // กำหนดความกว้างของ header แต่ละคอลัมน์หัวข้อ
                        doc.content[1].table.widths = ['*', 150, 150];
                        doc.styles.tableHeader.fontSize = 16; // กำหนดขนาด font ของ header
                        // Add cell borders
                        doc.content[1].table.layout = {
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
                            },
                            paddingLeft: function(i, node) {
                                return 5; // Padding for cells
                            },
                            paddingRight: function(i, node) {
                                return 5; // Padding for cells
                            },
                            paddingTop: function(i, node) {
                                return 3; // Padding for cells
                            },
                            paddingBottom: function(i, node) {
                                return 3; // Padding for cells
                            }

                        }
                        for (var i = 1; i < doc.content[1].table.body.length; i++) {
                            doc.content[1].table.body[i][0].alignment =
                                'center'; // Align the first column to the center
                            doc.content[1].table.body[i][1].alignment =
                                'center'; // Align the second column to the right
                                doc.content[1].table.body[i][2].alignment =
                                'center'; // Align the second column to the right
                            //doc.content[1].table.body[i][2].alignment =
                            //'center'; // Align the second column to the right
                            // Customize alignments for other columns as needed
                        }

                    }
                },
                {
                    extend: 'print',
                    text: 'Print',
                    title: 'จำนวนสายที่ติดต่อ',
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
                    data: 'cdate',
                    name: 'cdate'
                },
                {
                    data: 'terminada',
                    name: 'terminada'
                },
                {
                    data: 'abandonada',
                    name: 'abandonada'
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




        // Create product Ajax request.
        $('#SubmitCreateForm').click(function(e) {
            e.preventDefault();
            $('.alert-danger').html('');
            $('.alert-danger').hide();
            $('.alert-success').html('');
            $('.alert-success').hide();


            $.ajax({
                url: "{{ route('contacts.store') }}",
                method: 'post',
                data: {
                    name: $('#AddName').val(),
                    email: $('#AddEmail').val(),
                    postcode: $('#AddPostcode').val(),
                    address: $('#AddAddress').val(),
                    telephone: $('#AddTelephone').val(),
                    _token: token,
                },
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
                        $('.alert-success').append('<strong><li>' + result.success +
                            '</li></strong>');
                        toastr.success(result.success, {
                            timeOut: 5000
                        });
                        $('#Listview').DataTable().ajax.reload();
                        $('.form').trigger('reset');
                        $('#CreateModal').modal('hide');
                    }
                }
            });
        });


    });
</script>
