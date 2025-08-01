const maxActivePage = 5;
let lastEvenPage = 1;
let pageNext = 'current';

class Pagination {
    load(parent, data, action, url) {
        let prevBtn = document.createElement('a');
      prevBtn.className = `icon item ${(data.current_page == 1?"":"prev-page")}`;
      prevBtn.innerHTML = `<i class="left chevron icon"></i>`;
      prevBtn.onclick =  function(e) {
        pageNext = "prev";
        if (data.current_page > 1) {
          paginateMod.fetchData(url, data.current_page - 1, action);
        }
      }
      
      let nextBtn = document.createElement('a');
      nextBtn.className = `icon item ${(data.current_page == data.last_page?"":"next-page")}`;
      nextBtn.innerHTML = `<i class="right chevron icon"></i>`;
      nextBtn.onclick =  function(e) {
        pageNext = "next";
        if (data.current_page < data.last_page) {
            paginateMod.fetchData(url, data.current_page + 1, action);
        }
      }
      
      let div = document.createElement('div')
      div.className = 'ui right floated pagination menu';
      div.appendChild(prevBtn);
      
      let maxPage = (data.last_page < maxActivePage?data.last_page:(lastEvenPage+4));
      if (data.current_page % (maxPage+1) == 0 && pageNext == "next") {
        maxPage += 5;
        lastEvenPage = data.current_page;
      }
      
      let startPage = (data.current_page % (maxPage+1) == 0?data.current_page:lastEvenPage);
      if (((data.current_page % maxActivePage == 0) && pageNext == "prev") && startPage >= 1) {
        startPage = startPage - (maxActivePage);
        maxPage = maxPage - (maxActivePage);
        lastEvenPage = startPage;
      }

      console.log('-->', data.current_page, maxActivePage, maxPage, maxActivePage % data.current_page, pageNext);
      for (let index = startPage; index <= maxPage; index++) {
        let page = document.createElement('a');
        page.className = `${(data.current_page == index?'active':'')} item`;
        page.innerHTML = index;
        page.onclick = function() {
          pageNext = "next";
          paginateMod.fetchData(url, index, action);
        }
        div.appendChild(page);
      }
      
      div.appendChild(nextBtn);
      parent.innerHTML = "";
      parent.appendChild(div);
    }

    fetchData(url, page, action) {
        axios.get(url+'?'+(page?"page="+page:""),  {
            headers: {
                'Authorization': `Bearer ${localStorage.getItem('bearer')}`
                }
            }).then(function (response) {
                action(response.data)
        });
    }
}

export const paginateMod = new Pagination();