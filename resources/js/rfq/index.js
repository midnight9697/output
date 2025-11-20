import { preview } from "../app";
import { quillClass } from "../quil";
import { TBLButton } from "../table/buttons";
import Custom_table from "../table/custom_table";
import { rfqClass } from "./rfq";
var update_quill;
var quill;

document.addEventListener('DOMContentLoaded', () => {
    $('.menu .item').tab();
    const inbox = CTable(new Custom_table('#rfq-inbox', false, true, true, false, './api/rfq/page'), 'inbox');
    const outbox = CTable(new Custom_table('#rfq-outbox', false, true, false, false, './api/rfq/page'), 'inbox');
    
    // document.getElementById('modalCreateRFQ').onsubmit = (e) => {
    //   e.preventDefault();
    //   rfqClass.creatRFQTemplate({
    //     contents: JSON.stringify(quill.getContents())
    //   }, (e) => {
    //     inbox.table.ajax.reload();
    //   });
    // }
  
    $('.approve_button').on('click', () => {
      $('#formCreateRFQ').trigger('submit');
    });
    
    $('.ui.modal').modal({
      closable: false
    })

    // $('#create_rfq_btn').on('click', () => {
    //     $('#modalCreateRFQ').modal('show');
    // });
    
});

function CTable(CTBL, tab = 'inbox') {
    switch (tab) {
        case 'inbox':
            rfqClass.inbox_rfq = (res) => {
                CTBL.dataSrc = (json) => {
                    return res
                }
            }
            break;
        case 'outbox':
            rfqClass.outbox_pr = (res) => {
                CTBL.dataSrc = (json) => {
                    return res
                }
            }
            break;
        case 'close': 
            rfqClass.closed_pr = (res) => {
                CTBL.dataSrc = (json) => {
                    return res
                }
            }
        break;
    
        default:
            CTBL.dataSrc = (json) => {
                return json.data.filter(el => el.members.filter(member => member.user_id ==localStorage.getItem('user')).length > 0);
            }
            break;
    }
    
    CTBL.custom_buttons = (data) => {
      
        let div = document.createElement('div');
        TBLButton.loadCustomBtns(div);

        TBLButton.createCustomButton(div, 'PREVIEW', 'preview_btn', () => {
            window.open( "./rfq/preview/"+data.id, "_blank");
            // rfqClass.getDox((data) => {
            //     console.log('file', data);
            //     $('#modalDocumentPreview').modal('show');
            //     preview('document-preview', data);
            // });
        })

        TBLButton.createCustomButton(div, 'UPDATE', 'update_btn', () => {
            window.location = "./rfq/form-update/"+data.id;    
        })

        TBLButton.createCustomButton(div, 'ABSTRACT', 'abstract_btn', () => {
            window.location = "./abstract/process/"+data.id;
        })
        TBLButton.relinitialize();
        return div;
    }

    CTBL.load([
        'rfq_number',
        'project_purpose',
        'aproved_budget',
        'classification'
    ]);

    
    return CTBL;
}