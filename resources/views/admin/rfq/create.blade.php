<div class="ui top aligned modal" id="modalCreateRFQ">
    <i class="close icon"></i>
    <div class="header">
        <h3 class="modal-title">REQUEST FOR QUOTATION FORM</h3>
    </div>
    <div class="content">
        <div class="ui form attached segment">
            <form class="ui form" action="#" id="formCreateRFQ" method="post">
                <div id="toolbar">
    
                </div>
                <div id="editor">

                </div>
            </form>
        </div>
    </div>
    <div class="actions">
        <button class="ui approve very tiny button approve_button">PROCEED</button>
    </div>
</div>

<div class="ui top aligned modal" id="modalUpdatteRFQ">
    <i class="close icon"></i>
    <div class="header">
        <h3 class="modal-title">REQUEST FOR QUOTATION FORM</h3>
    </div>
    <div class="content">
        <div class="ui form attached segment">
            <form class="ui form" action="#" id="formUpdateRFQ" method="post">
                <div class="field">
                    <div id="update_toolbar">
                        {{--  --}}
                    </div>
                    <div id="update_editor">
                        {{--  --}}
                    </div>
                </div>
                <div class="field">
                    <label>Remarks</label>
                    <textarea name="remarks" id="remarks" cols="30" rows="10" placeholder="Remarks"></textarea>
                </div>
            </form>
        </div>
    </div>
    <div class="actions">
        <button class="ui approve very tiny button save_button">SAVE CHANGES</button>
    </div>
</div>

<div class="ui top aligned modal" id="modalViewRFQ">
    <i class="close icon"></i>
    <div class="content">
        <div class="ui top attached segment">
            <h3 class="modal-title">REQUEST FOR QUOTATION FORM</h3>
        </div>
        <div class="ui form attached segment">
            <div id="preview_rfq">
                
            </div>
        </div>
    </div>
</div>