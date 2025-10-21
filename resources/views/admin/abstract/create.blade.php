
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
@include('layout.custom-modal', ['view' => 'admin.abstract.add_bidder', 'name' => 'addBiddderModal', 'title' => 'ADD BIDDER SPECIFICATION', 'actions_button' => 'submit_bidder_button'])

<form action="#" class="form ui form-create-abstract">
    <div class="ui error message">
        {{--  --}}
    </div>
    <div class="ui top attached segment">
        <div class="ui right aligned grid">
            <div class="right floated left aligned eight wide column">
                <h5>ABSTRACT</h5>
            </div>
            <div class="left floated right aligned eight wide column">
                <button type="button" class="ui very tiny primary button create-abstarct-button">CREATE</button>
            </div>
        </div>
     </div>
    <div class="ui attached segment">
        <div class="field">
            <div class="two fields">
                <div class="field">
                    <label for="purpose">PURPOSE</label>
                    <input type="text" name="purpose" id="purpose" placeholder="Purpose">
                </div>
                <div class="field">
                    <label>UPLOAD ABSTRACT FILE (Optional)</label>
                    <input type="file" multiple class="file" id="files" name="files" placeholder="FILE UPLOAD">
                </div>
            </div>
            <div class="field">
                <label for="quotation">RFQ</label>
                <select closeOnChange={true} name="quotation" multiple id="quotation" class="ui fluid multiple search selection dropdown rfqs">
                    @foreach (encryptMany(RFQ::where('creator', auth()->user()->id)->orderBy('created_at', 'desc')->get()) as $item)
                        <option {{ ((decryptUrlSafe($rfq->id)) == decryptUrlSafe($item->id)?"selected":"") }} value="{{ $item->id }}">{{ $item->project_purpose }}</option>
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
            'ITEM',
            'QTY',
            'UNIT',
            'ITEM/DESCRIPTION',
            'ACTION',
        ]
      ])
    </div>
</form>
@endsection

@section('custom_js')
    <script>
        localStorage.setItem('rfq_id', "{{ $rfq->id }}");
    </script>
    @vite(['resources/js/abstract/create.js'])
    @vite(['resources/js/abstract/add_bidder.js'])
@endsection