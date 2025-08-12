<?php

use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Facades\DataTables;

function encryptUrlSafe($value) {
    $encrypted = Crypt::encryptString($value);
    return rtrim(strtr(base64_encode($encrypted), '+/', '-_'), '=');
}

function decryptUrlSafe($value) {
    $encrypted = base64_decode(strtr($value, '-_', '+/'));
    return Crypt::decryptString($encrypted);
}

function encryptIds($data) {
    return DataTables::of ($data)
        ->editColumn('id', function($res) {
            return encryptUrlSafe($res->id);
        })->make(true)
        ->editColumn('created_at', function($res) {
            return date('m-d-Y', strtotime($res->created_at));

        });
}

function encryptSingle($data) {
    $keys = json_decode($data);
    $keys = get_object_vars($keys);
    $converted = (object)[];
    foreach ($keys as $key => $value) {
        $value = ($value == null?"":$value);
        $value = ($key == "created_at"?date('m-d-Y', strtotime($value)):$value);
        $converted->{$key} = ($key == 'id'?encryptUrlSafe($value):$value);
    }
    return (object)$converted;
}

function encryptMany($data) {
    $converted = [];
    foreach ($data as $object) {
        array_push($converted, encryptSingle($object));
    }
    return $converted;
}