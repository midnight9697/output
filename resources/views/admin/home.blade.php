@extends('layout.app')

@section('main_content')
<style>
    body {
    background: rgb(243, 244, 245);
    height: 100%;
    color: rgb(100, 108, 127);
    line-height: 1.4rem;
    font-family: Roboto, "Open Sans", sans-serif;
    font-size: 20px;
    font-weight: 300;
    text-rendering: optimizeLegibility;
}

h1 { text-align: center; }

.dropzone {
    background: white;
    border-radius: 5px;
    border: 2px dashed rgb(0, 135, 247);
    border-image: none;
    max-width: 500px;
    margin-left: auto;
    margin-right: auto;
}

#total-progress {
        height: 20px;
        background-color: #f3f3f3;
        border-radius: 5px;
        margin-top: 10px;
        overflow: hidden;
    }

    #total-progress-bar {
        height: 100%;
        background-color: #4CAF50;
        transition: width 0.3s ease-in-out;
    }
</style>
@php
    $lastActivity = strtotime(date('Y-m-d h:m a'));

    // Get the session lifetime in minutes from the configuration
    $sessionLifetimeMinutes = Config::get('session.lifetime');
    
    // Calculate the expiration timestamp
    $expirationTimestamp = $lastActivity + ($sessionLifetimeMinutes * 60);
    
    // Calculate the remaining minutes
    $remainingMinutes = floor(($expirationTimestamp - time()) / 60);
    echo "Remaining session time: " . $remainingMinutes . " minutes.";
@endphp
<div class="ui grid stackable padded">
    <div class="four wide computer eight wide tablet sixteen wide mobile column">
        <div class="ui fluid card">
            <div class="content">
                <div class="ui right floated header">
                    <div class="file alternate icon"></div>
                </div>
                <div class="header">
                    <div class="red header">1,000</div>
                </div>
                <div class="meta">Files</div>
                <div class="description">
                    Purchase Request
                </div>
            </div>
            <div class="extra content">
                <a href="#" class="ui fluid button red">More Info</a>
            </div>
        </div>
    </div>
    <div class="four wide computer eight wide tablet sixteen wide mobile column">
        <div class="ui fluid card">
            <div class="content">
                <div class="ui right floated header">
                    <div class="file alternate icon"></div>
                </div>
                <div class="header">
                    <div class="red header">1,000</div>
                </div>
                <div class="meta">Files</div>
                <div class="description">
                    Purchase Order
                </div>
            </div>
            <div class="extra content">
                <a href="#" class="ui fluid button red">More Info</a>
            </div>
        </div>
    </div>

    <div class="four wide computer eight wide tablet sixteen wide mobile column">
        <div class="ui fluid card">
            <div class="content">
                <div class="ui right floated header">
                    <div class="file alternate icon"></div>
                </div>
                <div class="header">
                    <div class="red header">1,000</div>
                </div>
                <div class="meta">Files</div>
                <div class="description">
                    Members
                </div>
            </div>
            <div class="extra content">
                <a href="#" class="ui fluid button red">More Info</a>
            </div>
        </div>
    </div>
    
    <div class="four wide computer eight wide tablet sixteen wide mobile column">
        <div class="ui fluid card">
            <div class="content">
                <div class="ui right floated header">
                    <div class="file alternate icon"></div>
                </div>
                <div class="header">
                    <div class="red header">1,000</div>
                </div>
                <div class="meta">Files</div>
                <div class="description">
                    BAC
                </div>
            </div>
            <div class="extra content">
                <a href="#" class="ui fluid button red">More Info</a>
            </div>
        </div>
    </div>
</div>
<SECTION>
    <DIV id="dropzone">
      <FORM class="dropzone needsclick" id="demo-upload" action="{{ url('upload/temporary') }}">
        @csrf
        <DIV class="dz-message needsclick">    
          Drop files here or click to upload.<BR>
          <SPAN class="note needsclick">(This is just a demo dropzone. Selected 
          files are <STRONG>not</STRONG> actually uploaded.)</SPAN>
        </DIV>
      </FORM>
    </DIV>
    <div id="total-progress">
        <div id="total-progress-bar" class="progress-bar" style="width: 0%;"></div>
    </div>
  </SECTION>
@endsection
@section('custom_js')
    @vite(['resources/js/home.js'])
    <script>
        var dropzone = new Dropzone('#demo-upload', {
          previewTemplate: document.querySelector('#preview-template').innerHTML,
          parallelUploads: 2,
          thumbnailHeight: 120,
          thumbnailWidth: 120,
          maxFilesize: 3,
          filesizeBase: 1000,
          thumbnail: function(file, dataUrl) {
            if (file.previewElement) {
              file.previewElement.classList.remove("dz-file-preview");
              var images = file.previewElement.querySelectorAll("[data-dz-thumbnail]");
              for (var i = 0; i < images.length; i++) {
                var thumbnailElement = images[i];
                thumbnailElement.alt = file.name;
                thumbnailElement.src = dataUrl;
              }
              setTimeout(function() { file.previewElement.classList.add("dz-image-preview"); }, 1);
            }
          },
          init: function() {
                this.on("uploadprogress", function(file, progress) {
                    // This event fires for individual file progress
                    // You can access the progress percentage here
                    console.log("File progress:", file.name, progress + "%");
                });

                this.on("totaluploadprogress", function(totalProgress) {
                    // This event fires for the total upload progress of all files in the queue
                    // You can update a global progress bar here
                    console.log("Total progress:", totalProgress + "%");
                    document.querySelector("#total-progress-bar").style.width = totalProgress + "%";
                });
            }   

        });


// Now fake the file upload, since GitHub does not handle file uploads
// and returns a 404

var minSteps = 6,
    maxSteps = 60,
    timeBetweenSteps = 100,
    bytesPerStep = 100000;

dropzone.uploadFiles = function(files) {
  var self = this;

  for (var i = 0; i < files.length; i++) {

    var file = files[i];
    totalSteps = Math.round(Math.min(maxSteps, Math.max(minSteps, file.size / bytesPerStep)));

    for (var step = 0; step < totalSteps; step++) {
      var duration = timeBetweenSteps * (step + 1);
      setTimeout(function(file, totalSteps, step) {
        return function() {
          file.upload = {
            progress: 100 * (step + 1) / totalSteps,
            total: file.size,
            bytesSent: (step + 1) * file.size / totalSteps
          };

          self.emit('uploadprogress', file, file.upload.progress, file.upload.bytesSent);
          if (file.upload.progress == 100) {
            file.status = Dropzone.SUCCESS;
            self.emit("success", file, 'success', null);
            self.emit("complete", file);
            self.processQueue();
            //document.getElementsByClassName("dz-success-mark").style.opacity = "1";
          }
        };
      }(file, totalSteps, step), duration);
    }
  }
}
    </script>
@endsection