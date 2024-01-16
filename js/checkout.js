function print_invoice(){
    let w = window.open();
    let invoice = document.getElementById('invoiceTable').innerHTML;
    console.log(invoice);
    let html = "<!DOCTYPE HTML>";
    html += '<html lang="en-us">';
    // html += '<head><style>.invoice__table{min-width: 80%;min-height: 80%;margin: 2rem auto;border: 1px solid rgb(0 0 0 / .12);border-collapse: collapse ;}.invoice__table *{border: 1px solid rgb(0 0 0 / .12);}.invoice__table caption{background-color: rgb(var(--primary-clr) / .5);}th, td{text-align: center;padding: .5rem;background-color: rgb(var(--light-clr));}.rupee{border: none;}.invoice__amount{font-size: var(--fs-md);font-weight: 500;}</style></head>';
    html += '<head><style></style></head>';
    html += "<body>";
    html += invoice;
    html += "</body>";
    w.document.write(html);
    w.document.close();
    w.focus();
    w.window.print();
    // w.document.close();
}

// function print_invoice(){
//     var prtContent = document.getElementById("invoiceTable");
//     var WinPrint = window.open('', '', 'left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0');
//     WinPrint.document.write(prtContent.html);
//     WinPrint.document.close();
//     WinPrint.focus();
//     WinPrint.print();
//     WinPrint.close();
// }