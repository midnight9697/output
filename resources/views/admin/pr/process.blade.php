@extends('layout.app')

@section('main_content')
@php
    use Carbon\Carbon;
    use App\Models\Member;
    use App\Models\Alternative;
    use App\Models\Supplementary;
@endphp
    <div class="ui grid">
        <div class="eight wide column">
            {{-- PROCESS FORM SEGMENT --}}
            <div class="ui top attached header">
                <p>PROCESS PURCHASE REQUEST</p>
            </div>
            <div class="ui large form attached header">
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
                        <div class="ui fluid search search_people">
                            <div class="ui icon input">
                              <input class="prompt assigned_to" name="assigned_to" type="text" placeholder="Search People...">
                              <i class="search icon"></i>
                            </div>
                            <div class="results" style=""></div>
                          </div>
                    </div>
                    @if ($pr->last_transaction->action == 9)
                        <div class="field">
                            <label>Supplemental</label>
                            <select multiple="" class="ui dropdown" name="supplemental">
                                @foreach (Supplementary::get() as $sup)
                                    <option value="{{ $sup->id }}">{{ $sup->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif
                    
                    <div class="field">
                        <label>Remarks</label>
                      <textarea name="body" rows="3" placeholder="Enter a message"></textarea>
                    </div>
                </form>
            </div>
            <div class="ui very tiny bottom attached segment" style="text-align: right">
                <button type="submit" class="ui very tiny primary button submit_and_route">SUBMIT</button>
            </div>
            {{-- Transaction Segment --}}
            <div class="ui top attached header">
                <p>TRANSACTIONS</p>
            </div>
            <div class="ui large form attached segment">
                <div class="ui divided list transaction_preview">
                    <div style="text-align: center">Please wait...</div>
                </div>
            </div>
        </div>
        <div class="eight wide column">
            <div class="ui top attached header">
                <p>PURCHASE REQUEST</p>
            </div>
            <div class="ui small form attached segment">
                <iframe src="{{ url('pr/view') }}/{{ $pr->id }}#toolbar=0&navpanes=0&scrollbar=0&zoom=80" frameborder="0" id="preview" style="position: relative;width:100%;height:100vh;"></iframe>
            </div>
        </div>
        
    </div>
    <div class="ui grid">
        <div class="eight wide column">
            
        </div>
    </div>
@endsection
@section('custom_js')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        localStorage.setItem('pr_id', "{{ $pr->id }}");
    });
</script>
@vite(['resources/js/PR/process.js'])
@endsection