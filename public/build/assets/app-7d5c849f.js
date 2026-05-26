import{A as t}from"./login-1e9ef6f5.js";class n{constructor(){this.msgEl=document.createElement("div"),this.msgEl.className="ui very tiny modal",this.msgEl.innerHTML=`
            <div class="content">
            </div>
        `,document.getElementsByTagName("body")[0].appendChild(this.msgEl),$(this.msgEl).modal({allowMultiple:!1})}success(i,e=()=>{}){this.buttonY=document.createElement("div"),this.buttonY.className="ui green ok inverted button confirm_warning_action",this.buttonY.onclick=e,this.buttonY.innerHTML=`
            <i class="checkmark icon"></i>
            Yes
        `,this.div=document.createElement("div"),this.div.className="actions",this.div.appendChild(this.buttonY),this.msgEl.innerHTML=`
                <div class="ui icon header">
                    <i class="check green icon"></i>
                    ${i}
                </div>
        `,this.msgEl.appendChild(this.div),$(this.msgEl).modal("show")}warning(i,e=()=>{}){this.buttonY=document.createElement("div"),this.buttonY.className="ui red ok inverted button confirm_warning_action",this.buttonY.onclick=e,this.buttonY.innerHTML=`
            <i class="checkmark icon"></i>
            Ok
        `,this.div=document.createElement("div"),this.div.className="actions",this.div.appendChild(this.buttonY),this.msgEl.innerHTML=`
                <div class="ui icon header">
                    <i class="warning yellow icon"></i>
                    ${i}
                </div>
        `,this.msgEl.appendChild(this.div),$(this.msgEl).modal("show")}fail(i){this.msgEl.innerHTML=`
            <div class="ui icon header">
                <i class="warning red icon"></i>
                ${i}
            </div>
            <div class="actions">
                <div class="ui red basic cancel inverted button">
                    <i class="remove icon"></i>
                    No
                </div>
                <div class="ui green ok inverted button confirm_warning_action" id="modalSuccessDoneBtn">
                <i class="checkmark icon"></i>
                    Yes
                </div>
            </div>
        `,$(this.msgEl).modal("show")}hide(){$(this.msgEl).modal("hide").modal("hide dimmer")}}class o{constructor(i){this.element=document.getElementById(i)}destroy(i){$(i).removeClass("active")}}new n;new o;document.addEventListener("DOMContentLoaded",()=>{$(".ui .dropdown").dropdown(),$("#logout_user").on("click",()=>{t.logout()})});$(".ui.dropdown").dropdown({onChange:function(s){s&&$(this).closest(".field").addClass("active")}});
