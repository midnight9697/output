import{B as n,M as l,S as d,h as m}from"./login-1e9ef6f5.js";import{p}from"./pagination-008a36c2.js";import{u as f}from"./User-18220aaa.js";import{G as v}from"./Validation-8d628f68.js";var c=null;class o{constructor(){c=this,this.btnCreateFinalize=document.getElementById("createUserFinalize")}getSection(e){let i="";e.forEach(a=>{i+=`
          <option value="${a.id}">${a.section}</option>
        `}),document.getElementById("section").innerHTML=i}createUser(e,i){e.preventDefault();let a={};if(!v.form.form("is valid"))return 0;$("#formCreateUser :input").prop("readonly",!0),n.start(new o().btnCreateFinalize),$("#formCreateUser").serializeArray().forEach(s=>{a[s.name]=s.value}),f.createUser(a,s=>{n.load(document.getElementById("createUserFinalize"),()=>{new o().failedAction("formCreateUser"),i.table.ajax.reload(),l.success("User Successfully Created")},"REGISTER USER")},s=>{n.load(document.getElementById("createUserFinalize"),()=>{$("#formCreateUser .message").html(""),$("#formCreateUser :input").prop("readonly",!1),l.fail(s.message)},"REGISTER USER")})}failedAction(e){$("#"+e).form("reset"),$("#"+e+" .message").html(""),$("#"+e+" :input").prop("readonly",!1)}createUserAction(){var e=new o;d.getSection($("#division").val(),e.getSection),$("#modalCreate").modal("show")}sectionGetAction(e){var i=new o;d.getSection(e.target.value,i.getSection)}fetchUsers(e){e=e.data,console.log(e);let i="";e.forEach(a=>{i+=`
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
                      <a class="header truncate">${a.profile.firstname+" "+a.profile.middlename.charAt(0).toUpperCase()+". "+a.profile.lastname}</a>
                      <div class="meta">
                        <span class="description truncate">${a.profile.position}</span>
                      </div>
                  </div>
              </div>
          </div>
        `}),usersElement.innerHTML=i}fetchUsersTable(e){const i=document.getElementsByClassName("users_content")[0];var a=[];let s=e;e=e.data;let r="";e.forEach(t=>{a.push({title:t.profile.firstname+" "+(t.profile.middlename=="waived"?"":t.profile.middlename.charAt(0).toUpperCase()+".")+" "+t.profile.lastname}),r+=`
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
              ${m.humanDate(t.created_at,"s")}
            </td>
            <td>
              <a href="./users/${t.id}/edit" class="ui button positive tiny user-update-button" data-userid="${t.id}">UPDATE</a>
            </td>
          </tr>
        `}),p.load(document.getElementById("page_content"),s,c.fetchUsersTable,"./api/users/getpage"),i.innerHTML=r}}const E=new o;export{E as U};
