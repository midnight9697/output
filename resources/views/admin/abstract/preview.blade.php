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
            thead, th, td {
                border: solid black 1px;
                text-align:center;
                padding: 5px;
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
                            <th colspan="2">{{ $supplier->name }}</th>
                        @endforeach
                    </tr>
                   <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        @foreach (json_decode($data)->suppliers as $supplier)
                            <th style="width:120px">UNIT COST</th>
                            <th style="width:120px">TOTAL COST</th>
                        @endforeach
                   </tr>
                </thead>
                <tbody>
                    @foreach (json_decode($data)->abstract->abstract_items as $key => $abstract_item)
                        <tr>
                            <td>{{ ($key+1) }}</td>
                            <td>{{ $abstract_item->item->quantity_unit }}</td>
                            <td>{{ "N/A" }}</td>
                            <td>{{ $abstract_item->item->specification }}</td>
                            @foreach (json_decode($data)->suppliers as $supplier)
                                @php
                                    $bidder = ($supplier->name === $abstract_item->supplier->name);
                                @endphp
                                <td>{{ $bidder?$abstract_item->unit_cost: ""}}</td>
                                <td>{{ $bidder?$abstract_item->total_cost: ""}}</td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <footer class="py-2">
            <div class="px-5" style="text-wrap:wrap;display:inline;">FM-FAD-14</div>
            
            <div class="px-5" style="text-wrap:wrap;display:inline;position:absolute;right:0;">10-01-17</div>
        </footer>
    </body>
</html>