@extends('layout.app')

@section('main_content')
    {{-- @include('default.create-button', [
      'name' => 'create_rfq_btn',
      'text' => 'CREATE RFQ',
      'icon' => 'plus',
      'link' => url('rfq/form-create')
    ]) --}}
    {{-- <input type="file" id="fileInput" />
    <pre id="output"></pre>
    
    <button id="fillPdfBtn">Download</button> --}}
    {{-- <canvas id="pdf-canvas"></canvas> --}}
    <div class="ui top attached tabular menu">
        <div class="active item" data-tab="rfq-inbox">RFQ</div>
        {{-- <div class="item" data-tab="rfq-outbox">ARCHIVED</div> --}}
    </div>
    
    <div class="ui bottom attached active tab segment" data-tab="rfq-inbox">
        @include('admin.rfq.table', ['name' => 'rfq-inbox'])
    </div>
    <div class="ui bottom attached tab segment" data-tab="rfq-outbox">
        @include('admin.rfq.table', ['name' => 'rfq-outbox'])
    </div>
    
@endsection
@section('custom_js')
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js"></script> --}}
    {{-- <script src="https://unpkg.com/pdfjs-dist/build/pdf.js"></script> --}}
    @vite(['resources/js/rfq/index.js'])
    {{-- @vite(['resources/js/table/pdf.js']) --}}
    {{-- @vite(['resources/js/table/pdf-1.js']) --}}
    <script>
        const url = './files/rfq.pdf';
        // const loadingTask = pdfjsLib.getDocument(url);

        // loadingTask.promise.then(pdf => {
        //   console.log('PDF loaded');

        //   // Fetch the first page
        //   return pdf.getPage(1).then(page => {
        //     console.log('Page loaded');

        //     const scale = 1.5;
        //     const viewport = page.getViewport({ scale });

        //     // Prepare canvas
        //     const canvas = document.getElementById('pdf-canvas');
        //     const context = canvas.getContext('2d');
        //     canvas.height = viewport.height;
        //     canvas.width = viewport.width;

        //     // Render PDF page into canvas context
        //     const renderContext = {
        //       canvasContext: context,
        //       viewport: viewport
        //     };
        
        //     return page.render(renderContext).promise;
        //   });
        // }).then(() => {
        //   console.log('Page rendered');
        // }).catch(error => {
        //   console.error('Error loading PDF: ', error);
        // });
    </script>
@endsection