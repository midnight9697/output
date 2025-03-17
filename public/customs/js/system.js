class System {
    constructor(options = false) {
        this.options = options;
        console.log("Shit");
        $('.launch').on('click', function() {
            $('#ui_sidebar').sidebar('toggle');
        });
        
    }
}

document.addEventListener('DOMContentLoaded',() => {
    const SystemScrypt = new System();
});