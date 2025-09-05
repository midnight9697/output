import{P as s}from"./purchase_request-654254a2.js";import{P as e,a as o}from"./validation-a1bd98b3.js";document.addEventListener("DOMContentLoaded",()=>{$(".add_item_btn").on("click",()=>{$("#modalCreaeItem").modal("show")}),$(".submit_item_to_list").on("click",()=>{$("#formCreatePRItem").trigger("submit")}),e.CreatePRValidation(a=>{a.preventDefault(),s.creatPR(e.serializeArrayToJson(".createpr"),e.items,d=>{window.location.reload(!0)})}),o.CreatePRItemValidation(a=>{a.preventDefault(),$("#modalCreaeItem").modal("hide"),e.items.push(e.serializeArrayToJson(".formCreatePRItem")),r()}),r()});function r(){let a=$(".table-pr-items"),d="",l="";e.items.forEach(t=>{l+=`
            <tr>
                <td>${t.property_number}</td>
                <td>${t.unit}</td>
                <td>${t.item_description}</td>
                <td>${t.quantity}</td>
                <td>${t.unit_cost}</td>
                <td>${t.total_cost}</td>
            </tr>
        `}),d=`
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
                ${e.items.length==0?`
                    <tr>
                        <td style="text-align:center" colspan="6">No Item Found</td>
                    </tr>
                `:l}
            </tbody>
        </table>
    `,a.html(d)}function m(a){let d=$(".members-form-section"),l="",t="";a.forEach(i=>{t+=`
            <div class="item">
              <div class="right floated content">
                ${i.created_by==localStorage.getItem("user")?"":'<div class="ui very tiny green button">EDIT</div>'}
              </div>
              <img class="ui avatar image" src="/files/images/user logo.png">
              <div class="content">
                <div class="header">${i.user.profile.lastname+" "+i.user.profile.firstname}</div>
                <small>${i.role}. ${e.pr.created_by==i.user_id?"CREATOR":`ADDED BY: ${i.added_by.profile.firstname+" "+i.added_by.profile.lastname}`}</small>
              </div>
            </div> 
        `}),l=`
    <div class="ui middle aligned divided list">
        ${t}    
    </div>
    `,d.html(l)}export{r as i,m};
