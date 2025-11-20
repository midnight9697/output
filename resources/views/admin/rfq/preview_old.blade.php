<style>
    .table-container {
        font-size:11pt;
        text-align:center;
        color:black
    }

    .textL {
        text-align: start;
    }

    .textR {
        text-align: end;
    }


    .textWeightNormal {
        font-weight: normal;
    }

    .goldStyleBold {
        font-family: "Goldstyle-Bold";
        src: url("fonts/Goudy Old Style Bold Italic BT.ttf") format("truetype");
    }

    .bookmanOldStyleBold {
        font-family: "BookmanOldStyle";
        src: url("fonts/bookman-old-style.ttf") format("truetype");
        font-weight: bold;
    }
    
    .bookmanOldStyle {
        font-family: "BookmanOldStyle";
        src: url("fonts/bookman-old-style.ttf") format("truetype");
        font-style: normal;
    }

    .arialBold {
        font-family: 'Arial', sans-serif;
        font-weight: bold;
    }

    .arial {
        font-family: 'Arial', sans-serif;
    }

    .noSpace {
        padding: 0px;
        margin: 0pc;
    }

    .marginTopBig {
        margin-top: 80px;
    }

    .marginTop {
        margin-top: 40px;
    }

    .marginSE {
        margin-left: 72pt;
        margin-right: 72pt;
    }
    .underline {
        text-decoration: underline;
    }

    .colSpacing {
        padding-bottom:20px;
    }

    .verticalTop {
        vertical-align: top;
    }

    .colNumber {
        width: 50px;
    }
    * {
        margin: 0;
        padding: 0;
    }
</style>
<div>
    <img src="{{ (!$data?$url:json_decode($data)->data) }}/files/images/rfq-header.png" alt="footer.png" style="left: 0;right: 0;background-color: white;background-blend-mode: luminosity;width:100%;margin-bottom:10px;">
</div>
<div class="table-container">
    <div class="marginTopBig">
        <h2 class="bookmanOldStyleBold noSpace">REQUEST FOR QUOTATION (RFQ)</h2>
        <h2 class="bookmanOldStyleBold noSpace">(NP-53.10 Lease of Real Property and Venue)</h2>
    </div>
    <div class="marginTop marginSE">
        <h2 class="bookmanOldStyleBold noSpace">Provision of Meals with Venue and Accommodation for the Conduct of 2025 Case Inventory and Site Assessment with Participants from EMB Region 6 to Region 13, PAB Members and Secretariat on October 21-24, 2025</h2>
        <h2 class="underline">RFQ NO. 25-09-162</h2>
    </div>
    <div class="marginTop marginSE textL bookmanOldStyle" style="border: solid: 1px">
           <table style="width: 100%;margin:10px">
            @foreach (json_decode($data)->arrays as $key => $rule)
                <tr>
                    <td class="verticalTop colNumber">{{ ($key+1) }}.</td>
                    <td class="verticalTop colSpacing">
                        <h3 class="textWeightNormal">
                            {{ $rule }}
                        </h3>
                    </td>
                </tr>
            @endforeach
                
           </table>
    </div>
</div>