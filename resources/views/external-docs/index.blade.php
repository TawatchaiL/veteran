@extends('layouts.app')

@section('style')
    @include('external-docs.style')
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    {{-- <h4>Users & Roles Management</h4> --}}
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        {{-- <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Users Management</li> --}}

                        @can('external-doc-create')
                            <button type="button" class="btn btn-success" id="CreateButton">
                                <i class="fas fa-file-signature"></i> ลงรับหนังสือ</a> </button>
                        @else
                            <span class="d-inline-block" tabindex="0" data-toggle="tooltip" data-placement="bottom"
                                title="คุณไม่มีสิทธิ์ในส่วนนี้">
                                <button type="button" class="btn btn-success disabled">
                                    <i class="fas fa-file-signature"></i> ลงรับหนังสือ </a></button>
                            </span>
                        @endcan &nbsp;

                        @can('external-doc-delete')
                            <button type="button" class="btn btn-danger delete_all_button"><i class="fa fa-trash"></i> ลบ
                                ทั้งหมด</button>
                        @else
                            <span class="d-inline-block" tabindex="0" data-toggle="tooltip" data-placement="bottom"
                                title="คุณไม่มีสิทธิ์ในส่วนนี้">
                                <button type="button" class="btn btn-danger disabled"><i class="fa fa-trash"></i>
                                    ลบทั้งหมด</button>
                            </span>
                        @endcan
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
                            <h3 class="card-title"><i class="fas fa-file-signature"></i> ลงรับหนังสือ </h3>
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
                            <form method="post" action="{{ route('external-docs.destroy_all') }}" name="delete_all"
                                id="delete_all">
                                @csrf
                                @method('POST')
                                <table id="Listview" class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th><input type="checkbox" id="check-all" class="flat"></th>
                                            <th>ชื่อ อปท</th>
                                            <th>เลขที่รับ</th>
                                            <th>เรื่อง</th>
                                            <th>วันที่เวลา</th>
                                            <th>ระดับชั้นความเร็ว</th>
                                            <th>ผู้รับ</th>
                                            <th width="120px"></th>
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
        <div id="pdf-container">
          {{-- <embed type="application/pdf" class="pdf-viewer"
                src="file_store/KSfxgov4tL7Jk4A1Bqi3bJaLsXWelol7DhrQI8TD_1690428551565_QT-66072261-มานนท์-lenovo1-1(1).pdf"
                style="width: 95%; height: 650px;">  <canvas id="pdf-canvas" width="500" height="600"></canvas>--}}

        </div>

    </section>


    @include('external-docs.create')

    @include('external-docs.edit')

    @include('external-docs.inner-modal')

    {{--  {!! $data->render() !!} --}}
@endsection

@section('script')
    @include('external-docs.dropzone')
    @include('external-docs.script')
@endsection
<script>
    document.addEventListener("DOMContentLoaded", function() {
    // PDF.js configuration
    const pdfjsLib = window['pdfjs-dist/build/pdf'];

    // URL of the PDF file to load
    const pdfUrl = 'http://localhost:8000/file_store/1OjkuHeNTslPYT1DFG30QhHzMpCpXqEU7T84sguV_1690428274472_PreviewDocCertServlet.pdf';

    // Asynchronous function to load and render the PDF
    async function renderPDF() {
        try {
            // Fetch the PDF file and get its array buffer
            const response = await fetch(pdfUrl);
            const pdfData = await response.arrayBuffer();

            // Load the PDF document
            const pdfDocument = await pdfjsLib.getDocument({ data: pdfData }).promise;

            // Get the first page of the PDF
            const pdfPage = await pdfDocument.getPage(1);

            // Get the canvas element to render the PDF
            const pdfContainer = document.getElementById('pdf-container');
            const canvas = document.createElement('canvas');
            canvas.id = 'pdf-canvas';
            pdfContainer.appendChild(canvas);

            // Set the canvas context
            const context = canvas.getContext('2d');

            // Get the desired scale for rendering (optional)
            const desiredScale = 1.5; // Change this value as needed

            // Get the viewport of the PDF page
            const viewport = pdfPage.getViewport({ scale: desiredScale });

            // Set the canvas size based on the PDF page size
            canvas.width = viewport.width;
            canvas.height = viewport.height;

            // Render the PDF page on the canvas
            const renderContext = {
                canvasContext: context,
                viewport: viewport,
            };
            await pdfPage.render(renderContext).promise;
        } catch (error) {
            console.error('Error loading or rendering the PDF:', error);
        }
    }

    // Call the renderPDF function to load and display the PDF
    renderPDF();

    var pdfCanvas = $('#pdf-canvas');

    // Handle click event on the PDF canvas
    pdfCanvas.on('click', function(e) {
        alert();
        // Get the click coordinates relative to the canvas
        var canvasOffset = pdfCanvas.offset();
        var clickX = e.pageX - canvasOffset.left;
        var clickY = e.pageY - canvasOffset.top;

        // Get the current PDF page being displayed
        var pdfPageNumber = PDFViewerApplication.pdfViewer.currentPageNumber;
        var pdfPage = PDFViewerApplication.pdfViewer.getPageView(pdfPageNumber - 1);

        // Get the scale of the PDF rendering
        var scale = pdfPage.viewport.scale;

        // Calculate the approximate x, y coordinates on the PDF
        var pdfX = clickX / scale;
        var pdfY = clickY / scale;

        // Now you have the approximate click coordinates (pdfX, pdfY) on the PDF
        console.log('Clicked on PDF at: X=' + pdfX + ', Y=' + pdfY);
    });
});


</script>
