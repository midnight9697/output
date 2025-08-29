document.addEventListener('DOMContentLoaded', () => {
    $('#modalUploadSupplemental').modal('show');

    var dropzone = new Dropzone('#routingForm', {
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
})