class o{constructor(){this.msgEl=document.createElement("div"),this.msgEl.className="ui very tiny modal",this.msgEl.innerHTML=`
            <div class="content">
            </div>
        `,document.getElementsByTagName("body")[0].appendChild(this.msgEl),$(this.msgEl).modal({allowMultiple:!1})}success(e,t=()=>{}){this.buttonY=document.createElement("div"),this.buttonY.className="ui green ok inverted button confirm_warning_action",this.buttonY.onclick=t,this.buttonY.innerHTML=`
            <i class="checkmark icon"></i>
            Yes
        `,this.div=document.createElement("div"),this.div.className="actions",this.div.appendChild(this.buttonY),this.msgEl.innerHTML=`
                <div class="ui icon header">
                    <i class="check green icon"></i>
                    ${e}
                </div>
        `,this.msgEl.appendChild(this.div),$(this.msgEl).modal("show")}fail(e){this.msgEl.innerHTML=`
            <div class="ui icon header">
                <i class="warning red icon"></i>
                ${e}
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
        `,$(this.msgEl).modal("show")}hide(){$(this.msgEl).modal("hide").modal("hide dimmer")}}class i{constructor(e){this.element=document.getElementById(e)}destroy(e){$(e).removeClass("active"),console.log(e)}}new o;new i;document.addEventListener("DOMContentLoaded",()=>{$(".ui .dropdown").dropdown(),$("#logout_user").on("click",()=>{a.logout()})});class n{authenticate(e,t){axios({method:"post",url:"./login/auth",data:e,responseType:"json"}).then(t)}logout(){axios({method:"post",url:"./login/logout",data:{token_id:localStorage.getItem("token_id")},responseType:"json"},{headers:{Authorization:`Bearer ${localStorage.getItem("bearer")}`}}).then(()=>{localStorage.setItem("token_id",null),localStorage.setItem("bearer",null),window.location.reload()})}forgot_password(e,t){axios({method:"post",url:"./api/login/forgot_password",data:{email:t},responseType:"json"}).then(e)}reset_password(e,t){axios({method:"post",url:"./api/login/reset_password",data:{email:localStorage.getItem("email"),password:t},responseType:"json"}).then(e)}}const a=new n;export{a as A};
