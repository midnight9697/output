<div class="ui top aligned modal" id="modalCreateSupplementalSpec">
    <i class="close icon"></i>
    <div class="header">
        <h3 class="modal-title">ADD PROJECT PROCUREMENT</h3>
    </div>
    <div class="content">
        <div class="ui form attached segment">
            <form action="#" class="ui form formCreateSupplementalSpec" method="POST">
                <div class="ui error message">
                    {{--  --}}
                </div>
                <div class="field">
                    <label>CODE (PAP)</label>
                    <input type="text" name="code" placeholder="CODE">
                </div>
                <div class="field">
                    <label>PROCUREMENT PROJECT</label>
                    <textarea type="text" name="procurement_project" placeholder="PROCUREMENT PROJECT"></textarea>
                </div>
                <div class="field">
                    <label>END-USER</label>
                    <input type="text" name="end_user" placeholder="END-USER" required>
                </div>
                <div class="field">
                    <div class="two fields">
                        <div class="field">
                            <label>EARLY PROCUREMENT</label>
                            <select name="early_procurement" id="early_procurement">
                                <option value="0">NO</option>
                                <option value="1">YES</option>
                            </select>
                        </div>
                        <div class="field">
                            <label>MODE OF PROCUREMENT</label>
                            <select name="mode_of_procurement" id="mode_of_procurement">
                                @foreach (classify() as $class)
                                    <option value="{{ $class }}">{{ $class }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="field">
                    <label>SCHEDULE FOR EACH PROCUREMENT ACTIVITY</label>
                    <hr>
                    <div class="field">
                        <label>ADVERTISEMENT/POSTING IF EB/REI</label>
                        <input type="date" name="advertisement" placeholder="ADVERTISEMENT/POSTING IF EB/REI">
                    </div>
                    <div class="field">
                        <label>SUBMISSION/OPENING BIDS</label>
                        <input type="date" name="submission" placeholder="SUBMISSION/OPENING BIDS">
                    </div>
                    <div class="field">
                        <label>NOTICE OF AWARDS</label>
                        <input type="date" name="notice_of_awards" placeholder="NOTICE OF AWARDS">
                    </div>
                    <div class="field">
                        <label>CONTRACT SIGNING</label>
                        <input type="date" name="contract_signing" placeholder="CONTRACT SIGNING">
                    </div>
                </div>
                <div class="field">
                    <label>SOURCE OF FUNDS</label>
                    <input type="text" name="source_of_funds" placeholder="SOURCE OF FUNDS">
                </div>
                <div class="field">
                    <label>ESTIMATED BUDGET (PhP)</label>
                    <hr>
                    <div class="three fields">
                        <div class="field">
                            <label>TOTAL</label>
                            <input type="text" name="total" placeholder="TOTAL">
                        </div>
                        <div class="field">
                            <label>MOOE</label>
                            <input type="text" name="mooe" placeholder="MOOE">
                        </div>
                        <div class="field">
                            <label>CO</label>
                            <input type="text" name="co" placeholder="CO">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="actions">
        <button class="ui primary very tiny button add_rfq_item_button">PROCEED</button>
    </div>
</div>