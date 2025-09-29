@extends('layout.app')

@section('main_content')
@include('admin.pr.create_item')
   <div class="ui grid">
        <div class="sixteen wide column">
            <form action="{{ url('api/pr/create') }}" class="ui form createpr" method="POST">
                @csrf
                <div class="ui grid">
                    <div class="eight wide column">
                        <div class="ui top attached header">
                            PURCHASE REQUEST CREATION FORM
                        </div>
                        <div class="ui large form attached segment">
                            <div class="ui error message">
                                {{--  --}}
                            </div>
                            <div class="field">
                                <div class="two fields">
                                    <div class="field">
                                        <label>Entity Name</label>
                                        <input type="text" placeholder="Entity Name" name="entity_name">
                                    </div>
                                    <div class="field">
                                        <label>Fund Cluster</label>
                                        <input type="text" placeholder="Fund Cluster" name="fund_cluster">
                                    </div>
                                </div>
                                <div class="field">
                                    <div class="field">
                                        <label>Office/Section</label>
                                        <input type="text" placeholder="Office/Section" name="office">
                                    </div>
                                </div>
                                <div class="two fields">
                                    <div class="field">
                                        <label>Date</label>
                                        <input type="date" name="date">
                                    </div>
                                    <div class="field">
                                        <label>Responsibility Center Code</label>
                                        <input type="text" placeholder="Responsibility Center Code" name="responsibility_center_code">
                                    </div>
                                </div>
                                <div class="field">
                                    <label>Purpose</label>
                                    <textarea name="purpose" id="purpose" cols="30" rows="3" placeholder="Purpose" name="purpose"></textarea>
                                </div>
                                <div class="field" style="display:none">
                                    <select name="items" multiple id="items"></select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="eight wide column">
                        <div class="ui top attached header">
                            <div class="ui right aligned grid">
                                <div class="right floated left aligned eight wide column">
                                    ITEMS
                                </div>
                                <div class="left floated right aligned eight wide column">
                                    <button type="button" class="ui very tiny primary button add_item_btn">ADD</button>
                                </div>
                            </div>
                        </div>
                        <div class="ui large form attached segment table-pr-items">
                            <div style="text-align:center">Please wait...</div>
                            {{-- Items Table --}}
                        </div>
                    </div>
                    <div class="ui very tiny bottom attached segment">
                        <button type="submit" class="ui very tiny primary right floated button">FINISH</button>
                    </div>
                {{-- Items --}}
            </form>
        </div>
   </div>
@endsection
@section('custom_js')
    @vite(['resources/js/PR/create.js'])
@endsection