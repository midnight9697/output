import{m as d}from"./create-60c026f8.js";import{P as l}from"./purchase_request-b7d14ca2.js";import{P as r}from"./validation-858a56d8.js";document.addEventListener("DOMContentLoaded",()=>{$(".ui.accordion").accordion(),$("#modalRoutePR").on("submit",o=>{o.preventDefault();let i=r.serializeArrayToJson(".routingForm");i.assigned_to=r.assigned,l.routePR(i,e=>{window.location="../"+localStorage.getItem("pr_id")+"/track"})}),l.getPrItems(localStorage.getItem("pr_id"),t)});function t(o){r.transactions=o.transactions,r.members=o.pr.members,r.pr=o.pr,r.memebr_ids=[],o.pr.members.forEach(i=>{r.memebr_ids.push(i.user_id)}),localStorage.getItem("amember")==1&&d(r.members),a()}function a(){let o=$(".transaction_preview"),i="";console.log(r.members.length),r.transactions.slice(0,20).forEach((e,c)=>{let s=0;e.recepients.forEach(m=>{r.memebr_ids.includes(m.receiver_id)&&(s+=1)}),i+=`
        <div class="item">
        <div class="right floated content">
        ${e.action==12?"<span class='ui red text bold'><small><b>APPROVED PR</b></small></span>":`<small>Assigned to: <b><i>${s>1?"Members":e.recepient.profile.firstname+" "+e.recepient.profile.lastname}</b></i></small>`}
        </div>
            <i class="
                ${e.sender_id==localStorage.getItem("user")?"upload icon color green":e.recepient.receiver_id==localStorage.getItem("user")?"download icon color blue":"window minimize icon color dark"}">
            </i>
          <div class="content">
            <a class="header">${e.sender_id==localStorage.getItem("user")?"You":e.sender.firstname+" "+e.sender.lastname}</a>
            ${e.action==1&&e.body!=""?"":`<small style="color:green">(${e.action==12?"Signed":e.act.synonyms})${e.recepient.received==1?" | Received":""}</small>`}
            <div class="description"><b>${e.created_for}</b></div>
            ${e.body?`<div class="remarks_menu">${e.body}</div>`:""}
          </div>
        </div>
        `}),o.html(i)}
