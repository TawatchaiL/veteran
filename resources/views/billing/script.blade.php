<script src="dist/js/html2canvas.min.js"></script>
<script src='dist/js/jspdf.min.js'></script>
<script src="dist/js/jspdf.plugin.autotable.min.js"></script>
{{-- <script src="/js/app.js?v=1"></script> --}}
{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
<script type="module">
    import WaveSurfer from 'https://unpkg.com/wavesurfer.js@7/dist/wavesurfer.esm.js'
    import Hover from 'https://unpkg.com/wavesurfer.js@7/dist/plugins/hover.esm.js'
    import Minimap from 'https://unpkg.com/wavesurfer.js@7/dist/plugins/minimap.esm.js'
    import TimelinePlugin from 'https://unpkg.com/wavesurfer.js@7/dist/plugins/timeline.esm.js'
    import RegionsPlugin from 'https://unpkg.com/wavesurfer.js@7/dist/plugins/regions.esm.js'

    let wavesurfer; // Declare the wavesurfer variable
    // Function to create and initialize WaveSurfer
    const initializeWaveSurfer = (newUrl, tooltipsData) => {

        //wav
        // Create a second timeline
        const bottomTimline = TimelinePlugin.create({
            height: 15,
            timeInterval: 2,
            primaryLabelInterval: 10,
            style: {
                fontSize: '10px',
                color: '#000000',
            },
        })

        if (wavesurfer) {
            // Destroy the existing WaveSurfer instance to clear it
            wavesurfer.destroy();
        }

        wavesurfer = WaveSurfer.create({
            container: '#waveform',
            height: 200,
            audioRate: 1,
            splitChannels: false,
            normalize: false,
            waveColor: '#4F4A85',
            progressColor: '#383351',
            url: newUrl,
            cursorColor: '#b3aefb',
            cursorWidth: 1,
            //barWidth: 1,
            //barGap: 1,
            barRadius: 1,
            barHeight: null,
            barAlign: "",
            minPxPerSec: 1,
            fillParent: true,
            plugins: [
                Hover.create({
                    lineColor: '#ff0000',
                    lineWidth: 2,
                    labelBackground: '#555',
                    labelColor: '#fff',
                    labelSize: '11px',
                }),
                Minimap.create({
                    height: 30,
                    waveColor: '#ddd',
                    progressColor: '#ff0000',
                }), /* topTimeline,*/ bottomTimline
            ],
        })

        const wsRegions = wavesurfer.registerPlugin(RegionsPlugin.create())
        const playButton = document.querySelector('#play')
        const forwardButton = document.querySelector('#forward')
        const backButton = document.querySelector('#backward')
        const stopButton = document.querySelector('#stop')
        const toggleMuteButton = document.querySelector('#toggleMuteBtn')
        const setMuteOnButton = document.querySelector('#setMuteOnBtn')
        const setMuteOffButton = document.querySelector('#setMuteOffBtn')
        let oldcreate = true;



        let preservePitch = true
        const speeds = [0.25, 0.5, 1, 2, 4]

        // Toggle pitch preservation
        /* document.querySelector('#pitch').addEventListener('change', (e) => {
            preservePitch = e.target.checked
            wavesurfer.setPlaybackRate(wavesurfer.getPlaybackRate(), preservePitch)
        }) */

        // Set the playback rate
        document.querySelector('#speed').addEventListener('input', (e) => {
            const speed = speeds[e.target.valueAsNumber]
            document.querySelector('#rate').textContent = speed.toFixed(2)
            wavesurfer.setPlaybackRate(speed, preservePitch)
            wavesurfer.play()
        })

        var volumeInput = document.querySelector('#volume');
        var onChangeVolume = function(e) {
            wavesurfer.setVolume(e.target.value);
            const volume = parseFloat(e.target.value * 10);
            document.querySelector('#vol').textContent = volume.toFixed(2)
            //console.log(e.target.value);
        };
        volumeInput.addEventListener('input', onChangeVolume);
        volumeInput.addEventListener('change', onChangeVolume);


        const fetchTooltipsFromDB = () => {
            // Perform an API request or database query to retrieve tooltip data
            return [{
                    startTime: null,
                    endTime: null,
                    content: null,
                }
                // More tooltip data...
            ];
        };

        const updateTimer = () => {
            const formattedTime = secondsToTimestamp(wavesurfer.getCurrentTime());
            $('#waveform-time-indicator .time').text(formattedTime);
        };

        const secondsToTimestamp = (seconds) => {
            seconds = Math.floor(seconds);
            const h = Math.floor(seconds / 3600);
            const m = Math.floor((seconds - (h * 3600)) / 60);
            const s = seconds - (h * 3600) - (m * 60);

            const padZero = (value) => (value < 10 ? '0' + value : value);

            return `${padZero(h)}:${padZero(m)}:${padZero(s)}`;
        };


        wavesurfer.on('ready', updateTimer)
        wavesurfer.on('audioprocess', updateTimer)
        wavesurfer.on('seek', updateTimer)


        wavesurfer.once('decode', () => {
            const slider = document.querySelector('input[type="range"]')

            slider.addEventListener('input', (e) => {
                const minPxPerSec = e.target.valueAsNumber
                wavesurfer.zoom(minPxPerSec)
            })

            document.querySelector('button').addEventListener('click', () => {
                wavesurfer.playPause()
            })

            /* toggleMuteButton.onclick = function() {
                wavesurfer.toggleMute();
            };

            setMuteOnButton.onclick = function() {
                wavesurfer.setMute(true);
            };

            setMuteOffButton.onclick = function() {
                wavesurfer.setMute(false);
            }; */

            playButton.onclick = () => {
                wavesurfer.playPause()
            }

            stopButton.onclick = () => {
                wavesurfer.stop()
            }


            forwardButton.onclick = () => {
                wavesurfer.skip(5)
            }

            backButton.onclick = () => {
                wavesurfer.skip(-5)
            }

            const totalTime = wavesurfer.getDuration()
            document.querySelector('#duration').textContent = secondsToTimestamp(totalTime);

            wavesurfer.setVolume(0.4);
            document.querySelector('#volume').value = wavesurfer.getVolume();


            if (tooltipsData) {
                tooltipsData.forEach(({
                    id,
                    start,
                    end,
                    comment
                }) => {
                    if (id !== null && start !== null && end !== null && comment !== null) {
                        const region = wsRegions.addRegion({
                            id: id,
                            start: start,
                            end: end,
                            color: 'rgba(255, 0, 0, 0.1)'
                        });

                        // Create a tooltip element
                        const tooltip = document.createElement('div');
                        oldcreate = true;
                        tooltip.className = 'region-tooltip';
                        tooltip.style.paddingLeft = '10px';
                        tooltip.textContent = comment;

                        // Attach the tooltip to the region's element
                        region.element.appendChild(tooltip);
                    } else {
                        // Handle the case where any of the properties is null
                        console.log('One or more properties are null in the tooltip data');
                    }
                });
                oldcreate = false;
            } else {
                // Handle the case where tooltipsData is null
                console.log('Tooltips data is null');
            }
        });


        @can('billing-supervisor')
            wsRegions.enableDragSelection({
                color: 'rgba(255, 0, 0, 0.1)',
                //content: 'Region Content',
            });
        @endcan

        let currentRegion;
        wsRegions.on('region-created', (region) => {
            // console.log('Region Created:', region);
            const button = document.createElement('button');
            button.className = 'remove-region-button';
            button.textContent = 'X';

            if (oldcreate == false) {
                ezBSAlert({
                    type: "prompt",
                    okButtonText: "บันทึกข้อมูล",
                    messageText: "กรุณาระบุ Comment",
                    alertType: "primary"
                }).done(function(e) {
                    if (e !== '') {
                        const tooltip = document.createElement('div');
                        const content = e;

                        tooltip.className = 'region-tooltip';
                        tooltip.textContent = content;
                        tooltip.style.paddingLeft = '10px';
                        currentRegion.element.appendChild(tooltip);

                        const uniqueId = $('#uniqueid').val();
                        const csrfToken = document.querySelector('meta[name="csrf-token"]')
                            .getAttribute('content');
                        $.ajax({
                            type: "get",
                            url: "/billing/comment",
                            headers: {
                                'X-CSRF-TOKEN': csrfToken
                            },
                            data: {
                                uniqueid: uniqueId,
                                comment: content,
                                start: region.start,
                                end: region.end,
                            },
                            success: function(response) {
                                console.log(response.message);
                                region.id = response.id;
                                //$('#CreateModal').modal('hide');
                            },
                            error: function(error) {}
                        });
                    } else {
                        region.remove();
                    }
                });
            }

            button.addEventListener('click', () => {
                @can('billing-supervisor')
                    region.remove();

                    const commentId = region.id;
                    const csrfToken = document.querySelector('meta[name="csrf-token"]')
                        .getAttribute('content');
                    $.ajax({
                        type: "DELETE",
                        url: '/billing/comment/' + commentId,
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        },

                        success: function(response) {
                            //region.remove();
                            //$('#CreateModal').modal('hide');
                            console.log(response.message);
                        },
                        error: function(error) {}
                    });
                @else
                    toastr.error('คุณไม่มีสิทธิ์ลบ Comment', {
                        timeOut: 5000
                    });
                @endcan
            });


            region.element.appendChild(button);
            currentRegion = region;

        });

        wsRegions.on('region-updated', (region) => {
            console.log('Updated region', region)
            const regionId = region.id;
            const csrfToken = document.querySelector('meta[name="csrf-token"]')
                .getAttribute('content');
            $.ajax({
                type: "POST",
                url: "/billing/comment/update/" + regionId,
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                data: {
                    start: region.start,
                    end: region.end,
                },
                success: function(response) {
                    console.log(response.message);
                },
                error: function(error) {}
            });
        })

        // Loop a region on click
        let loop = false
        // Toggle looping with a checkbox
        document.querySelector('#loop').onclick = (e) => {
            loop = e.target.checked
        }

        {
            let activeRegion = null
            wsRegions.on('region-in', (region) => {
                activeRegion = region
            })
            wsRegions.on('region-out', (region) => {
                if (activeRegion === region) {
                    if (loop) {
                        region.play()
                    } else {
                        activeRegion = null
                    }
                }
            })
            wsRegions.on('region-clicked', (region, e) => {
                e.stopPropagation()
                activeRegion = region
                //region.play()
                /* region.setOptions({
                    color: randomColor()
                }) */
            })

            wavesurfer.on('interaction', () => {
                activeRegion = null
            })
        }

        $('#CreateModal').modal('show');
    }

    const random = (min, max) => Math.random() * (max - min) + min
    const randomColor = () => `rgba(${random(0, 255)}, ${random(0, 255)}, ${random(0, 255)}, 0.5)`
    
    $(document).on('click', '.changeUrlButton', function() {
        var dataId = $(this).data('id');
        $.ajax({
            type: "GET",
            url: "billing/edit/" + dataId,
            success: function(response) {
                $('#vioc_name').text(response.voic_name);
                $('#uniqueid').val(response.remoteData2.uniqueid);
                const tooltipsData = response.tooltips;
                const newUrl = 'wav/' + response.voic;
                initializeWaveSurfer(newUrl, tooltipsData);
            },
            error: function(error) {
                console.error('Error in Ajax request:', error);
            }
        });
    });



    $('.modelClose').on('click', () => {
        if (wavesurfer) {
            wavesurfer.destroy();
            wavesurfer = null;
        }
    });


    $("#SubmitDownloadForm").click(function() {
        const uniqueId = $('#uniqueid').val();
        var url = '/voice/download/' + uniqueId;
        window.open(url, '_blank');
    });

    // Function to change the audio URL
    const changeAudioUrl = (newUrl) => {
        wavesurfer.load(newUrl);
    };

    /*   wavesurfer.on('interaction', () => {
          //wavesurfer.play()
          //wavesurfer.playPause()
          activeRegion = null
      }) */

    //wav
    /* const topTimeline = TimelinePlugin.create({
         height: 20,
         insertPosition: 'beforebegin',
         timeInterval: 0.2,
         primaryLabelInterval: 5,
         secondaryLabelInterval: 1,
         style: {
             fontSize: '20px',
             color: '#2D5B88',
         },
     }) */
