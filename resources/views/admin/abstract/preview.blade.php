<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="CWK9gF43NFI3FNq6pLAZs5uOTYOtZsg88xU7EBMZ">
        <link rel="shortcut icon" href="images/favicon.svg" type="image/x-icon">
        <title>ABSTRACT - {{ json_decode($data)->abstract->purpose }}</title>
        <link rel="stylesheet" href="{{ public_path('plugins/new/datatables/css/semantic.min.css') }}">
        <link rel="stylesheet" href="{{ (!$data?$url."/":json_decode($data)->data."/") }}css/main.css">
        {{-- <link rel="stylesheet" href="{{ (!$data?$url."/":json_decode($data)->data."/") }}custom/css/app.css" type="text/css"> --}}

        <style>
            table, th, td {
                border: 1px solid black;
                border-collapse: collapse;
                color:black
                /* text-align: center */
            }
            body {
                font-size:9;
            }
            #preview {
                font-size: 9;
                margin-top:50px;
            }
            footer {
                position: fixed;
                bottom: 0;
                width: 100%;
                font-size: 9;
                color: black;
                display: inline;
            }
            .item_columns {
                text-align: center;
                padding:5px;
                /* display:inline-block */
            }
        </style>
    </head>
    <body>
        <div class="container text-dark" id="preview">
            {{-- <img src="{{ (!$data?$url:json_decode($data)->data) }}/files/images/abstract-header.png" alt="footer.png" height="80px" width="98%" style="left: 1%;position:absolute;background-color: white;background-blend-mode: luminosity;"> --}}
            <table style="width:100%;">
                <thead>
                    <tr>
                        <th>ITEM</th>
                        <th>QUANTITY</th>
                        <th>UNIT</th>
                        <th>DESCRIPTION</th>
                        @foreach (json_decode($data)->suppliers as $supplier)
                            <th>{{ "Supplier" }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                  
                </tbody>
            </table>
        </div>
        <footer class="py-2">
            <div class="px-5" style="text-wrap:wrap;display:inline;">FM-FAD-14</div>
            
            <div class="px-5" style="text-wrap:wrap;display:inline;position:absolute;right:0;">10-01-17</div>
        </footer>
    </body>
</html>