<?php

namespace App\Models;

use Database\Factories\ComplaintFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Complaint extends Model
{
    /** @use HasFactory<ComplaintFactory> */
    use HasFactory;

    public const STATUS_WAITING = 'Menunggu Verifikasi';
    public const STATUS_PROCESS = 'Diproses';
    public const STATUS_DONE = 'Selesai';
    public const STATUS_REJECTED = 'Ditolak';

    public const STATUSES = [
        self::STATUS_WAITING,
        self::STATUS_PROCESS,
        self::STATUS_DONE,
        self::STATUS_REJECTED,
    ];

    protected $fillable = [
        'user_id',
        'category_id',
        'province_id',
        'province_name',
        'regency_id',
        'regency_name',
        'district_id',
        'district_name',
        'village_id',
        'village_name',
        'title',
        'description',
        'photo',
        'address',
        'latitude',
        'longitude',
        'complaint_date',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'complaint_date' => 'date',
            'latitude' => 'decimal:7',
            'longitude' => 'decimal:7',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function responses(): HasMany
    {
        return $this->hasMany(Response::class);
    }

    public function scopeFilter(Builder $query, array $filters): Builder
    {
        return $query
            ->when($filters['search'] ?? null, function (Builder $query, string $search): void {
                $query->where(function (Builder $query) use ($search): void {
                    $query->where('title', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%")
                        ->orWhere('address', 'like', "%{$search}%");
                });
            })
            ->when($filters['category_id'] ?? null, fn (Builder $query, string $category) => $query->where('category_id', $category))
            ->when($filters['status'] ?? null, fn (Builder $query, string $status) => $query->where('status', $status))
            ->when($filters['province_id'] ?? null, fn (Builder $query, string $province) => $query->where('province_id', $province))
            ->when($filters['regency_id'] ?? null, fn (Builder $query, string $regency) => $query->where('regency_id', $regency))
            ->when($filters['date_from'] ?? null, fn (Builder $query, string $date) => $query->whereDate('complaint_date', '>=', $date))
            ->when($filters['date_to'] ?? null, fn (Builder $query, string $date) => $query->whereDate('complaint_date', '<=', $date))
            ->when($filters['month'] ?? null, fn (Builder $query, string $month) => $query->whereMonth('complaint_date', $month))
            ->when($filters['year'] ?? null, fn (Builder $query, string $year) => $query->whereYear('complaint_date', $year));
    }
}
