import { MessageMod, confirmMod } from "../app";
import { quillClass } from "../quil";
import { TBLButton } from "../table/buttons";
import Custom_table from "../table/custom_table";
import { PurchaseOrderClass } from "./purchase_order";
var update_quill;
var quill;

document.addEventListener('DOMContentLoaded', () => {
    $('.menu .item').tab();
    const inbox = CTable(new Custom_table('#purchase_order_tab', false, true, true, false, './api/purchase_order/page'), 'inbox');
    // const outbox = CTable(new Custom_table('#rfq-outbox', false, true, false, false, './api/rfq/page'), 'inbox');
    
    // document.getElementById('modalCreateRFQ').onsubmit = (e) => {
    //   e.preventDefault();
    //   PurchaseOrderClass.creatRFQTemplate({
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
            PurchaseOrderClass.inbox_rfq = (res) => {
                CTBL.dataSrc = (json) => {
                    return res
                }
            }
            break;
        case 'outbox':
            PurchaseOrderClass.outbox_pr = (res) => {
                CTBL.dataSrc = (json) => {
                    return res
                }
            }
            break;
        case 'close': 
            PurchaseOrderClass.closed_pr = (res) => {
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
      TBLButton.viewName = "Update";
      TBLButton.updateAction = () => {
        window.location = "./purchase_order/form-update/"+data.id;        
      }

      TBLButton.deleteAction = (e) => {
        confirmMod.load(() => {
          PurchaseOrderClass.remove(data.id, (e) => {
            SPLTBL.table.ajax.reload();
            MessageMod.success("Successfully Deleted.");
          });
        }, "Do you want to delete this file ?");
      }
      
      TBLButton.loadButtons(div);
      return div;
    }

    CTBL.load([
        'purchase_order_no',
        'purchase_order_no',
        'purchase_order_no',
        'created_at',
    ]);

    
    return CTBL;
}