function renderPDF(pdfFilePath) {
    // Asynchronously load the PDF file using PDF.js
    var loadingTask = pdfjsLib.getDocument(pdfFilePath);
    loadingTask.promise.then(function(pdf) {
        // Fetch the first page
        pdf.getPage(1).then(function(page) {
            var scale = 1.5;
            var viewport = page.getViewport({ scale: scale });

            // Prepare the canvas element for rendering
            var canvas = document.createElement('canvas');
            var context = canvas.getContext('2d');
            canvas.width = viewport.width;
            canvas.height = viewport.height;
            document.getElementById('pdf-viewer').innerHTML = '';
            document.getElementById('pdf-viewer').appendChild(canvas);

            // Render the page on the canvas
            var renderContext = {
                canvasContext: context,
                viewport: viewport
            };
            page.render(renderContext);
        });
    });
}