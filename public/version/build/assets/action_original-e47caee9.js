import{B as v,M as h,S as E,h as C}from"./login-2eaeddfa.js";import{u as m}from"./User-18220aaa.js";import{G as y}from"./Validation-8d628f68.js";var f=null;const o=5-1;class r{constructor(){f=this,this.btnCreateFinalize=document.getElementById("createUserFinalize")}getSection(e){let n="";e.forEach(i=>{n+=`
          <option value="${i.id}">${i.section}</option>
        `}),document.getElementById("section").innerHTML=n}createUser(e){e.preventDefault();let n={};if(!y.form.form("is valid"))return 0;$("#formCreateUser :input").prop("readonly",!0),v.start(new r().btnCreateFinalize),$("#formCreateUser").serializeArray().forEach(i=>{n[i.name]=i.value}),m.createUser(n,i=>{v.load(document.getElementById("createUserFinalize"),()=>{new r().failedAction("formCreateUser"),m.getByPage(new r().fetchUsersTable),h.success("User Successfully Created")},"REGISTER USER")},i=>{v.load(document.getElementById("createUserFinalize"),()=>{$("#formCreateUser .message").html(""),$("#formCreateUser :input").prop("readonly",!1),h.fail(i.message)},"REGISTER USER")})}failedAction(e){$("#"+e).form("reset"),$("#"+e+" .message").html(""),$("#"+e+" :input").prop("readonly",!1)}createUserAction(){var e=new r;E.getSection($("#division").val(),e.getSection),$("#modalCreate").modal("show")}sectionGetAction(e){var n=new r;E.getSection(e.target.value,n.getSection)}fetchUsers(e){e=e.data,console.log(e);let n="";e.forEach(i=>{n+=`
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
        `}),usersElement.innerHTML=n}fetchUsersTable(e){const n=document.getElementsByClassName("users_content")[0];var i=[];let a=e;e=e.data,console.log(e);let u="";e.forEach(t=>{i.push({title:t.profile.firstname+" "+(t.profile.middlename=="waived"?"":t.profile.middlename.charAt(0).toUpperCase()+".")+" "+t.profile.lastname}),u+=`
          <tr>
            <td>
              <h4 class="ui image header">
                <img src="files/images/square-image.png" class="ui mini rounded image">
                <div class="content">
                  ${t.profile.firstname+" "+(t.profile.middlename=="waived"?"":t.profile.middlename.charAt(0).toUpperCase()+".")+" "+t.profile.lastname}
                  <div class="sub header">
                    ${t.profile.position}
                  </div>
                </div>
              </h4>
            </td>
            <td>
              ${t.profile.division.division}
            </td>
            <td>
              ${t.profile.section.section}
            </td>
            <td>
              ${C.humanDate(t.created_at,"s")}
            </td>
            <td>
              <a href="./users/${t.id}/edit" class="ui button positive tiny user-update-button" data-userid="${t.id}">UPDATE</a>
            </td>
          </tr>
        `});let p=document.createElement("a");p.className=`icon item ${a.current_page==1?"":"prev-page"}`,p.innerHTML='<i class="left chevron icon"></i>',p.onclick=function(t){if(a.current_page==1)return 0;m.getByPage(l=>{f.fetchUsersTable(l)},a.current_page-1)};let g=document.createElement("a");g.className=`icon item ${a.current_page==a.last_page?"":"next-page"}`,g.innerHTML='<i class="right chevron icon"></i>',g.onclick=function(t){if(a.current_page==a.last_page)return 0;m.getByPage(l=>{f.fetchUsersTable(l)},a.current_page+1)};let c=document.createElement("div");c.className="ui right floated pagination menu",c.appendChild(p);let d=a.last_page>=o?o:a.last_page,s=a.last_page>=o?a.current_page:1;console.log("Start - Max: ",s,d),s+o<a.last_page?d=s+o:(d=s+(a.last_page-s),s=s-(o+s-a.last_page)),console.log("Start - Max: ",s,d);for(let t=s;t<=d;t++){let l=document.createElement("a");l.className=`${a.current_page==t?"active":""} item`,l.innerHTML=t,l.onclick=function(){m.getByPage(U=>{f.fetchUsersTable(U)},t)},c.appendChild(l)}c.appendChild(g),document.getElementById("page_content").innerHTML="",document.getElementById("page_content").appendChild(c),n.innerHTML=u}}new r;
