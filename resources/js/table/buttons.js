class tableButtons {

    constructor() {
        this.updateAction = () => {} 
        this.viewAction = () => {} 
        this.deleteAction = () => {}
        this.udpateName = "Update";
        this.viewName = "View";
        this.deleteName = "Delete";
    }

    loadButtons(parent) {
        var self = this;
        let button = document.createElement('div');
        let vbutton = document.createElement('div');
        let dbutton = document.createElement('div');
        let popup = document.createElement('div');
        let menu = document.createElement('div'); 
        let options_button = document.createElement("div");
        
        options_button.innerHTML = `
          <i class="ellipsis vertical icon"></i>
        `;
        
        button.innerHTML =  `
          <i class="edit icon"></i> ${this.udpateName}
        `;

        vbutton.innerHTML =  `
          <i class="eye icon"></i> ${this.viewName}
        `;

        dbutton.innerHTML =  `
          <i class="trash icon"></i> ${this.deleteName}
        `;

        button.className = 'item link';
        vbutton.className = 'item link';
        dbutton.className = 'item link';
        options_button.className = "ui icon button options-button";
        popup.className = 'ui popup';
        menu.className = 'ui vertical menu';
        
        button.onclick = this.updateAction

        vbutton.onclick = this.viewAction

        dbutton.onclick = this.deleteAction

        parent.appendChild(options_button);
        menu.appendChild(button);
        menu.appendChild(vbutton);
        menu.appendChild(dbutton);
        popup.appendChild(menu);
        parent.appendChild(popup);

        $('.options-button').popup({
          popup: $('.ui.popup'),
          on: 'click',
          position: 'bottom right',
          hoverable: true,
          closable: true
        });
    }
}


export const TBLButton = new tableButtons();