@extends('layout.app')

@section('main_content')
    <div style="border: solid 1px" id="iframe-wrapper">
        <iframe allowfullscreen style="margin:auto" height="1248px" width="816px" id="viewer" src="https://view.officeapps.live.com/op/embed.aspx?src=https://tracking-staging.embr8.com/WORD RFQ WITH HEADER.docx" width="100%" height="600"></iframe>
    </div>
    <style>
        .iframe-wrapper {
  text-align: center;
}
.iframe-wrapper iframe {
  display: inline-block;
}

    </style>
@endsection

@section('custom_js')
<script>
    // Later, you can revoke the URL
    // URL.revokeObjectURL(url);
    function goFullscreen() {
      const iframe = document.getElementById("pdfViewer");
      if (iframe.requestFullscreen) {
        iframe.requestFullscreen();
      } else if (iframe.webkitRequestFullscreen) { // Safari
        iframe.webkitRequestFullscreen();
      } else if (iframe.msRequestFullscreen) { // IE/Edge
        iframe.msRequestFullscreen();
      }
    }

    document.getElementById('fileInput').addEventListener('change', function() {
        goFullscreen();
    });
</script>
@endsection