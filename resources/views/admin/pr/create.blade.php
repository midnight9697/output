@extends('layout.app')

@section('main_content')
   <div class="ui grid">
        <div class="eight wide column">
            <form action="#" class="ui form">
                <div class="ui top attached header">
                    PURCHASE REQUEST CREATION FORM
                </div>
                <div class="ui attached segment">
                    <div class="field">
                        <div class="two fields">
                            <div class="field">
                                <label>Entity Name</label>
                                <input type="text" placeholder="Entity Name">
                            </div>
                            <div class="field">
                                <label>Fund Cluster</label>
                                <input type="text" placeholder="Fund Cluster">
                            </div>
                        </div>
                        <div class="two fields">
                            <div class="field">
                                <label>Office/Section</label>
                                <input type="text" placeholder="Office/Section">
                            </div>
                            <div class="field">
                                <label>PR No.</label>
                                <input type="text" placeholder="PR No.">
                            </div>
                        </div>
                        <div class="two fields">
                            <div class="field">
                                <label>Date</label>
                                <input type="datetime-local">
                            </div>
                            <div class="field">
                                <label>Responsibility Center Code</label>
                                <input type="text" placeholder="Responsibility Center Code">
                            </div>
                        </div>
                        
                    </div>
                </div>
                {{-- Items --}}
                <div class="ui top attached header">
                    ITEMS
                </div>
                <div class="ui attached segment">
                    <div class="field">
                        <div class="two fields">
                            <div class="field">
                                <label>Stock/Property No.</label>
                                <input type="text" name="property_number[]" placeholder="Property No.">
                            </div>
                            <div class="field">
                                <label>Unit</label>
                                <input type="text" name="unit[]" placeholder="Unit">
                            </div>
                        </div>
                        <div class="field">
                            <label>Item Description</label>
                            <textarea type="text" name="item_description[]" placeholder="Item Description"></textarea>
                        </div>
                        <div class="three fields">
                            <div class="field">
                                <label>Quantity</label>
                                <input type="text" name="quantity[]" placeholder="Quantity">
                            </div>
                            <div class="field">
                                <label>Unit Cost</label>
                                <input type="text" name="unit_cost[]" placeholder="Unit Cost">
                            </div>
                            <div class="field">
                                <label>Total Cost</label>
                                <input type="text" name="total_cost[]" placeholder="Total Cost">
                            </div>
                        </div>
                    </div>
                    <div class="field">
                        <label>Purpose</label>
                        <textarea name="purpose" id="purpose" cols="30" rows="10" placeholder="Purpose"></textarea>
                    </div>
                </div>
            </form>
        </div>
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
            <div class="ui attached segment">
                <div>NOTHING</div>
            </div>
        </div>
   </div>
@endsection