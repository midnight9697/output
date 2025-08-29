<div class="ui tiny modal" id="modalUploadSupplemental">
    {{-- <div class="header">REGISTER NEW USER</div> --}}
    <div class="content">
        <div class="ui very tiny form formAddMember" id="formAddMember">
            <h4 class="ui dividing header">UPLOAD SUPPLEMENTAL</h4>
            <div class="ui error message">
                {{--  --}}
            </div>
            <section>
                  <FORM class="dropzone ui form" id="demo-upload" action="{{ url('upload/temporary') }}">
                    @csrf
                    <div class="field">
                        <label>Titel</label>
                        <input type="text" name="title" id="title" placeholder="Title">
                    </div>
                    <div class="dz-message needsclick">
                      Drop files here or click to upload.<BR>
                      <SPAN class="note needsclick">(This is just a demo dropzone. Selected 
                      files are <STRONG>not</STRONG> actually uploaded.)</SPAN>
                    </div>
                  </FORM>
                <div id="dropzone">
                </div>
                <div id="total-progress">
                    <div id="total-progress-bar" class="progress-bar" style="width: 0%;"></div>
                </div>
              </section>
        </div>
    </div>
    <div class="actions"><button class="ui very tiny primary button submit_and_route">NEW</button></div>
</div>