</script>
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


        var startDate;
        var endDate;

        function datesearch() {
            var currentDate = moment();
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
                    d.agent = $('#agen').val();
                    d.telp = $('#telp').val();
                    d.ctype = $('#ctype').val();
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
            buttons: [
                'copy',
                {
                    extend: 'excel',
                    text: 'Excel',
                    title: 'ไฟล์บันทึกเสียงสนทนา',
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
                    "title": 'ไฟล์บันทึกเสียงสนทนา',
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
                        doc.content[1].table.widths = [80, 80, 100, 110, 60, 60];
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
                            //doc.content[1].table.body[i][2].alignment =
                            //'center'; // Align the second column to the right
                            // Customize alignments for other columns as needed
                            doc.content[1].table.body[i][2].alignment =
                                'center';
                            doc.content[1].table.body[i][3].alignment =
                                'center';
                            doc.content[1].table.body[i][4].alignment =
                                'center';

                        }

                    }
                },
                {
                    extend: 'print',
                    text: 'Print',
                    title: 'ไฟล์บันทึกเสียงสนทนา',
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
            stateSave: true,

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
                    data: 'ctime',
                    name: 'ctime'
                },
                {
                    data: 'telno',
                    name: 'telno'
                },
                {
                    data: 'agent',
                    name: 'agent'
                },
                {
                    data: 'duration',
                    name: 'duration'
                },
                {
                    data: 'action',
                    name: 'action',
                    className: 'no-print'
                },
            ]



        };

        var table = $('#Listview').DataTable(table_option);

        $('#searchButton').on('click', function() {
            storeFieldValues();
            //var telp = $('#telp').val();
            table.search('').draw();
            $.fn.dataTable.ext.search.pop();
            /* if (telp !== '') {
                table.column(3).search(telp).draw();
            } */
        });

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
            var startDate = moment(currentDate).subtract(30, 'days').startOf('day').format('YYYY-MM-DD HH:mm:ss');
            var endDate = moment(currentDate).endOf('month').endOf('day').format('YYYY-MM-DD HH:mm:ss');

            daterange();
            table = $('#Listview').DataTable(table_option);
            table.draw();
        });

        $('#exportPDFButton').on('click', function() {
            table.button('3').trigger();
        });

        $('#exportXLSButton').on('click', function() {
            table.button('1').trigger();
        });


        $('#exportPrintButton').on('click', function() {
            table.button('4').trigger();
        });

        $('#billing-update-button').on('click', function() {
            if (!confirm("ยืนยันการทำรายการ ?")) return;
            //e.preventDefault();
            var Id = $('#uniqueid').val();
            
            $('.alert-danger').html('');
            $('.alert-danger').hide();
            $('.alert-success').html('');
            $('.alert-success').hide();
            
            var csrfToken = document.querySelector('meta[name="csrf-token"]')
                            .getAttribute('content');
                        $.ajax({
                            type: "get",
                            url: "/billing/comment",
                            headers: {
                                'X-CSRF-TOKEN': csrfToken
                            },
                            data: {
                                uniqueid: Id,
                                billing: $('#billing-input').val(),
                            },
                            success: function(response) {
                                if (response.errors) {
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
                                    $('#CreateModal').modal('hide');
                                    toastr.success(result.success, {
                                        timeOut: 5000
                                    });
                                    $('#Listview').DataTable().ajax.reload();
                                }
                            },
                            error: function(error) {}
                        });
        });





    });
</script>
