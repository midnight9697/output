<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DOCX Preview Example</title>
  <style>
    /* Optional: Styling the viewer */
    #viewer {
      margin-top: 20px;
      font-family: Arial, sans-serif;
    }
    img {
      max-width: 100%; /* Ensures images are responsive */
      margin-bottom: 20px;
    }
  </style>
</head>
<body>

  <h1>Upload a DOCX file to preview</h1>
  <input type="file" id="docxFile" accept=".docx">
  <div id="viewer"></div>
  <script src="{{ url('plugins/docx-preview/jszip.min.js') }}"></script>
  <script src="{{ url('plugins/docx-preview/docx-preview.js') }}"></script>
  <script>
    // Set up options to include header and footer rendering
    const docxOptions = Object.assign(docx.defaultOptions, {
      renderHeaders: true,
      renderFooters: true,
      useBase64URL: true,   // Use base64 for embedded images
      ignoreWidth: false,   // Retain the original image size
      ignoreHeight: false,  // Retain the original image size
      experimental: true,   // Enable floating object support
      debug: false,         // Disable debug messages (set to true if needed)
    });

    const input = document.getElementById("docxFile");
    const viewer = document.getElementById("viewer");

    input.addEventListener("change", async (e) => {
      const file = e.target.files[0];
      if (!file) return;

      const arrayBuffer = await file.arrayBuffer();

      // Clear previous content in the viewer
      viewer.innerHTML = "";

      // Render DOCX into the viewer with the specified options
      docx.renderAsync(arrayBuffer, viewer, docxOptions)
        .catch((err) => {
          console.error("Error rendering DOCX:", err);
        });
    });
  </script>

</body>
</html>
