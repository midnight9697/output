<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\RFQ;
use App\Models\RFQItem;
use App\Models\RFQTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class RFQController extends Controller {
    protected $attachment_path = "public/rfq";

    public function deleteRFQ(Request $request) {
        $id = decryptUrlSafe($request->id);
        if (!Gate::allows('rfq-update-view', $request->id)) {
            abort('403', 'Unauthorized Action');
        }
        return RFQ::where('id', $id)->delete();
    }
    
    public function delete_rfq(Request $request) {
        $id = decryptUrlSafe($request->id);
        if (!Gate::allows('rfq-update-view', $request->id)) {
            abort('403', 'Unauthorized Action');
        }
        RFQ::where('id', $id)->delete();
    }
    
    public function update_rfq(Request $request) {
        $id = decryptUrlSafe($request->id);
        if (!Gate::allows('rfq-update-view', $request->id)) {
            abort('403', 'Unauthorized Action');
        }
        $this->uploadUpdate($request);
        $rfq = RFQ::where('id', $id)->update([
            'project_purpose' => $request->project_purpose,
            'rfq_number' => $request->rfq_number, //date('y-m')+'-'.str_pad((RFQ::count() + 1), 3, '0',STR_PAD_LEFT),
            'attachment_one' => $request->attachment_one,
            'aproved_budget' => $request->aproved_budget,
            'standard_unit' => $request->standard_unit,
            'target_delivery_date' => $request->target_delivery_date,
            'classification' => $request->classification,
            'remarks' => $request->remarks,
        ]);

        $items = json_decode($request->items);
        $new_item_ids = [];
        foreach ($items as $item) {
            if (!isset($item->id)) {
                $new_item = RFQItem::create([
                    'rfq_id' => $id,
                    'specification' => $item->specification,
                    'bidder_specs' => $item->bidder_specs,
                    'quantity_unit' => $item->quantity_unit,
                    'unit_price' => $item->unit_price,
                    'total_price' => $item->total_price,
                ]);
                array_push($new_item_ids, $new_item->id);
            }
            else {
                RFQItem::where('id', decryptUrlSafe($item->id))->update([
                    'specification' => $item->specification,
                    'bidder_specs' => $item->bidder_specs,
                    'quantity_unit' => $item->quantity_unit,
                    'unit_price' => $item->unit_price,
                    'total_price' => $item->total_price,
                ]);
                array_push($new_item_ids, decryptUrlSafe($item->id));
            }
        }
        RFQItem::whereNotIn('id', $new_item_ids)->where('rfq_id', $id)->delete();
        return ['success', $rfq];
    }

    public function create_rfq(Request $request) {
        $rfq = RFQ::create([
            'project_purpose' => $request->project_purpose,
            'pr_id' => decryptUrlSafe($request->pr_id),
            'rfq_number' => date('y-m')+'-'.str_pad((RFQ::count() + 1), 3, '0',STR_PAD_LEFT),
            'attachment_one' => $request->attachment_one,
            'aproved_budget' => $request->aproved_budget,
            'standard_unit' => $request->standard_unit,
            'target_delivery_date' => $request->target_delivery_date,
            'classification' => $request->classification,
            'creator' => Auth::user()->id,
            'remarks' => $request->remarks,
        ]);

        $items = $request->items;

        foreach ($items as $item) {
            RFQItem::create([
                'rfq_id' => $rfq->id,
                'specification' => $item['specification'],
                'bidder_specs' => $item['bidder_specs'],
                'quantity_unit' => $item['quantity_unit'],
                'unit_price' => $item['unit_price'],
                'total_price' => $item['total_price'],
            ]);
        }
        return ['success', $rfq];
    }

    public function create_rfq_template(Request $request) {
        $data = $request->input('contents');
        $rfq = RFQTemplate::create([
            'contents' => $data,
        ]);
        return ['success'];
    }

    public function fetch_template() {
        $rfq = RFQTemplate::get();
        return encryptSingle($rfq);
    }

    public function countRFQ() {
        return response()->json(['data' => RFQ::orderByDesc('created_at')->count()]);;
    }

    public function fetch_rfq(Request $request) {
        if (isset($request->ids)) {
            $id = decryptUrlSafe($request->ids);
            return encryptMany(RFQItem::where('rfq_id', $id)->with('quotation')->get());
        }
        else {
            $id = decryptUrlSafe($request->id);
        }
        $rfq = RFQ::where('id', $id)->with('items')->first();
        return encryptSingle($rfq);
    }

    public function fetch_by_page() {
        $rfqs = RFQ::where('creator', Auth::user()->id)->has('items')->orderByDesc('created_at');
        return encryptIds($rfqs);
    }

    public function uploadUpdate(Request $request) {
        $rfq_id = decryptUrlSafe($request->rfq_id);
        $fakename = RFQ::where('id', $rfq_id);
        if (!$fakename->exists()) {
            return [null];
        }
        $fakename = 'RFQ-'.RFQ::where('id', $rfq_id)->first()->rfq_number;
        $files = Storage::files($this->attachment_path."/".$fakename); // folder path relative to disk
        $fileCount = count($files);
        $uniq_name = $fakename."-".($fileCount+1);
        $file = $request->file('rfq_file');
        $extension = $file->getClientOriginalExtension();
        $request->file('rfq_file')->storeAs($this->attachment_path."/".$fakename, $uniq_name.".".$extension, 'local');
        $uploadedFile = $request->file('rfq_file');
        $filenameWithoutExtension = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
        $new_file_data = [
            'title' => $filenameWithoutExtension,
            'filename' => $fakename,
            'unique' => $uniq_name,
            'origin' => $request->filename,
            'filetype' => $extension,
            'creator' => Auth::user()->id,
        ];

        return ['Success' => 'shit', 'data' => $new_file_data];
    }
}
