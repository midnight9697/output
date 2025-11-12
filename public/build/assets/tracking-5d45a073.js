import{m as t}from"./create-f9b3d0e4.js";import{P as l}from"./purchase_request-5474f191.js";import{P as r}from"./validation-444b2c61.js";document.addEventListener("DOMContentLoaded",()=>{$(".ui.accordion").accordion(),$("#modalRoutePR").on("submit",s=>{s.preventDefault();let o=r.serializeArrayToJson(".routingForm");o.assigned_to=r.assigned,l.routePR(o,e=>{window.location="../"+localStorage.getItem("pr_id")+"/track"})}),l.getPrItems(localStorage.getItem("pr_id"),d)});function d(s){r.transactions=s.transactions,r.members=s.pr.members,r.pr=s.pr,r.memebr_ids=[],s.pr.members.forEach(o=>{r.memebr_ids.push(o.user_id)}),localStorage.getItem("amember")==1&&t(r.members),a()}function a(){let s=$(".transaction_preview"),o="";console.log(r.members.length),r.transactions.slice(0,20).forEach((e,c)=>{let i=0;e.recepients.forEach(m=>{r.memebr_ids.includes(m.receiver_id)&&(i+=1)}),o+=`
        <div class="item">
        <div class="right floated content">
        ${e.action==12?"<span class='ui red text bold'><small><b>FILE CLOSED</b></small></span>":`<small>Assigned to: <b><i>${i>1?"Members":e.recepient.profile.firstname+" "+e.recepient.profile.lastname}</b></i></small>`}
        </div>
            <i class="
                ${e.sender_id==localStorage.getItem("user")?"upload icon color green":e.recepient.receiver_id==localStorage.getItem("user")?"download icon color blue":"window minimize icon color dark"}">
            </i>
          <div class="content">
            <a class="header">${e.sender_id==localStorage.getItem("user")?"You":e.sender.firstname+" "+e.sender.lastname}</a>
            ${e.action==1&&e.body!=""?"":`<small style="color:green">(${e.act.synonyms})${e.recepient.received==1?" | Received":""}</small>`}
            <div class="description"><b>${e.created_for}</b></div>
            <div class="remarks_menu">Remarks: ${e.body}</div>
          </div>
        </div>
        `}),s.html(o)}
