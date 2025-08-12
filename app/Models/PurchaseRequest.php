<?php

namespace App\Models;

use Carbon\Carbon;
use Database\Factories\PRFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseRequest extends Model
{
    use HasFactory;

    protected static function  newFactory() {
        return PRFactory::new();
    }

    protected $fillable = [
        'entity_name',
        'fund_cluster',
        'office',
        'pr_number',
        'responsibility_center_code',
        'purpose',
        'created_by',
        'created_at'
    ];

    public function purchase_request_items() {
        return $this->hasMany(PRItem::class, 'purchase_request_id');
    }

    public function members() {
        return $this->hasMany(Member::class);
    }

    protected function createdAtFormatted(): Attribute {
        return Attribute::make(
            get: fn ($value, $attributes) => Carbon::parse($attributes['created_at'])->format('H:i d, M Y'),
        );
    }

    public function getCreatedAtFormattedAttribute() {
        return $this->created_at->format('H:i d, M Y');
    }

    public function getPrIdAttribute() {
        return encryptUrlSafe($this->id);
    }
}
