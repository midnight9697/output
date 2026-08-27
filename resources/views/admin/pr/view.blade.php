<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token"
        content="CWK9gF43NFI3FNq6pLAZs5uOTYOtZsg88xU7EBMZ">

    <link rel="shortcut icon"
        href="images/favicon.svg"
        type="image/x-icon">

    <title>
        PURCHASE REQUEST -
        {{ json_decode($data)->request->office }}
    </title>

    <link rel="stylesheet"
        href="{{ (!$data ? $url . "/" : json_decode($data)->data . "/") }}bootstrap/bootstrap.min.css">

    <link rel="stylesheet"
        href="{{ (!$data ? $url . "/" : json_decode($data)->data . "/") }}css/main.css">

    {{--
    <link rel="stylesheet"
        href="{{ (!$data ? $url . "/" : json_decode($data)->data . "/") }}custom/css/app.css"
        type="text/css">
    --}}

    <style>

        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
            color: black;
            /* text-align: center */
        }

        body {
            font-size: 9px;
        }

        #preview {
            font-size: 9px;
        }

        footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            font-size: 9px;
            color: black;
            display: inline;
        }

        .item_columns {
            text-align: center;
            padding: 5px;
            /* display:inline-block */
        }

    </style>

</head>

<body>

    <div class="container text-dark"
        id="preview"
        style="padding-top:10px">

        <!-- HEADER IMAGE -->
        <img
            src="{{ (!$data ? $url : json_decode($data)->data) }}/files/images/pr header.png"
            alt="footer.png"
            height="80px"
            width="100%"
        >

        <table style="width:100%">

            <thead>

                <!-- APPENDIX / ENTITY -->
                <tr>

                    <th colspan="6">

                        <div style="text-align:right;">
                            Appendix 60
                        </div>

                        <div style="position:relative;height:13px">

                            <h6
                                class="d-inline"
                                style="
                                    left:0;
                                    position:absolute;
                                    font-weight:bold;
                                    font-size:9px;
                                "
                            >

                                Entity Name:

                                @if (!$data)

                                    _____________

                                @else

                                    <span style="border-bottom:solid 1px">
                                        {{ json_decode($data)->request->entity_name }}
                                    </span>

                                @endif

                            </h6>


                            <h6
                                class="d-inline px-1"
                                style="
                                    right:10px;
                                    position:absolute;
                                    font-weight:bold;
                                    font-size:9px;
                                "
                            >

                                Fund Cluster:

                                {{ (!$data
                                    ? "_____________"
                                    : json_decode($data)->request->fund_cluster
                                ) }}

                            </h6>

                        </div>

                    </th>

                </tr>


                <!-- OFFICE / PR NUMBER / DATE -->
                <tr>

                    <th colspan="2">

                        Office/Section:

                        {{ json_decode($data)->request->office }}

                    </th>


                    <th colspan="2">

                        <div>
                            PR No.:

                            {{ json_decode($data)->request->pr_number }}
                        </div>

                        <div>
                            Responsibility Center Code:

                            {{ json_decode($data)->request->responsibility_center_code }}
                        </div>

                    </th>


                    <th colspan="2">

                        Date:

                        {{ date(
                            'm d, Y',
                            strtotime(
                                json_decode($data)->request->created_in
                            )
                        ) }}

                    </th>

                </tr>


                <!-- COLUMN HEADERS -->
                <tr>

                    <th class="item_columns">
                        Stock/Property No.
                    </th>

                    <th class="item_columns">
                        Unit
                    </th>

                    <th class="item_columns">
                        Item Description
                    </th>

                    <th class="item_columns">
                        Quantity
                    </th>

                    <th class="item_columns">
                        Unit Cost
                    </th>

                    <th class="item_columns">
                        Total Cost
                    </th>

                </tr>

            </thead>


            <tbody>


                <!-- PURPOSE -->
                @if (json_decode($data)->request->purpose)

                    <tr>

                        <td class="item_columns"></td>

                        <td class="item_columns"></td>

                        <td class="item_columns">

                            {{ json_decode($data)->request->purpose }}

                        </td>

                        <td class="item_columns"></td>

                        <td class="item_columns"></td>

                        <td class="item_columns"></td>

                    </tr>

                @endif


                <!-- PURCHASE REQUEST ITEMS -->
                @foreach (json_decode($data)->request->purchase_request_items as $item)

                    <tr>

                        <td class="item_columns">

                            {{ $item->property_number }}

                        </td>


                        <td class="item_columns">

                            {{ $item->unit }}

                        </td>


                        <td class="item_columns">

                            {{ $item->item_description }}

                        </td>


                        <!-- FIXED QUANTITY -->
                        <td class="item_columns">

                            {{ number_format((float) $item->quantity) }}

                        </td>


                        <!-- FIXED UNIT COST -->
                        <td class="item_columns">

                            {{ number_format((float) $item->unit_cost, 2) }}

                        </td>


                        <!-- FIXED TOTAL COST -->
                        <td class="item_columns">

                            {{ number_format((float) $item->total_cost, 2) }}

                        </td>

                    </tr>

                @endforeach


                <!-- EMPTY ROWS -->
                @for (
                    $i = 0;
                    $i < (
                        16 -
                        count(
                            $data
                            ? json_decode($data)->request->purchase_request_items
                            : []
                        )
                    );
                    $i++
                )

                    <tr>

                        <td
                            style="
                                border-bottom:black solid 1px;
                                padding:9px
                            "
                        ></td>

                        <td
                            style="
                                border-bottom:black solid 1px;
                                padding:9px
                            "
                        ></td>

                        <td
                            style="
                                border-bottom:black solid 1px;
                                padding:9px
                            "
                        ></td>

                        <td
                            style="
                                border-bottom:black solid 1px;
                                padding:9px
                            "
                        ></td>

                        <td
                            style="
                                border-bottom:black solid 1px;
                                padding:9px
                            "
                        ></td>

                        <td
                            style="
                                border-bottom:black solid 1px;
                                padding:9px
                            "
                        ></td>

                    </tr>

                @endfor


                <!-- PURPOSE SECTION -->
                <tr>

                    <td colspan="6">

                        <div style="min-height:80px">

                            <label>
                                Purpose:
                            </label>

                            <h6 style="text-align:center">

                                {{ json_decode($data)->request->purpose }}

                            </h6>

                        </div>

                    </td>

                </tr>


                <!-- REQUESTED / APPROVED -->
                <tr>

                    <td
                        colspan="2"
                        style="
                            border:none;
                            padding-bottom:30px;
                        "
                    ></td>

                    <td
                        colspan="2"
                        style="
                            border:none;
                            padding-bottom:30px
                        "
                    >
                        Requested by:
                    </td>

                    <td
                        colspan="2"
                        style="
                            border:none;
                            padding-bottom:30px
                        "
                    >
                        Approved by:
                    </td>

                </tr>


                <!-- SIGNATURE -->
                <tr>

                    <td
                        colspan="2"
                        style="
                            border:none;
                            padding-left:10px
                        "
                    >
                        Signature:
                    </td>

                    <td
                        colspan="2"
                        style="
                            text-align:center;
                            border:none
                        "
                    >
                        ______________________________
                    </td>

                    <td
                        colspan="2"
                        style="
                            text-align:center;
                            border:none
                        "
                    >
                        ______________________________
                    </td>

                </tr>


                <!-- PRINTED NAME -->
                <tr>

                    <td
                        colspan="2"
                        style="
                            border:none;
                            padding-left:10px
                        "
                    >
                        Printed Name:
                    </td>

                    <td
                        colspan="2"
                        style="
                            text-align:center;
                            border:none;
                            font-weight:bold
                        "
                    >
                        ATTY. RODOLFO A. YODICO II
                    </td>

                    <td
                        colspan="2"
                        style="
                            text-align:center;
                            border:none;
                            font-weight:bold
                        "
                    >
                        ENGR. ALEX D. JIMENEZ
                    </td>

                </tr>


                <!-- DESIGNATION -->
                <tr>

                    <td
                        colspan="2"
                        style="
                            border:none;
                            padding-left:10px
                        "
                    >
                        Designation:
                    </td>

                    <td
                        colspan="2"
                        style="
                            text-align:center;
                            border:none
                        "
                    >
                        OIC-Chief, FAD and Concurrent Chief Legal Unit
                    </td>

                    <td
                        colspan="2"
                        style="
                            text-align:center;
                            border:none
                        "
                    >
                        Regional Director
                    </td>

                </tr>


                <!-- BOTTOM SPACE -->
                <tr>

                    <td
                        colspan="6"
                        style="height:19px"
                    ></td>

                </tr>

            </tbody>

        </table>

    </div>


    <!-- FOOTER -->
    <footer class="py-2">

        <div
            class="px-5"
            style="
                text-wrap:wrap;
                display:inline;
            "
        >
            FM-FAD-14
        </div>


        <div
            class="px-5"
            style="
                text-wrap:wrap;
                display:inline;
                position:absolute;
                right:0;
            "
        >
            10-01-17
        </div>

    </footer>

</body>

</html>