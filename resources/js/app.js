import places from './places.json' with { type: 'json' };
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

    success(msg, action = () => {}) {
        this.buttonY = document.createElement('div');
        this.buttonY.className = "ui green ok inverted button confirm_warning_action";
        this.buttonY.onclick = action;
        this.buttonY.innerHTML = `
            <i class="checkmark icon"></i>
            Yes
        `;
        this.div = document.createElement('div');
        this.div.className = 'actions';
        this.div.appendChild(this.buttonY);
        this.msgEl.innerHTML = `
                <div class="ui icon header">
                    <i class="check green icon"></i>
                    ${msg}
                </div>
        `;

        this.msgEl.appendChild(this.div);
        $(this.msgEl).modal('show');
    }

    warning(msg, action = () => {}) {
        this.buttonY = document.createElement('div');
        this.buttonY.className = "ui red ok inverted button confirm_warning_action";
        this.buttonY.onclick = action;
        this.buttonY.innerHTML = `
            <i class="checkmark icon"></i>
            Ok
        `;
        this.div = document.createElement('div');
        this.div.className = 'actions';
        this.div.appendChild(this.buttonY);
        this.msgEl.innerHTML = `
                <div class="ui icon header">
                    <i class="warning yellow icon"></i>
                    ${msg}
                </div>
        `;

        this.msgEl.appendChild(this.div);
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
            <div class="ui icon header">
                <i class="warning yellow icon"></i>
                ${message?message:"Are you sure you want to proceed with this action?"}
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

export class progressBar {

    constructor() {
        this.progress_bar = null;
        this.valid = false;
    }

    make(element) {
        console.log('Elemnt', element);
        this.parent = document.querySelector('#'+element);
        this.parent.innerHTML = '';

        this.ui_progress = document.createElement('div');
        this.bar = document.createElement('div');
        this.label = document.createElement('div');

        this.ui_progress.className = "ui indicating progress";
        this.bar.className = 'bar';
        this.label.className = 'label';

        this.label.innerHTML = "Uploading Files";
        
        this.ui_progress.appendChild(this.bar);
        this.ui_progress.appendChild(this.label);

        $(this.ui_progress).progress({
            label: 'ratio', // Or 'value' for a numeric percentage
            text: 'Uploading Files' // Set initial text
        });

        this.valid = false;
    }

    progress(prog, name = false) {
        if (this.valid == false) {
            this.valid = true;
            this.parent.appendChild(this.ui_progress);
        }
        $(this.ui_progress).progress('set progress', prog);
        this.label.innerHTML = (name=false?"":name+" ")+prog+'% Completed';
    }

    success() {
        $(this.ui_progress).progress('set success', '100% Upload Complete');
    }

    fail() {
        this.parent.innerHTML = `
            <div class="ui progress error">
                <div class="bar">
                    <div class="progress"></div>
                </div>
                <div class="label">There was an error.</div>
            </div>
        `;
    }
}


export class Uploader {
    upload(uri, data, action = () => {}, progress = () => {}, fail = () => {}) {
        var usersClone = this;
        let fd = data;
        
        axios.post(uri, fd, {
            headers: {
              'Authorization': `Bearer ${localStorage.getItem('bearer')}`,
            },
            onUploadProgress: (progressEvent) => {
              const percentCompleted = Math.round((progressEvent.loaded * 100) / progressEvent.total);
              progress(percentCompleted);
            }
        })
        .then(action).catch(fail);
    }
}

export function createElement(className = "", text = "", type = "div", action = () => {}) {
    let new_element = document.createElement(type);
    new_element.className = className;
    new_element.innerText = text;
    new_element.onclick = action;
    return new_element;
}

function getRandomInteger(min, max) {
    min = Math.ceil(min); // Ensures min is an integer
    max = Math.floor(max); // Ensures max is an integer
    // console.log(Math.floor(Math.random() * (max - min + 1)) + min);
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

export function global_place(supplier_province,supplier_municipality,supplier_barangay){
    let provinces = places['08']['province_list'];
    let municipalities = [];
    let brgys = [];
    // select province
    $('#'+supplier_province)
    .dropdown({
      values: Object.keys(provinces).map(function(prov) {
        return {
          name: prov,
          value: prov,
        }
      }),
      onChange: function(value, text, selectedItem) {
            municipalities = provinces[value]['municipality_list'];
            console.log('trigger');
            $('#'+supplier_municipality).form('clear', true);
            $('#'+supplier_barangay).form('clear', true);
            // select municipality
            $('#'+supplier_municipality).dropdown('change values', Object.keys(municipalities).map(function(mun) {
                return {
                  name: Object.keys(municipalities[mun])[0],
                  value: Object.keys(municipalities[mun])[0],
                };
            }));

            supplierMunicipalControl();
      },
      clearable: true
    });

    function supplierMunicipalControl() {
        $('#'+supplier_municipality).dropdown({
            onChange: function(value,text, selectedItem){
                $('#'+supplier_barangay).form('clear', true);
                let tmp_municipality = municipalities.find(municipality => Object.keys(municipality)[0] == value);
                brgys = value?tmp_municipality[value]['barangay_list']:[];

                $('#'+supplier_barangay).dropdown('change values',  brgys.map(function(brgy) {
                    return {
                      name: brgy,
                      value: brgy,
                    };
                }));
                
                $('#'+supplier_barangay).dropdown();
            },
            clearable: true
        });
    }

    function supplierBarangayControl() {
        $('#'+supplier_barangay).dropdown({
            clearable: true,
            onChange: function(value,text, selectedItem){
    
            }
        });
    }
    
    supplierMunicipalControl();
    supplierBarangayControl();
    
}

export const SectionMod = new Section();
export const MessageMod = new Message();
export const BtnLoaderMod = new BtnLoader();
export const humanDate = new CustomDate();
export const confirmMod = new confModal();
export const pageLoadMod = new pageLoader();
export const progressControl = new progressBar();
export const uploadControl = new Uploader();

document.addEventListener('DOMContentLoaded', () => {
    // pageLoadMod.destroy();
    const editorElement = document.getElementById('draft-editor-container');
    // if (editorElement) {
    //     createRoot(editorElement).render(<DraftEditor />);
    // }
    
    $('.ui .dropdown').dropdown();
    $('#logout_user').on('click', () => {
        AuthClass.logout();
    });
});
