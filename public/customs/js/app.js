document.addEventListener('DOMContentLoaded', () => {
    $('.ui.dropdown').dropdown();
});

class Section {

    constructor() {

    }

    getSection(division_id = false, action) {
        var usersClone = this;
        axios.post('./system/sections', {
            division_id: division_id
        })
          .then(function (response) {
            action(response.data)
          });
    }
}

class Message {

    constructor() {
        this.msgEl = document.createElement('div');
        this.msgEl.className = "ui info message transition hidden";
        this.msgEl.innerHTML = `
            <div class="ui green message">

            </div>
        `  
        document.getElementsByTagName('body')[0].appendChild(this.msgEl);
    }

    success() {
        const ht = `
            <div class=""ui green message">

            </div>
        `;
    }
}

const SectionMod = new Section();
const MessageMod = new Message();