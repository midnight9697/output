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