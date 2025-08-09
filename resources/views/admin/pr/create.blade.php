@extends('layout.app')

@section('main_content')
@include('admin.pr.create_item')
   <div class="ui grid">
        <div class="sixteen wide column">
            <form action="{{ url('api/pr/create') }}" class="ui form createpr" method="POST">
                @csrf
                <div class="ui grid">
                    <div class="sixteen wide column">
                        <div class="ui top attached header">
                            PURCHASE REQUEST CREATION FORM
                        </div>
                        <div class="ui very tiny form attached segment">
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
                                <div class="two fields">
                                    <div class="field">
                                        <label>Office/Section</label>
                                        <input type="text" placeholder="Office/Section" name="office">
                                    </div>
                                    <div class="field">
                                        <label>PR No.</label>
                                        <input type="text" placeholder="PR No." name="pr_number">
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
                            </div>
                        </div>
                    </div>
                    <div class="sixteen wide column">
                        <div class="ui top attached header">
                            <div class="ui top attached header">
                                <div class="ui right aligned grid">
                                    <div class="right floated left aligned eight wide column">
                                        PEOPLE WHO CAN SEE YOUR WORTH
                                    </div>
                                    <div class="left floated right aligned eight wide column">
                                        <button type="button" class="ui very tiny primary button">ADD</button>
                                    </div>
                                  </div>
                            </div>
                        </div>
                        <div class="ui very tiny form attached segment">
                            <div class="align center">Please wait...</div>
                        </div>
                    </div>
                {{-- Items --}}
            </form>
        </div>
        <div class="eight wide column" style="display: none">
            <div class="eight wide column">
                <div class="ui top attached header">
                    <div class="ui right aligned grid">
                        <div class="right floated left aligned eight wide column">
                            PEOPLE WHO CAN SEE YOUR WORTH
                        </div>
                        <div class="left floated right aligned eight wide column">
                            <button class="ui very tiny primary button">ADD</button>
                        </div>
                       
                      </div>
                </div>
                <div class="ui attached segment" style="max-height: 473px;min-height:473px">
                    <div>NOTHING</div>
                </div>
            </div>
        </div>
   </div>
@endsection
@section('custom_js')
    @vite(['resources/js/PR/create.js'])
@endsection