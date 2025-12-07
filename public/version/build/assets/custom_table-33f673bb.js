class d{constructor(){this.downAction=!1,this.updateAction=!1,this.viewAction=!1,this.deleteAction=!1,this.udpateName="Update",this.viewName="View",this.downName="Download",this.deleteName="Delete",this.deleteClassName="",this.updateClassName="",this.data={},this.popup=document.createElement("div"),this.menu=document.createElement("div"),this.options_button=document.createElement("div")}loadButtons(s){let t=document.createElement("a"),i=document.createElement("div"),n=document.createElement("div"),e=document.createElement("div"),a=document.createElement("div"),o=document.createElement("div"),c=document.createElement("div");Object.keys(this.data).forEach(l=>{i.dataset[l]=this.data[l],n.dataset[l]=this.data[l],e.dataset[l]=this.data[l]}),c.innerHTML=`
          <i class="ellipsis vertical icon"></i>
        `,t.innerHTML=`
          <i class="edit icon"></i> ${this.downName}
        `,i.innerHTML=`
          <i class="edit icon"></i> ${this.udpateName}
        `,n.innerHTML=`
          <i class="eye icon"></i> ${this.viewName}
        `,e.innerHTML=`
          ${this.deleteName}
        `,t.className="item link",i.className="item link",n.className="item link",e.className="item link "+this.deleteClassName,i.className="item link "+this.updateClassName,c.className="ui icon button custom-options-button",a.className="ui popup custom-popup",o.className="ui vertical very tiny menu",t.target="__blank",t.href=this.downAction,i.onclick=this.updateAction,n.onclick=this.viewAction,e.onclick=this.deleteAction,s.appendChild(c),this.downAction&&o.appendChild(t),this.updateAction&&o.appendChild(i),this.viewAction&&o.appendChild(n),this.deleteAction&&o.appendChild(e),a.appendChild(o),s.appendChild(a),this.relinitialize()}createCustomButton(s,t,i,n){let e=document.createElement("div");Object.keys(this.data).forEach(a=>{e.dataset[a]=this.data[a]}),e.innerHTML=`
       ${t}
      `,e.className="item link "+i,this.popup.className="ui popup custom-popup",this.menu.className="ui vertical very tiny menu",this.menu.style="text-align:center",e.onclick=n,n&&this.menu.appendChild(e),this.popup.appendChild(this.menu),s.appendChild(this.popup)}loadCustomBtns(s){this.resetBtns();let t=document.createElement("div");t.innerHTML=`
        <i class="ellipsis vertical icon"></i>
      `,t.className="ui icon button custom-options-button",s.appendChild(t)}resetBtns(){this.popup.innerHTML="",this.options_button.innerHTML="",this.menu.innerHTML=""}relinitialize(){$(".custom-options-button").popup({popup:$(".custom-popup"),on:"click",position:"bottom right",hoverable:!0,closable:!0})}}const u=new d;export{u as T,d as t};
