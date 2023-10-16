<script src="dist/js/html2canvas.min.js"></script>
<script src='dist/js/jspdf.min.js'></script>
<script src="dist/js/jspdf.plugin.autotable.min.js"></script>
<script src="/js/app.js?v=1"></script>
{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
<script type="module">
    import WaveSurfer from 'https://unpkg.com/wavesurfer.js@7/dist/wavesurfer.esm.js'
    import Hover from 'https://unpkg.com/wavesurfer.js@7/dist/plugins/hover.esm.js'
    import Minimap from 'https://unpkg.com/wavesurfer.js@7/dist/plugins/minimap.esm.js'
    import TimelinePlugin from 'https://unpkg.com/wavesurfer.js@7/dist/plugins/timeline.esm.js'
    import RegionsPlugin from 'https://unpkg.com/wavesurfer.js@7/dist/plugins/regions.esm.js'

    let wavesurfer; // Declare the wavesurfer variable

    // Function to create and initialize WaveSurfer
    const initializeWaveSurfer = (newUrl) => {

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

            toggleMuteButton.onclick = function() {
                wavesurfer.toggleMute();
            };

            setMuteOnButton.onclick = function() {
                wavesurfer.setMute(true);
            };

            setMuteOffButton.onclick = function() {
                wavesurfer.setMute(false);
            };

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

            const tooltipsData = fetchTooltipsFromDB();
            // Iterate through the tooltip data and add tooltips to the waveform
            tooltipsData.forEach(({
                startTime,
                endTime,
                content
            }) => {
                // Create a region for each tooltip
                const region = wsRegions.addRegion({
                    start: startTime,
                    end: endTime,
                    color: 'rgba(255, 0, 0, 0.1)', // Set your desired tooltip color
                });

                const tooltip = document.createElement('div');
                tooltip.className = 'region-tooltip';
                tooltip.style.paddingLeft = '10px';
                tooltip.textContent = content;

                // Attach the tooltip to the region's element
                region.element.appendChild(tooltip);
                customDialog.style.display = 'none';

            });

            /*  // Create a button to remove the region
            const regionButton = document.createElement('button');
            regionButton.className = 'remove-region-button';
            regionButton.textContent = 'X';

            // Add a click event listener to remove the region when the button is clicked
            regionButton.addEventListener('click', () => {
                const activeRegion = wsRegions.getActiveRegion();
                if (activeRegion) {
                    activeRegion.remove();
                }
            });
           */
            // Append the button to the container
            //const container = document.querySelector('#waveform-container');
            //container.appendChild(regionButton);
        });

        const customDialog = document.getElementById('custom-dialog');
        const contentInput = document.getElementById('content-input');
        const addContentButton = document.getElementById('add-content-button');
        // const callRecordingId = $('#call_recording_id').val();
        // const uniqueId = $('#uniqueid').val();
        wsRegions.enableDragSelection({
            color: 'rgba(255, 0, 0, 0.1)',
            //content: 'Region Content',
        });

        let currentRegion;

        // Debug statement to check if the code leading up to onRegionCreated is executing
        // console.log('Before onRegionCreated');

        // Add a listener for the region-created event
        wsRegions.on('region-created', (region) => {
            // Callback code
            console.log('Region Created:', region);

            const button = document.createElement('button');
            button.className = 'remove-region-button';
            button.textContent = 'X';
            customDialog.style.display = 'block';

            button.addEventListener('click', () => {
                // Remove the region when the button is clicked
                region.remove();
                // console.log(region);

            });

            document.getElementById('add-content-button').addEventListener('click', function(e) {
                // addContentButton.addEventListener('click', () => {
                    console.log('current Region');
                    console.log(currentRegion);

                e.preventDefault();
                if (currentRegion) {

                    // Remove any existing tooltips in the current region
                    const existingTooltips = currentRegion.element.querySelectorAll('.region-tooltip');
                    existingTooltips.forEach((tooltip) => {
                        tooltip.remove();
                    });

                    // Create a tooltip element
                    const tooltip = document.createElement('div');
                    const content = contentInput.value;

                    tooltip.className = 'region-tooltip';
                    tooltip.textContent = content; // Replace with your tooltip text
                    tooltip.style.paddingLeft = '10px';
                    customDialog.style.display = 'none'; // Close the dialog box
                    currentRegion.element.appendChild(tooltip);

                    const callRecordingId = $('#call_recording_id').val();
                    const uniqueId = $('#uniqueid').val();
                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    // const content = contentInput.value;
                    //end
                    $.ajax({
                        type: "get",
                        url: "/voicerecord/comment",
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        },
                        data: {
                            call_recording_id: callRecordingId,
                            uniqueid: uniqueId,
                            comment: content,
                            start: region.start,
                            end: region.end,
                        },
                        success: function(response) {
                            // Handle success response if needed
                            console.log(response.message);
                            $('#CreateModal').modal('hide');
                        },
                        error: function(error) {
                            // Handle error if needed
                        }
                    });

                }
            });

            // Attach a click event handler to the button


            // Append the button to the region element
            region.element.appendChild(button);

            currentRegion = region;

            // console.log(currentRegion);
        });

        wsRegions.on('region-updated', (region) => {
            console.log('Updated region', region)
        })

        // Loop a region on click
        let loop = true
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
                e.stopPropagation() // prevent triggering a click on the waveform
                activeRegion = region
                region.play()
                /* region.setOptions({
                    color: randomColor()
                }) */
            })
            // Reset the active region when the user clicks anywhere in the waveform
            wavesurfer.on('interaction', () => {
                activeRegion = null
            })
        }

        $('#CreateModal').modal('show');
    }

    const random = (min, max) => Math.random() * (max - min) + min
    const randomColor = () => `rgba(${random(0, 255)}, ${random(0, 255)}, ${random(0, 255)}, 0.5)`

    $(document).on('click', '.changeUrlButton', function() {
        //const newUrl = 'wav/PinkPanther60.wav'; // Replace with the new URL
        // const newUrl = 'wav/2023/10/01/q-4567-8888-20231001-141026-1696169425.161.wav';
        var dataId = $(this).data('id'); // Use $(this) to refer to the clicked button

        $.ajax({
            type: "GET",
            url: "voicerecord/edit/" + dataId,
            success: function(response) {
                console.log(response.voic);
                console.log(response.remoteData2);
                const newUrl = 'wav/' + response.voic;
                $('#vioc_name').text(response.voic_name);
                $('#call_recording_id').val(response.remoteData2.id);
                $('#uniqueid').val(response.remoteData2.uniqueid);
                // console.log('Button clicked!');
                initializeWaveSurfer(newUrl);
            },
            error: function(error) {
                console.error('Error in Ajax request:', error);
            }
        });


    });


    $('#canclecomment').on('click', () => {
        document.getElementById('custom-dialog').style.display = 'none';
    });



    $('.modelClose').on('click', () => {
        console.log(wavesurfer);
        if (wavesurfer) {

            // Destroy the WaveSurfer instance to clear it
            wavesurfer.destroy();
            wavesurfer = null; // Set wavesurfer to null to indicate it's destroyed
        }
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

        $(document).on('click', '#CreateButton', function(e) {
            e.preventDefault();
            $('.alert-danger').html('');
            $('.alert-danger').hide();
            $('.alert-success').html('');
            $('.alert-success').hide();
            $('#CreateModal').modal('show');
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
                url: "contacts/edit/" + id,
                method: 'GET',
                success: function(res) {
                    $('#EditName').val(res.data.name);
                    $('#EditEmail').val(res.data.email);
                    $('#EditPostcode').val(res.data.postcode);
                    $('#EditAddress').val(res.data.address);
                    $('#EditTelephone').val(res.data.telephone);

                    $('#EditModalBody').html(res.html);
                    $('#EditModal').modal('show');
                }
            });

        })


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
