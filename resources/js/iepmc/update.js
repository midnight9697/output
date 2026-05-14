export function updateIEPMCForm(item) {
  let checkboxes = item.checkboxes;
  let mdcbs = {}; //Modified Checkboxes
  console.log(item);
  const alphabet = Array.from({ length: 26 }, (_element, index) => String.fromCharCode(97 + index));
  const arra = Array.from({ length: 9 }, (_, i) => `a${i + 1}`);
  const arrb = Array.from({ length: 2 }, (_, i) => `b${i + 1}`);
  Object.keys(checkboxes).forEach(key => {
    if (alphabet.includes(key) || arra.includes(key) || arrb.includes(key)) {
      mdcbs[key] = (checkboxes[key] == "✔"?"checked":"");
    }
    checkboxes[key] = (checkboxes[key] ?? '');
  });

  console.log('Modified', mdcbs);
  return `
    <h4 class="ui dividing header">Document Information</h4>
    <div class="two fields">
      <div class="field">
        <label>Document Number</label>
        <input type="text" value="${item.document_number??'N/A'}" name="document_number" placeholder="IEPMC-XXXX-XXXXX">
      </div>
      <div class="field">
        <label>Property Number</label>
        <input type="text" name="property_number" value="${item.property_number??'N/A'}">
      </div>
    </div>
    <div class="two fields">
      <div class="field">
        <label>Issued To</label>
        <input type="text" name="issued_to" value="${item.issued_to??'N/A'}">
      </div>
      <div class="field">
        <label>Assigned To</label>
        <input type="text" name="assigned_to" value="${item.assigned_to??'N/A'}">
      </div>
    </div>
    <div class="field">
      <label>Unit Location</label>
      <input type="text" name="unit_location" value="${item.unit_location??'N/A'}">
    </div>
    <h4 class="ui dividing header">Computer Information</h4>
    <div class="two fields">
      <div class="field">
        <label>Computer Name</label>
        <input type="text" name="computer_name" value="${item.computer_name??'N/A'}">
      </div>
      <div class="field">
        <label>Brand / Model</label>
        <input type="text" name="brand_model" value="${item.brand_model??'N/A'}">
      </div>
    </div>
    <div class="three fields">
      <div class="field">
        <label>MAC Address</label>
        <input type="text" name="mac_address" value="${item.mac_address??'N/A'}">
      </div>
      <div class="field">
        <label>Serial Number</label>
        <input type="text" name="serial_number" value="${item.serial_number??'N/A'}">
      </div>
      <div class="field">
        <label>UPS Serial Number</label>
        <input type="text" name="ups_serial_number" value="${item.ups_serial_number??'N/A'}">
      </div>
    </div>
    <h4 class="ui dividing header">Peripherals</h4>
    <div class="three fields">
      <div class="field">
        <label>Monitor Brand / Model</label>
        <input type="text" name="monitor_brand_model" value="${item.monitor_brand_model??'N/A'}">
      </div>
      <div class="field">
        <label>Monitor Serial Number</label>
        <input type="text" name="monitor_serial_number" value="${item.monitor_serial_number??'N/A'}">
      </div>
      <div class="field">
          <label>UPS Brand/Model</label>
          <input type="text" name="ups_brand_model" value="${checkboxes.ups_brand_model??'N/A'}">
      </div>
    </div>
    <div class="two fields">
      <div class="field">
        <label>Printer</label>
        <input type="text" name="printer" value="${item.printer??'N/A'}">
      </div>
      <div class="field">
        <label>Printer Serial Number</label>
        <input type="text" name="printer_serial_number" value="${item.printer_serial_number??'N/A'}">
      </div>
    </div>
    <h4 class="ui dividing header">Maintenance</h4>
    <div class="three fields">
      <div class="field">
        <label>Date Last Maintenance</label>
        <input type="date" name="date_last_maintenance" value="${item.date_last_maintenance??'N/A'}">
      </div>
      <div class="field">
        <label>Date Maintenance</label>
        <input type="date" name="date_maintenance" value="${item.date_maintenance??'N/A'}">
      </div>
      <div class="field">
        <label>Inspected By</label>
        <input type="text" name="inspected_by" value="${item.inspected_by??'N/A'}">
      </div>
    </div>
    <h3 class="ui dividing header">General Maintenance</h3>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="a" ${mdcbs.a}>
          <label>Update Operating System</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="b" ${mdcbs.b}>
          <label>Delete browser history and cache files</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="c" ${mdcbs.c}>
          <label>Clean out Windows temporary Internet files</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="d" ${mdcbs.d}>
          <label>Check for patches and Windows updates</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="e" ${mdcbs.e}>
          <label>Configure startup programs</label>
        </div>
      </div>

      <div class="two fields">
        <div class="field">
          <label>Processor</label>
          <input type="text" value="${checkboxes.processor}" name="processor">
        </div>
        <div class="field">
          <label>Operating System</label>
          <input type="text" value="${checkboxes.operating_system}" name="operating_system">
        </div>
      </div>

      <div class="two fields">
        <div class="field">
          <label>Office Version</label>
          <input type="text" value="${checkboxes.office_version}" name="office_version">
        </div>
        <div class="field">
          <label>Primary Internet Browser</label>
          <input type="text" value="${checkboxes.primary_browser}" name="primary_browser">
        </div>
      </div>

      <!-- Security Maintenance -->
      <h3 class="ui dividing header">Security Maintenance</h3>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="f" ${mdcbs.f}>
          <label>Run anti-malware/anti-virus in the operating system</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="g" ${mdcbs.g}>
          <label>Update the anti-virus software as needed</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="h" ${mdcbs.h}>
          <label>Confirm that backups are done by users</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="i" ${mdcbs.i}>
          <label>Create or update boot disk or emergency repair disk as needed</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="j" ${mdcbs.j}>
          <label>Advise users to change passwords</label>
        </div>
      </div>
      <div class="field">
        <label>Anti-Virus</label>
        <input type="text" value="${checkboxes.antivirus??'N/A'}" name="antivirus">
      </div>

      <!-- Hardware Maintenance -->
      <h3 class="ui dividing header">Hardware Maintenance</h3>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="k" ${mdcbs.k}>
          <label>Inspect computer hardware</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="l" ${mdcbs.l}>
          <label>Check monitor for dead pixel</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="m" ${mdcbs.m}>
          <label>Check the keyboard and mouse</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="n" ${mdcbs.n}>
          <label>Check CPU case</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="o" ${mdcbs.o}>
          <label>Check all connections</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="p" ${mdcbs.p}>
          <label>Check CPU’s cooling fans if working properly</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="q" ${mdcbs.q}>
          <label>Check power supply</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="r" ${mdcbs.r}>
          <label>Check power source</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="s" ${mdcbs.s}>
          <label>Check RAM if installed correctly</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="t" ${mdcbs.t}>
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
              <input type="radio" name="u" value="no" ${mdcbs.u}>
              <label>NO</label>
            </div>
          </div>
        </div>
        <input type="text" value="" name="damage" placeholder="If yes, describe damage(s)">
      </div>

      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="v" ${mdcbs.v}>
          <label>Re-seat all connections while the computer is open</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="w" ${mdcbs.w}>
          <label>Clean CD drives and USB Ports</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="x" ${mdcbs.x}>
          <label>Clean the keyboard and mouse</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="y" ${mdcbs.y}>
          <label>Check printers (test page) and scanners</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="z" ${mdcbs.z}>
          <label>Organize the cables</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="a1" ${mdcbs.a1}>
          <label>Clean CPU case</label>
        </div>
      </div>
      <div class="two fields">
        <div class="field">
          <label>GPU</label>
          <input type="text" value="${checkboxes.gpu??'N/A'}" name="gpu">
        </div>
        <div class="field">
          <label>RAM</label>
          <input type="text" value="${checkboxes.ram??'N/A'}" name="ram">
        </div>
      </div>
      <div class="two fields">
        <div class="field">
          <label>Keyboard</label>
          <input type="text" value="${checkboxes.keyboard??'N/A'}" name="keyboard">
        </div>
        <div class="field">
          <label>Mouse</label>
          <input type="text" value="${checkboxes.mouse??'N/A'}" name="mouse">
        </div>
      </div>
      <div class="field">
        <label>UPS</label>
        <input type="text" value="${checkboxes.ups??'N/A'}" name="ups">
      </div>

      <!-- Software Maintenance -->
      <h3 class="ui dividing header">Software Maintenance</h3>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="a2" ${mdcbs.a2}>
          <label>Run disk cleanup in the Operating System</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="a3" ${mdcbs.a3}>
          <label>Defragment the hard drive in Windows</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="a4" ${mdcbs.a4}>
          <label>Empty the recycle bin</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="a5" ${mdcbs.a5}>
          <label>Delete .tmp/.tilde files</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="a6" ${mdcbs.a6}>
          <label>Delete old .zip files that were already unzipped</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="a7" ${mdcbs.a7}>
          <label>Update drivers as needed</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="a8" ${mdcbs.a8}>
          <label>Uninstall unnecessary programs</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="a9" ${mdcbs.a9}>
          <label>Check hard drive space</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="b1" ${mdcbs.b1}>
          <label>Check memory space</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="b2" ${mdcbs.b2}>
          <label>Check network connectivity</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="b3" ${mdcbs.b3}>
          <label>Reboot the system</label>
        </div>
      </div>
      <div class="field">
        <label>Record Startup Time</label>
          <input type="text" value="${checkboxes.startup_time??'N/A'}" name="startup_time" >
      </div>
      <div class="field">
        <label>Storage</label>
        <textarea value="${checkboxes.storage??'N/A'}" name="storage" >${checkboxes.storage??'N/A'}</textarea>
      </div>
      <div class="field">
      <label>Overall Findings</label>
      <textarea value="${checkboxes.overall_findings??'N/A'}" name="overall_findings" >${checkboxes.overall_findings??'N/A'}</textarea>
      </div>
`;
}