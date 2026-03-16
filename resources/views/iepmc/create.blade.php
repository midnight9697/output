<div class="ui large modal" id="maintenanceModal">
    <i class="close icon"></i>
    <div class="header">
      Equipment Maintenance Form
    </div>
    <div class="scrolling content">
      <form class="ui form maintenance_form" id="maintenance_form">
        <h4 class="ui dividing header">Document Information</h4>
        <div class="two fields">
          <div class="field">
            <label>Document Number</label>
            <input type="text" name="document_number">
          </div>
          <div class="field">
            <label>Property Number</label>
            <input type="text" name="property_number">
          </div>
        </div>
        <div class="two fields">
          <div class="field">
            <label>Issued To</label>
            <input type="text" name="issued_to">
          </div>
          <div class="field">
            <label>Assigned To</label>
            <input type="text" name="assigned_to">
          </div>
        </div>
        <div class="field">
          <label>Unit Location</label>
          <input type="text" name="unit_location">
        </div>
        <h4 class="ui dividing header">Computer Information</h4>
        <div class="two fields">
          <div class="field">
            <label>Computer Name</label>
            <input type="text" name="computer_name">
          </div>
          <div class="field">
            <label>Brand / Model</label>
            <input type="text" name="brand_model">
          </div>
        </div>
        <div class="three fields">
          <div class="field">
            <label>MAC Address</label>
            <input type="text" name="mac_address">
          </div>
          <div class="field">
            <label>Serial Number</label>
            <input type="text" name="serial_number">
          </div>
          <div class="field">
            <label>UPS Serial Number</label>
            <input type="text" name="ups_serial_number">
          </div>
        </div>
        <h4 class="ui dividing header">Peripherals</h4>
        <div class="two fields">
          <div class="field">
            <label>Monitor Brand / Model</label>
            <input type="text" name="monitor_brand_model">
          </div>
          <div class="field">
            <label>Monitor Serial Number</label>
            <input type="text" name="monitor_serial_number">
          </div>
        </div>
        <div class="two fields">
          <div class="field">
            <label>Printer</label>
            <input type="text" name="printer">
          </div>
          <div class="field">
            <label>Printer Serial Number</label>
            <input type="text" name="printer_serial_number">
          </div>
        </div>
        <h4 class="ui dividing header">Maintenance</h4>
        <div class="three fields">
          <div class="field">
            <label>Date Last Maintenance</label>
            <input type="date" name="date_last_maintenance">
          </div>
          <div class="field">
            <label>Date Maintenance</label>
            <input type="date" name="date_maintenance">
          </div>
          <div class="field">
            <label>Inspected By</label>
            <input type="text" name="inspected_by">
          </div>
        </div>
        <!-- General Maintenance -->
      <h3 class="ui dividing header">General Maintenance</h3>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="cb1" checked>
          <label>Update Operating System</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="cb2">
          <label>Delete browser history and cache files</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="cb3" checked>
          <label>Clean out Windows temporary Internet files</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="cb3A" checked>
          <label>Check for patches and Windows updates</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="cb4" checked>
          <label>Configure startup programs</label>
        </div>
      </div>

      <div class="two fields">
        <div class="field">
          <label>Processor</label>
          <input type="text" value="Intel(R) Core(TM) i7-7700 CPU @ 3.60GHz">
        </div>
        <div class="field">
          <label>Operating System</label>
          <input type="text" value="Windows 10 Home">
        </div>
      </div>

      <div class="two fields">
        <div class="field">
          <label>Office Version</label>
          <input type="text" value="Microsoft Office 2016">
        </div>
        <div class="field">
          <label>Primary Internet Browser</label>
          <input type="text" value="Google Chrome">
        </div>
      </div>

      <!-- Security Maintenance -->
      <h3 class="ui dividing header">Security Maintenance</h3>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="cb5" checked>
          <label>Run anti-malware/anti-virus in the operating system</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="cb6" checked>
          <label>Update the anti-virus software as needed</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="cb7">
          <label>Confirm that backups are done by users</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="cb8">
          <label>Create or update boot disk or emergency repair disk as needed</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="cb9" checked>
          <label>Advise users to change passwords</label>
        </div>
      </div>
      <div class="field">
        <label>Anti-Virus</label>
        <input type="text" value="Seqrite">
      </div>

      <!-- Hardware Maintenance -->
      <h3 class="ui dividing header">Hardware Maintenance</h3>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="cb10" checked>
          <label>Inspect computer hardware</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="cb11" checked>
          <label>Check monitor for dead pixel</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="cb12" checked>
          <label>Check the keyboard and mouse</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="cb13" checked>
          <label>Check CPU case</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="cb14" checked>
          <label>Check all connections</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="cb15" checked>
          <label>Check CPU’s cooling fans if working properly</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="cb16" checked>
          <label>Check power supply</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="cb17" checked>
          <label>Check power source</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="cb18" checked>
          <label>Check RAM if installed correctly</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="cb19" checked>
          <label>Check network hardware</label>
        </div>
      </div>
      <div class="field">
        <label>Is the computer damaged or in need of repair?</label>
        <div class="inline fields">
          <div class="field">
            <div class="ui radio checkbox">
              <input type="radio" name="damage" value="yes">
              <label>YES</label>
            </div>
          </div>
          <div class="field">
            <div class="ui radio checkbox">
              <input type="radio" name="damage" value="no" checked>
              <label>NO</label>
            </div>
          </div>
        </div>
        <input type="text" placeholder="If yes, describe damage(s)">
      </div>

      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="cb20" checked>
          <label>Re-seat all connections while the computer is open</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="cb21" checked>
          <label>Clean CD drives and USB Ports</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="cb22" checked>
          <label>Clean the keyboard and mouse</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="cb23" checked>
          <label>Check printers (test page) and scanners</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="cb24" checked>
          <label>Organize the cables</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="cb25" checked>
          <label>Clean CPU case</label>
        </div>
      </div>
      <div class="two fields">
        <div class="field">
          <label>GPU</label>
          <input type="text" value="Intel(R) Core(TM) i7-7700 CPU @ 3.60GHz 3.60 GHz">
        </div>
        <div class="field">
          <label>RAM</label>
          <input type="text" value="16GB">
        </div>
      </div>
      <div class="two fields">
        <div class="field">
          <label>Keyboard</label>
          <input type="text" value="Acer Keyboard S/N: DKUSB1P02D90280958K701">
        </div>
        <div class="field">
          <label>Mouse</label>
          <input type="text" value="Acer Mouse S/N: DKUSB1B0DL90501486K801">
        </div>
      </div>
      <div class="field">
        <label>UPS</label>
        <input type="text" value="Prolink S/N: 54781193501089">
      </div>

      <!-- Software Maintenance -->
      <h3 class="ui dividing header">Software Maintenance</h3>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="cb26" checked>
          <label>Run disk cleanup in the Operating System</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="cb27" checked>
          <label>Defragment the hard drive in Windows</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="cb28" checked>
          <label>Empty the recycle bin</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="cb29" checked>
          <label>Delete .tmp/.tilde files</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="cb30">
          <label>Delete old .zip files that were already unzipped</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="cb31" checked>
          <label>Update drivers as needed</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="cb32" checked>
          <label>Uninstall unnecessary programs</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="cb33" checked>
          <label>Check hard drive space</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="cb34" checked>
          <label>Check memory space</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="cb35" checked>
          <label>Check network connectivity</label>
        </div>
      </div>
      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="cb36" checked>
          <label>Reboot the system (Record startup time: 140 seconds)</label>
        </div>
      </div>
      </form>
    </div>
    <div class="actions">
      <div class="ui black deny button">
        Cancel
      </div>
      <button type="button" class="ui positive button submit_iepmc_btn">
        Save
      </button>
    </div>
  
  </div>