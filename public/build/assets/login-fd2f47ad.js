class d{getSection(e=!1,s){axios.post("./system/sections",{division_id:e}).then(function(a){s(a.data)})}}class c{constructor(){this.msgEl=document.createElement("div"),this.msgEl.className="ui very tiny modal",this.msgEl.innerHTML=`
            <div class="content">
            </div>
        `,document.getElementsByTagName("body")[0].appendChild(this.msgEl),$(this.msgEl).modal({allowMultiple:!1})}success(e,s=()=>{}){this.buttonY=document.createElement("div"),this.buttonY.className="ui green ok inverted button confirm_warning_action",this.buttonY.onclick=s,this.buttonY.innerHTML=`
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
        `,$(this.msgEl).modal("show")}hide(){$(this.msgEl).modal("hide").modal("hide dimmer")}}class h{constructor(){this.counter=null,this.defbtn="",this.ldbtn=`
          <i class="loading spinner icon"></i>
            Please wait
        `}start(e){this.defbtn=e,e.disabled=!0,e.innerHTML='<i class="loading spinner icon"></i> Please wait...'}load(e=!1,s,a=!1){let t=b;e.innerHTML=a||t.defbtn,e.disabled=!1,s()}}class m{constructor(){this.date=new Date,this.month=["January","February","March","April","May","June","July","August","September","October","November","December"],this.smonth=["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sept","Oct","Nov","Dec"]}humanDate(e=new Date,s="s"){return this.cdate=new Date(e),(s=="s"?this.smonth[this.cdate.getMonth()]:this.month[this.cdate.getMonth()])+" "+String(this.cdate.getDate()).padStart("2","0")+", "+this.cdate.getFullYear()}}class u{load(e,s=!1){const a=`
            <div class="ui small icon header">
                <i class="warning small tiny yellow icon"></i>
                Confirm Action
            </div>
            <div class="content">
                <h5>${s||"Are you sure you want to proceed with this action?"}</h5>
            </div>
            <div class="actions">
                <div class="ui red basic cancel button">
                    <i class="remove icon"></i>
                    No
                </div>
                <div class="ui green ok button confirm_warning_action">
                <i class="checkmark icon"></i>
                    Yes
                </div>
            </div>
        `;this.modal=document.createElement("div"),this.modal.className="ui very tiny modal",this.modal.innerHTML=a;let t=this;document.getElementById("main_event").appendChild(this.modal),$(this.modal).modal({allowMultiple:!1}),$(this.modal).modal("show"),$(".confirm_warning_action").on("click",o=>{$(t.modal).modal("hide").modal("hide dimmer"),t.modal.remove(),e(o)})}}class p{constructor(e){this.element=document.getElementById(e)}destroy(e){$(e).removeClass("active"),console.log(e)}}class g{constructor(){this.progress_bar=null,this.valid=!1}make(e){console.log("Elemnt",e),this.parent=document.querySelector("#"+e),this.parent.innerHTML="",this.ui_progress=document.createElement("div"),this.bar=document.createElement("div"),this.label=document.createElement("div"),this.ui_progress.className="ui indicating progress",this.bar.className="bar",this.label.className="label",this.label.innerHTML="Uploading Files",this.ui_progress.appendChild(this.bar),this.ui_progress.appendChild(this.label),$(this.ui_progress).progress({label:"ratio",text:"Uploading Files"}),this.valid=!1}progress(e,s=!1){this.valid==!1&&(this.valid=!0,this.parent.appendChild(this.ui_progress)),$(this.ui_progress).progress("set progress",e),this.label.innerHTML=(s=s+" ")+e+"% Completed"}success(){$(this.ui_progress).progress("set success","100% Upload Complete")}fail(){this.parent.innerHTML=`
            <div class="ui progress error">
                <div class="bar">
                    <div class="progress"></div>
                </div>
                <div class="label">There was an error.</div>
            </div>
        `}}class v{upload(e,s,a=()=>{},t,o=()=>{}){let l=s;axios.post(e,l,{headers:{Authorization:`Bearer ${localStorage.getItem("bearer")}`},onUploadProgress:n=>{const r=Math.round(n.loaded*100/n.total);t(r)}}).then(a).catch(o)}}function M(i="",e="",s="div",a=()=>{}){let t=document.createElement(s);return t.className=i,t.innerText=e,t.onclick=a,t}const _=new d,y=new c,b=new h,E=new m,k=new u,T=new p,C=new g,L=new v;document.addEventListener("DOMContentLoaded",()=>{$(".ui .dropdown").dropdown(),$("#logout_user").on("click",()=>{f.logout()})});class w{authenticate(e,s){axios({method:"post",url:"./login/auth",data:e,responseType:"json"}).then(s)}logout(){axios({method:"post",url:"./login/logout",data:{token_id:localStorage.getItem("token_id")},responseType:"json"},{headers:{Authorization:`Bearer ${localStorage.getItem("bearer")}`}}).then(()=>{localStorage.setItem("token_id",null),localStorage.setItem("bearer",null),window.location.reload()})}forgot_password(e,s){axios({method:"post",url:"./api/login/forgot_password",data:{email:s},responseType:"json"}).then(e)}reset_password(e,s){axios({method:"post",url:"./api/login/reset_password",data:{email:localStorage.getItem("email"),password:s},responseType:"json"}).then(e)}}const f=new w;export{f as A,b as B,y as M,_ as S,M as a,p as b,k as c,C as d,E as h,T as p,L as u};
