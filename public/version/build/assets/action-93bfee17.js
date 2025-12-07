import{B as n,M as r,S as l,h as p}from"./login-dacdc280.js";import{p as f}from"./pagination-008a36c2.js";import{u as d}from"./User-18220aaa.js";import{G as v}from"./Validation-8d628f68.js";var c=null;class s{constructor(){c=this,this.btnCreateFinalize=document.getElementById("createUserFinalize")}getSection(e){let i="";e.forEach(t=>{i+=`
          <option value="${t.id}">${t.section}</option>
        `}),document.getElementById("section").innerHTML=i}createUser(e){e.preventDefault();let i={};if(!v.form.form("is valid"))return 0;$("#formCreateUser :input").prop("readonly",!0),n.start(new s().btnCreateFinalize),$("#formCreateUser").serializeArray().forEach(t=>{i[t.name]=t.value}),d.createUser(i,t=>{n.load(document.getElementById("createUserFinalize"),()=>{new s().failedAction("formCreateUser"),d.getByPage(new s().fetchUsersTable),r.success("User Successfully Created")},"REGISTER USER")},t=>{n.load(document.getElementById("createUserFinalize"),()=>{$("#formCreateUser .message").html(""),$("#formCreateUser :input").prop("readonly",!1),r.fail(t.message)},"REGISTER USER")})}failedAction(e){$("#"+e).form("reset"),$("#"+e+" .message").html(""),$("#"+e+" :input").prop("readonly",!1)}createUserAction(){var e=new s;l.getSection($("#division").val(),e.getSection),$("#modalCreate").modal("show")}sectionGetAction(e){var i=new s;l.getSection(e.target.value,i.getSection)}fetchUsers(e){e=e.data,console.log(e);let i="";e.forEach(t=>{i+=`
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
                      <a class="header truncate">${t.profile.firstname+" "+t.profile.middlename.charAt(0).toUpperCase()+". "+t.profile.lastname}</a>
                      <div class="meta">
                        <span class="description truncate">${t.profile.position}</span>
                      </div>
                  </div>
              </div>
          </div>
        `}),usersElement.innerHTML=i}fetchUsersTable(e){const i=document.getElementsByClassName("users_content")[0];var t=[];let m=e;e=e.data;let o="";e.forEach(a=>{t.push({title:a.profile.firstname+" "+(a.profile.middlename=="waived"?"":a.profile.middlename.charAt(0).toUpperCase()+".")+" "+a.profile.lastname}),o+=`
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
              ${p.humanDate(a.created_at,"s")}
            </td>
            <td>
              <a href="./users/${a.id}/edit" class="ui button positive tiny user-update-button" data-userid="${a.id}">UPDATE</a>
            </td>
          </tr>
        `}),f.load(document.getElementById("page_content"),m,c.fetchUsersTable,"./api/users/getpage"),i.innerHTML=o}}const E=new s;export{E as U};
