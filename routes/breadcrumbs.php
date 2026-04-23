<?php

use App\Breadcrumbs\AdminBreadcrumbs;
use App\Breadcrumbs\UserBreadcrumbs;
use Diglactic\Breadcrumbs\Breadcrumbs;

Breadcrumbs::for('home.index', [UserBreadcrumbs::class, 'home']);
Breadcrumbs::for('home.about', [UserBreadcrumbs::class, 'about']);
Breadcrumbs::for('home.contact', [UserBreadcrumbs::class, 'contact']);
Breadcrumbs::for('product.index', [UserBreadcrumbs::class, 'productIndex']);
Breadcrumbs::for('product.show', [UserBreadcrumbs::class, 'productShow']);
Breadcrumbs::for('cart.index', [UserBreadcrumbs::class, 'cartIndex']);
Breadcrumbs::for('order.index', [UserBreadcrumbs::class, 'orderIndex']);
Breadcrumbs::for('order.show', [UserBreadcrumbs::class, 'orderShow']);
Breadcrumbs::for('review.edit', [UserBreadcrumbs::class, 'reviewEdit']);

Breadcrumbs::for('admin.home.index', [AdminBreadcrumbs::class, 'dashboard']);
Breadcrumbs::for('admin.product.index', [AdminBreadcrumbs::class, 'productIndex']);
Breadcrumbs::for('admin.product.edit', [AdminBreadcrumbs::class, 'productEdit']);
Breadcrumbs::for('admin.user.index', [AdminBreadcrumbs::class, 'userIndex']);
Breadcrumbs::for('admin.user.edit', [AdminBreadcrumbs::class, 'userEdit']);
Breadcrumbs::for('admin.order.index', [AdminBreadcrumbs::class, 'orderIndex']);
Breadcrumbs::for('admin.review.index', [AdminBreadcrumbs::class, 'reviewIndex']);
