<div class="ui modal" id="modalCreate">
    {{-- <div class="header">REGISTER NEW USER</div> --}}
    <div class="content">
        <form class="ui form" action="#" id="formCreateUser" method="post">
            <h4 class="ui dividing header">REGISTER NEW USER</h4>
            <div class="ui error message">
                {{--  --}}
            </div>
            <div class="field">
                <div class="seven fields">
                    <div class="field">
                        <label>Stock/Property No.</label>
                        <input type="text" name="property_number[]" placeholder="Property No.">
                    </div>
                    <div class="field">
                        <label>Unit</label>
                        <input type="text" name="unit[]" placeholder="Unit">
                    </div>
                    <div class="field">
                        <label>Item Description</label>
                        <textarea type="text" name="item_description[]" placeholder="Item Description" rows="1"></textarea>
                    </div>
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
        </form>
    </div>
</div>
{{-- <button class="ui very tiny primary button">ADD</button> --}}