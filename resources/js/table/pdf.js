// resources/js/app.js
import { PDFDocument } from 'pdf-lib';

async function fillPdf() {
  // Fetch existing PDF file (you can fetch from public folder or server)
  const url = '/files/testing.pdf';
  const existingPdfBytes = await fetch(url).then(res => res.arrayBuffer());
    console.log(existingPdfBytes);
  // Load PDF
  const pdfDoc = await PDFDocument.load(existingPdfBytes);

  // Get form
  const form = pdfDoc.getForm();

  // Fill a field by its name
  console.log('Fields', form.getFields());
  const nameField = form.getTextField('type');
  nameField.setText('Gwadfasdfhasjkfghsdjkghhgsfggdfggdgsdgxedfgpo');

  // Save the PDF
  const pdfBytes = await pdfDoc.save();

  // Trigger download or do something with pdfBytes
  const blob = new Blob([pdfBytes], { type: 'application/pdf' });
  const link = document.createElement('a');
  link.href = URL.createObjectURL(blob);
  link.download = 'filled_form.pdf';
  link.click();
}

// Just call the function somewhere, e.g. button click
// document.getElementById('fillPdfBtn').addEventListener('click', fillPdf);
  