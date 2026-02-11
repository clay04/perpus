document.addEventListener("DOMContentLoaded", function () {

    const container = document.getElementById('pdf-container');

    if (!container) return;

    const url = container.dataset.url;
    const previewLimit = parseInt(container.dataset.limit || 5);

    if (!url) return;

    const pdfjsLib = window['pdfjs-dist/build/pdf'];

    pdfjsLib.GlobalWorkerOptions.workerSrc =
        'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.4.120/pdf.worker.min.js';

    pdfjsLib.getDocument(url).promise.then(function(pdf) {

        const totalPages = Math.min(pdf.numPages, previewLimit);

        for (let pageNum = 1; pageNum <= totalPages; pageNum++) {

            pdf.getPage(pageNum).then(function(page) {

                const scale = 1.2;
                const viewport = page.getViewport({ scale });

                const canvas = document.createElement("canvas");
                const context = canvas.getContext("2d");

                canvas.height = viewport.height;
                canvas.width = viewport.width;

                container.appendChild(canvas);

                page.render({
                    canvasContext: context,
                    viewport: viewport
                });
            });
        }

    });

});
