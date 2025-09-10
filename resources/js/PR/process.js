import { MessageMod, confirmMod, createElement, progressControl, uploadControl } from "../app";
import { filePreview } from "../supplemental";
import { PRClass } from "./purchase_request";
import { PRValidator } from "./validation";
let uploaded_attachments = [];
document.addEventListener('DOMContentLoaded', () => {

  $('#upload_attachment').on('click', (e) => {
    e.preventDefault();
    confirmMod.load(() => {
      const attFile = document.getElementById('att_file');
      var fcount = 0;
      uploaded_attachments = [];
      if (attFile.files.length > 0) {
        progressControl.make('progress-section');
        uploadFile(attFile, fcount);
      }
      // PRClass.uploadAtt(attFile.file)
    }, "Do you want to upload attachments ?");
  });

    $('#att_file').on('change', () => {
      const attFile = document.getElementById('att_file');
      filePreview(attFile.files);
    });
    
    $('.ui.accordion').accordion();

    $('.submit_and_route').on('click', () => {
        console.log('yow');
        $('#routingForm').trigger('submit');
    });

    $('#routingForm').on('submit', (e) => {
        e.preventDefault();
        let data = PRValidator.serializeArrayToJson('.routingForm');
        data['supplementary'] = $('#supplemental').dropdown('get value');
        data['assigned_to'] = PRValidator.assigned;
        data['attachments'] = uploaded_attachments;
        PRClass.routePR(data, (respsons) => {
          window.location = '../'+localStorage.getItem('pr_id')+'/track';
        });
    });
    
    $('.ui.search')
      .search({
        apiSettings: {
            headers: {
                'Authorization': `Bearer ${localStorage.getItem('bearer')}`
            },
            url: '/api/users/search?q={query}',
            onResponse: function(response) {
              let result = [];
              response.data.forEach(user => {
                result.push({
                  title: user.profile.firstname+" "+user.profile.lastname,
                  description: user.profile.position,
                  id: user.id,
                  image: { avatar: true, src: '../files/images/user logo.png' }
                });
              });
              return {
                results : result
              };
            },
          },
        searchFields   : [
          'firstname'
        ],
        onSelect: (result, response) => {
          PRValidator.assigned = result.id
      }
    });

    PRClass.getPrItems(localStorage.getItem('pr_id'), dataFetcher);
});

function dataFetcher(data) {
    PRValidator.transactions = data.transactions;
    PRValidator.members = data.pr.members;
    PRValidator.memebr_ids = [];
    data.pr.members.forEach(member => {
        PRValidator.memebr_ids.push(member.user_id);
    });
    transactionTable()
    
}

function transactionTable() {
    let parentElement = $('.transaction_preview');
    let ht = "";

    PRValidator.transactions.slice(0, 20).forEach((transaction, index) => {
        let receiver = "";
        let member_count = 0;
        transaction.recepients.forEach(recepient => {
            if (PRValidator.memebr_ids.includes(recepient.receiver_id)) {
                member_count += 1;
            }
        });
        ht += `
        <div class="item">
        <div class="right floated content">
            <small>Assigned: ${(member_count == PRValidator.members.length?"Members":transaction.recepient.profile.firstname+" "+transaction.recepient.profile.lastname)}</small>
            <br>
            <div style="width:100%;text-align:right;">
              <small>${(transaction.attachments.length > 0?"<a data-id='"+transaction.id+"' class='show_files' href='#'>Files</a>":"")}</small>
            </div>
          </div>
          <i class="location arrow icon"></i>
          <div class="content">
            <a class="header">${(transaction.sender_id==localStorage.getItem('user')?"You":transaction.sender.firstname+" "+transaction.sender.lastname)}</a>
            ${(transaction.action == 1 && transaction.body != ""?"":`<small style="color:green">(${transaction.act.synonyms})${transaction.recepient.received == 1?" | Received":""}</small>`)}
           
            <div class="description">
              <b>${transaction.created_for}</b> | ${transaction.body} 
            </div>
          </div>
        </div>
        `;
    });
    parentElement.html(ht);
    $('.show_files').on('click', (event) => {
      let modal =  createElement("ui tiny modal top-aligned");
      let files = PRValidator.transactions.find(el => el.id == event.target.dataset.id);
      modal.innerHTML = `
        <div class="header">
          Supplemental
        </div>
        <div class="scrolling  content">
          <div class="ui relaxed divided list" style="text-align:center">
            ${(files.attachments?files.attachments.map(attachment => {
              return `
              <div class="item">
                <i class="large file middle aligned icon"></i>
                <div class="content">
                  <a class="header" target="__blank" href="../../attachment/${attachment.id}">${attachment.origin}</a>
                </div>
              </div>
              `;
            }):"")}
            ${
              files.attachments.length == 0?"<smal>No Attachments Available</small>":""
            }
          </div>
        </div>
      `;
      let body = document.getElementsByTagName('body')[0];
      body.appendChild(modal);

      $(modal).modal('show');
      
    })
}

function uploadFile(attachmentFile, fcount) {
  let current_file = attachmentFile.files[fcount];
  let fd = new FormData();
  fd.append('att_file', current_file, current_file.name);
  fd.append('filename', current_file.name);
  fd.append('filetype', current_file.type);
  uploadControl.upload('./api/pr/attachment/upload', fd, (response) => {
    fcount += 1;
    uploaded_attachments.push(response.data);
    console.log('uploaded', uploaded_attachments);
    if (fcount < attachmentFile.files.length) {
      progressControl.make('progress-section');
      progressControl.progress(0, (fcount+1)+' of '+attachmentFile.files.length);
      setTimeout(() => {
        uploadFile(attachmentFile, fcount);
      }, 1000);
    }
    else {
      document.getElementById('routingForm').reset();
      MessageMod.success("All files have been uploaded successfully.");
      progressControl.make('progress-section');
    }
  }, (progress) => {
    progressControl.progress(progress, (fcount+1)+' of '+attachmentFile.files.length);
    if (progress >= 100) {
      progressControl.success();
    }// If Statement
  }, (fail) => {
    console.log('fail', fail);
    MessageMod.fail("File too large.");
    progressControl.make('progress-section');
    progressControl.fail();
  });// UploadControl Endpoint
}