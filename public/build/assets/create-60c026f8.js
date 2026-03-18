import{P as d}from"./purchase_request-b7d14ca2.js";import{P as l,a as r}from"./validation-858a56d8.js";document.addEventListener("DOMContentLoaded",()=>{$(".total_cost").on("input",()=>{let e=document.getElementsByClassName("total_cost"),t=document.getElementById("total_cost");t.value=e[0].value*e[1].value}),$(".add_item_btn").on("click",()=>{$("#modalCreaeItem").modal("show")}),$(".submit_item_to_list").on("click",()=>{$("#formCreatePRItem").trigger("submit")}),l.CreatePRValidation(e=>{e.preventDefault();let t=l.serializeArrayToJson(".createpr");d.creatPR(t,l.items,o=>{window.location.reload(!0)})}),r.CreatePRItemValidation(e=>{e.preventDefault(),$("#modalCreaeItem").modal("hide");let t=document.getElementById("total_cost");t.hasAttribute("disabled")&&t.removeAttribute("disabled"),l.items.push(l.serializeArrayToJson(".formCreatePRItem")),t.disabled=!0,s()}),s()});function s(){let e=$(".table-pr-items"),t="",o="";l.items.forEach(a=>{o+=`
            <tr>
                <td>${a.property_number}</td>
                <td>${a.unit}</td>
                <td>${a.item_description}</td>
                <td>${a.quantity}</td>
                <td>${a.unit_cost}</td>
                <td>${a.total_cost}</td>
            </tr>
        `}),t=`
        <table class="ui very basic collapsing celled table hidden" id="prTable" style="width:100%">
            <thead>
               <tr>
                    <th>Stock/Property No.</th>
                    <th>Unit</th>
                    <th>Item Description</th>
                    <th>Quantity</th>
                    <th>Unit Cost</th>
                    <th>Tota Cost</th>
               </tr>
            </thead>
            <tbody>
                ${l.items.length==0?`
                    <tr>
                        <td style="text-align:center" colspan="6">No Item Found</td>
                    </tr>
                `:o}
            </tbody>
        </table>
    `,e.html(t)}function m(e){let t=$(".members-form-section"),o="",a="";e.forEach(i=>{a+=`
            <div class="item">
              <div class="right floated content">
                ${i.created_by==localStorage.getItem("user")?"":'<div class="ui very tiny green button">EDIT</div>'}
              </div>
              <img class="ui avatar image" src="/files/images/user logo.png">
              <div class="content">
                <div class="header">${i.user.profile.lastname+" "+i.user.profile.firstname}</div>
                <small>${i.role}. ${l.pr.created_by==i.user_id?"CREATOR":`ADDED BY: ${i.added_by.profile.firstname+" "+i.added_by.profile.lastname}`}</small>
              </div>
            </div> 
        `}),o=`
    <div class="ui middle aligned divided list">
        ${a}    
    </div>
    `,t.html(o)}export{s as i,m};
