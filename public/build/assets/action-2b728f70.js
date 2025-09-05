import{B as h,M as v,S as y,h as _}from"./login-5c7dd7c4.js";import{u as E}from"./User-18220aaa.js";const c=5;let u=1,m="current";class C{load(t,e,i,n){let s=document.createElement("a");s.className=`icon item ${e.current_page==1?"":"prev-page"}`,s.innerHTML='<i class="left chevron icon"></i>',s.onclick=function(o){m="prev",e.current_page>1&&g.fetchData(n,e.current_page-1,i)};let a=document.createElement("a");a.className=`icon item ${e.current_page==e.last_page?"":"next-page"}`,a.innerHTML='<i class="right chevron icon"></i>',a.onclick=function(o){m="next",e.current_page<e.last_page&&g.fetchData(n,e.current_page+1,i)};let d=document.createElement("div");d.className="ui right floated pagination menu",d.appendChild(s);let r=e.last_page<c?e.last_page:u+4;e.current_page%(r+1)==0&&m=="next"&&(r+=5,u=e.current_page);let p=e.current_page%(r+1)==0?e.current_page:u;e.current_page%c==0&&m=="prev"&&p>=1&&(p=p-c,r=r-c,u=p),console.log("-->",e.current_page,c,r,c%e.current_page,m);for(let o=p;o<=r;o++){let f=document.createElement("a");f.className=`${e.current_page==o?"active":""} item`,f.innerHTML=o,f.onclick=function(){m="next",g.fetchData(n,o,i)},d.appendChild(f)}d.appendChild(a),t.innerHTML="",t.appendChild(d)}fetchData(t,e,i){axios.get(t+"?"+(e?"page="+e:""),{headers:{Authorization:`Bearer ${localStorage.getItem("bearer")}`}}).then(function(n){i(n.data)})}}const g=new C;class S{StoreUserValidation(t,e){$.fn.form.settings.rules.checkEmailExists=function(i){return t.filter(n=>n.email==i).length==0},this.form=$(".ui.form").form({fields:{firstname:{identifier:"firstname",rules:[{type:"empty"}]},role:{identifier:"role",rules:[{type:"empty"}]},lastname:{identifier:"lastname",rules:[{type:"empty"}]},email:{identifier:"email",rules:[{type:"checkEmailExists",prompt:"Email already used."},{type:"email",prompt:"Please enter valid email email."},{type:"empty"}]},position:{identifier:"position",rules:[{type:"empty"}]},division:{identifier:"division",rules:[{type:"empty"}]},section:{identifier:"section",rules:[{type:"empty"}]},password:{identifier:"password",rules:[{type:"empty"},{type:"minLength[6]"},{type:"match[password_confirmation]",prompt:"Password does not match"}]},password_confirmation:{identifier:"password",rules:[{type:"empty"},{type:"match[password]",prompt:"Password does not match"}]}},onSuccess:e})}UpdateUserValidation(t,e){$.fn.form.settings.rules.checkEmailExists=function(i){return t.filter(n=>n.email==i&&localStorage.getItem("user")!=n.id).length==0},this.form=$(".ui.form").form({fields:{firstname:{identifier:"firstname",rules:[{type:"empty"}]},role:{identifier:"role",rules:[{type:"empty"}]},lastname:{identifier:"lastname",rules:[{type:"empty"}]},email:{identifier:"email",rules:[{type:"checkEmailExists",prompt:"Email already used."},{type:"email",prompt:"Please enter valid email email."},{type:"empty"}]},position:{identifier:"position",rules:[{type:"empty"}]},division:{identifier:"division",rules:[{type:"empty"}]},section:{identifier:"section",rules:[{type:"empty"}]},password:{identifier:"password",rules:[{type:"match[password_confirmation]",prompt:"Password does not match"}]},password_confirmation:{identifier:"password",rules:[{type:"match[password]",prompt:"Password does not match"}]}},onSuccess:e})}}const x=new S;var w=null;class l{constructor(){w=this,this.btnCreateFinalize=document.getElementById("createUserFinalize")}getSection(t){let e="";t.forEach(i=>{e+=`
          <option value="${i.id}">${i.section}</option>
        `}),document.getElementById("section").innerHTML=e}createUser(t){t.preventDefault();let e={};if(!x.form.form("is valid"))return 0;$("#formCreateUser :input").prop("readonly",!0),h.start(new l().btnCreateFinalize),$("#formCreateUser").serializeArray().forEach(i=>{e[i.name]=i.value}),E.createUser(e,i=>{h.load(document.getElementById("createUserFinalize"),()=>{new l().failedAction("formCreateUser"),E.getByPage(new l().fetchUsersTable),v.success("User Successfully Created")},"REGISTER USER")},i=>{h.load(document.getElementById("createUserFinalize"),()=>{$("#formCreateUser .message").html(""),$("#formCreateUser :input").prop("readonly",!1),v.fail(i.message)},"REGISTER USER")})}failedAction(t){$("#"+t).form("reset"),$("#"+t+" .message").html(""),$("#"+t+" :input").prop("readonly",!1)}createUserAction(){var t=new l;y.getSection($("#division").val(),t.getSection),$("#modalCreate").modal("show")}sectionGetAction(t){var e=new l;y.getSection(t.target.value,e.getSection)}fetchUsers(t){t=t.data,console.log(t);let e="";t.forEach(i=>{e+=`
          <div class="two wide computer eight wide tablet sixteen wide mobile column">
              <div class="ui card">
                  <div class="ui slide masked reveal image">
                      <div class="ui fade reveal">
                          <div class="visible content">
                              <img src="files/images/square-image.png" class="visible content">
                          </div>
                          <div class="hidden content">
                              <img src="files/images/middle.avif" class="visible content">
                          </div>
                      </div>
                  </div>
                  <div class="content">
                      <a class="header truncate">${i.profile.firstname+" "+i.profile.middlename.charAt(0).toUpperCase()+". "+i.profile.lastname}</a>
                      <div class="meta">
                        <span class="description truncate">${i.profile.position}</span>
                      </div>
                  </div>
              </div>
          </div>
        `}),usersElement.innerHTML=e}fetchUsersTable(t){const e=document.getElementsByClassName("users_content")[0];var i=[];let n=t;t=t.data;let s="";t.forEach(a=>{i.push({title:a.profile.firstname+" "+(a.profile.middlename=="waived"?"":a.profile.middlename.charAt(0).toUpperCase()+".")+" "+a.profile.lastname}),s+=`
          <tr>
            <td>
              <h4 class="ui image header">
                <img src="files/images/square-image.png" class="ui mini rounded image">
                <div class="content">
                  ${a.profile.firstname+" "+(a.profile.middlename=="waived"?"":a.profile.middlename.charAt(0).toUpperCase()+".")+" "+a.profile.lastname}
                  <div class="sub header">
                    ${a.profile.position}
                  </div>
                </div>
              </h4>
            </td>
            <td>
              ${a.profile.division.division}
            </td>
            <td>
              ${a.profile.section.section}
            </td>
            <td>
              ${_.humanDate(a.created_at,"s")}
            </td>
            <td>
              <a href="./users/${a.id}/edit" class="ui button positive tiny user-update-button" data-userid="${a.id}">UPDATE</a>
            </td>
          </tr>
        `}),g.load(document.getElementById("page_content"),n,w.fetchUsersTable,"./api/users/getpage"),e.innerHTML=s}}const P=new l;export{x as G,P as U};
