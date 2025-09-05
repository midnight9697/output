import{P as d}from"./purchase_request-654254a2.js";import{P as t,a as l}from"./validation-a1bd98b3.js";document.addEventListener("DOMContentLoaded",()=>{$(".add_item_btn").on("click",()=>{$("#modalCreaeItem").modal("show")}),$(".submit_item_to_list").on("click",()=>{$("#formCreatePRItem").trigger("submit")}),t.CreatePRValidation(a=>{a.preventDefault(),d.creatPR(t.serializeArrayToJson(".createpr"),t.items,o=>{window.location.reload(!0)})}),l.CreatePRItemValidation(a=>{a.preventDefault(),$("#modalCreaeItem").modal("hide"),t.items.push(t.serializeArrayToJson(".formCreatePRItem")),i()}),i()});function i(){let a=$(".table-pr-items"),o="",r="";t.items.forEach(e=>{r+=`
            <tr>
                <td>${e.property_number}</td>
                <td>${e.unit}</td>
                <td>${e.item_description}</td>
                <td>${e.quantity}</td>
                <td>${e.unit_cost}</td>
                <td>${e.total_cost}</td>
            </tr>
        `}),o=`
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
                ${t.items.length==0?`
                    <tr>
                        <td style="text-align:center" colspan="6">No Item Found</td>
                    </tr>
                `:r}
            </tbody>
        </table>
    `,a.html(o)}
