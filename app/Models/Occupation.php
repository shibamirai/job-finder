<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Occupation extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    // MySQL では boolean は 0/1でセットされる
    // Vue では checkbox の値は true/false がセットされるため
    // ここで 0/1 を boolean にキャストする
    protected $casts = [
        'is_it' => 'boolean',
    ];

    public function workers(): HasMany
    {
        return $this->hasMany(JobFinder::class);
    }
}
