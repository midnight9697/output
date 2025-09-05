import{P as l}from"./purchase_request-654254a2.js";import{P as i}from"./validation-a1bd98b3.js";document.addEventListener("DOMContentLoaded",()=>{$(".ui.accordion").accordion(),$(".submit_and_route").on("click",()=>{console.log("yow"),$("#routingForm").trigger("submit")}),$("#routingForm").on("submit",s=>{s.preventDefault();let r=i.serializeArrayToJson(".routingForm");r.supplementary=$("#supplemental").dropdown("get value"),r.assigned_to=i.assigned,l.routePR(r,e=>{})}),$(".ui.search").search({apiSettings:{headers:{Authorization:`Bearer ${localStorage.getItem("bearer")}`},url:"/api/users/search?q={query}",onResponse:function(s){let r=[];return s.data.forEach(e=>{r.push({title:e.profile.firstname+" "+e.profile.lastname,description:e.profile.position,id:e.id,image:{avatar:!0,src:"../files/images/user logo.png"}})}),{results:r}}},searchFields:["firstname"],onSelect:(s,r)=>{i.assigned=s.id}}),l.getPrItems(localStorage.getItem("pr_id"),a)});function a(s){i.transactions=s.transactions,i.members=s.pr.members,i.memebr_ids=[],s.pr.members.forEach(r=>{i.memebr_ids.push(r.user_id)}),n()}function n(){let s=$(".transaction_preview"),r="";i.transactions.slice(0,20).forEach((e,d)=>{let t=0;e.recepients.forEach(o=>{i.memebr_ids.includes(o.receiver_id)&&(t+=1)}),r+=`
        <div class="item">
        <div class="right floated content">
            <small>Assigned: ${t==i.members.length?"Members":e.recepient.profile.firstname+" "+e.recepient.profile.lastname}</small>
            <br>
            <div style="width:100%;text-align:right;">
              <small>${e.spl?"<a href='../../supplemental/download/"+e.spl[0].id+"'>Download</a>":""}</small>
            </div>
        </div>
          <i class="location arrow icon"></i>
          <div class="content">
            <a class="header">${e.sender_id==localStorage.getItem("user")?"You":e.sender.firstname+" "+e.sender.lastname}</a>
            ${e.action==1&&e.body!=""?"":`<small style="color:green">(${e.act.synonyms})${e.recepient.received==1?" | Received":""}</small>`}
           
            <div class="description">
              <b>${e.created_for}</b> | ${e.body} 
            </div>
            
          </div>
        </div>
        `}),s.html(r)}
