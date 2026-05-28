class n{fetch_by_page(e,t){this.customGetRequest("./eia_corner/ps-data",e,t)}insert(e,t,o){this.customPostURequest("./eia_corner/scoping/insert",e,t,o)}update(e,t,o){this.customPostURequest("./eia_corner/scoping/update",e,t,o)}remove(e,t,o){this.customPostURequest("./eia_corner/scoping/remove",{id:e},t,o)}customGetRequest(e,t,o=()=>{}){axios.get(e,{headers:{Authorization:`Bearer ${localStorage.getItem("bearer")}`,responseType:"application/json"}}).then(a=>{t(a.data)})}customPostRequest(e,t,o,a=()=>{}){axios.post(e,t,{headers:{"Content-Type":"application/json; charset=utf-8",Accept:"application/vnd.github+json",Authorization:`Bearer ${localStorage.getItem("bearer")}`}}).then(o).catch(a)}customPostURequest(e,t,o,a=()=>{}){axios.post(e,t,{headers:{Authorization:`Bearer ${localStorage.getItem("bearer")}`}}).then(o).catch(a)}}class r{fetch_by_page(e,t){this.customGetRequest("./eia_corner/hearing/ps-data",e,t)}insert(e,t,o){this.customPostURequest("./eia_corner/hearing/insert",e,t,o)}update(e,t,o){this.customPostURequest("./eia_corner/hearing/update",e,t,o)}remove(e,t,o){this.customPostURequest("./eia_corner/hearing/remove",{id:e},t,o)}customGetRequest(e,t,o=()=>{}){axios.get(e,{headers:{Authorization:`Bearer ${localStorage.getItem("bearer")}`,responseType:"application/json"}}).then(a=>{t(a.data)})}customPostRequest(e,t,o,a=()=>{}){axios.post(e,t,{headers:{"Content-Type":"application/json; charset=utf-8",Accept:"application/vnd.github+json",Authorization:`Bearer ${localStorage.getItem("bearer")}`}}).then(o).catch(a)}customPostURequest(e,t,o,a=()=>{}){axios.post(e,t,{headers:{Authorization:`Bearer ${localStorage.getItem("bearer")}`}}).then(o).catch(a)}}const l=new n,c=new r;function p(i){return`
    <div class="field">
      <label>Tentative Date and Time</label>
      <input 
        type="text" 
        name="tentative_date_and_time"
        placeholder="Select date and time"
        value="${i.tentative_date_and_time}"
    >
    </div>

    <div class="field">
      <label>Public Scoping Location</label>
      <input 
        type="text" 
        name="public_scoping_location"
        placeholder="Enter public scoping location"
        value="${i.public_scoping_location}"
      >
    </div>

    <div class="field">
      <label>Project Name</label>
      <input 
        type="text" 
        name="project_name"
        placeholder="Enter project name"
        value="${i.project_name}"
      >
    </div>

    <div class="field">
      <label>Project Proponent</label>
      <input 
        type="text" 
        name="project_proponent"
        placeholder="Enter project proponent"
        value="${i.project_proponent}"
      >
    </div>

    <div class="field">
      <label>Project Location</label>
      <textarea 
        name="project_location"
        placeholder="Enter project location"
      >${i.project_location}</textarea>
    </div>

    <!-- Long URL Field -->
    <div class="field">
      <label>Project Description Link</label>
      <textarea 
        rows="3"
        name="project_description"
        placeholder="Paste the project description link here"
      >${i.project_description}</textarea>
    </div>
    `}const d=i=>`
  <div class="field">
    <label>Tentative Date and Time</label>
    <input 
      type="text" 
      name="tentative_date_and_time"
      placeholder="Select date and time"
      value="${i.tentative_date_and_time}"
  >
  </div>

  <div class="field">
    <label>Public Scoping Location</label>
    <input 
      type="text" 
      name="public_hearing_location"
      placeholder="Enter public hearing location"
      value="${i.public_hearing_location}"
    >
  </div>

  <div class="field">
    <label>Project Name</label>
    <input 
      type="text" 
      name="project_name"
      placeholder="Enter project name"
      value="${i.project_name}"
    >
  </div>

  <div class="field">
    <label>Project Proponent</label>
    <input 
      type="text" 
      name="project_proponent"
      placeholder="Enter project proponent"
      value="${i.project_proponent}"
    >
  </div>

  <div class="field">
    <label>Project Location</label>
    <textarea 
      name="project_location"
      placeholder="Enter project location"
    >${i.project_location}</textarea>
  </div>

  <!-- Long URL Field -->
  <div class="field">
    <label>Project Description Link</label>
    <textarea 
      rows="3"
      name="project_description"
      placeholder="Paste the project description link here"
    >${i.project_description}</textarea>
  </div>
  `;class s{CreatePSValidation(e,t="insert-form"){this.form=$(".ui.form."+t).form({fields:{tentative_date_and_time:this.fieldsRules("tentative_date_and_time","empty"),public_scoping_location:this.fieldsRules("public_scoping_location","empty"),project_name:this.fieldsRules("project_name","empty"),project_proponent:this.fieldsRules("project_proponent","empty"),project_location:this.fieldsRules("project_location","empty"),project_description:this.fieldsRules("project_description","empty")},onSuccess:e})}UpdatePSValidation(e,t="update-form"){this.form=$(".ui.form."+t).form({fields:{tentative_date_and_time:this.fieldsRules("tentative_date_and_time","empty"),public_scoping_location:this.fieldsRules("public_scoping_location","empty"),project_name:this.fieldsRules("project_name","empty"),project_proponent:this.fieldsRules("project_proponent","empty"),project_location:this.fieldsRules("project_location","empty"),project_description:this.fieldsRules("project_description","empty")},onSuccess:e})}CreatePHValidation(e,t="insert-ph-form"){this.form=$(".ui.form."+t).form({fields:{tentative_date_and_time:this.fieldsRules("tentative_date_and_time","empty"),public_hearing_location:this.fieldsRules("public_hearing_location","empty"),project_name:this.fieldsRules("project_name","empty"),project_proponent:this.fieldsRules("project_proponent","empty"),project_location:this.fieldsRules("project_location","empty"),project_description:this.fieldsRules("project_description","empty")},onSuccess:e})}UpdatePHValidation(e,t="insert-ph-form"){this.form=$(".ui.form."+t).form({fields:{tentative_date_and_time:this.fieldsRules("tentative_date_and_time","empty"),public_hearing_location:this.fieldsRules("public_hearing_location","empty"),project_name:this.fieldsRules("project_name","empty"),project_proponent:this.fieldsRules("project_proponent","empty"),project_location:this.fieldsRules("project_location","empty"),project_description:this.fieldsRules("project_description","empty")},onSuccess:e})}fieldsRules(e,t,o=!1){let a={identifier:e,rules:[{type:t}]};return o!=!1&&(a={identifier:e,rules:[{type:t,prompt:o}]}),a}}const _=new s;export{_ as P,p as a,c as h,l as s,d as u};
