class d{constructor(){this.downAction=!1,this.updateAction=!1,this.viewAction=!1,this.deleteAction=!1,this.udpateName="Update",this.viewName="View",this.downName="Download",this.deleteName="Delete",this.deleteClassName="",this.updateClassName="",this.data={}}loadButtons(c){let a=document.createElement("a"),t=document.createElement("div"),s=document.createElement("div"),n=document.createElement("div"),l=document.createElement("div"),e=document.createElement("div"),o=document.createElement("div");Object.keys(this.data).forEach(i=>{t.dataset[i]=this.data[i],s.dataset[i]=this.data[i],n.dataset[i]=this.data[i]}),o.innerHTML=`
          <i class="ellipsis vertical icon"></i>
        `,a.innerHTML=`
          <i class="edit icon"></i> ${this.downName}
        `,t.innerHTML=`
          <i class="edit icon"></i> ${this.udpateName}
        `,s.innerHTML=`
          <i class="eye icon"></i> ${this.viewName}
        `,n.innerHTML=`
          <i class="trash icon"></i> ${this.deleteName}
        `,a.className="item link",t.className="item link",s.className="item link",n.className="item link "+this.deleteClassName,t.className="item link "+this.updateClassName,o.className="ui icon button custom-options-button",l.className="ui popup custom-popup",e.className="ui vertical very tiny menu",a.target="__blank",a.href=this.downAction,t.onclick=this.updateAction,s.onclick=this.viewAction,n.onclick=this.deleteAction,c.appendChild(o),this.downAction&&e.appendChild(a),this.updateAction&&e.appendChild(t),this.viewAction&&e.appendChild(s),this.deleteAction&&e.appendChild(n),l.appendChild(e),c.appendChild(l),this.relinitialize()}relinitialize(){$(".custom-options-button").popup({popup:$(".custom-popup"),on:"click",position:"bottom right",hoverable:!0,closable:!0})}}const p=new d;export{p as T,d as t};
