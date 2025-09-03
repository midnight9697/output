<?php

use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Schema;
use Yajra\DataTables\Facades\DataTables;

use function PHPUnit\Framework\isNull;

function encryptUrlSafe($value) {
    $encrypted = Crypt::encryptString($value);
    return rtrim(strtr(base64_encode($encrypted), '+/', '-_'), '=');
}

function decryptUrlSafe($value) {
    $encrypted = base64_decode(strtr($value, '-_', '+/'));
    $result = false;
    try {
        $result = Crypt::decryptString($encrypted);
    } catch (\Illuminate\Contracts\Encryption\DecryptException) {
        abort(403, 'Unauthorize action.');
    }
    return $result;
}

function encryptIds($data) {
    return DataTables::of ($data)
        ->editColumn('id', function($res) {
            return encryptUrlSafe($res->id);
        })
        ->editColumn('created_at', function($res) {
            return date('M d, Y', strtotime($res->created_at));
        })
        ->make(true);
}

function encryptSingle($data) {
    $keys = json_decode($data);
    $keys = get_object_vars($keys);
    $converted = (object)[];
    foreach ($keys as $key => $value) {
        $value = ($value == null?"":$value);
        if ($key == "created_at") {
            $converted->{'created_for'} = date('m-d-Y h:i a', strtotime($value));
        }
        $merge = $key;
        $reflect = new ReflectionClass($data->getModel());
        $methods = $reflect->getMethods();
        $method_names = [];
        foreach ($methods as $k => $method) {
            $method_names[] = $method->getName();
        }

        $spt = explode("_", $key);
        $i = 0;
        foreach ($spt as $sp) {
            if ($i > 0) {
                $spt[$i] = ucfirst($sp);
            }
            $i++;
        }
        $merge = implode("", $spt);
        if (!in_array($merge, $method_names)) {
           $merge = $key;
        }
        
        if (!in_array($key, $method_names)) {
            $merge = $key;
        }
        if (is_object($data->{$merge}) || is_object($data->{$key})) {
            if (is_object($data->{$key})) {
                $merge = $key;
            }
            
            if (isset($value->id)) {
                $value = encryptSingle($data->{$merge}->getModel());
            }
            
            $type = (is_string($value)?true:(is_int($value)?true:false));
            if ($type == false) {
                echo "Null daw => ". $value;
                $value = encryptMany((object)$value);
            }
        }
        
        // echo $merge."<br>";
        if (is_array($data->{$merge}) || is_array($data->{$key})) {
            if (is_array($data->{$key})) {
                $merge = $key;
            }
            
            $value = encryptMany($data->{$merge});
        }
        $converted->{$key} = ($key == 'id'?encryptUrlSafe($value):$value);
    }
    // echo json_encode($converted);
    return (object)$converted;
}

function encryptMany($data) {
    $converted = [];
    foreach ($data as $object) {
        array_push($converted, encryptSingle($object));
    }
    return $converted;
}

function transactionBodies() {
        return (object)[
        'initiate' => 'initiated the request',
        'update' => 'changed the details of the purchase request',
        'update_with_items' => 'Modified the purchase request and added a new participant',
    ];
}