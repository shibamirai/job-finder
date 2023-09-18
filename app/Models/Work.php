<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Work extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = ['period_of_creation'];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(JobFinder::class);
    }

    public function periodOfCreation(): Attribute
    {
        return new Attribute(
            get: function () {
                if ($this->creation_time) {
                    return ($this->creation_time >= 12 ? floor($this->creation_time / 12) . '年' : '') . $this->creation_time % 12 . 'ヶ月';
                } else {
                    return '制作期間不明';
                }
            }
        );
    }
}
