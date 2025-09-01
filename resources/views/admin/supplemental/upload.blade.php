<div class="ui tiny modal" id="modalUploadSupplemental">
    {{-- <div class="header">REGISTER NEW USER</div> --}}
    <div class="content" style="overflow: hidden">
        <div class="ui very tiny form formAddMember" id="formAddMember">
            <h4 class="ui dividing header">UPLOAD SUPPLEMENTAL</h4>
            <form class="ui form" id="demo-upload" action="{{ url('upload/temporary') }}">
              @csrf
              <div class="field" id="file-upload-section">
                <label>Supplemental File</label>
                <div class="ui action input">
                  <input type="file" name="supplemental" id="supplemental" multiple>
                  <button type="button" class="ui grey button" id="upload-file-button">UPLOAD</button>
                </div>
                <div class="ui divider"></div>
                <div id="progress-section">
                  {{-- Progress Bar --}}
                </div>
                <div id="files-preview">
                    
                </div>
              </div>
            </form>
        </div>
    </div>
</div>