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
        border: solid 1px;
        padding: 0px;
    }

    @media print {
        html, body {
          height: 100%;
          margin: 0;
          padding: 0;
        }
        @page {
            margin: 0px;
        }
        
        table {
            border: none;
            /* visibility: visible; */
            height: 100%;
        }

        body {
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
      top: 0;
      left: 0;
      width: 100%;
      text-align: center;
      z-index: 1000;
      border-bottom: solid blue 10px;
    }

    @page {
        margin-left: 0;
        margin-right: 0;
    }
    /* Main content styling */
    main {
        width: 816px;
      line-height: 1.6;
    }
    
    .content {
      /* border: solid 1px; */
      margin-left: 60px;
      margin-right: 60px;
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
        margin-top: 40px;
        text-align: center;
        font-size: 11px;
        color: #333;
    }
  </style>
</head>
<body>
    <main>
        <table>
            <thead>
                <tr>
                    <th>
                        @include('admin.rfq.tbHeader')
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        @include('admin.rfq.content')
                    </td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <th style="border: solid 1px;position:relative;height: 100%">
                        @include('admin.rfq.tbFooter')
                    </th>
                </tr>
            </tfoot>
        </table>
    </main>

</body>
</html>
