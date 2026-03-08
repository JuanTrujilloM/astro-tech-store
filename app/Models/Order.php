<?php

namespace App\Models;

use Carbon\Carbon;
use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['total', 'status', 'can_be_cancelled', 'created_at', 'updated_at'];

    protected $casts = [
        'total' => 'decimal:2',
        'can_be_cancelled' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function setId(int $id): void
    {
        $this->attributes['id'] = $id;
    }

    public function getTotal(): float
    {
        return $this->attributes['total'];
    }

    public function setTotal(float $total): void
    {
        $this->attributes['total'] = $total;
    }

    public function getStatus(): string
    {
        return $this->attributes['status'];
    }

    public function setStatus(string $status): void
    {
        $this->attributes['status'] = $status;
    }

    public function getCanBeCancelled(): bool
    {
        return $this->attributes['can_be_cancelled'];
    }

    public function setCanBeCancelled(bool $canBeCancelled): void
    {
        $this->attributes['can_be_cancelled'] = $canBeCancelled;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->created_at instanceof DateTime
            ? $this->created_at
            : Carbon::parse($this->attributes['created_at']);
    }

    public function setCreatedAt($createdAt): void
    {
        $this->attributes['created_at'] = $createdAt;
    }

    public function getUpdatedAt(): DateTime
    {
        return $this->updated_at instanceof DateTime
            ? $this->updated_at
            : Carbon::parse($this->attributes['updated_at']);
    }

    public function setUpdatedAt($updatedAt): void
    {
        $this->attributes['updated_at'] = $updatedAt;
    }
}
