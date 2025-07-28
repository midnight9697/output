// axios.defaults.baseURL = 'http://172.16.6.103';
import { Authentication } from "./login/login";

const authentication =  new Authentication();

export class Section {

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

export class Message {

    constructor() {
        this.msgEl = document.createElement('div');
        this.msgEl.className = "ui small modal";
        this.msgEl.innerHTML = `
            <div class="content">
            </div>
        `
        document.getElementsByTagName('body')[0].appendChild(this.msgEl);
    }

    success(msg) {
        this.msgEl.innerHTML = `
            <div style="padding:30px;display:flex;justify-content:center;flex-direction:column;text-align:center">
                <h2 style="margin:0px">${msg}<h2>
                <div class="ui green button" onclick="$('.modal').modal('hide')" id="modalSuccessDoneBtn" style="margin:0px">Done</div>
            </div>
        `;
        $(this.msgEl).modal('show');
    }

    fail(msg) {
        this.msgEl.innerHTML = `
            <div style="padding:30px;display:flex;justify-content:center;flex-direction:column;text-align:center">
                <h2 style="margin:0px">${msg}<h2>
                <div class="ui red button" id="modalFailDoneBtn" onclick="$('.modal').modal('hide')" style="margin:0px">Done</div>
            </div>
        `;
        $(this.msgEl).modal('show');
    }

    hide() {
        $(this.msgEl).modal('hide');
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
        this.defbtn = element.innerHTML;
        element.disabled = true;
        // element.innerHTML = this.ldbtn;
        element.innerHTML = `<i class="loading spinner icon"></i> Please wait...`;
    }

    load(element = false, action) {
        var self = this;
        element.innerHTML = self.defbtn;
        element.disabled = false;
        action();
        // let cnt = 1;

        // let x = setInterval(() => {
        //     console.log('Count', cnt);
        //     if (cnt <= 0) {
        //         clearInterval(x);
        //         element.innerHTML = self.defbtn;
        //         element.disabled = false;
        //         action();
        //     }
        //     cnt--;
        // }, 1000);

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

document.addEventListener('DOMContentLoaded', () => {
    $('.ui.dropdown').dropdown();

    $('#modalSuccessDoneBtn').on('click', function() {
        console.log('Hide');
        MessageMod.hide();
    })
    
    $('#modalFailDoneBtn').on('click', function() {
        console.log('Hide');
        MessageMod.hide();
    })

    $('#logout_user').on('click', () => {
        authentication.logout();
    });
});
