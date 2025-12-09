class d{constructor(){this.downAction=!1,this.updateAction=!1,this.viewAction=!1,this.deleteAction=!1,this.udpateName="Update",this.viewName="View",this.downName="Download",this.deleteName="Delete",this.deleteClassName="",this.updateClassName="",this.data={},this.popup=document.createElement("div"),this.menu=document.createElement("div"),this.options_button=document.createElement("div")}loadButtons(l){let t=document.createElement("a"),n=document.createElement("div"),s=document.createElement("div"),e=document.createElement("div"),i=document.createElement("div"),a=document.createElement("div"),o=document.createElement("div");Object.keys(this.data).forEach(c=>{n.dataset[c]=this.data[c],s.dataset[c]=this.data[c],e.dataset[c]=this.data[c]}),o.innerHTML=`
          <i class="ellipsis vertical icon"></i>
        `,t.innerHTML=`
        ${this.downName}
        `,n.innerHTML=`
        ${this.udpateName}
        `,s.innerHTML=`
          ${this.viewName}
        `,e.innerHTML=`
          ${this.deleteName}
        `,t.className="item link",n.className="item link",s.className="item link",e.className="item link "+this.deleteClassName,n.className="item link "+this.updateClassName,o.className="ui icon button custom-options-button",i.className="ui popup custom-popup",a.className="ui vertical very tiny menu",t.target="__blank",t.href=this.downAction,n.onclick=this.updateAction,s.onclick=this.viewAction,e.onclick=this.deleteAction,l.appendChild(o),this.downAction&&a.appendChild(t),this.updateAction&&a.appendChild(n),this.viewAction&&a.appendChild(s),this.deleteAction&&a.appendChild(e),i.appendChild(a),l.appendChild(i),this.relinitialize()}createCustomButton(l,t,n,s,e={}){const i=document.createElement("div");let a=Object.keys(e);console.log(e),a.forEach(o=>{i.dataset[o]=e[o]}),i.dataset.uid=Date.now().toString(),i.innerHTML=`
       ${t}
      `,i.className="item link "+n,this.popup.className="ui popup custom-popup",this.menu.className="ui vertical very tiny menu",this.menu.style="text-align:center",i.onclick=o=>s(e),s&&this.menu.appendChild(i),this.popup.appendChild(this.menu),l.appendChild(this.popup)}loadCustomBtns(l){this.resetBtns();let t=document.createElement("div");t.innerHTML=`
        <i class="ellipsis vertical icon"></i>
      `,t.className="ui icon button custom-options-button",l.appendChild(t)}resetBtns(){this.popup=document.createElement("div"),this.menu=document.createElement("div"),this.options_button=document.createElement("div")}relinitialize(){$(".custom-options-button").popup({popup:$(".custom-popup"),on:"click",position:"bottom right",hoverable:!0,closable:!0})}}new d;
