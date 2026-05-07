<!DOCTYPE html>
<html>
<head>
    <title>Office.js Vanilla JS Example</title>
    <script src="https://appsforoffice.microsoft.com/lib/1/hosted/office.js"></script>
</head>
<body>
    <div id="content">
        <h1>Report</h1>
        <p>This is HTML converted to Word.</p>
      </div>
      
      <button onclick="exportToWord()">Download Word</button>
</body>
</html>
<script>
function exportToWord(){
    var content = document.getElementById("content").innerHTML;
    var header = "<html xmlns:o='urn:schemas-microsoft-com:office:office' "+
                 "xmlns:w='urn:schemas-microsoft-com:office:word'>";
    var footer = "</body></html>";
    var sourceHTML = header + "<body>" + content + footer;

    var blob = new Blob(['\ufeff', sourceHTML], {
        type: 'application/msword'
    });

    var url = 'data:application/vnd.ms-word;charset=utf-8,' + encodeURIComponent(sourceHTML);

    var downloadLink = document.createElement("a");
    document.body.appendChild(downloadLink);

    downloadLink.href = url;
    downloadLink.download = 'document.doc';
    downloadLink.click();

    document.body.removeChild(downloadLink);
}
</script>