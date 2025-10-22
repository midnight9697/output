import { pageLoadMod } from "./app";
import { rfqClass } from "./rfq/rfq";

document.addEventListener('DOMContentLoaded', () => {
   // let rfq_counter = $('.rfq_counter');
  
   // setInterval(() => {
   //    rfqCounter();
   // }, 1000);
   // pageLoadMod.destroy();
});

function rfqCounter() {
   rfqClass.counter(function(res) {
      $('.rfq_counter').html(res);
   });
}