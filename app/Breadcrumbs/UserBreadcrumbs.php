<?php

/**
 * Author: Juan Esteban Trujillo Montes
 * Description: Defines breadcrumb trails for user-facing pages.
 */

namespace App\Breadcrumbs;

use App\Models\Order;
use App\Models\Product;
use App\Models\Review;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

class UserBreadcrumbs
{
    public static function home(BreadcrumbTrail $trail): void
    {
        $trail->push(__('messages.layout.nav.home'), route('home.index'));
    }

    public static function about(BreadcrumbTrail $trail): void
    {
        $trail->parent('home.index');
        $trail->push(__('messages.layout.nav.about'), route('home.about'));
    }

    public static function contact(BreadcrumbTrail $trail): void
    {
        $trail->parent('home.index');
        $trail->push(__('messages.layout.nav.contact'), route('home.contact'));
    }

    public static function productIndex(BreadcrumbTrail $trail): void
    {
        $trail->parent('home.index');
        $trail->push(__('messages.layout.nav.products'), route('product.index'));
    }

    public static function productShow(BreadcrumbTrail $trail, Product $product): void
    {
        $trail->parent('product.index');
        $trail->push($product->getName(), route('product.show', $product));
    }

    public static function cartIndex(BreadcrumbTrail $trail): void
    {
        $trail->parent('home.index');
        $trail->push(__('messages.layout.nav.cart'), route('cart.index'));
    }

    public static function orderIndex(BreadcrumbTrail $trail): void
    {
        $trail->parent('home.index');
        $trail->push(__('messages.layout.nav.orders'), route('order.index'));
    }

    public static function orderShow(BreadcrumbTrail $trail, Order $order): void
    {
        $trail->parent('order.index');
        $trail->push(__('messages.breadcrumbs.order_number', ['id' => $order->getId()]), route('order.show', $order));
    }

    public static function reviewEdit(BreadcrumbTrail $trail, Product $product, Review $review): void
    {
        $trail->parent('product.show', $product);
        $trail->push(__('messages.breadcrumbs.edit_review'), route('review.edit', [$product, $review]));
    }
}
