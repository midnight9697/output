import{P as d}from"./purchase_request-5474f191.js";import{P as a,a as r}from"./validation-444b2c61.js";document.addEventListener("DOMContentLoaded",()=>{$(".total_cost").on("input",()=>{let e=document.getElementsByClassName("total_cost"),t=document.getElementById("total_cost");t.value=e[0].value*e[1].value}),$(".add_item_btn").on("click",()=>{$("#modalCreaeItem").modal("show")}),$(".submit_item_to_list").on("click",()=>{$("#formCreatePRItem").trigger("submit")}),a.CreatePRValidation(e=>{e.preventDefault();let t=a.serializeArrayToJson(".createpr");d.creatPR(t,a.items,l=>{window.location.reload(!0)})}),r.CreatePRItemValidation(e=>{e.preventDefault(),$("#modalCreaeItem").modal("hide");let t=document.getElementById("total_cost");t.hasAttribute("disabled")&&t.removeAttribute("disabled"),a.items.push(a.serializeArrayToJson(".formCreatePRItem")),t.disabled=!0,i()}),i()});function i(){let e=$(".table-pr-items"),t="",l="";a.items.forEach(o=>{l+=`
            <tr>
                <td>${o.property_number}</td>
                <td>${o.unit}</td>
                <td>${o.item_description}</td>
                <td>${o.quantity}</td>
                <td>${o.unit_cost}</td>
                <td>${o.total_cost}</td>
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
                ${a.items.length==0?`
                    <tr>
                        <td style="text-align:center" colspan="6">No Item Found</td>
                    </tr>
                `:l}
            </tbody>
        </table>
    `,e.html(t)}
