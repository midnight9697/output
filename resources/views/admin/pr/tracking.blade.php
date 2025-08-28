@extends('layout.app')

@section('main_content')
    <div class="ui grid">
        <div class="eight wide column">
           
            
            <div class="ui top attached header">
                <p>TRANSACTIONS</p>
            </div>
            <div class="ui large form attached segment">
                <div class="ui divided list transaction_preview">
                    <div style="text-align: center">Please wait...</div>
                </div>
            </div>
            @if($amember)
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
            @endif
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
        localStorage.setItem('amember', "{{ ($amember?1:0) }}");
    });
</script>
@vite(['resources/js/PR/tracking.js'])
@endsection