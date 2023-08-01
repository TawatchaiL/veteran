<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.min.js"></script>
<div id="pdf-container">
    {{-- <embed type="application/pdf" class="pdf-viewer"
        src="file_store/KSfxgov4tL7Jk4A1Bqi3bJaLsXWelol7DhrQI8TD_1690428551565_QT-66072261-มานนท์-lenovo1-1(1).pdf"
        style="width: 95%; height: 650px;">  <canvas id="pdf-canvas" width="500" height="600"></canvas> --}}

</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // PDF.js configuration
        const pdfjsLib = window['pdfjs-dist/build/pdf'];

        // URL of the PDF file to load
        const pdfUrl =
            'http://localhost:8000/file_store/k5azzIYOytnB4cngfcLlY5RVP2TtDwu9XQW5bZwg_1690298206875_Attach_TOR_1.pdf';

        // Variable to store the canvas element
        let canvas;

        // Asynchronous function to load and render the PDF
        async function renderPDF() {
            try {
                // Fetch the PDF file and get its array buffer
                const response = await fetch(pdfUrl);
                const pdfData = await response.arrayBuffer();

                // Load the PDF document
                const pdfDocument = await pdfjsLib.getDocument({
                    data: pdfData
                }).promise;

                // Get the first page of the PDF
                const pdfPage = await pdfDocument.getPage(1);

                

                const pdfContainer = document.getElementById('pdf-container');
                const canvas = document.createElement('canvas');
                canvas.id = 'pdf-canvas';
                pdfContainer.appendChild(canvas);

                // Set the canvas context
                const context = canvas.getContext('2d');

                // Get the desired scale for rendering (optional)
                const desiredScale = 1.5; // Change this value as needed

                // Get the viewport of the PDF page
                const viewport = pdfPage.getViewport({
                    scale: desiredScale
                });

                // Set the canvas size based on the PDF page size
                canvas.width = viewport.width;
                canvas.height = viewport.height;

                // Render the PDF page on the canvas
                const renderContext = {
                    canvasContext: context,
                    viewport: viewport,
                };
                await pdfPage.render(renderContext).promise;

                // Add click event listener to the canvas (inside the renderPDF function)
                canvas.addEventListener('click', function(e) {
                    // Get the click coordinates relative to the canvas
                    const canvasRect = canvas.getBoundingClientRect();
                    const clickX = e.clientX - canvasRect.left;
                    const clickY = e.clientY - canvasRect.top;

                    // Get the scale of the PDF rendering
                    const scale = pdfPage.getViewport({
                        scale: 6
                    }).scale;

                    // Calculate the approximate x, y coordinates on the PDF
                    const pdfX = clickX / scale;
                    const pdfY = clickY / scale;

                    // Now you have the approximate click coordinates (pdfX, pdfY) on the PDF
                    console.log('Clicked on PDF at: X=' + clickX + ', Y=' + clickY);
                    console.log('Clicked on PDF at: X=' + pdfX + ', Y=' + pdfY);
                });
            } catch (error) {
                console.error('Error loading or rendering the PDF:', error);
            }
        }

        // Call the renderPDF function to load and display the PDF
        renderPDF();
    });
</script>