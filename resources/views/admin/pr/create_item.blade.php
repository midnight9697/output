<div class="ui tiny modal" id="modalCreaeItem">
    {{-- <div class="header">REGISTER NEW USER</div> --}}
    <div class="content">
        <form class="ui very tiny form formCreatePRItem" action="#" id="formCreatePRItem" method="post">
            <h4 class="ui dividing header">ADD NEW ITEM</h4>
            <div class="ui error message">
                {{--  --}}
            </div>
            <div class="field">
                <div class="field">
                    <label>Stock/Property No.</label>
                    <input type="text" name="property_number" placeholder="Property No.">
                </div>
                <div class="field">
                    <label>Unit</label>
                    <input type="text" name="unit" placeholder="Unit">
                </div>
                <div class="field">
                    <label>Item Description</label>
                    <textarea type="text" name="item_description" placeholder="Item Description" rows="1"></textarea>
                </div>
                <div class="field">
                    <label>Quantity</label>
                    <input type="text" name="quantity" placeholder="Quantity">
                </div>
                <div class="field">
                    <label>Unit Cost</label>
                    <input type="text" name="unit_cost" placeholder="Unit Cost">
                </div>
                <div class="field">
                    <label>Total Cost</label>
                    <input type="text" name="total_cost" placeholder="Total Cost">
                </div>
            </div>
        </form>
    </div>
    <div class="actions"><button class="ui very tiny primary button submit_item_to_list">NEW</button></div>
</div>
{{-- <button class="ui very tiny primary button">ADD</button> --}}