import{c as g,M as d,a as o,u as f,b}from"./login-c329fcbe.js";import{C as y,T as m}from"./custom_table-2cefb59f.js";import{S as w}from"./supplemental-c1abe652.js";import{P as p}from"./purchase_request-5474f191.js";import{P as i}from"./validation-a1bd98b3.js";let n={};document.addEventListener("DOMContentLoaded",()=>{n=new y("#splTable",!1,!0,!1,!1,"./api/supplemental/page"),n.dataSrc=l=>l.data,n.custom_buttons=l=>{let a=document.createElement("div");return m.data=l,m.updateAction=()=>{window.location="./supplemental/update/"+l.id},m.deleteAction=e=>{g.load(()=>{let t=e.target.dataset.id;w.remove(t,s=>{n.table.ajax.reload(),d.success("Successfully Deleted.")})},"Do you want to delete this file ?")},m.loadButtons(a),a},n.load(["ref","title","created_at"]),$("#supplemental").on("change",()=>{const l=document.getElementById("supplemental");h(l.files)}),$("#upload-file-button").on("click",()=>{const l=document.getElementById("supplemental");o.make("progress-section");var a=0;l.files.length>0&&($("#modalUploadSupplemental").modal("hide"),v(l,a))})});function h(l,a=document.getElementById("files-preview")){const e=a;e.innerHTML="";let t=document.createElement("div");t.className="ui list";let s="";l.forEach(r=>{s+=`
      <div class="item">
        <i class="file icon"></i>
        <div class="content">
          <a ${r.url?"href='"+r.url+"'":""} class="description">${r.name}</a>
        </div>
      </div>
    `}),t.innerHTML=s,e.appendChild(t)}function v(l,a){let e=l.files[a],t=new FormData;t.append("sup_file",e,e.name),t.append("filename",e.name),t.append("filetype",e.type),f.upload("./api/supplemental/upload",t,s=>{a+=1,a<l.files.length?(o.make("progress-section"),o.progress(0,a+1+" of "+l.files.length),n.table.ajax.reload(function(){setTimeout(()=>{v(l,a)},1e3)})):(n.table.ajax.reload(),d.success("All files have been uploaded successfully."),o.make("progress-section"))},s=>{o.progress(s,a+1+" of "+l.files.length),s>=100&&o.success()},()=>{d.fail("File too large."),o.make("progress-section"),o.fail()})}let u=[];console.log("hello");document.addEventListener("DOMContentLoaded",()=>{const l=document.getElementById("action_process"),a=document.getElementById("assigned_to_pr");action_process.onchange=()=>{p.getDecryptAction(l.value,e=>{e==12?a.style.display="none":a.style.display="block"})},$("#generate_pr_number").on("click",()=>{g.load(()=>{p.generatePR(localStorage.getItem("pr_id"),()=>{d.success("Success.!",()=>{window.location.reload()})})},"Do you want to generate PR. No.")}),$("#upload_attachment").on("click",e=>{e.preventDefault(),g.load(()=>{const t=document.getElementById("att_file");var s=0;u=[],t.files.length>0&&(o.make("progress-section"),_(t,s))},"Do you want to upload attachments ?")}),$("#att_file").on("change",()=>{const e=document.getElementById("att_file");h(e.files)}),$(".ui.accordion").accordion(),$(".submit_and_route").on("click",()=>{console.log("yow"),$("#routingForm").trigger("submit")}),$("#routingForm").on("submit",e=>{e.preventDefault();let t=i.serializeArrayToJson(".routingForm");t.supplementary=$("#supplemental").dropdown("get value"),t.assigned_to=i.assigned,t.attachments=u,p.routePR(t,s=>{window.location="../"+localStorage.getItem("pr_id")+"/track"})}),$(".ui.search").search({apiSettings:{headers:{Authorization:`Bearer ${localStorage.getItem("bearer")}`},url:"/api/users/search?q={query}",onResponse:function(e){let t=[];return e.data.forEach(s=>{t.push({title:s.profile.firstname+" "+s.profile.lastname,description:s.profile.position,id:s.id,image:{avatar:!0,src:"../files/images/user logo.png"}})}),{results:t}}},searchFields:["firstname"],onSelect:(e,t)=>{i.assigned=e.id}}),p.getPrItems(localStorage.getItem("pr_id"),E)});function E(l){i.transactions=l.transactions,i.members=l.pr.members,i.memebr_ids=[],l.pr.members.forEach(a=>{i.memebr_ids.push(a.user_id)}),k()}function k(){let l=$(".transaction_preview"),a="";i.transactions.slice(0,20).forEach((e,t)=>{let s=0;e.recepients.forEach(r=>{i.memebr_ids.includes(r.receiver_id)&&(s+=1)}),a+=`
        <div class="item">
        <div class="right floated content">
            ${e.action==12?"<span class='ui red text bold'><small><b>FILE CLOSED</b></small></span>":`<small>Assigned to: <b><i>${s>1?"Members":e.recepient.profile.firstname+" "+e.recepient.profile.lastname}</b></i></small>`}
            <br>
            <div style="width:100%;text-align:right;">
              <small>${e.attachments.length>0?"<a data-id='"+e.id+"' class='show_files' href='#'>Files</a>":""}</small>
            </div>
          </div>
          <i class="${e.sender_id==localStorage.getItem("user")?"upload icon color green":e.recepient.receiver_id==localStorage.getItem("user")?"download icon color blue":"window minimize icon color dark"}"></i>
        <div class="content">
        <a class="header">${e.sender_id==localStorage.getItem("user")?"You":e.sender.firstname+" "+e.sender.lastname}</a>
        ${e.action==1&&e.body!=""?"":`<small style="color:green">(${e.act.synonyms})${e.recepient.received==1?" | Received":""}</small>`}
        <div class="description"><b>${e.created_for}</b></div>
        <div class="remarks_menu">Remarks: ${e.body}</div>
      </div>
        </div>
        `}),l.html(a),$(".show_files").on("click",e=>{let t=b("ui tiny modal top-aligned"),s=i.transactions.find(c=>c.id==e.target.dataset.id);t.innerHTML=`
        <div class="header">
          Supplemental
        </div>
        <div class="scrolling  content">
          <div class="ui relaxed divided list" style="text-align:center">
            ${s.attachments?s.attachments.map(c=>`
              <div class="item">
                <i class="large file middle aligned icon"></i>
                <div class="content">
                  <a class="header" target="__blank" href="../../attachment/${c.id}">${c.origin}</a>
                </div>
              </div>
              `):""}
            ${s.attachments.length==0?"<smal>No Attachments Available</small>":""}
          </div>
        </div>
      `,document.getElementsByTagName("body")[0].appendChild(t),$(t).modal("show")})}function _(l,a){let e=l.files[a],t=new FormData;t.append("att_file",e,e.name),t.append("filename",e.name),t.append("filetype",e.type),f.upload("./api/pr/attachment/upload",t,s=>{a+=1,u.push(s.data),console.log("uploaded",u),a<l.files.length?(o.make("progress-section"),o.progress(0,a+1+" of "+l.files.length),setTimeout(()=>{_(l,a)},1e3)):(document.getElementById("routingForm").reset(),d.success("All files have been uploaded successfully."),o.make("progress-section"))},s=>{o.progress(s,a+1+" of "+l.files.length),s>=100&&o.success()},s=>{console.log("fail",s),d.fail("File too large."),o.make("progress-section"),o.fail()})}
