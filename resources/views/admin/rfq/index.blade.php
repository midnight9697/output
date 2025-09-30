@extends('layout.app')

@section('main_content')
    @include('default.create-button', [
      'name' => 'create_rfq_btn',
      'text' => 'CREATE RFQ',
      'icon' => 'plus',
    ])
    <div class="ui top attached tabular menu">
        <div class="active item" data-tab="inbox">RFQ</div>
        <div class="item" data-tab="outbox">ARCHIVED</div>
    </div>
    
    <div class="ui bottom attached active tab segment">
        <div id="toolbar">

        </div>
        <div id="editor">
            <p>Core build with no theme, formatting, non-essential modules</p>
        </div>
        {{-- @include('default.create-table', [ 'name' => 'rfq-table',
            'columns' => [
              'PR No.',
              'Entity Name',
              'Fund Cluster',
              'Office',
              'Responsibility Code',
              'Purpose',
              'Creator',
              'Member',
              'Date Created',
              'Latest Update',

            ]
        ]) --}}
    </div>
@endsection
@section('custom_js')
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet">
    <script>
        const toolbarOptions = [
          ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
          ['blockquote', 'code-block'],
          ['link', 'image', 'video', 'formula'],

          [{ 'header': 1 }, { 'header': 2 }],               // custom button values
          [{ 'list': 'ordered'}, { 'list': 'bullet' }, { 'list': 'check' }],
          [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
          [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
          [{ 'direction': 'rtl' }],                         // text direction

          [{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown
          [{ 'header': [1, 2, 3, 4, 5, 6, false] }],

          [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
          [{ 'font': [] }],
          [{ 'align': [] }],

          ['clean']                                         // remove formatting button
        ];
        const options = {
          debug: 'info',
          modules: {
            toolbar: toolbarOptions,
          },
          placeholder: 'Compose an epic...',
          theme: 'snow'
        };
        const quill = new Quill('#editor', options);
    </script>
    {{-- @vite(['resources/js/PR/create.js']) --}}
@endsection