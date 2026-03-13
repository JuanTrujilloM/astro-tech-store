<?php

/**
 * Author: Andres Perez Quinchia
 * Description: Model responsible for managing products
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * PRODUCT ATTRIBUTES
     * $this->attributes['id'] - int - contains the product primary key (id)
     * $this->attributes['name'] - string - contains the name of the product
     * $this->attributes['description'] - string - contains the description of the product
     * $this->attributes['price'] - int - contains the price of the product
     * $this->attributes['stock'] - int - contains the stock of the product
     * $this->attributes['image'] - string - contains the url of the image of the product
     * $this->attributes['created_at'] - string - contains the date and time of the creation of the product
     * $this->attributes['updated_at'] - string - contains the date and time of the last update of the product
     */
    protected $fillable = ['name', 'description', 'price', 'stock', 'image'];

    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function getName(): string
    {
        return $this->attributes['name'];
    }

    public function setName(string $name): void
    {
        $this->attributes['name'] = $name;
    }

    public function getDescription(): string
    {
        return $this->attributes['description'];
    }

    public function setDescription(string $description): void
    {
        $this->attributes['description'] = $description;
    }

    public function getPrice(): int
    {
        return $this->attributes['price'];
    }

    public function setPrice(int $price): void
    {
        $this->attributes['price'] = $price;
    }

    public function getStock(): int
    {
        return $this->attributes['stock'];
    }

    public function setStock(int $stock): void
    {
        $this->attributes['stock'] = $stock;
    }

    public function getImage(): string
    {
        return $this->attributes['image'];
    }

    public function setImage(string $image): void
    {
        $this->attributes['image'] = $image;
    }

    public function getCreatedAt(): string
    {
        return $this->attributes['created_at'];
    }

    public function getUpdatedAt(): string
    {
        return $this->attributes['updated_at'];
    }
}
