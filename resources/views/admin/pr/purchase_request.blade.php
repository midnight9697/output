@extends('layout.app')

@section('main_content')
    <div class="ui grid stackable padded" id="prs_table">
        <div style="width:100%">
            <div class="ui right aligned grid">
                <div class="left floated left aligned six wide column">
                    <div class="ui small primary labeled icon button" id="create_user_vbtn">
                        <i class="plus icon"></i>CREATE PURCHASE REQUEST
                    </div>
                </div>
                <div class="right floated right aligned six wide column">
                    <div class="ui right aligned search search_people">
                      <div class="ui icon input">
                        <input class="prompt" type="text" placeholder="Search PR...">
                        <i class="search icon"></i>
                      </div>
                      <div class="results"></div>
                    </div>
                </div>
              </div>
        </div>
    </div>
@endsection

@section('custom_js')
    @vite(['resources/js/PR/index.js'])
@endsection