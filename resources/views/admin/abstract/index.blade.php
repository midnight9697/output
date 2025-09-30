@extends('layout.app')

@section('main_content')
    @include('default.create-button', [
      'name' => 'create_rfq_btn',
      'text' => 'CREATE ABSTRACT',
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

    </div>
@endsection
@section('custom_js')
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet">
    {{-- @vite(['resources/js/PR/create.js']) --}}
@endsection