<!-- Semantic UI Modal -->
<div class="ui modal " id="insertModal">
    <i class="close icon"></i>
  
    <div class="header">
      Project Information
    </div>
  
    <div class="content">
      <form class="ui form insert-form" id="insert-form" method="POST">
        <div class="ui error message">
          {{--  --}}
        </div>
        <div class="field">
          <label>Tentative Date and Time</label>
          <input 
            type="text" 
            name="tentative_date_and_time"
            placeholder="Select date and time"
          >
        </div>
  
        <div class="field">
          <label>Public Scoping Location</label>
          <input 
            type="text" 
            name="public_scoping_location"
            placeholder="Enter public scoping location"
          >
        </div>
  
        <div class="field">
          <label>Project Name</label>
          <input 
            type="text" 
            name="project_name"
            placeholder="Enter project name"
          >
        </div>
  
        <div class="field">
          <label>Project Proponent</label>
          <input 
            type="text" 
            name="project_proponent"
            placeholder="Enter project proponent"
          >
        </div>
  
        <div class="field">
          <label>Project Location</label>
          <textarea 
            name="project_location"
            placeholder="Enter project location"
          ></textarea>
        </div>
  
        <!-- Long URL Field -->
        <div class="field">
          <label>Project Description Link</label>
          <textarea 
            rows="3"
            name="project_description"
            placeholder="Paste the project description link here"
          ></textarea>
        </div>
  
      </form>
    </div>
  
    <div class="actions">
      <div class="ui black deny button">
        Cancel
      </div>
  
      <button type="submit" class="ui green right labeled icon button" id="insert-submit-btn">
        Save
        <i class="checkmark icon"></i>
      </button>
    </div>
</div>

<div class="ui modal" id="updateModal">
  <i class="close icon"></i>

  <div class="header">
    Update Project Information
  </div>

  <div class="content">
    <form class="ui form update-form" id="update-form">
      <div id="update-form-field">
        {{-- Field --}}
      </div>
    </form>
  </div>

  <div class="actions">
    <div class="ui black deny button">
      Cancel
    </div>

    <div class="ui green right labeled icon button" id="update-submit-btn">
      Save
      <i class="checkmark icon"></i>
    </div>
  </div>
</div>
{{-- PUBLIC HEARING MODAL --}}

<!-- Semantic UI Modal -->
<div class="ui modal " id="insertPHModal">
  <i class="close icon"></i>

  <div class="header">
    Project Information
  </div>

  <div class="content">
    <form class="ui form insert-ph-form" id="insert-ph-form" method="POST">
      <div class="ui error message">
        {{--  --}}
      </div>
      <div class="field">
        <label>Tentative Date and Time</label>
        <input 
          type="text" 
          name="tentative_date_and_time"
          placeholder="Select date and time"
        >
      </div>

      <div class="field">
        <label>Public Hearing Location</label>
        <input 
          type="text" 
          name="public_hearing_location"
          placeholder="Enter public hearing location"
        >
      </div>

      <div class="field">
        <label>Project Name</label>
        <input 
          type="text" 
          name="project_name"
          placeholder="Enter project name"
        >
      </div>

      <div class="field">
        <label>Project Proponent</label>
        <input 
          type="text" 
          name="project_proponent"
          placeholder="Enter project proponent"
        >
      </div>

      <div class="field">
        <label>Project Location</label>
        <textarea 
          name="project_location"
          placeholder="Enter project location"
        ></textarea>
      </div>

      <!-- Long URL Field -->
      <div class="field">
        <label>Project Description Link</label>
        <textarea 
          rows="3"
          name="project_description"
          placeholder="Paste the project description link here"
        ></textarea>
      </div>

    </form>
  </div>

  <div class="actions">
    <div class="ui black deny button">
      Cancel
    </div>

    <button type="submit" class="ui green right labeled icon button" id="insert-ph-submit-btn">
      Save
      <i class="checkmark icon"></i>
    </button>
  </div>
</div>

<div class="ui modal" id="updatePHModal">
  <i class="close icon"></i>

  <div class="header">
    Update Project Information
  </div>

  <div class="content">
    <form class="ui form update-ph-form" id="update-ph-form">
      <div id="update-ph-form-field">
        {{-- Field --}}
      </div>
    </form>
  </div>

  <div class="actions">
    <div class="ui black deny button">
      Cancel
    </div>

    <div class="ui green right labeled icon button" id="update-ph-submit-btn">
      Save
      <i class="checkmark icon"></i>
    </div>
  </div>
</div>

{{-- View Links --}}
<div class="ui modal tiny" id="viewLinksModal">
  <i class="close icon"></i>

  <div class="header">
    Project Links
  </div>

  <div class="content">
    <div id="view-links">

    </div>
  </div>

  <div class="actions">
    <div class="ui black deny button">
      Cancel
    </div>
  </div>
</div>