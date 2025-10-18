@extends('layout.app')

@section('main_content')
@php
    use Carbon\Carbon;
    use App\Models\Member;
    use App\Models\Alternative;
    use App\Models\Supplementary;
    use App\Models\Profile;
    $prof = Profile::where('user_id', auth()->user()->id);
    $actions = encryptMany(Alternative::orderBy('id', 'desc')->get());
    $signed = array_filter($actions, function ($obj) {
        return decryptUrlSafe($obj->id)== 12;
    });
@endphp
    <style>
        .ui.modal.top-aligned {
          top: 5% !important;   /* distance from top */
          margin: 0 auto !important; /* keep it centered horizontally */
        }
    </style>
    
    <div class="ui grid">
        <div class="eight wide column">
            {{-- PROCESS FORM SEGMENT --}}
            <div class="ui top attached header">
                <div class="ui grid">
                    <div class="eight wide column">
                        <p>PROCESS PURCHASE REQUEST</p>
                    </div>
                    <div class="eight wide column" style="text-align:end">
                        {{ $pr->pr_number?$pr->pr_number:""}}
                        @if ($prof->exists() && $prof->first()->section_id == 12 && (!$pr->pr_number))
                            <button type="button" class="ui very tiny primary button" id="generate_pr_number">GENERATE PR NO.</button>
                        @endif
                    </div>
                </div>
            </div>
            <div class="ui large form attached header">
                <form class="ui form routingForm" id="routingForm" action="#" method="POST">
                    <div class="field">
                        <label>Attachment</label>
                        <div class="ui icon input">
                            <input type="file" multiple name="att_file" id="att_file" multiple>
                            <button type="button" class="ui very tiny green button" id="upload_attachment">UPLOAD</button>
                        </div>
                        <div>
                            @include('default.progress', [
                              'view' => "progress-upload"
                            ])
                        </div>
                        <div class="ui divider"></div>
                        <div id="files-preview">
                            
                        </div>
                    </div>
                    <div class="field">
                        <label>Action:</label>
                        <select name="action" id="action_process">
                            @foreach (array_reverse($actions) as $action)
                                @if (decryptUrlSafe($action->id) != 11)
                                    <option value="{{ ($action->id) }}">{{ strtoupper(decryptUrlSafe($action->id) == 1?"--":$action->synonyms) }}</option>
                                @endif
                                @if (decryptUrlSafe($action->id) == 11 && $prof->first()->section_id == 12)
                                    <option value="{{ ($action->id) }}">{{ strtoupper(decryptUrlSafe($action->id) == 1?"--":$action->synonyms) }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="field" id="assigned_to_pr">
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
                        {{-- <div class="field">
                            <label>Supplemental</label>
                            <select multiple class="ui dropdown supplemental" name="supplemental" id="supplemental">
                                @foreach (Supplementary::get() as $sup)
                                    <option value="{{ $sup->id }}">{{ $sup->title }}</option>
                                @endforeach
                            </select>
                        </div> --}}
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
            <div class="ui styled fluid accordion" style="width:100%">
                <div class="title">
                  <i class="dropdown icon"></i>
                  PURCHASE REQUEST
                </div>
                <div class="content">
                    <div class="ui small form attached segment">
                        <iframe src="{{ url('pr/view') }}/{{ $pr->id }}#toolbar=0&navpanes=0&scrollbar=0&zoom=80" frameborder="0" id="preview" style="position: relative;width:100%;height:100vh;"></iframe>
                    </div>
                </div>
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
        localStorage.setItem('signed', "{{ $signed[0]->id }}");
    });
</script>
@vite(['resources/js/PR/process.js'])
@endsection
