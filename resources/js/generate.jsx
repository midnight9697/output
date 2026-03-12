import PizZip from "pizzip";
import Docxtemplater from "docxtemplater";
import { saveAs } from "file-saver";

// Load template as ArrayBuffer (example using fetch)
async function loadTemplate(url) {
  const response = await fetch(url);
  return await response.arrayBuffer();
}

export async function generateWordBrowser(data, docTemplate, action = () => {}) {
  const content = await loadTemplate(docTemplate); // template in public folder
  const zip = new PizZip(content);
  const doc = new Docxtemplater(zip, { paragraphLoop: true, linebreaks: true });

  doc.render(data);
  const blob = doc.getZip().generate({ type: "blob" });
  console.clear();
  console.log('file', blob);
  action (blob);
//   saveAs(blob, "output.docx");
}

// Example usage
// generateWordBrowser({
//   name: "John Doe",
//   orderId: "INV-1001",
//   product: "Laptop",
//   price: "$1200"
// });