import{a as m}from"./login-fd2f47ad.js";import{P as o}from"./purchase_request-654254a2.js";import{P as l}from"./validation-a1bd98b3.js";document.addEventListener("DOMContentLoaded",()=>{$(".ui.accordion").accordion(),$(".submit_and_route").on("click",()=>{console.log("yow"),$("#routingForm").trigger("submit")}),$("#routingForm").on("submit",s=>{s.preventDefault();let i=l.serializeArrayToJson(".routingForm");i.supplementary=$("#supplemental").dropdown("get value"),i.assigned_to=l.assigned,o.routePR(i,e=>{})}),$(".ui.search").search({apiSettings:{headers:{Authorization:`Bearer ${localStorage.getItem("bearer")}`},url:"/api/users/search?q={query}",onResponse:function(s){let i=[];return s.data.forEach(e=>{i.push({title:e.profile.firstname+" "+e.profile.lastname,description:e.profile.position,id:e.id,image:{avatar:!0,src:"../files/images/user logo.png"}})}),{results:i}}},searchFields:["firstname"],onSelect:(s,i)=>{l.assigned=s.id}}),o.getPrItems(localStorage.getItem("pr_id"),c)});function c(s){l.transactions=s.transactions,l.members=s.pr.members,l.memebr_ids=[],s.pr.members.forEach(i=>{l.memebr_ids.push(i.user_id)}),p()}function p(){let s=$(".transaction_preview"),i="";l.transactions.slice(0,20).forEach((e,r)=>{let t=0;e.recepients.forEach(d=>{l.memebr_ids.includes(d.receiver_id)&&(t+=1)}),i+=`
        <div class="item">
        <div class="right floated content">
            <small>Assigned: ${t==l.members.length?"Members":e.recepient.profile.firstname+" "+e.recepient.profile.lastname}</small>
            <br>
            <div style="width:100%;text-align:right;">
              <small>${e.spl?"<a data-id='"+e.id+"' class='show_files' href='#'>Files</a>":""}</small>
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
        `}),s.html(i),$(".show_files").on("click",e=>{let r=m("ui tiny modal top-aligned"),t=l.transactions.find(a=>a.id==e.target.dataset.id);r.innerHTML=`
        <div class="header">
          Supplemental
        </div>
        <div class="scrolling  content">
          <div class="ui relaxed divided list" style="etxt-align:center">
            ${t?t.spl.map(a=>{let n=a.supplemental;return`
              <div class="item">
                <i class="large file middle aligned icon"></i>
                <div class="content">
                  <a class="header" target="__blank" href="/supplemental/download/${a.id}">${n.origin}</a>
                </div>
              </div>
              `}):""}
          </div>
        </div>
      `,document.getElementsByTagName("body")[0].appendChild(r),$(r).modal("show")})}
