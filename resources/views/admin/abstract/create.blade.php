
@extends('layout.app')

@section('custom_css')
    <style>
        .prTable {
            width:100%;
        }
    </style>
@endsection

@section('main_content')
@php
    use App\Models\RFQ;
@endphp
<form action="#" class="form ui form-create-abstract">
    <div class="ui error message">
        {{--  --}}
    </div>
    <div class="ui top attached segment">
        <h5> ABSTRACT DETAILS</h5>
     </div>
    <div class="ui attached segment">
        <div class="field">
            <div class="two fields">
                <div class="field">
                    <label for="purpose">PURPOSE</label>
                    <input type="text" name="purpose" id="purpose" placeholder="Purpose">
                </div>
                <div class="field">
                    <label>UPLOAD ABSTRACT FILE</label>
                    <input type="file" multiple class="file" id="files" name="files" placeholder="FILE UPLOAD">
                </div>
            </div>
            <div class="field">
                <label for="quotation">RFQ</label>
                <select name="quotation" multiple="" class="ui fluid multiple search selection dropdown">
                    @foreach (encryptMany(RFQ::orderBy('created_at', 'desc')->get()) as $item)
                        <option value="{{ $item->id }}">{{ $item->project_purpose }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="ui attached segment">
        <h5> ABSTRACT PROJECTS</h5>
    </div>
    <div class="ui bottom attached segment">
        @include('default.create-table', [ 'name' => 'abstract-items-table', 'body' => 'abstract-items-body',
        'columns' => [
            'REF NO.',
            'PURPOSE',
            'UPLOADED AT'
        ]
      ])
    </div>
</form>
@endsection

@section('custom_js')
    @vite(['resources/js/abstract/create.js'])
@endsection
