<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="CWK9gF43NFI3FNq6pLAZs5uOTYOtZsg88xU7EBMZ">
        <link rel="shortcut icon" href="images/favicon.svg" type="image/x-icon">
        <title>PURCHASE REQUEST - {{ json_decode($data)->request->office }}</title>
        <link rel="stylesheet" href="{{ (!$data?$url."/":json_decode($data)->data."/") }}bootstrap/bootstrap.min.css">
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
        <div class="container text-dark" id="preview" style="padding-top:10px">
            <img src="{{ (!$data?$url:json_decode($data)->data) }}/files/images/pr header.png" alt="footer.png" height="80px" width="100%">
            <table style="width:100%">
                <thead>
                    <tr>
                        <th colspan="6">
                            <div style="text-align:right;">Appendix 60</div>
                            <div style="position:relative;height:13px">
                                <h6 class="d-inline" style="left:0;position: absolute;font-weight:bold;font-size:9">Entity Name: {{ (!$data?"_____________":`<div style="border-bottom: solid 1px">`.json_decode($data)->request->entity_name.`</div>`) }}</h6>
                                <h6 class="d-inline px-1" style="right:10;position:absolute;font-weight:bold;font-size:9">Fund Cluster: {{ (!$data?"_____________":json_decode($data)->request->fund_cluster) }}</h6>
                            </div>
                        </th>
                    </tr>
                    <tr>
                        <th colspan="2">Office/Section: {{ json_decode($data)->request->office }}</th>
                        <th colspan="2">
                            <div>PR No.: {{ json_decode($data)->request->pr_number }}</div>
                            <div>Responsibility Center Code: {{ json_decode($data)->request->responsibility_center_code }}</div>
                        </th>
                        <th colspan="2">
                            Date: {{ date('m d, Y', strtotime(json_decode($data)->request->created_in)) }}
                        </th>
                    </tr>
                    <tr>
                        <th class="item_columns">Stock/Property No.</th>
                        <th class="item_columns">Unit</th>
                        <th class="item_columns">Item Description</th>
                        <th class="item_columns">Quantity</th>
                        <th class="item_columns">Unit Cost</th>
                        <th class="item_columns">Total Cost</th>
                    </tr>
                </thead>
                <tbody>
                    @if (json_decode($data)->request->purpose)
                        <tr>
                            <td class="item_columns"></td>
                            <td class="item_columns"></td>
                            <td class="item_columns">{{ json_decode($data)->request->purpose }}</td>
                            <td class="item_columns"></td>
                            <td class="item_columns"></td>
                            <td class="item_columns"></td>
                        </tr>
                    @endif
                    @foreach (json_decode($data)->request->purchase_request_items as $item)
                        <tr>
                            <td class="item_columns">{{ $item->property_number }}</td>
                            <td class="item_columns">{{ $item->unit }}</td>
                            <td class="item_columns">{{ $item->item_description }}</td>
                            <td class="item_columns">{{ number_format($item->quantity) }}</td>
                            <td class="item_columns">{{ number_format($item->unit_cost, 2) }}</td>
                            <td class="item_columns">{{ number_format($item->total_cost, 2) }}</td>
                        </tr>
                    @endforeach
                    @for ($i = 0; $i < (16 - count($data?json_decode($data)->request->purchase_request_items:[])); $i++)
                    <tr>
                        <td style="border-bottom: black solid 1px;padding: 9px"></td>
                        <td style="border-bottom: black solid 1px;padding: 9px"></td>
                        <td style="border-bottom: black solid 1px;padding: 9px"></td>
                        <td style="border-bottom: black solid 1px;padding: 9px"></td>
                        <td style="border-bottom: black solid 1px;padding: 9px"></td>
                        <td style="border-bottom: black solid 1px;padding: 9px"></td>
                    </tr>
                    @endfor
                    <tr>
                        <td colspan="6">
                            <div class="display:relative">
                                <div class="display:flex;justify-content:space-between">
                                    <div>Bro</div>
                                    <div>Bro</div>
                                    <div>Bro</div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6">
                           <div style="min-height:80px">
                            <label>Purpose:</label>
                            <h6 style="text-align: center">
                                {{ json_decode($data)->request->purpose }}
                            </h6>
                           </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6">
                            <div class="row">
                                <div class="col-md-4">
                                    <p>Signature by:</p>
                                    <p>Printed name</p>
                                    <p>Designation</p>
                                </div>
                                <div class="col-md-4">
                                    <p>Requested by:</p>
                                    <p>ATTY. RODOLFO A. YODICO II</p>
                                    <p><small>OIC-Chief, FAD and Concurrent Chief Legal Unit</small></p>
                                </div>
                                <div class="col-md-4">
                                    <p>Approved by:</p>
                                    <p>ENGR. ALEX D. JIMENEZ</p>
                                    <p>Regional Director</p>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6" style="height:19px"></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <footer class="py-2">
            <div class="px-5" style="text-wrap:wrap;display:inline;">FM-FAD-14</div>
            
            <div class="px-5" style="text-wrap:wrap;display:inline;position:absolute;right:0;">10-01-17</div>
        </footer>
    </body>
</html>