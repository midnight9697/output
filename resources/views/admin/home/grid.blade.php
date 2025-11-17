@php
use App\Models\User;
use App\Models\Supplier;
use App\Models\PurchaseRequest;
use App\Models\Transaction;
use App\Models\RFQ;

$lastTransaction = Transaction::orderByDesc('id')->with('purchase_request')->first();
$quotation = RFQ::orderByDesc('id')->with('created_by')->first();
@endphp

<div class="ui grid stackable padded">
    <div
        class="four wide computer eight wide tablet sixteen wide mobile column">
        <div class="ui fluid card">
          <div class="content">
            <div class="ui right floated header red">
              <i class="icon users"></i>
            </div>
            <div class="header">
              <div class="ui red header">
                {{ $count_user }}
              </div>
            </div>
            <div class="meta">
              Users
            </div>
            <div class="description" style="min-height:40px">
              <b>{{ User::orderByDesc('id')->first()->fullname }}</b> have been recently added to the system.
            </div>
          </div>
          <div class="extra content">
            <div class="ui two buttons">
              <div class="ui red button">More Info</div>
            </div>
          </div>
        </div>
      </div>
      <div class="four wide computer eight wide tablet sixteen wide mobile column">
        <div class="ui fluid card">
          <div class="content">
            <div class="ui right floated header green">
              <i class="icon shopping cart"></i>
            </div>
            <div class="header">
              <div class="ui header green">{{ $count_supplier }}</div>
            </div>
            <div class="meta">
              Supplier
            </div>
            <div class="description" style="min-height:40px">
              <b>{{ Supplier::orderByDesc('id')->first()->name }}</b> is the newly added supplier in this system.
            </div>
          </div>
          <div class="extra content">
            <div class="ui two buttons">
              <div class="ui green button">More Info</div>
            </div>
          </div>
        </div>
      </div>
      <div class="four wide computer eight wide tablet sixteen wide mobile column">
        <div class="ui fluid card">
          <div class="content">
            <div class="ui right floated header teal">
              <i class="file excel icon"></i>
            </div>
            <div class="header">
              <div class="ui teal header">{{ $count_pr }}</div>
            </div>
            <div class="meta">
              Purchase Request
            </div>
            <div class="description" style="min-height:40px">
              {{ ($lastTransaction?"A formal request to buy goods or services.":"Please raise a purchase request to initiate the procedure.") }}
            </div>
          </div>
          <div class="extra content">
            <div class="ui two buttons">
              <div class="ui teal button">More Info</div>
            </div>
          </div>
        </div>
      </div>
      <div class="four wide computer eight wide tablet sixteen wide mobile column">
        <div class="ui fluid card">
          <div class="content">
            <div class="ui right floated header purple">
              <i class="icon file alternate"></i>
            </div>
            <div class="header">
              <div class="ui purple header">{{ $count_rfq }}</div>
            </div>
            <div class="meta">
              Request for Quotation
            </div>
            <div class="description" style="min-height:40px">
             {{ ($quotation?$quotation->created_by->fullname." created a quotation in response to the purchase request.":"To begin the process, please create a purchase request.") }}
            </div>
          </div>
          <div class="extra content">
            <div class="ui two buttons">
              <div class="ui purple button">More Info</div>
            </div>
          </div>
        </div>
    </div>
</div>