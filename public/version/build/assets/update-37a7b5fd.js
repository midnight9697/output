import{M as s}from"./login-dacdc280.js";import{R as i}from"./validation-e9260cf5.js";import{T as d}from"./custom_table-33f673bb.js";import{S as c}from"./supplemental-c1abe652.js";import{S as a,a as u}from"./validation-3bd72878.js";let m=".formCreateSupplementalSpec",l=i.serializeArrayToJson(m);document.addEventListener("DOMContentLoaded",()=>{c.fetchSupplemental(localStorage.getItem("supplemental_id"),function(t){a.items=t.projects,r(t.projects)}),$(".submit_supplemental_form_button").on("click",()=>{$(".formCreateSupplemental").trigger("submit")}),$(".add_item_button").on("click",()=>{$("#modalCreateSupplementalSpec").modal("show")}),$(".add_rfq_item_button").on("click",()=>{$(m).trigger("submit")}),a.CreateSupplementalValidation(t=>{t.preventDefault();let o=i.serializeArrayToJson(".formCreateSupplemental");o.projects=a.items,o.id=localStorage.getItem("supplemental_id"),c.updateSupplemental(o,()=>{s.success("Saved Changes.",()=>{})})}),u.CreateSupplementalProjectValidation(t=>{t.preventDefault(),l=i.serializeArrayToJson(m),l.notice_of_award=l.notice_of_awards,a.items.push(l),s.success("Supplemental Project successfully added."),r(a.items)}),r(a.items)});function r(t){console.log(t);let o="";t.forEach(e=>{let n=document.createElement("div");d.data=e,d.deleteAction=!0,d.deleteClassName="removeItem",d.loadButtons(n),o+=`
            <tr>
                <td>${e.code}</td>
                <td>${e.procurement_project}</td>
                <td>${e.end_user}</td>
                <td>${e.early_procurement==1?"YES":"NO"}</td>
                <td>${e.mode_of_procurement}</td>
                <td>${e.advertisement}</td>
                <td>${e.submission}</td>
                <td>${e.notice_of_awards?e.notice_of_awards:e.notice_of_award}</td>
                <td>${e.contract_signing}</td>
                <td>${e.total}</td>
                <td>${e.mooe}</td>
                <td>${e.co}</td>
            </tr>
        `}),t.length==0&&(o+=`
            <tr>
                <td colspan="12">No Record Found</td>
            </tr>
        `),document.getElementById("projects_table_body").innerHTML=o,$(".removeItem").on("click",e=>{console.log(e.target.dataset.id),a.items=a.items.filter(n=>n.id!=e.target.dataset.id),r(a.items)}),d.relinitialize()}
