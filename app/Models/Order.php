<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    /**
     * ORDER ATTRIBUTES
     * $this->attributes['id'] - int - contains the order primary key (id)
     * $this->attributes['user_id'] - int - contains the referenced user id
     * $this->attributes['total'] - int - contains the order total price
     * $this->attributes['status'] - string - contains the order status (pending, completed, cancelled)
     * $this->attributes['can_be_cancelled'] - bool - contains whether the order can be cancelled or not
     * $this->attributes['created_at'] - string - contains the order creation date
     * $this->attributes['updated_at'] - string - contains the order update date
     * $this->user - User - contains the associated User
     * $this->items - Item[] - contains the associated items
     */
    protected $fillable = ['user_id', 'total', 'status', 'can_be_cancelled'];

    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function getUserId(): int
    {
        return $this->attributes['user_id'];
    }

    public function setUserId(int $userId): void
    {
        $this->attributes['user_id'] = $userId;
    }

    public function getTotal(): int
    {
        return $this->attributes['total'];
    }

    public function setTotal(int $total): void
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
        return (bool) $this->attributes['can_be_cancelled'];
    }

    public function setCanBeCancelled(bool $canBeCancelled): void
    {
        $this->attributes['can_be_cancelled'] = $canBeCancelled;
    }

    public function getCreatedAt(): string
    {
        return $this->attributes['created_at'];
    }

    public function getUpdatedAt(): string
    {
        return $this->attributes['updated_at'];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    }

    public function getItems(): Collection
    {
        return $this->items;
    }

    public function setItems(Collection $items): void
    {
        $this->items = $items;
    }
}
