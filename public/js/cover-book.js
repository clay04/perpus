document.querySelectorAll('.pdf-cover').forEach(el => {

    const url = el.dataset.pdf;

    const pdfjsLib = window['pdfjs-dist/build/pdf'];

    pdfjsLib.GlobalWorkerOptions.workerSrc =
        'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.4.120/pdf.worker.min.js';

    pdfjsLib.getDocument(url).promise.then(pdf => {

        pdf.getPage(1).then(page => {

            const viewport = page.getViewport({ scale: 0.5 });

            const canvas = document.createElement('canvas');
            const context = canvas.getContext('2d');

            canvas.height = viewport.height;
            canvas.width = viewport.width;

            el.appendChild(canvas);

            el.style.height = '200px';
            el.style.overflow = 'hidden';

            page.render({
                canvasContext: context,
                viewport
            });

        });

    });

});
