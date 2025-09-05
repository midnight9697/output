import{m as l}from"./create-5848b868.js";import{P as t}from"./purchase_request-654254a2.js";import{P as r}from"./validation-a1bd98b3.js";document.addEventListener("DOMContentLoaded",()=>{$(".ui.accordion").accordion(),$("#modalRoutePR").on("submit",s=>{s.preventDefault();let i=r.serializeArrayToJson(".routingForm");i.assigned_to=r.assigned,t.routePR(i,e=>{window.location="../"+localStorage.getItem("pr_id")+"/track"})}),t.getPrItems(localStorage.getItem("pr_id"),a)});function a(s){r.transactions=s.transactions,r.members=s.pr.members,r.pr=s.pr,r.memebr_ids=[],s.pr.members.forEach(i=>{r.memebr_ids.push(i.user_id)}),localStorage.getItem("amember")==1&&l(r.members),d()}function d(){let s=$(".transaction_preview"),i="";r.transactions.slice(0,20).forEach((e,n)=>{let o=0;e.recepients.forEach(m=>{r.memebr_ids.includes(m.receiver_id)&&(o+=1)}),i+=`
        <div class="item">
        <div class="right floated content">
            <small>Assigned: ${o==r.members.length?"Members":e.recepient.profile.firstname+" "+e.recepient.profile.lastname}</small>
        </div>
          <i class="location arrow icon"></i>
          <div class="content">
            <a class="header">${e.sender_id==localStorage.getItem("user")?"You":e.sender.firstname+" "+e.sender.lastname}</a>
            ${e.action==1&&e.body!=""?"":`<small style="color:green">(${e.act.synonyms})${e.recepient.received==1?" | Received":""}</small>`}
            
            <div class="description"><b>${e.created_for}</b> | ${e.body}</div>
          </div>
        </div>
        `}),s.html(i)}
