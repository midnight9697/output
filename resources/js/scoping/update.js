export default function updateForm(data) {
    return `
    <div class="field">
      <label>Tentative Date and Time</label>
      <input 
        type="text" 
        name="tentative_date_and_time"
        placeholder="Select date and time"
        value="${data.tentative_date_and_time}"
    >
    </div>

    <div class="field">
      <label>Public Scoping Location</label>
      <input 
        type="text" 
        name="public_scoping_location"
        placeholder="Enter public scoping location"
        value="${data.public_scoping_location}"
      >
    </div>

    <div class="field">
      <label>Project Name</label>
      <input 
        type="text" 
        name="project_name"
        placeholder="Enter project name"
        value="${data.project_name}"
      >
    </div>

    <div class="field">
      <label>Project Proponent</label>
      <input 
        type="text" 
        name="project_proponent"
        placeholder="Enter project proponent"
        value="${data.project_proponent}"
      >
    </div>

    <div class="field">
      <label>Project Location</label>
      <textarea 
        name="project_location"
        placeholder="Enter project location"
      >${data.project_location}</textarea>
    </div>

    <!-- Long URL Field -->
    <div class="field">
      <label>Project Description Link</label>
      <textarea 
        rows="3"
        name="project_description"
        placeholder="Paste the project description link here"
      >${data.project_description}</textarea>
    </div>
    `
}