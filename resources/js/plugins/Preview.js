export class CustomPreview {

    constructor() {
        jspreadsheet.setLicense('YWE3OTljOTA2ZThmOWVhZjYwNmJjZDk3OTY0MmRkMDZhMjQwMTQ4NTRhZWVkN2RiNDUxNmUyZDIzZmZiNzc2MzJhMjhmNDZjNDI5YmU0Y2JhNTY4OTY0NmQ5YmJiYmU3YTY3YmVlYjgwNDkwZmMxODNkMTFmNTgxYzU0OThjMTQsZXlKamJHbGxiblJKWkNJNklpSXNJbTVoYldVaU9pSktjM0J5WldGa2MyaGxaWFFpTENKa1lYUmxJam94TnpFMU9Ua3pNamN6TENKa2IyMWhhVzRpT2xzaWFuTndjbVZoWkhOb1pXVjBMbU52YlNJc0ltTnZaR1Z6WVc1a1ltOTRMbWx2SWl3aWFuTm9aV3hzTG01bGRDSXNJbU56WWk1aGNIQWlMQ0ozWldJaUxDSnNiMk5oYkdodmMzUWlYU3dpY0d4aGJpSTZJak0wSWl3aWMyTnZjR1VpT2xzaWRqY2lMQ0oyT0NJc0luWTVJaXdpZGpFd0lpd2lkakV4SWl3aVkyaGhjblJ6SWl3aVptOXliWE1pTENKbWIzSnRkV3hoSWl3aWNHRnljMlZ5SWl3aWNtVnVaR1Z5SWl3aVkyOXRiV1Z1ZEhNaUxDSnBiWEJ2Y25SbGNpSXNJbUpoY2lJc0luWmhiR2xrWVhScGIyNXpJaXdpYzJWaGNtTm9JaXdpY0hKcGJuUWlMQ0p6YUdWbGRITWlMQ0pqYkdsbGJuUWlMQ0p6WlhKMlpYSWlMQ0p6YUdGd1pYTWlYU3dpWkdWdGJ5STZkSEoxWlgwPQ==');
        // Set extensions
        // jspreadsheet.setExtensions({ parser });
    }

    fetch(success, path, cont_id, tfile, tcont_id) {
        console.log('Path',path);
        var tmp = this;
        // return;
        jQuery.ajax({
            url:path,
            cache:false,
            xhr:function(){// Seems like the only way to get access to the xhr object
                var xhr = new XMLHttpRequest();
                xhr.responseType= 'blob'
                return xhr;
            },
            success: function(data){
                console.log('image', data);
                console.log('type',path);
                
                var print_item = document.getElementById('print_item')?document.getElementById('print_item'):{dataset:{ type:''}};
                if (data.type == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document') {
                    print_item.dataset.type = 'word';
                    $(document.getElementById(cont_id)).attr('class', '');
                    tmp.preview(cont_id, data);
                }
                else {
                    switch (data.type) {
                        case 'application/pdf':
                            var container = document.querySelector("#"+ tcont_id);
                            print_item.dataset.type = 'pdf';
                            $(document.getElementById(tcont_id)).attr('class', '');
                            container.src = tfile;
                            container.style = "width:100%;height: 78vh";

                            // container.onload = function() {
                            //     this.contentWindow.document.body.style = 'overflow:hidden';
                            //     let tst = container.contentWindow.document.querySelector('embed');
                            //     this.height = this.contentWindow.document.body.scrollHeight;
                            //     console.log('Contain',tst);
                            // }
                            break;
                        case 'text/plain':
                            var container = document.querySelector("#"+ tcont_id);
                            print_item.dataset.type = 'text';
                            $(document.getElementById(tcont_id)).attr('class', '');
                            container.src = tfile;
                            container.style = "width:100%;height: 78vh";

                            container.onload = function() {
                                this.contentWindow.document.body.style = 'overflow:hidden';
                                let tst = container.contentWindow.document.querySelector('embed');
                                this.height = this.contentWindow.document.body.scrollHeight;
                                console.log('Contain',tst);
                            }
                            break;
                        case "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet":
                                print_item.dataset.type = 'excel';
                                console.log('Excel');
                                var container = document.getElementById('excel_item');
                                jspreadsheet.destroy(container);
                                jspreadsheet.parser({
                                    file: data,
                                    // It would be used to updated the formats only
                                    locale: 'en-GB',
                                    onload: function(config) {
                                        config.editable = false;
                                        jspreadsheet(document.getElementById('excel_item'), config);
                                    },
                                    onerror: function(error) {
                                        alert(error);
                                    }
                                });
                                container.className  = 'm-auto';
                            break;
                        default:
                            // console.clear();
                            console.log(path);
                            print_item.dataset.type = 'image';
                            var container = document.querySelector("#image_item");
                            container.src = path;
                            container.className = 'm-auto';
                            container.style = 'max-height:100%;max-width:100%';
                            break;
                    }
                    
                    // window.open(tfile);
                }
                // document.getElementById('download_dox').href = path;
                
                let anchor = document.getElementById('download_dox');
                document.getElementById('print_item').onclick = tmp.PrintElem;
                $(anchor).attr('href', path).attr("download", anchor.dataset.name);
                success(data);
                // print_item.className = 'd-none';
            },
            error:function(){

            }
        });
    }

    preview(cont_id, doc) {
        //Read the Word Document data from the File Upload.
        // var doc =  //document.getElementById("files").files[0];
        console.log('Documents',doc);
        //If Document not NULL, render it.
        if (doc != null) {
            //Set the Document options.
            var docxOptions = Object.assign(docx.defaultOptions, {
                // useMathMLPolyfill: true
            });
            //Reference the Container DIV.
            var container = document.querySelector("#"+ cont_id);
            
            //Render the Word Document.
            docx.renderAsync(doc, container, null, docxOptions);
            // var cont = document.getElementById("#"+ cont_id);
            // let dos = cont.lastChild;
            // $(dos).css('width', '100%');
            container.className = 'm-auto';
            container.style = 'max-width:auto;padding:0px';
            console.log('Yana', container);
        }
    }

    PrintElem(elem) {
        elem = 'previewer';
        var print_item = document.getElementById('print_item');
        console.log(print_item.dataset.type);
        
        if (print_item.dataset.type == 'pdf') {
            elem = 'preview';
            document.getElementById(elem).contentWindow.print();
            return;
        }
        if (print_item.dataset.type == 'image') {
            elem = 'image_item';
            let el = document.getElementById(elem);
            var Pagelink = el.src;
            var pwa = window.open(Pagelink, "myWindow","width=500,height=700");
            pwa.onload = function () {pwa.print();}
            return;
        }
        var mywindow = window.open('', 'PRINT', 'height=400,width=600');
    
        mywindow.document.write('<html><head><title>' + document.title  + '</title>');
        mywindow.document.write('</head><body >');
        // mywindow.document.write('<h1></h1>');
        mywindow.document.write(document.getElementById(elem).innerHTML);
        mywindow.document.write('</body></html>');
        
        mywindow.document.close(); // necessary for IE >= 10
        mywindow.focus(); // necessary for IE >= 10*/
        
        mywindow.print();
        mywindow.close();
        
        return true;
    }

}

export const docPreview = new CustomPreview();