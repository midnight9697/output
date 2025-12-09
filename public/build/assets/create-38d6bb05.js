import{P as s}from"./purchase_request-8ae33fa3.js";import{P as i}from"./validation-858a56d8.js";import{T as d}from"./custom_table-ff526490.js";import{r as m}from"./rfq-dedac424.js";import{R as a,a as l}from"./validation-e9260cf5.js";document.addEventListener("DOMContentLoaded",()=>{document.getElementsByClassName("formCreateRFQSpec")[0],$(".add_item_button").on("click",function(){$("#modalCreateRFQSpec").modal("show")}),$(".add_rfq_item_button").on("click",()=>{$(".formCreateRFQSpec").trigger("submit")}),$(".submit_rfq_form_button").on("click",function(){$("#formCreateRFQ").trigger("submit")})});s.getPrItems(localStorage.getItem("pr_id"),o=>{let e=o.items,t=[];e.forEach(r=>{t.push({id:Math.floor(Math.random()*1e3),bidder_specs:r.item_description,quantity_unit:r.quantity,specification:r.item_description,total_price:r.total_cost,unit_price:r.unit_cost})}),a.items=[...t],n(t)});a.CreateRFQValidation(o=>{o.preventDefault();let e={project_purpose:i.serializeArrayToJson(".formCreateRFQ").project_purpose,rfq_number:i.serializeArrayToJson(".formCreateRFQ").rfq_number,attachment_one:i.serializeArrayToJson(".formCreateRFQ").attachment_one,aproved_budget:i.serializeArrayToJson(".formCreateRFQ").approved_budget,standard_unit:i.serializeArrayToJson(".formCreateRFQ").standard_unit,target_delivery_date:i.serializeArrayToJson(".formCreateRFQ").target_deliver_date,classification:i.serializeArrayToJson(".formCreateRFQ").classification,items:a.items,pr_id:localStorage.getItem("pr_id")};m.creatRFQ(e,t=>{window.location.reload(!0)})});l.CreateRFQItemValidation(o=>{o.preventDefault();let e=a.serializeArrayToJson(".formCreateRFQSpec");e.id=Math.floor(Math.random()*1e3),a.items.push(e),$(".formCreateRFQSpec").form("reset"),$("#modalCreateRFQSpec").modal("hide"),n(a.items)});function n(o){let e="";o.forEach(t=>{let r=document.createElement("div");d.data=t,d.deleteAction=!0,d.deleteClassName="removeItem",d.loadButtons(r),e+=`
            <tr>
                <td>${t.specification}</td>
                <td>${t.bidder_specs}</td>
                <td>TBA</td>
                <td>${t.quantity_unit}</td>
                <td>${t.unit_price}</td>
                <td>${t.total_price}</td>
                <td>${r.innerHTML}</td>
            </tr>
        `}),o.length==0&&(e+=`
            <tr>
                <td colspan="7">No Record Found</td>
            </tr>
        `),document.getElementById("quotation_table_body").innerHTML=e,$(".removeItem").on("click",t=>{console.log(t.target.dataset.id),a.items=a.items.filter(r=>r.id!=t.target.dataset.id),n(a.items)}),d.relinitialize()}
