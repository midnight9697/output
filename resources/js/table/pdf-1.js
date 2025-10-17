const pdfjsLib = window['pdfjs-dist/build/pdf'];

// Optional: specify workerSrc for better performance
pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://unpkg.com/pdfjs-dist/build/pdf.worker.js';

const fileInput = document.getElementById('fileInput');
const output = document.getElementById('output');

// fileInput.addEventListener('change', async (event) => {
//   const file = event.target.files[0];
//   if (!file) return;

//   const arrayBuffer = await file.arrayBuffer();

  // Load the PDF document
  const loadingTask = pdfjsLib.getDocument("/files/rfq.pdf");
  const pdf = await loadingTask.promise;

  // We'll process the first page here
  const page = await pdf.getPage(1);
  const textContent = await page.getTextContent();

  // Clear previous output
  output.textContent = '';

  // Loop through each text item
  textContent.items.forEach(item => {
    // item.str = text string
    // item.transform = transform matrix: [a, b, c, d, e, f]
    // e = x position, f = y position

    const x = item.transform[4].toFixed(2);
    const y = item.transform[5].toFixed(2);
    const text = item.str;
    const fontName = item.fontName;
    console.log(item);
    // output.textContent += `Text: "${text}" at (x: ${x}, y: ${y}) font: ${fontName}\n`;
  });
// });
