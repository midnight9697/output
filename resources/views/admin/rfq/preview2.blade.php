    <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Fixed Header Test</title>
  <style>
    /* Header styling */
    body {
        font-family: "Times New Roman", serif;
        margin: 0px;
        /* font-size: 11px; */
        display: flex;
        justify-content: center; /* centers content horizontally */
    }
    
    table {
        top: 0;
        padding: 0px;
        height: 100vh
    }

    spacer {
      height: 100%;
    }

    @media print {
        html, body {
          min-height: 100%;
          margin: 0;
          padding: 0;
        }
        @page {
            position:absolute;
            bottom: 0;
            top: 0;
            height: 100vh;
            margin: 0px;
        }
        
        table {
            border: none;
            height: 100vh;
            /* visibility: visible; */
        }

        body {
          height: 100%;
            /* visibility: hidden; */
        }

        thead {
          display: table-header-group; /* repeats on every page */
        }

        tfoot {
          display: table-footer-group; /* repeats on every page */
        }
        
        tr {
          page-break-inside: avoid; /* prevent row splitting */
        }

        table {
          page-break-inside: auto;
        }
    }

    header {
      position: fixed;
      top: 0;
      width: 100%;
      text-align: center;
      /* border-bottom: solid blue 10px; */
    }

    @page {
        margin-left: 0;
        margin-right: 0;
    }
    /* Main content styling */
    main {
        width: 100%;
        line-height: 1.6;
        margin-bottom:126px;
        margin-top:126px;
    }
    
   

    .content ol {
        margin-top: 20px;
        line-height: 1.3;
    }

    .rules>li {
      margin-bottom: 10px
    }

    .rules-emb-address {
      margin: 0px;
      margin-left: 60px;
      margin-top: 10px;
    }

    footer {
      height: 116;
      width:100%;
      background: black;
      position: fixed;
      bottom: 0;
    }
  </style>
</head>
<body>
  <header>
    @include('admin.rfq.tbHeader')
    @include('admin.rfq.content')
  </header>
    <main>
        {{-- <table height="100%">
            <thead>
                <tr>
                    <th>
                       
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        @include('admin.rfq.content')
                    </td>
                </tr>
                <tr class="spacer">
                  <td></td>
                </tr>
            </tbody>
        </table> --}}
    </main>
    <footer>
      @include('admin.rfq.tbFooter')
    </footer>

</body>
</html>
