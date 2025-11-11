<div style="font-size:12;margin-bottom:5px;font-weight:bold;">
    <div style="width:49%; display:inline-block; vertical-align:top;">
        <div style="width:200px;display:inline-block">
            {{ $left }}:
        </div>
        <div style="display: inline-block;text-decoration:underline">
            {{ $left_value }}
        </div>
    </div>
    <div style="width:49%; display:inline-block; vertical-align:top;text-align:right">
        <div style="width:125px;display:inline-block">
            {{ $right }}:
        </div>
        <div style="display: inline-block;text-decoration:underline">
            {{ isset($right_value)?$right_value:"" }}
        </div>
    </div>
</div> 