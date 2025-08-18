@php
    use Carbon\Carbon;
    use App\Models\Member;
    use App\Models\Alternative;
@endphp

<div class="ui tiny modal" id="modalRoutePR">
    {{-- <div class="header">REGISTER NEW USER</div> --}}
    <div class="content">
        <div class="ui very tiny form formAddMember" id="formAddMember">
            <h4 class="ui dividing header">PURCHASE REQUEST PROCESSING FORM</h4>
            <div class="ui error message">
                {{--  --}}
            </div>
            <form class="ui form routingForm" id="routingForm" action="#" method="POST">
                <div class="field">
                    <label>Action:</label>
                    <select name="action">
                        @foreach (Alternative::get() as $action)
                            <option value="{{ encryptUrlSafe($action->id) }}">{{ strtoupper($action->id == 1?"--":$action->synonyms) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="field">
                    <label>Assigned to:</label>
                    <div class="ui right aligned search search_people">
                        <div class="ui icon input">
                          <input class="prompt assigned_to" name="assigned_to" type="text" placeholder="Search People...">
                          <i class="search icon"></i>
                        </div>
                        <div class="results"></div>
                      </div>
                </div>
                <div class="field">
                    <label>Remarks</label>
                  <textarea name="body" rows="3" placeholder="Enter a message"></textarea>
                </div>
            </form>
        </div>
    </div>
    <div class="actions"><button class="ui very tiny primary button submit_and_route">NEW</button></div>
</div>