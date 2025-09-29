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
                    <input type="text" name="unit" placeholder="Unit" pattern="[A-Za-z]*">
                </div>
                <div class="field">
                    <label>Item Description</label>
                    <textarea type="text" name="item_description" placeholder="Item Description" rows="1"></textarea>
                </div>
                <div class="field">
                    <label>Quantity</label>
                    <input type="text" name="quantity" placeholder="Quantity" class="total_cost">
                </div>
                <div class="field">
                    <label>Unit Cost</label>
                    <input type="text" name="unit_cost" placeholder="Unit Cost" class="total_cost">
                </div>
                <div class="field">
                    <label>Total Cost</label>
                    <input type="text" name="total_cost" placeholder="Total Cost" disabled id="total_cost">
                </div>
            </div>
        </form>
    </div>
    <div class="actions"><button class="ui very tiny primary button submit_item_to_list">NEW</button></div>
</div>

<div class="ui tiny modal" id="modalAddMember">
    {{-- <div class="header">REGISTER NEW USER</div> --}}
    <div class="content">
        <div class="ui very tiny form formAddMember" id="formAddMember">
            <h4 class="ui dividing header">ADD NEW MEMBER</h4>
            <div class="ui error message">
                {{--  --}}
            </div>
            <div class="field">
                <div class="field">
                    <label>PEOPLE</label>
                    <div class="ui user search search-people">
                        <div class="ui icon input">
                          <input class="prompt" type="text" placeholder="Search...">
                          <i class="search icon"></i>
                        </div>
                        <div class="results"></div>
                      </div>
                </div>
                <div class="field">
                    <label>ROLE</label>
                    <select name="role" id="role" class="member-role">
                        <option value="admin">ADMIN</option>
                        <option value="member">MEMBER</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="actions"><button class="ui very tiny primary button submit_user_to_list">NEW</button></div>
</div>
{{-- <button class="ui very tiny primary button">ADD</button> --}}