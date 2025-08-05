@extends('layout.app')

@section('custom_css')
    <style>
        #prTable {
            width:100%;
        }
    </style>
@endsection

@section('main_content')
    <div class="ui grid stackable padded" id="prs_table">
       
    </div>
    <table class="ui very basic collapsing celled table hidden" id="prTable">
        <thead>
           <tr>
                <th>Shit Melody</th>
                <th>Shit Melody</th>
                <th>Office</th>
           </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="2" class="center aligned">Loading...</td>
            </tr>
        </tbody>
    </table>
@endsection

@section('custom_js')
    @vite(['resources/js/PR/index.js'])
@endsection