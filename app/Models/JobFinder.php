<?php

namespace App\Models;

use App\Enums\EmploymentPattern;
use App\Enums\Gender;
use DateTime;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JobFinder extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'gender' => Gender::class,
        'employment_pattern' => EmploymentPattern::class,
        'has_certificate' => 'boolean',
        'is_handicaps_opened' => 'boolean',
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function scopeFilter($query, array $filters)
    {
        $query->when(
            $filters['search'] ?? false,
            fn ($query, $search) => $query->where('name', 'like', '%' . $search . '%')
                ->orWhereHas(
                    'occupation',   
                    function ($query) use ($search) {
                        $query->where('name', 'like', '%' . $search . '%');
                    }
                )
        );
    }

    public function skills(): BelongsToMany
    {
        return $this->belongsToMany(Skill::class);
    }

    public function occupation(): BelongsTo
    {
        return $this->belongsTo(Occupation::class);
    }

    public function works(): HasMany
    {
        return $this->hasMany(Work::class);
    }

    public function handicaps(): BelongsToMany
    {
        return $this->belongsToMany(Handicap::class);
    }

    public function genderLabel(): Attribute
    {
        return new Attribute(
            get: fn () => $this->gender->label()
        );
    }

    public function employmentPatternLabel(): Attribute
    {
        return new Attribute(
            get: fn () => $this->employment_pattern->label()
        );
    }

    public function hired(): Attribute
    {
        return new Attribute(
            get: fn () => date('Y年m月', strtotime($this->hired_at))
        );
    }

    public function periodOfUse(): Attribute
    {
        return new Attribute(
            get: function () {
                $diff = date_diff(
                    new DateTime($this->use_from),
                    new DateTime($this->hired_at)
                );
                return ($diff->y > 0 ? $diff->y . '年' : '') . $diff->m . 'ヶ月';
            }
        );
    }
}
