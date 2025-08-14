import { AuthClass } from "./login/login";
let pageLoaderGlobal;
export class Section {

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

export class Message {

    constructor() {
        this.msgEl = document.createElement('div');
        this.msgEl.className = "ui very tiny modal";
        this.msgEl.innerHTML = `
            <div class="content">
            </div>
        `
        document.getElementsByTagName('body')[0].appendChild(this.msgEl);
        $(this.msgEl).modal({
            allowMultiple: false
        })
    }

    success(msg) {
        this.msgEl.innerHTML = `
                <div class="ui icon header">
                    <i class="check green icon"></i>
                    ${msg}
                </div>
                <div class="actions">
                    <div class="ui green ok inverted button confirm_warning_action" id="modalSuccessDoneBtn">
                    <i class="checkmark icon"></i>
                        Yes
                    </div>
                </div>
        `;
        $(this.msgEl).modal('show');
    }

    fail(msg) {
        this.msgEl.innerHTML = `
            <div class="ui icon header">
                <i class="warning red icon"></i>
                ${msg}
            </div>
            <div class="actions">
                <div class="ui red basic cancel inverted button">
                    <i class="remove icon"></i>
                    No
                </div>
                <div class="ui green ok inverted button confirm_warning_action" id="modalSuccessDoneBtn">
                <i class="checkmark icon"></i>
                    Yes
                </div>
            </div>
        `;
        $(this.msgEl).modal('show');
    }

    hide() {
        $(this.msgEl).modal('hide').modal('hide dimmer');
    }
}

export class BtnLoader {
    
    constructor() {
        this.counter = null;
        this.defbtn = "";
        this.ldbtn = `
          <i class="loading spinner icon"></i>
            Please wait
        `;
    }

    start(element) {
        this.defbtn = element;
        element.disabled = true;
        element.innerHTML = `<i class="loading spinner icon"></i> Please wait...`;
    }

    load(element = false, action, ht = false) {
        let self = BtnLoaderMod;
        element.innerHTML = (ht?ht:self.defbtn);
        element.disabled = false;
        action();
    }
}

export class CustomDate {

    constructor() {
        this.date = new Date();
        this.month = [
            'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December',
        ]

        this.smonth = [
            'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec',
        ]
    }

    humanDate(date = new Date(), month = 's') { //month = short/whole
        this.cdate = new Date(date);
        return (month == 's'?this.smonth[this.cdate.getMonth()]:this.month[this.cdate.getMonth()])+" "+String(this.cdate.getDate()).padStart('2', '0')+', '+this.cdate.getFullYear();
    }



    
}

export class confModal {
    load(accept, message = false) {
        const ht = `
            <div class="ui small icon header">
                <i class="warning small tiny yellow icon"></i>
                Confirm Action
            </div>
            <div class="content">
                <h5>${message?message:"Are you sure you want to proceed with this action?"}</h5>
            </div>
            <div class="actions">
                <div class="ui red basic cancel button">
                    <i class="remove icon"></i>
                    No
                </div>
                <div class="ui green ok button confirm_warning_action">
                <i class="checkmark icon"></i>
                    Yes
                </div>
            </div>
        `;
        this.modal = document.createElement('div');
        this.modal.className = 'ui very tiny modal';
        this.modal.innerHTML = ht;
        let self = this;
        
        document.getElementById('main_event').appendChild(this.modal);
        $(this.modal).modal({
            allowMultiple: false
        })
        $(this.modal).modal('show');
        $('.confirm_warning_action').on('click', (e) => {
            $(self.modal).modal('hide').modal('hide dimmer');
            self.modal.remove();
            accept(e);
        });
       
    }
}

export class pageLoader {

    constructor(element) {
        this.element = document.getElementById(element);
        pageLoaderGlobal = element;
    }

    destroy(pageLoadClass) {
        $(pageLoadClass).removeClass('active');
        console.log(pageLoadClass);
    }
}

function getRandomInteger(min, max) {
    min = Math.ceil(min); // Ensures min is an integer
    max = Math.floor(max); // Ensures max is an integer
    // console.log(Math.floor(Math.random() * (max - min + 1)) + min);
    return Math.floor(Math.random() * (max - min + 1)) + min;
  }

export const SectionMod = new Section();
export const MessageMod = new Message();
export const BtnLoaderMod = new BtnLoader();
export const humanDate = new CustomDate();
export const confirmMod = new confModal();
export const pageLoadMod = new pageLoader();

document.addEventListener('DOMContentLoaded', () => {
    // pageLoadMod.destroy();
    $('.ui .dropdown').dropdown();
    $('#logout_user').on('click', () => {
        AuthClass.logout();
    });
});
