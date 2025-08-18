@extends('layout.app')

@section('main_content')
@php
    use Carbon\Carbon;
    use App\Models\Member;
    use App\Models\Alternative;
@endphp
@include('admin.pr.create_item')
@include('admin.pr.routing')
    
   <div class="ui grid">
        <div class="sixteen wide column">
            <form action="{{ url('api/pr/edit') }}" class="ui form updatepr" method="POST">
                @csrf
                <div class="ui success message">
                    Changes Saved
                </div>
                <div class="ui error message">
                    {{--  --}}
                </div>
                <div class="ui grid">
                    <div class="eight wide column">
                        <div class="ui top attached header">
                            PURCHASE REQUEST UPDATE FORM
                        </div>
                        <div class="ui small form attached segment">
                            <div class="field">
                                <div class="two fields">
                                    <div class="field">
                                        <label>Entity Name</label>
                                        <input type="text" value="{{ $pr->entity_name }}" placeholder="Entity Name" name="entity_name">
                                    </div>
                                    <div class="field">
                                        <label>Fund Cluster</label>
                                        <input type="text" value="{{ $pr->fund_cluster }}" placeholder="Fund Cluster" name="fund_cluster">
                                    </div>
                                </div>
                                <div class="two fields">
                                    <div class="field">
                                        <label>Office/Section</label>
                                        <input type="text" value="{{ $pr->office }}" placeholder="Office/Section" name="office">
                                    </div>
                                    <div class="field">
                                        <label>PR No.</label>
                                        <input type="text" value="{{ $pr->pr_number }}" placeholder="PR No." name="pr_number">
                                    </div>
                                </div>
                                <div class="two fields">
                                    <div class="field">
                                        <label>Date</label>
                                        <input type="date" name="date" value="{{ date('Y-m-d', strtotime($pr->created_in))  }}">
                                    </div>
                                    <div class="field">
                                        <label>Responsibility Center Code</label>
                                        <input type="text" value="{{ $pr->responsibility_center_code }}" placeholder="Responsibility Center Code" name="responsibility_center_code">
                                    </div>
                                </div>
                                <div class="field">
                                    <label>Purpose</label>
                                    <textarea name="purpose" id="purpose" cols="30" rows="3" value="{{ $pr->purpose }}" placeholder="Purpose" name="purpose"></textarea>
                                </div>
                                <div class="field" style="display:none">
                                    <select name="items" multiple id="items"></select>
                                </div>
                            </div>
                        </div>
                        <div class="ui top attached header">
                            <div class="ui right aligned grid">
                                <div class="right floated left aligned eight wide column">
                                    ITEMS
                                </div>
                                <div class="left floated right aligned eight wide column">
                                    <button type="button" class="ui very tiny primary button add_item_btn">ADD</button>
                                </div>
                            </div>
                        </div>
                        <div class="ui very tiny form attached segment table-pr-items">
                            <div style="text-align:center">Please wait...</div>
                            {{-- Items Table --}}
                        </div>
                        <div class="ui top attached header">
                            <div class="ui right aligned grid">
                                <div class="right floated left aligned eight wide column">
                                    MEMBERS
                                </div>
                                <div class="left floated right aligned eight wide column">
                                    <button type="button" class="ui very tiny primary button add_member_btn">ADD</button>
                                </div>
                               
                              </div>
                        </div>
                        <div class="ui form attached segment">
                            <div class="members-form-section">
                                <p style="text-align:center">Please wait...</p>
                            </div>
                        </div>
                    </div>
                    <div class="eight wide column">
                        <div class="ui top attached header">
                            INTERNAL REVIEW
                        </div>
                        <div class="ui very tiny form attached segment">
                            <div class="ui segment">
                                <form class="ui form" id="commentForm" action="#" method="POST">
                                    <div class="field">
                                        <label>ACTION</label>
                                        <select name="alternative" id="alternative">
                                            @foreach (Alternative::get() as $action)
                                                <option value="{{ encryptUrlSafe($action->id) }}">{{ strtoupper($action->id == 1?"--":$action->synonyms) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="field">
                                        <label>Remarks</label>
                                      <textarea id="long-message" name="long-message" rows="3" placeholder="Enter a message"></textarea>
                                    </div>
                                    <div class="field" style="display: flex; justify-content: flex-end;">
                                        <button type="button" class="ui very tiny primary button commentFormBtn">COMMENT</button>
                                    </div>
                                </form>
                                <div class="ui divider"></div>
                                <div class="item">
                                    <label><b>TRANSACTIONS</b></label>
                                </div>
                                <div class="ui divided list transaction_preview">
                                    <div style="text-align: center">Please wait...</div>
                                </div>
                                <a class="header">See More</a>
                            </div>
                        </div>
                       
                    </div>
                    
                    <div class="ui very tiny bottom attached segment">
                        @if (Member::where('user_id', Auth::user()->id)->first()->role == "admin")
                            <button class="ui very tiny primary button lunchRouteForm" type="button">Initiate Approval Process</button>
                        @endif
                        <button type="submit" class="ui very tiny green right floated button">SAVE CHANGES</button>
                    </div>
                </div>
                {{-- Items --}}
            </form>
        </div>
       
   </div>
@endsection
@section('custom_js')
    <script>
         document.addEventListener('DOMContentLoaded', () => {
             localStorage.setItem('pr_id', "{{ $pr->id }}");
         });
    </script>

    @vite(['resources/js/PR/update.js'])
@endsection