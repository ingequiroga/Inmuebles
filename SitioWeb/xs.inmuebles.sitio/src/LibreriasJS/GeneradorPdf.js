function generarPDF(){
   
    const doc = new jsPDF('p', 'px');
    doc.text("Hello world!", 10, 10);
           // doc.save("a4.pdf");
    let binary = doc.output();
    let objpdf = binary ? btoa(binary) : "";
    return objpdf;
}