@php
    use App\Models\Supplier;
@endphp
<form action="#" class="form ui form-abstract-bid">
    <div class="ui error message">
        {{--  --}}
    </div>
    <div class="field">
        <label>SPECIFICATION</label>
        <textarea name="description" id="description" cols="20" rows="2" placeholder="Description"></textarea>
    </div>
    <div class="field">
        <div class="three fields">
            <div class="field">
                <label>QUANTITY</label>
                <input name="quantity" disabled id="quantity" placeholder="Quantity"/>
            </div>
            <div class="field">
                <label>UNIT PRICE</label>
                <input name="unit_price" disabled id="unit_price" placeholder="Unit Price"/> 
            </div>
            <div class="field">
                <label>TOTAL PRICE</label>
                <input name="total_price" disabled id="total_price" placeholder="Total Price"/> 
            </div>
        </div>
    </div>
    <div class="field">
        <label for="suppliers">SUPPLIERS</label>
        <select closeOnChange={true} name="suppliers" multiple id="suppliers" class="ui fluid multiple search selection dropdown suppliers">
            @foreach (encryptMany(Supplier::get()) as $supplier)
                <option value="{{ $supplier->name }}">{{ $supplier->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="ui bottom attached segment">
        @include('default.create-table', [ 'name' => 'abstract-bidders-table', 'body' => 'abstract-bidders-body',
        'columns' => [
            'SUPPLIER',
            'UNIT PRICE',
            'UNIT COST',
            'WINNER',
        ]
      ])
    </div>
</form>