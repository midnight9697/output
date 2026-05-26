import{M as s}from"./login-1e9ef6f5.js";import{R as r}from"./validation-e9260cf5.js";import{T as l}from"./custom_table-ff526490.js";import{S as c}from"./supplemental-c1abe652.js";import{S as t,a as u}from"./validation-3bd72878.js";let n=".formCreateSupplementalSpec",i=r.serializeArrayToJson(n);document.addEventListener("DOMContentLoaded",()=>{$(".submit_supplemental_form_button").on("click",()=>{$(".formCreateSupplemental").trigger("submit")}),$(".add_item_button").on("click",()=>{$("#modalCreateSupplementalSpec").modal("show")}),$(".add_rfq_item_button").on("click",()=>{$(n).trigger("submit")}),t.CreateSupplementalValidation(a=>{a.preventDefault();let o=r.serializeArrayToJson(".formCreateSupplemental");o.projects=t.items,c.createSupplemental(o,()=>{s.success("Supplemental successfully created.",()=>{window.location="/supplemental"})})}),u.CreateSupplementalProjectValidation(a=>{a.preventDefault(),i=r.serializeArrayToJson(n),t.items.push(i),s.success("Supplemental Project successfully added."),m(t.items)}),m(t.items)});function m(a){console.log(a);let o="";a.forEach(e=>{let d=document.createElement("div");l.data=e,l.deleteAction=!0,l.deleteClassName="removeItem",l.loadButtons(d),o+=`
            <tr>
                <td>${e.code}</td>
                <td>${e.procurement_project}</td>
                <td>${e.end_user}</td>
                <td>${e.early_procurement==1?"YES":"NO"}</td>
                <td>${e.mode_of_procurement}</td>
                <td>${e.advertisement}</td>
                <td>${e.submission}</td>
                <td>${e.notice_of_awards}</td>
                <td>${e.contract_signing}</td>
                <td>${e.total}</td>
                <td>${e.mooe}</td>
                <td>${e.co}</td>
            </tr>
        `}),a.length==0&&(o+=`
            <tr>
                <td colspan="12">No Record Found</td>
            </tr>
        `),document.getElementById("projects_table_body").innerHTML=o,$(".removeItem").on("click",e=>{console.log(e.target.dataset.id),t.items=t.items.filter(d=>d.id!=e.target.dataset.id),m(t.items)}),l.relinitialize()}
