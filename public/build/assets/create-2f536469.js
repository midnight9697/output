import{P as a}from"./validation-a1bd98b3.js";import{T as i}from"./buttons-0cb8bf8c.js";import{r as m}from"./rfq-d6705b51.js";import{R as t,a as s}from"./validation-e9260cf5.js";document.addEventListener("DOMContentLoaded",()=>{document.getElementsByClassName("formCreateRFQSpec")[0],$(".add_item_button").on("click",function(){$("#modalCreateRFQSpec").modal("show")}),$(".add_rfq_item_button").on("click",()=>{$(".formCreateRFQSpec").trigger("submit")}),$(".submit_rfq_form_button").on("click",function(){$("#formCreateRFQ").trigger("submit")})});t.CreateRFQValidation(o=>{o.preventDefault(),console.log(t.serializeArrayToJson("#formCreateRFQ"));let r={project_purpose:a.serializeArrayToJson(".formCreateRFQ").project_purpose,rfq_number:a.serializeArrayToJson(".formCreateRFQ").rfq_number,attachment_one:a.serializeArrayToJson(".formCreateRFQ").attachment_one,aproved_budget:a.serializeArrayToJson(".formCreateRFQ").approved_budget,standard_unit:a.serializeArrayToJson(".formCreateRFQ").standard_unit,target_delivery_date:a.serializeArrayToJson(".formCreateRFQ").target_deliver_date,classification:a.serializeArrayToJson(".formCreateRFQ").classification,items:t.items};m.creatRFQ(r,e=>{window.location.reload(!0)})});s.CreateRFQItemValidation(o=>{o.preventDefault();let r=t.serializeArrayToJson(".formCreateRFQSpec");r.id=Math.floor(Math.random()*1e3),t.items.push(r),$(".formCreateRFQSpec").form("reset"),$("#modalCreateRFQSpec").modal("hide"),d(t.items)});function d(o){let r="";o.forEach(e=>{let n=document.createElement("div");i.data=e,i.deleteAction=!0,i.deleteClassName="removeItem",i.loadButtons(n),r+=`
            <tr>
                <td>${e.specification}</td>
                <td>${e.bidder_specs}</td>
                <td>TBA</td>
                <td>${e.quantity_unit}</td>
                <td>${e.unit_price}</td>
                <td>${e.total_price}</td>
                <td>${n.innerHTML}</td>
            </tr>
        `}),o.length==0&&(r+=`
            <tr>
                <td colspan="7">No Record Found</td>
            </tr>
        `),document.getElementById("quotation_table_body").innerHTML=r,$(".removeItem").on("click",e=>{console.log(e.target.dataset.id),t.items=t.items.filter(n=>n.id!=e.target.dataset.id),d(t.items)}),i.relinitialize()}
