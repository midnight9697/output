@php
    use App\Models\Supplier;
@endphp
<h5 id="monitoring_pr_number" class="text color green">PR-2025-10-001</h5>
<form class="ui very tiny form formCreatePRMonitorItem" action="#" id="formCreatePRMonitorItem" method="post">
    <div class="field">
        <div class="field">
            <label>CANVASS DATE</label>
            <input type="date" name="canvass_date" id="canvass_date">
        </div>
        <div class="field">
            <label>ABSTRACT DATE</label>
            <input type="date" name="abstract_date" id="abstract_date">
        </div>
        <div class="field">
            <label>OPENING DATE</label>
            <input type="date" name="opening_date" id="opening_date">
        </div>
        <div class="field">
            <label>WINNING BIDDER</label>
            <select closeOnChange={true} name="suppliers" multiple id="suppliers" class="ui fluid multiple search selection dropdown suppliers">
                @foreach (encryptMany(Supplier::get()) as $supplier)
                    <option value="{{ $supplier->name }}">{{ $supplier->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="field">
            <label>DATE OF AWARD</label>
            <input type="date" name="date_of_award" id="date_of_award">
        </div>
        <div class="field">
            <label>DATE OF P.O</label>
            <input type="date" name="date_of_po" id="date_of_po">
        </div>
    </div>
</form>