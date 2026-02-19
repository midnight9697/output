<!DOCTYPE html>
<html>
<head>
    <title>Office.js Vanilla JS Example</title>
    <script src="https://appsforoffice.microsoft.com/lib/1/hosted/office.js"></script>
</head>
<body>
    <h1>Office.js Vanilla JS Demo</h1>
    <button id="insertData">Insert Data (Excel)</button>
    <button id="insertText">Insert Text (Word)</button>

    {{-- <script src="taskpane.js"></script> --}}
</body>
</html>
<script>
  // Wait until the Office host is ready
Office.onReady((info) => {
    if (info.host === Office.HostType.Excel) {
        document.getElementById("insertData").onclick = insertDataExcel;
    } else if (info.host === Office.HostType.Word) {
        document.getElementById("insertText").onclick = insertTextWord;
    }
});

// Excel example
async function insertDataExcel() {
    try {
        await Excel.run(async (context) => {
            const sheet = context.workbook.worksheets.getActiveWorksheet();
            const range = sheet.getRange("A1:B2");
            range.values = [
                ["Name", "Age"],
                ["Alice", 25]
            ];
            await context.sync();
            alert("Data inserted in Excel!");
        });
    } catch (error) {
        console.error(error);
    }
}

// Word example
async function insertTextWord() {
    try {
        await Word.run(async (context) => {
            const body = context.document.body;
            body.insertText("Hello from vanilla JS!", Word.InsertLocation.end);
            await context.sync();
            alert("Text inserted in Word!");
        });
    } catch (error) {
        console.error(error);
    }
}

</script>