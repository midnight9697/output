export class tableButtons {

    constructor() {
        this.downAction =  false 
        this.updateAction =  false 
        this.viewAction =  false 
        this.deleteAction =  false
        this.udpateName = "Update";
        this.viewName = "View";
        this.downName = "Download";
        this.deleteName = "Delete";
        this.deleteClassName = "";
        this.updateClassName = "";
        this.data = {};
        this.popup = document.createElement('div');
        this.menu = document.createElement('div'); 
        this.options_button = document.createElement("div");

    }

    loadButtons(parent) {
        var self = this;
        let dwbutton = document.createElement('a');
        let button = document.createElement('div');
        let vbutton = document.createElement('div');
        let dbutton = document.createElement('div');
        let popup = document.createElement('div');
        let menu = document.createElement('div'); 
        let options_button = document.createElement("div");
        Object.keys(this.data).forEach(key => {
          button.dataset[key] = this.data[key];
          vbutton.dataset[key] = this.data[key];
          dbutton.dataset[key] = this.data[key];
        });
        
        options_button.innerHTML = `
          <i class="ellipsis vertical icon"></i>
        `;
        
        dwbutton.innerHTML =  `
        ${this.downName}
        `;
        
        button.innerHTML =  `
        ${this.udpateName}
        `;

        vbutton.innerHTML =  `
          ${this.viewName}
        `;

        dbutton.innerHTML =  `
          ${this.deleteName}
        `;

        dwbutton.className = 'item link';
        button.className = 'item link';
        vbutton.className = 'item link';
        dbutton.className = 'item link'+ " "+this.deleteClassName;
        button.className = 'item link'+ " "+this.updateClassName;
        options_button.className = "ui icon button custom-options-button";
        popup.className = 'ui popup custom-popup';
        menu.className = 'ui vertical very tiny menu';
        dwbutton.target = "__blank";
        dwbutton.href = this.downAction

        button.onclick = this.updateAction

        vbutton.onclick = this.viewAction

        dbutton.onclick = this.deleteAction
        
        parent.appendChild(options_button);
        if (this.downAction) {
          menu.appendChild(dwbutton);
        }
        if (this.updateAction) {
          menu.appendChild(button);
        }
        if (this.viewAction) {
          menu.appendChild(vbutton);
        }
        if (this.deleteAction) {
          menu.appendChild(dbutton);
        }
        popup.appendChild(menu);
        parent.appendChild(popup);

        this.relinitialize();
    }

    createCustomButton(parent, customBtnName, customBtnClassName, action) {
      var self = this;
      let button = document.createElement('div');
      
      Object.keys(this.data).forEach(key => {
        button.dataset[key] = this.data[key];
      });
      
      button.innerHTML =  `
       ${customBtnName}
      `;
      
      // button.className = 'item link';
      button.className = 'item link'+ " "+customBtnClassName;
      this.popup.className = 'ui popup custom-popup';
      this.menu.className = 'ui vertical very tiny menu';
      this.menu.style = "text-align:center";
      button.onclick = action;

      if (action) {
        this.menu.appendChild(button);
      }

      this.popup.appendChild(this.menu);
      parent.appendChild(this.popup);
    }

    loadCustomBtns(parent) {
      this.resetBtns();
      let options_button = document.createElement("div");
      options_button.innerHTML = `
        <i class="ellipsis vertical icon"></i>
      `;
      options_button.className = "ui icon button custom-options-button";
      parent.appendChild(options_button);
    }
    
    resetBtns() {
      this.popup.innerHTML = "";
      this.options_button.innerHTML = "";
      this.menu.innerHTML = "";
    }

    relinitialize() {
      $('.custom-options-button').popup({
        popup: $('.custom-popup'),
        on: 'click',
        position: 'bottom right',
        hoverable: true,
        closable: true
      });
    }
}


export const TBLButton = new tableButtons();