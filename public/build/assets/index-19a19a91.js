import{c as m}from"./login-1e9ef6f5.js";import{T as n}from"./custom_table-ff526490.js";import{C as h}from"./custom_table-3ec5b6ab.js";import{g as r}from"./generate-91682e52.js";import{P as b}from"./validation-858a56d8.js";import"./_commonjsHelpers-725317a4.js";class f{CreateIEPMCValidation(a,e="maintenance_form"){this.form=$(".ui.form."+e).form({fields:{},onSuccess:a})}UpdateIEPMCValidation(a,e="update-maintenance_form"){this.form=$(".ui.form."+e).form({fields:{},onSuccess:a})}fieldsRules(a,e,i=!1){let t={identifier:a,rules:[{type:e}]};return i!=!1&&(t={identifier:a,rules:[{type:e,prompt:i}]}),t}}const u=new f;class k{fetch_by_page(a,e){this.customGetRequest("./api/iepmc",a,e)}fetch_item(a,e,i){this.customGetRequest("./api/iepmc/item/"+a,e,i)}remove(a,e,i){this.customPostRequest("./api/iepmc/remove",{id:a},e,i)}update(a,e,i,t){a.iepmc_id=a.id;const d=new FormData;Object.keys(a).forEach(s=>{d.append(s,a[s])});const c=`iepmc-template-report-${Date.now()}.docx`;d.append("iepmc_file",e,c),this.customPostURequest("./api/iepmc/update",d,i,t)}create(a,e,i,t){const d=new FormData;Object.keys(a).forEach(s=>{d.append(s,s=="items"?JSON.stringify(a[s]):a[s])});const c=`iepmc-template-report-${Date.now()}.docx`;d.append("iepmc_file",e,c),this.customPostURequest("./api/iepmc/create",d,i,t)}customGetRequest(a,e,i=()=>{}){axios.get(a,{headers:{Authorization:`Bearer ${localStorage.getItem("bearer")}`,responseType:"application/json"}}).then(t=>{e(t.data)})}customPostRequest(a,e,i,t=()=>{}){axios.post(a,e,{headers:{"Content-Type":"application/json; charset=utf-8",Accept:"application/vnd.github+json",Authorization:`Bearer ${localStorage.getItem("bearer")}`}}).then(i).catch(t)}customPostURequest(a,e,i,t=()=>{}){axios.post(a,e,{headers:{Authorization:`Bearer ${localStorage.getItem("bearer")}`}}).then(i).catch(t)}}const v=new k;function x(l){let a=l.checkboxes,e={};console.log(l);const i=Array.from({length:26},(c,s)=>String.fromCharCode(97+s)),t=Array.from({length:9},(c,s)=>`a${s+1}`),d=Array.from({length:2},(c,s)=>`b${s+1}`);return Object.keys(a).forEach(c=>{(i.includes(c)||t.includes(c)||d.includes(c))&&(e[c]=a[c]=="✔"?"checked":""),a[c]=a[c]??""}),console.log("Modified",e),`
    <h4 class="ui dividing header">Document Information</h4>
    <div class="two fields">
      <div class="field">
        <label>Document Number</label>
        <input type="text" value="${l.document_number??"N/A"}" name="document_number">
      </div>
      <div class="field">
        <label>Property Number</label>
        <input type="text" name="property_number" value="${l.property_number??"N/A"}">
      </div>
    </div>
    <div class="two fields">
      <div class="field">
        <label>Issued To</label>
        <input type="text" name="issued_to" value="${l.issued_to??"N/A"}">
      </div>
      <div class="field">
        <label>Assigned To</label>
        <input type="text" name="assigned_to" value="${l.assigned_to??"N/A"}">
      </div>
    </div>
    <div class="field">
      <label>Unit Location</label>
      <input type="text" name="unit_location" value="${l.unit_location??"N/A"}">
    </div>
    <h4 class="ui dividing header">Computer Information</h4>
    <div class="two fields">
      <div class="field">
        <label>Computer Name</label>
        <input type="text" name="computer_name" value="${l.computer_name??"N/A"}">
      </div>
      <div class="field">
        <label>Brand / Model</label>
        <input type="text" name="brand_model" value="${l.brand_model??"N/A"}">
      </div>
    </div>
    <div class="three fields">
      <div class="field">
        <label>MAC Address</label>
        <input type="text" name="mac_address" value="${l.mac_address??"N/A"}">
      </div>
      <div class="field">
        <label>Serial Number</label>
        <input type="text" name="serial_number" value="${l.serial_number??"N/A"}">
      </div>
      <div class="field">
        <label>UPS Serial Number</label>
        <input type="text" name="ups_serial_number" value="${l.ups_serial_number??"N/A"}">
      </div>
    </div>
    <h4 class="ui dividing header">Peripherals</h4>
    <div class="three fields">
      <div class="field">
        <label>Monitor Brand / Model</label>
        <input type="text" name="monitor_brand_model" value="${l.monitor_brand_model??"N/A"}">
      </div>
      <div class="field">
        <label>Monitor Serial Number</label>
        <input type="text" name="monitor_serial_number" value="${l.monitor_serial_number??"N/A"}">
      </div>
      <div class="field">
          <label>UPS Brand/Model</label>
          <input type="text" name="ups_brand_model" value="${a.ups_brand_model??"N/A"}">
      </div>
    </div>
    <div class="two fields">
      <div class="field">
        <label>Printer</label>
        <input type="text" name="printer" value="${l.printer??"N/A"}">
      </div>
      <div class="field">
        <label>Printer Serial Number</label>
        <input type="text" name="printer_serial_number" value="${l.printer_serial_number??"N/A"}">
      </div>
    </div>
    <h4 class="ui dividing header">Maintenance</h4>
    <div class="three fields">
      <div class="field">
        <label>Date Last Maintenance</label>
        <input type="date" name="date_last_maintenance" value="${l.date_last_maintenance??"N/A"}">
      </div>
      <div class="field">
        <label>Date Maintenance</label>
        <input type="date" name="date_maintenance" value="${l.date_maintenance??"N/A"}">
      </div>
      <div class="field">
        <label>Inspected By</label>
        <input type="text" name="inspected_by" value="${l.inspected_by??"N/A"}">
      </div>
    </div>
    <h3 class="ui dividing header">General Maintenance</h3>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="a" ${e.a}>
          <label>Update Operating System</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="b" ${e.b}>
          <label>Delete browser history and cache files</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="c" ${e.c}>
          <label>Clean out Windows temporary Internet files</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="d" ${e.d}>
          <label>Check for patches and Windows updates</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="e" ${e.e}>
          <label>Configure startup programs</label>
        </div>
      </div>

      <div class="two fields">
        <div class="field">
          <label>Processor</label>
          <input type="text" value="${a.processor}" name="processor">
        </div>
        <div class="field">
          <label>Operating System</label>
          <input type="text" value="${a.operating_system}" name="operating_system">
        </div>
      </div>

      <div class="two fields">
        <div class="field">
          <label>Office Version</label>
          <input type="text" value="${a.office_version}" name="office_version">
        </div>
        <div class="field">
          <label>Primary Internet Browser</label>
          <input type="text" value="${a.primary_browser}" name="primary_browser">
        </div>
      </div>

      <!-- Security Maintenance -->
      <h3 class="ui dividing header">Security Maintenance</h3>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="f" ${e.f}>
          <label>Run anti-malware/anti-virus in the operating system</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="g" ${e.g}>
          <label>Update the anti-virus software as needed</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="h" ${e.h}>
          <label>Confirm that backups are done by users</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="i" ${e.i}>
          <label>Create or update boot disk or emergency repair disk as needed</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="j" ${e.j}>
          <label>Advise users to change passwords</label>
        </div>
      </div>
      <div class="field">
        <label>Anti-Virus</label>
        <input type="text" value="${a.antivirus??"N/A"}" name="antivirus">
      </div>

      <!-- Hardware Maintenance -->
      <h3 class="ui dividing header">Hardware Maintenance</h3>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="k" ${e.k}>
          <label>Inspect computer hardware</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="l" ${e.l}>
          <label>Check monitor for dead pixel</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="m" ${e.m}>
          <label>Check the keyboard and mouse</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="n" ${e.n}>
          <label>Check CPU case</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="o" ${e.o}>
          <label>Check all connections</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="p" ${e.p}>
          <label>Check CPU’s cooling fans if working properly</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="q" ${e.q}>
          <label>Check power supply</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="r" ${e.r}>
          <label>Check power source</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="s" ${e.s}>
          <label>Check RAM if installed correctly</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="t" ${e.t}>
          <label>Check network hardware</label>
        </div>
      </div>
      <div class="field">
        <label>Is the computer damaged or in need of repair?</label>
        <div class="inline fields">
          <div class="field">
            <div class="ui radio checkbox">
              <input type="radio" name="u" value="yes-">
              <label>YES</label>
            </div>
          </div>
          <div class="field">
            <div class="ui radio checkbox">
              <input type="radio" name="u" value="no" ${e.u}>
              <label>NO</label>
            </div>
          </div>
        </div>
        <input type="text" value="" name="damage" placeholder="If yes, describe damage(s)">
      </div>

      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="v" ${e.v}>
          <label>Re-seat all connections while the computer is open</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="w" ${e.w}>
          <label>Clean CD drives and USB Ports</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="x" ${e.x}>
          <label>Clean the keyboard and mouse</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="y" ${e.y}>
          <label>Check printers (test page) and scanners</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="z" ${e.z}>
          <label>Organize the cables</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="a1" ${e.a1}>
          <label>Clean CPU case</label>
        </div>
      </div>
      <div class="two fields">
        <div class="field">
          <label>GPU</label>
          <input type="text" value="${a.gpu??"N/A"}" name="gpu">
        </div>
        <div class="field">
          <label>RAM</label>
          <input type="text" value="${a.ram??"N/A"}" name="ram">
        </div>
      </div>
      <div class="two fields">
        <div class="field">
          <label>Keyboard</label>
          <input type="text" value="${a.keyboard??"N/A"}" name="keyboard">
        </div>
        <div class="field">
          <label>Mouse</label>
          <input type="text" value="${a.mouse??"N/A"}" name="mouse">
        </div>
      </div>
      <div class="field">
        <label>UPS</label>
        <input type="text" value="${a.ups??"N/A"}" name="ups">
      </div>

      <!-- Software Maintenance -->
      <h3 class="ui dividing header">Software Maintenance</h3>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="a2" ${e.a2}>
          <label>Run disk cleanup in the Operating System</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="a3" ${e.a3}>
          <label>Defragment the hard drive in Windows</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="a4" ${e.a4}>
          <label>Empty the recycle bin</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="a5" ${e.a5}>
          <label>Delete .tmp/.tilde files</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="a6" ${e.a6}>
          <label>Delete old .zip files that were already unzipped</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="a7" ${e.a7}>
          <label>Update drivers as needed</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="a8" ${e.a8}>
          <label>Uninstall unnecessary programs</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="a9" ${e.a9}>
          <label>Check hard drive space</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="b1" ${e.b1}>
          <label>Check memory space</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="b2" ${e.b2}>
          <label>Check network connectivity</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="b3" ${e.b3}>
          <label>Reboot the system</label>
        </div>
      </div>
      <div class="field">
        <label>Record Startup Time</label>
          <input type="text" value="${a.startup_time??"N/A"}" name="startup_time" >
      </div>
      <div class="field">
        <label>Storage</label>
        <textarea value="${a.storage??"N/A"}" name="storage" >${a.storage??"N/A"}</textarea>
      </div>
      <div class="field">
      <label>Overall Findings</label>
      <textarea value="${a.overall_findings??"N/A"}" name="overall_findings" >${a.overall_findings??"N/A"}</textarea>
      </div>
`}function y(){return`
    <h4 class="ui dividing header">Document Information</h4>
        <div class="two fields">
          <div class="field">
            <label>Document Number</label>
            <input type="text" value="${"IEPMC-"+new Date().getFullYear()+"-"}" name="document_number" placeholder="IEPMC-XXXX-XXXXX">
          </div>
          <div class="field">
            <label>Property Number</label>
            <input type="text" value="" name="property_number">
          </div>
        </div>
        <div class="two fields">
          <div class="field">
            <label>Issued To</label>
            <input type="text" value="" name="issued_to">
          </div>
          <div class="field">
            <label>Assigned To</label>
            <input type="text" value="" name="assigned_to">
          </div>
        </div>
        <div class="field">
          <label>Unit Location</label>
          <input type="text" value="" name="unit_location">
        </div>
        <h4 class="ui dividing header">Computer Information</h4>
        <div class="two fields">
          <div class="field">
            <label>Computer Name</label>
            <input type="text" value="" name="computer_name">
          </div>
          <div class="field">
            <label>Brand / Model</label>
            <input type="text" value="" name="brand_model">
          </div>
        </div>
        <div class="three fields">
          <div class="field">
            <label>MAC Address</label>
            <input type="text" value="" name="mac_address">
          </div>
          <div class="field">
            <label>Serial Number</label>
            <input type="text" value="" name="serial_number">
          </div>
          <div class="field">
            <label>UPS Serial Number</label>
            <input type="text" value="" name="ups_serial_number">
          </div>
        </div>
        <h4 class="ui dividing header">Peripherals</h4>
        <div class="three fields">
          <div class="field">
            <label>Monitor Brand / Model</label>
            <input type="text" value="" name="monitor_brand_model">
          </div>
          <div class="field">
            <label>Monitor Serial Number</label>
            <input type="text" value="" name="monitor_serial_number">
          </div>
          <div class="field">
            <label>UPS Brand/Model</label>
            <input type="text" value="" name="ups_brand_model">
          </div>
        </div>
        <div class="two fields">
          <div class="field">
            <label>Printer</label>
            <input type="text" value="" name="printer">
          </div>
          <div class="field">
            <label>Printer Serial Number</label>
            <input type="text" value="" name="printer_serial_number">
          </div>
        </div>
        <h4 class="ui dividing header">Maintenance</h4>
        <div class="three fields">
          <div class="field">
            <label>Date Last Maintenance</label>
            <input type="date" value="" name="date_last_maintenance">
          </div>
          <div class="field">
            <label>Date Maintenance</label>
            <input type="date" value="" name="date_maintenance">
          </div>
          <div class="field">
            <label>Inspected By</label>
            <input type="text" value="${localStorage.getItem("name")}" name="inspected_by">
          </div>
        </div>
        <!-- General Maintenance -->
      <h3 class="ui dividing header">General Maintenance</h3>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="a" checked>
          <label>Update Operating System</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="b">
          <label>Delete browser history and cache files</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="c" checked>
          <label>Clean out Windows temporary Internet files</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="d" checked>
          <label>Check for patches and Windows updates</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="e" checked>
          <label>Configure startup programs</label>
        </div>
      </div>
      <div class="two fields">
        <div class="field">
          <label>Processor</label>
          <input type="text" value="" name="processor">
        </div>
        <div class="field">
          <label>Operating System</label>
          <input type="text" value="" name="operating_system">
        </div>
      </div>
      <div class="two fields">
        <div class="field">
          <label>Office Version</label>
          <input type="text" value="" name="office_version">
        </div>
        <div class="field">
          <label>Primary Internet Browser</label>
          <input type="text" value="" name="primary_browser">
        </div>
      </div>

      <!-- Security Maintenance -->
      <h3 class="ui dividing header">Security Maintenance</h3>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="f" checked>
          <label>Run anti-malware/anti-virus in the operating system</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="g" checked>
          <label>Update the anti-virus software as needed</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="h">
          <label>Confirm that backups are done by users</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="i">
          <label>Create or update boot disk or emergency repair disk as needed</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="j" checked>
          <label>Advise users to change passwords</label>
        </div>
      </div>
      <div class="field">
        <label>Anti-Virus</label>
        <input type="text" value="" name="antivirus">
      </div>

      <!-- Hardware Maintenance -->
      <h3 class="ui dividing header">Hardware Maintenance</h3>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="k" checked>
          <label>Inspect computer hardware</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="l" checked>
          <label>Check monitor for dead pixel</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="m" checked>
          <label>Check the keyboard and mouse</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="n" checked>
          <label>Check CPU case</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="o" checked>
          <label>Check all connections</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="p" checked>
          <label>Check CPU’s cooling fans if working properly</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="q" checked>
          <label>Check power supply</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="r" checked>
          <label>Check power source</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="s" checked>
          <label>Check RAM if installed correctly</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="t" checked>
          <label>Check network hardware</label>
        </div>
      </div>
      <div class="field">
        <label>Is the computer damaged or in need of repair?</label>
        <div class="inline fields">
          <div class="field">
            <div class="ui radio checkbox">
              <input type="radio" name="u" value="yes">
              <label>YES</label>
            </div>
          </div>
          <div class="field">
            <div class="ui radio checkbox">
              <input type="radio" name="u" value="no" checked>
              <label>NO</label>
            </div>
          </div>
        </div>
        <input type="text" value="" name="damage" placeholder="If yes, describe damage(s)">
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="v" checked>
          <label>Re-seat all connections while the computer is open</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="w" checked>
          <label>Clean CD drives and USB Ports</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="x" checked>
          <label>Clean the keyboard and mouse</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="y" checked>
          <label>Check printers (test page) and scanners</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="z" checked>
          <label>Organize the cables</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="a1" checked>
          <label>Clean CPU case</label>
        </div>
      </div>
      <div class="two fields">
        <div class="field">
          <label>GPU</label>
          <input type="text" value="" name="gpu">
        </div>
        <div class="field">
          <label>RAM</label>
          <input type="text" value="" name="ram">
        </div>
      </div>
      <div class="two fields">
        <div class="field">
          <label>Keyboard</label>
          <input type="text" value="" name="keyboard">
        </div>
        <div class="field">
          <label>Mouse</label>
          <input type="text" value="" name="mouse">
        </div>
      </div>
      <div class="field">
        <label>UPS</label>
        <input type="text" value="" name="ups">
      </div>

      <!-- Software Maintenance -->
      <h3 class="ui dividing header">Software Maintenance</h3>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="a2" checked>
          <label>Run disk cleanup in the Operating System</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="a3" checked>
          <label>Defragment the hard drive in Windows</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="a4" checked>
          <label>Empty the recycle bin</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="a5" checked>
          <label>Delete .tmp/.tilde files</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="a6">
          <label>Delete old .zip files that were already unzipped</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="a7" checked>
          <label>Update drivers as needed</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="a8" checked>
          <label>Uninstall unnecessary programs</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="a9" checked>
          <label>Check hard drive space</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="b1" checked>
          <label>Check memory space</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="b2" checked>
          <label>Check network connectivity</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="b3">
          <label>Reboot the system</label>
        </div>
      </div>
      <div class="field">
        <label>Record Startup Time</label>
          <input type="text" name="startup_time" >
      </div>
      <div class="field">
        <label>Storage</label>
        <textarea name="storage" ></textarea>
      </div>
      <div class="field">
      <label>Overall Findings</label>
      <textarea name="overall_findings" ></textarea>
      </div>
    `}let o,p=null;document.addEventListener("DOMContentLoaded",()=>{o=new h("#iepmc-table",!1,!0,!1,!0,"./api/iepmc/page"),u.CreateIEPMCValidation(l=>{l.preventDefault();let a=b.serializeArrayToJson(".maintenance_form");for(let e="a".charCodeAt(0);e<="z".charCodeAt(0);e++){let i=String.fromCharCode(e),t=$('input[name="'+i+'"]');if(i=="a"||i=="b")for(let d=1;d<=9;d++){let c=$('input[name="'+i+d+'"]');console.log(i+d),c.is(":checked")?a[i+d]="✔":a[i+d]=""}t.is(":checked")?a[i]="✔":a[i]=""}r(a,"./iepmc/stream-template",e=>{console.log("Serialize",a),v.create(a,e,()=>{o.table.ajax.reload(),$("#maintenanceModal").modal("hide")})})}),u.UpdateIEPMCValidation(l=>{l.preventDefault();let a=b.serializeArrayToJson(".update-maintenance_form");for(let e="a".charCodeAt(0);e<="z".charCodeAt(0);e++){let i=String.fromCharCode(e),t=$('input[name="'+i+'"]');if(i=="a"||i=="b")for(let d=1;d<=9;d++){let c=$('input[name="'+i+d+'"]');console.log(i+d),c.is(":checked")?a[i+d]="✔":a[i+d]=""}t.is(":checked")?a[i]="✔":a[i]=""}r(a,"./iepmc/stream-template",e=>{a.id=p.id,v.update(a,e,()=>{o.table.ajax.reload(),$("#update-maintenanceModal").modal("hide")})})}),o.custom_buttons=l=>{let a=document.createElement("div");return n.data=l,n.viewName="View",n.viewAction=()=>{window.open("iepmc/office/stream/2025/"+l.id)},n.deleteAction=e=>{m.load(()=>{let i=e.target.dataset.id;v.remove(i,t=>{o.table.ajax.reload()})},"Do you want to delete this file ?")},n.updateAction=e=>{v.fetch_item(l.id,i=>{p=i,document.getElementById("update-maintenance_form").innerHTML=x(i),document.getElementById("maintenance_form").innerHTML="",$("#update-maintenanceModal").modal("show")})},n.loadButtons(a),a},o.load(["document_number","property_number","issued_to","brand_model","mac_address","inspected_by","updated_at"]),$("#create_iepmc_btn").on("click",function(){document.getElementById("maintenance_form").innerHTML=y(),$("#maintenanceModal").modal("show")}),$(".submit_iepmc_btn").on("click",function(){$("#maintenance_form").trigger("submit")}),$(".submit_update_iepmc_btn").on("click",function(){$("#update-maintenance_form").trigger("submit")})});
