    <style>
        /* --- DOMPDF Optimized Styles --- */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            font-size: 10pt; /* Default text size */
        }

        /* --- Page Configuration --- */
        @page {
            margin: 1.5cm 1cm 3.0cm 1cm; /* Top, Right, Bottom, Left margins */
        }

        /* --- Fixed Header --- */
        #header {
            position: fixed;
            top: -1.5cm;
            left: 0;
            right: 0;
            height: 1.5cm;
            padding: 0 1cm;
            text-align: center;
        }
        .header-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 8pt;
        }
        .header-table td {
            vertical-align: top;
            padding: 0;
        }
        .header-table img {
            width: 60px;
            height: auto;
        }
        .header-title {
            text-align: center;
            line-height: 1.2;
            padding-left: 10px;
            padding-right: 10px;
        }
        .header-title h4 {
            margin: 0;
            font-size: 10pt;
            font-weight: bold;
            color: #000080;
        }
        .header-title p {
            margin: 0;
            font-size: 9pt;
            font-weight: bold;
        }
        .blue-underline {
            border-bottom: 2px solid #000080;
            display: inline-block;
            padding-bottom: 2px;
        }

        /* --- Fixed Footer --- */
        #footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            height: 3.0cm;
            padding: 0 1cm;
            font-size: 8pt;
            text-align: center;
        }
        .footer-line {
            padding-top: 5px;
            border-top: 1px solid #000;
            margin-bottom: 5px;
        }
        .footer-contact {
            line-height: 1.4;
            margin-bottom: 10px;
        }

        /* --- Main Content --- */
        #content {
            margin-top: 1.5cm;
            padding-bottom: 3.0cm;
        }
        .main-heading {
            text-align: center;
            margin-bottom: 20px;
        }
        .main-heading p {
            margin: 0;
            line-height: 1.2;
            font-weight: bold;
            font-size: 9pt;
        }
        .rfq-title {
            font-size: 11pt;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .conditions-list {
            margin-left: 0;
            padding-left: 0;
            list-style-type: none;
        }
        .conditions-list li {
            margin-bottom: 10px;
            text-align: justify;
        }
        .conditions-list span.number {
            float: left;
            width: 25px;
        }
        .conditions-list p.text {
            overflow: hidden;
            line-height: 1.4;
        }
        .highlight {
            font-weight: bold;
        }
        .submission-list {
            margin-left: 50px; /* Aligns with the list text above */
            margin-top: 5px;
            line-height: 1.5;
        }
        .note {
            color: red;
            font-style: italic;
            font-weight: bold;
            margin: 15px 0;
        }
        .signatory {
            margin-top: 50px;
        }
    </style>
    <div id="header">
        <table class="header-table">
            <tr>
                <td style="width: 15%;"><img src="path/to/philippine_logo.png" alt="Philippine Logo"></td>
                <td style="width: 70%;" class="header-title">
                    <p>Republic of the Philippines</p>
                    <p>Department of Environment and Natural Resources</p>
                    <h4 class="blue-underline">ENVIRONMENTAL MANAGEMENT BUREAU</h4>
                    <p>Regional Office VIII</p>
                </td>
                <td style="width: 15%; text-align: right;"><img src="path/to/bagong_pilipinas_logo.png" alt="Bagong Pilipinas Logo"></td>
            </tr>
        </table>
    </div>

    <div id="footer">
        <p style="font-size: 9pt; font-weight: bold; margin-bottom: 5px;">Protect the Environment | Protect Life</p>
        <div class="footer-contact">
            DENR 8 Compound, Brgy. 2, Jones Extension, Tacloban City, 6500<br>
            Tel. No. (053) 832-1088 (Admin) / (053) 888-0849 (Clerk) / 0917-885-3009 (Smart)<br>
            Email: <span style="color: #0000ff; text-decoration: underline;">em8red_records@emb.gov.ph</span>, Website: <span style="color: #0000ff; text-decoration: underline;">EMB8 Official</span><br>
            Facebook: <span style="color: #0000ff; text-decoration: underline;">www.facebook.com</span>
        </div>
        <table style="width: 100%; font-size: 8pt;">
            <tr>
                <td style="text-align: left;">FM-FAD-34</td>
                <td style="text-align: center;">00</td>
                <td style="text-align: right;">10-01-17</td>
            </tr>
        </table>
    </div>

    <div id="content">
        <div class="main-heading">
            <p>REQUEST FOR QUOTATION (RFQ)</p>
            <p style="font-style: italic; margin-bottom: 10px;">(Procurement Type)</p>
            <div class="rfq-title">PROJECT TITLE</div>
            <div class="rfq-title">RFQ NO.</div>
        </div>

        <ul class="conditions-list">
            <li>
                <span class="number">1.</span>
                <p class="text">The Department of Environment and Natural Resources – Environmental Management Bureau (DENR-EMB-R8) hereinafter referred to as the “Purchaser” now requests for submission of price quotations for the procurement of the aforesaid item described in the Technical Specifications.</p>
            </li>
            <li>
                <span class="number">2.</span>
                <p class="text">A set of technical specifications are provided in Attachment 1. <span class="highlight">Here</span></p>
            </li>
            <li>
                <span class="number">3.</span>
                <p class="text">All items listed under the Purchaser’s Specifications must be complied with on a pass-fail basis. Failure to meet any one of the requirements may result in rejection of the quotation. The Approved Budget for this contract is Php <span class="highlight">Here</span></p>
            </li>
            <li>
                <span class="number">4.</span>
                <p class="text">Small value procurement/Shopping procedures will be conducted in accordance with the provisions of the Implementing Rules and Regulations (IRR) of Republic Act 9184.</p>
            </li>
            <li>
                <span class="number">5.</span>
                <p class="text">It is the intent of the Purchaser to evaluate the bid/quotation on a <span class="highlight">here</span>, and an award will be made to the bid/quotation or combination of quotations resulting in the lowest evaluated quotation meeting the Purchaser’s technical specifications.</p>
            </li>
            <li>
                <span class="number">6.</span>
                <p class="text">Quotations must be delivered to the address below not later than <span class="highlight">here</span>.</p>
                <div style="margin-top: 10px; margin-left: 25px; line-height: 1.4;">
                    Department of Environment and Natural Resources<br>
                    Environmental Management Bureau<br>
                    Brgy 2, Jones St., Tacloban City
                </div>
            </li>
            <li>
                <span class="number">7.</span>
                <p class="text">Prices must be quoted in Philippine Peso and must include the <span class="highlight">unit price and total price, inclusive of all taxes to be paid and other incidental cost</span> to the delivery site/s if the contract is awarded.</p>
                <div style="margin-top: 10px; margin-left: 25px; line-height: 1.4;">
                    Bid/quotation may be typewritten or handwritten and may be placed in a sealed envelope marked <span class="highlight">“here”</span> or you may send your bid/quotation through e-mail at <span style="color: #0000ff; text-decoration: underline;">emb8r8_bacc@emb.gov.ph</span>. Late bids and proposals above $ABC$ shall be automatically disqualified.
                </div>
            </li>
            <li>
                <span class="number">8.</span>
                <p class="text">Bids/quotations shall be valid for sixty (60) calendar days from the deadline of submission of bids.</p>
            </li>
            <li>
                <span class="number">9.</span>
                <p class="text">The goods should be delivered <span class="highlight">here</span>. The supplier should inform the Purchaser at least three (3) days before the date of delivery. The delivery will be made only during working days and hours.</p>
            </li>
            <li>
                <span class="number">10.</span>
                <p class="text">The applicable rate for <span class="highlight">late deliveries is one tenth (1/10) of one (1) percent</span> of the cost of the unperformed part of the contract for every day of delay. The maximum deduction shall be ten percent (10%) of the amount of contract. Once the cumulative amount of liquidated damages reaches ten percent (10%) of the contract amount, the Purchaser shall rescind the contract without prejudice to other courses of action and remedies open to it.</p>
            </li>
            <li>
                <span class="number">11.</span>
                <p class="text">The Purchaser reserves the right to accept or reject any quotation, and to annul the bidding/shopping process or reject all quotations at any time prior to contract award, without thereby incurring any liability to the affected bidder/bidders. The Purchaser also reserves the right to waive minor deviations in the bid/quotation, <span style="font-weight: normal;">defects/or infirmities therein. A minor deviation/defect or infirmity is one that does not materially affect the overall functionality of the material and the capability of the supplier to perform the contract.</span></p>
            </li>
            <li>
                <span class="number">12.</span>
                <p class="text">The prospective bidder shall submit the following:</p>
                <ol type="a" class="submission-list">
                    <li><span class="highlight">Quotation Form / Technical Specifications</span>;</li>
                    <li><span class="highlight">Latest Mayor/Business Permit</span>;</li>
                    <li><span class="highlight">Income Tax Return</span>;</li>
                    <li><span class="highlight">PhilGEPS Registration Number</span>;</li>
                    <li><span class="highlight">Certificate of Registration/BIR Form 2303</span>;</li>
                    <li><span class="highlight">Omnibus Sworn Statement</span> original & notarized ($ABC$ above $500,000.00$);</li>
                </ol>
            </li>
        </ul>

        <div class="note" style="margin-left: 25px;">
            Note: Existing suppliers with UPDATED documentary requirements on file are no longer<br>
            required to submit.
        </div>

        <div class="signatory" style="margin-left: 25px;">
            <p style="font-weight: bold; margin-bottom: 2px;">BAC CHAIRMAN</p>
            <p>BAC Chairperson</p>
        </div>
    </div>