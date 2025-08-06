@extends('layout.app')

@section('custom_css')
    <style>
        #prTable {
            width:100%;
        }
    </style>
@endsection

@section('main_content')
    <div class="ui right aligned grid">
        <div class="left floated left aligned six wide column">
            <div class="ui small primary labeled icon button" id="create_user_vbtn">
              <i class="user icon"></i> REGISTER
            </div>
        </div>
    </div>
    <table class="ui very basic collapsing celled table hidden" id="prTable">
        <thead>
           <tr>
                <th>Entity Name</th>
                <th>Fund Cluster</th>
                <th>Office</th>
                <th>PR No.</th>
                <th>Date</th>
                <th>Responsibility Code</th>
                <th>Purpose</th>
           </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="7" class="center aligned">Loading...</td>
            </tr>
        </tbody>
    </table>
@endsection

@section('custom_js')
    @vite(['resources/js/PR/index.js'])
@endsection