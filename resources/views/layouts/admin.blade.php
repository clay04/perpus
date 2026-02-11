<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container-fluid">
    <div class="row min-vh-100">

        <!-- Sidebar -->
        @include('partials.admin-sidebar')

        <!-- Main Content -->
        <div class="col-md-9 col-lg-10 p-4 bg-light">
            @yield('content')
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('js/app.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('js/delete-confirm.js') }}"></script>
<script src="{{ asset('js/pdfFile.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.4.120/pdf.min.js"></script>
@if(isset($fileUrl))
<script>
const url = "{{ $fileUrl }}";
const previewLimit = {{ $previewPages }};
const container = document.getElementById('pdf-container');

if (container && url) {

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

}
</script>
@endif


</body>
</html>
