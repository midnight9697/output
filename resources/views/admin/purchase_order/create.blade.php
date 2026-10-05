@extends('layout.app')  
  
@section('custom_css')  
    <style>  
        .prTable {  
            width: 100%;  
        }  
    </style>  
@endsection  
  
@section('main_content')  
  
<div class="ui form attached segment">  
  
    <form  
        class="ui form formCreatePurchaseOrder"  
        action="#"  
        id="formCreatePurchaseOrder"  
        method="post">  
  
        <div class="ui error message">  
            {{-- --}}  
        </div>  
  
        {{-- ========================================= --}}  
        {{-- ALL FORM FIELDS IN ONE MAIN DIV --}}  
        {{-- ========================================= --}}  
        <div class="field">  
  
            {{-- ========================================= --}}  
            {{-- PURCHASE ORDER INFORMATION --}}  
            {{-- ========================================= --}}  
            <div class="ui dividing header">  
                PURCHASE ORDER INFORMATION  
            </div>  
  
            {{-- SUPPLIER NAME --}}  
            <div class="three fields">  
            <div class="field">  
                <label>SUPPLIER NAME</label>  
  
                <select  
                    name="supplier_name"  
                    id="supplier_name"  
                    placeholder="SUPPLIER NAME">  
                </select>  
            </div> 

                <div class="field">  
                    <label>ADDRESS</label>  
  
                    <input  
                        type="text"  
                        name="supplier_address"  
                        id="supplier_address"  
                        placeholder="SUPPLIER ADDRESS">  
                </div>  
                <div class="field">  
                    <label>TIN</label>  
  
                    <input  
                        type="text"  
                        name="supplier_tin"  
                        id="supplier_tin"  
                        placeholder="SUPPLIER TIN">  
                </div>  

            </div>  
  
            {{-- ========================================= --}}  
            {{-- ADDRESS / TIN / P.O. NO. --}}  
            {{-- ========================================= --}}  
            <div class="three fields">  
  
                
  
                
  
                
  
            </div>  
  
            {{-- ========================================= --}}  
            {{-- DATE / MODE OF PROCUREMENT --}}  
            {{-- ========================================= --}}  
            <div class="three fields"> 
                
                <div class="field">  
                    <label>P.O. NO.</label>  
  
                    <input  
                        type="text"  
                        name="po_no"  
                        id="po_no"  
                        placeholder="P.O. NO.">  
                </div>  
  
                <div class="field">  
                    <label>DATE</label>  
  
                    <input  
                        type="date"  
                        name="po_date"  
                        id="po_date">  
                </div>  
  
                <div class="field">  
                    <label>MODE OF PROCUREMENT</label>  
  
                    <select  
                        name="mode_of_procurement"  
                        id="mode_of_procurement"  
                        class="ui dropdown">  
  
                        <option value="">SELECT MODE OF PROCUREMENT</option>  
  
                        <option value="Public Bidding">  
                            PUBLIC BIDDING  
                        </option>  
  
                        <option value="Limited Source Bidding">  
                            LIMITED SOURCE BIDDING  
                        </option>  
  
                        <option value="Competitive Dialogue">  
                            COMPETITIVE DIALOGUE  
                        </option>  
  
                        <option value="Unsolicited Offer with Bid Matching">  
                            UNSOLICITED OFFER WITH BID MATCHING  
                        </option>  
  
                        <option value="Direct Contracting">  
                            DIRECT CONTRACTING  
                        </option>  
  
                        <option value="Repeat Order">  
                            REPEAT ORDER  
                        </option>  
  
                        <option value="Small Value Procurement">  
                            SMALL VALUE PROCUREMENT  
                        </option>  
  
                        <option value="Negotiated Procurement">  
                            NEGOTIATED PROCUREMENT  
                        </option>  
  
                        <option value="Direct Acquisition">  
                            DIRECT ACQUISITION  
                        </option>  
  
                    </select>  
                </div>  
  
                
  
            </div>  
  
            {{-- ========================================= --}}  
            {{-- ORS/BURS NO. / ORS/BURS DATE / PLACE --}}  
            {{-- ========================================= --}}  
            <div class="three fields"> 
                
                <div class="field">  
                    <label>AMOUNT</label>  
  
                    <div class="ui left labeled input">  
  
                        <input  
                            type="VARCHAR"  
                            name="amount"  
                            id="amount"  
                            placeholder="P"  
                            step="0.01"  
                            min="0">                       
  
                    </div>  
                </div>  
  
                <div class="field">  
                    <label>ORS/BURS NO.</label>  
  
                    <input  
                        type="text"  
                        name="ors_burs_no"  
                        id="ors_burs_no"  
                        placeholder="ORS/BURS NO.">  
                </div>  
  
                <div class="field">  
                    <label>DATE OF THE ORS/BURS</label>  
  
                    <input  
                        type="date"  
                        name="ors_burs_date"  
                        id="ors_burs_date">  
                </div>  
  
            </div>  
  
            {{-- ========================================= --}}  
            {{-- DELIVERY INFORMATION --}}  
            {{-- ========================================= --}}  
  
            <div class="ui dividing header">  
                DELIVERY INFORMATION  
            </div>  
  
            {{-- ========================================= --}}  
            {{-- DELIVERY TERM / DATE OF DELIVERY / PAYMENT --}}  
            {{-- ========================================= --}}  
            <div class="three fields">  

                 <div class="field">  
                    <label>PLACE OF DELIVERY</label>  
  
                    <input  
                        type="text"  
                        name="place_of_delivery"  
                        id="place_of_delivery"  
                        placeholder="PLACE OF DELIVERY">  
                </div>  
  
                <div class="field">  
                    <label>DELIVERY TERM</label>  
  
                    <input  
                        type="text"  
                        name="delivery_term"  
                        id="delivery_term"  
                        placeholder="DELIVERY TERM">  
                </div>  
  
                <div class="field">  
                    <label>DATE OF DELIVERY</label>  
  
                    <input  
                        type="date"  
                        name="date_of_delivery"  
                        id="date_of_delivery">  
                </div>  
  
                <div class="field">  
                    <label>PAYMENT TERM</label>  
  
                    <input  
                        type="text"  
                        name="payment_term"  
                        id="payment_term"  
                        placeholder="PAYMENT TERM">  
                </div>  
  
            </div>  
  
        </div>  
        {{-- END OF ONE MAIN FIELD DIV --}}  
  
    </form>  
  
</div>  
  
{{-- ========================================= --}}  
{{-- BOTTOM PROCEED BUTTON --}}  
{{-- ========================================= --}}  
<div class="ui bottom attached segment">  
  
    <div class="ui two column grid">  
  
        <div class="column">  
            {{-- Empty --}}  
        </div>  
  
        <div class="column" style="text-align: right">  
  
            <div class="ui very tiny bottom attached segment">
                        <button type="submit" class="ui very tiny primary right floated button">PROCEED</button>
                    </div>
  
        </div>  
  
    </div>  
  
</div>  
  
@endsection  
  
@section('custom_js')  
    @vite(['resources/js/purchase_order/create.js'])  
@endsection