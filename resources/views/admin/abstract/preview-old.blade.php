<style>
    .table-container {
      width: 100%;       /* div takes full width of parent */
      max-width: 100%;   /* prevents overflow */
      /* font-size: clamp(30px, 100px, 60px) !important;  */
      /* -webkit-text-size-adjust: 10%; */
    }
    /* table, th, td {
        border: 1px solid black;
        color:black;
        text-align:center;
        padding:5px;
    } */
    .table-container table {
        width: 100%;
        table-layout: fixed;
        border-collapse: collapse;
        /*font-size: clamp(2rem, 10%, 4rem); text scales between 12px and 16px */
    }
    .table-container th,
    .table-container td {
        padding: 8px;
        border: 1px solid #ccc;
        word-wrap: break-word;  /* wraps long content inside cell */
        white-space: normal;    /* allows text to wrap */
    }
</style>
<div style="font-size: clamp(2px, 5vw, 12px) !important;">
        <div class="table-container">
            {{-- <img src="{{ (!$data?$url:json_decode($data)->data) }}/files/images/abstract-header.png" alt="footer.png" height="80px" width="98%" style="left: 1%;position:absolute;background-color: white;background-blend-mode: luminosity;"> --}}
                <table>
                    <thead>
                        <tr>
                            <th>ITEM</th>
                            <th>QUANTITY</th>
                            <th>UNIT</th>
                            <th style="min-width: 500px">DESCRIPTION</th>
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
</div>