class d{constructor(){this.downAction=!1,this.updateAction=!1,this.viewAction=!1,this.deleteAction=!1,this.udpateName="Update",this.viewName="View",this.downName="Download",this.deleteName="Delete",this.deleteClassName="",this.data={}}loadButtons(c){let i=document.createElement("a"),a=document.createElement("div"),n=document.createElement("div"),s=document.createElement("div"),o=document.createElement("div"),t=document.createElement("div"),l=document.createElement("div");Object.keys(this.data).forEach(e=>{a.dataset[e]=this.data[e],n.dataset[e]=this.data[e],s.dataset[e]=this.data[e]}),l.innerHTML=`
          <i class="ellipsis vertical icon"></i>
        `,i.innerHTML=`
          <i class="edit icon"></i> ${this.downName}
        `,a.innerHTML=`
          <i class="edit icon"></i> ${this.udpateName}
        `,n.innerHTML=`
          <i class="eye icon"></i> ${this.viewName}
        `,s.innerHTML=`
          <i class="trash icon"></i> ${this.deleteName}
        `,i.className="item link",a.className="item link",n.className="item link",s.className="item link "+this.deleteClassName,l.className="ui icon button custom-options-button",o.className="ui popup custom-popup",t.className="ui vertical very tiny menu",i.target="__blank",i.href=this.downAction,a.onclick=this.updateAction,n.onclick=this.viewAction,s.onclick=this.deleteAction,c.appendChild(l),this.downAction&&t.appendChild(i),this.updateAction&&t.appendChild(a),this.viewAction&&t.appendChild(n),this.deleteAction&&t.appendChild(s),o.appendChild(t),c.appendChild(o),this.relinitialize()}relinitialize(){$(".custom-options-button").popup({popup:$(".custom-popup"),on:"click",position:"bottom right",hoverable:!0,closable:!0})}}const m=new d;export{m as T};
