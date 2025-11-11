<style>
    @page {
        /* display:inline-block; */
        margin-bottom:none;
        margin-top:10px;
    }
    thead {
        display: table-header-group; /* default behavior */
    }

    thead {
        display: table-row-group !important; /* prevent repeating */
    }
    .table-container {
        width: 100%;       /* div takes full width of parent */
        max-width: 100%;   /* prevents overflow */
        /* font-size: clamp(30px, 100px, 60px) !important;  */
        /* -webkit-text-size-adjust: 10%; */
        transform-origin:center top;
        font-family: "Helvetica", sans-serif;
    }
    /* table, th, td {
        border: 1px solid black;
        color:black;
        text-align:center;
        padding:5px;
    } */
    .table-container table {
        width: 100%;
        /* table-layout: fixed; */
        border-collapse: collapse;
        /*font-size: clamp(2rem, 10%, 4rem); text scales between 12px and 16px */
    }

    .table-container th,
    .table-container td {
        padding: 8px;
        border: 1px solid #524c4c;
        word-wrap: break-word;  /* wraps long content inside cell */
        white-space: normal;    /* allows text to wrap */
        text-align: center;
        font-size: 12;
    }
    
    table, tr, td, th {
        page-break-inside: auto !important;
        break-inside: auto !important;
    }
    /* td:nth-child(2) { width: 7%; }
    td:nth-child(4) { width: 30%; } */
</style>
    {{-- <div class="table-container" id="content" style=" transform: scale({{ (isset(json_decode($data)->scaleX)?json_decode($data)->scaleX:1) }});"> --}}
    <div>
        <img src="{{ (!$data?$url:json_decode($data)->data) }}/files/images/abstract-header.png" alt="footer.png" height="80px"style="left: 0;right: 0;background-color: white;background-blend-mode: luminosity;width:100%;margin-bottom:10px">
    </div>
   
    <div class="table-container">
        @include('admin.abstract.abstract-details', ['left_value' => 'PR2025-02-001', 'left' => 'Office/End-user', 'right' => 'PR No.', 'right_value' =>  json_decode($data)->abstract->quotation->purchase_requst->pr_number])
        @include('admin.abstract.abstract-details', ['left_value' => json_decode($data)->abstract->quotation->project_purpose, 'left' => 'Project Name', 'right' => 'PR Date', 'right_value' => date('Y-m-d', strtotime(json_decode($data)->abstract->quotation->purchase_requst->created_at))])
        @include('admin.abstract.abstract-details', ['left_value' => '', 'left' => 'Funding Source', 'right' => 'RFQ No.', 'right_value' => json_decode($data)->abstract->quotation->rfq_number])
        @include('admin.abstract.abstract-details', ['left_value' => (json_decode($data)->abstract->quotation->classification), 'left' => 'Mode of Procurement', 'right' => 'Date of Opening'])
        @include('admin.abstract.abstract-details', ['left_value' => '', 'left' => 'ABC', 'right' => 'Time'])
        <table>
            <thead>
                <tr>
                    <th rowspan="2">ITEM</th>
                    <th rowspan="2">QUANTITY</th>
                    <th rowspan="2">UNIT</th>
                    <th rowspan="2" style="min-width: 300px">DESCRIPTION</th>
                    @foreach (json_decode($data)->suppliers as $supplier)
                        <th colspan="2">{{ $supplier->name }}</th>
                    @endforeach
                </tr>
               <tr>
                    @foreach (json_decode($data)->suppliers as $supplier)
                        <th>UNIT COST</th>
                        <th>TOTAL COST</th>
                    @endforeach
               </tr>
            </thead>
            <tbody>
                @foreach (json_decode($data)->items as $key => $item)
                    @php
                        $abstract_items = $item->abstract_items;
                    @endphp
                    <tr>
                        <td>{{ ($key+1) }}</td>
                        <td>{{ $item->quantity_unit }}</td>
                        <td>{{ "N/A" }}</td>
                        <td>{{ $item->specification }}</td>
                        @foreach (json_decode($data)->suppliers as $supplier)
                            @php
                                $bidders = array_filter($abstract_items, function($abstract_item) use($supplier) {
                                    return $abstract_item->supplier->name == $supplier->name;
                                });
                                $bidder = null;
                                if (count($bidders) > 0) {
                                    $bidder = $bidders[array_keys($bidders)[0]];
                                }
                            @endphp
                            <td>{{ $bidder?$bidder->unit_cost: ""}}</td>
                            <td>{{ $bidder?$bidder->total_cost: ""}}</td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <table style="width:100%;margin-top:30px;font-size:12px">
        <thead>
            <tr>
                <td>Prepared by:</td>
                <td>Conforme (End-user):</td>
                <td colspan="2">Recommending Approval:</td>
            </tr>
            <tr>
                <td style="height: 100px;text-align:center">
                    <div style="text-wrap:wrap">
                        <p style="margin:0px;text-decoration:underline;font-weight:bold">JANE C. NOVEDA</p>
                        <small>Support Staff</small>
                    </div>
                </td>
                <td style="font-weight:bold;text-align:center">
                    <p style="margin:0px;text-decoration:underline;font-weight:bold">ATTY. RODOLFO A. YODICO, II</p>
                    <small>|</small>
                </td>
                <td style="font-weight:bold;text-align:center">
                    <p style="margin:0px;text-decoration:underline;font-weight:bold">ENGR.VENUS V. BAUTISTA</p>
                    <small>Member, BAC</small>
                </td>
                <td style="font-weight:bold;text-align:center">
                    <p style="margin:0px;text-decoration:underline;font-weight:bold">ENGR.LIZA A. TAN</p>
                    <small>Member, BAC</small>
                </td>
            </tr>
            <tr>
                <td></td>
                <td colspan="3">Canvassed by:</td>
            </tr>
            <tr>
                <td>

                </td>
                <td style="text-align:center;">
                    <p style="margin:0px;text-decoration:underline;font-weight:bold">EIVER KY C. VILLEGAS</p>
                    <small>Canvasser</small>
                </td>
                <td style="text-align:center;font-weight:bold">
                    <p style="margin:0px;text-decoration:underline;font-weight:bold">ENGR. ALEX D. JIMENEZ</p>
                    <small>Chairperson, BAC</small>
                </td>
            </tr>
            <tr>
                <td></td>
                <td colspan="3">Checked by:</td>
            </tr>
            <tr>
                <td>
                    
                </td>
                <td style="text-align:center;">
                    <p style="margin:0px;text-decoration:underline;font-weight:bold">ENGR. NOEL C. CABIAO</p>
                    <small>Head, Property and Supply Unit</small>
                </td>
                <td style="text-align:center;">
                    <p style="margin:0px;text-decoration:underline;font-weight:bold">ENGR. ALEX D. JIMENEZ</p>
                    <small> Regional Director</small>
                </td>
            </tr>
        </thead>
    </table>