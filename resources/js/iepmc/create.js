export default function createIEPMCForm() {


    return `
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
            <input type="text" value="" name="inspected_by">
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
    `;
}