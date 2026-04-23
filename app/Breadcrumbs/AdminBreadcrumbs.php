<?php

namespace App\Breadcrumbs;

use App\Models\Product;
use App\Models\User;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

class AdminBreadcrumbs
{
    public static function dashboard(BreadcrumbTrail $trail): void
    {
        $trail->push(__('messages.admin.dashboard'), route('admin.home.index'));
    }

    public static function productIndex(BreadcrumbTrail $trail): void
    {
        $trail->parent('admin.home.index');
        $trail->push(__('messages.admin.products'), route('admin.product.index'));
    }

    public static function productEdit(BreadcrumbTrail $trail, Product $product): void
    {
        $trail->parent('admin.product.index');
        $trail->push($product->getName(), route('admin.product.edit', $product));
    }

    public static function userIndex(BreadcrumbTrail $trail): void
    {
        $trail->parent('admin.home.index');
        $trail->push(__('messages.admin.users'), route('admin.user.index'));
    }

    public static function userEdit(BreadcrumbTrail $trail, User $user): void
    {
        $trail->parent('admin.user.index');
        $trail->push($user->getName(), route('admin.user.edit', $user));
    }

    public static function orderIndex(BreadcrumbTrail $trail): void
    {
        $trail->parent('admin.home.index');
        $trail->push(__('messages.admin.orders'), route('admin.order.index'));
    }

    public static function reviewIndex(BreadcrumbTrail $trail): void
    {
        $trail->parent('admin.home.index');
        $trail->push(__('messages.admin.reviews'), route('admin.review.index'));
    }
}
