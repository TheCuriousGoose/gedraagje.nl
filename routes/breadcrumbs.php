<?php

use App\Models\User;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::for('dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('dashboard', route('dashboard'));
});

Breadcrumbs::for('profiles.edit', function (BreadcrumbTrail $trail, $user) {
    $trail->parent('dashboard');
    $trail->push(__('breadcrumbs.profiles.edit', ['name' => User::find($user)->name]), route('profiles.edit', $user));
});

Breadcrumbs::for('management', function (BreadcrumbTrail $trail) {
    $trail->push('management');
});

Breadcrumbs::for('users.index', function (BreadcrumbTrail $trail) {
    $trail->parent('management');
    $trail->push(__('breadcrumbs.users.index'), route('users.index'));
});

Breadcrumbs::for('users.edit', function (BreadcrumbTrail $trail, User $user) {
    $trail->parent('users.index');
    $trail->push(__('breadcrumbs.users.edit', ['name' => $user->name]));
});

Breadcrumbs::for('users.create', function (BreadcrumbTrail $trail) {
    $trail->parent('users.index');
    $trail->push(__('breadcrumbs.users.create'));
});

Breadcrumbs::for('settings.index', function (BreadcrumbTrail $trail) {
    $trail->parent('management');
    $trail->push(__('breadcrumbs.settings.index'), route('settings.index'));
});

Breadcrumbs::for('settings.edit', function (BreadcrumbTrail $trail, $setting) {
    $trail->parent('settings.index');
    $trail->push(__('breadcrumbs.settings.edit', ['name' => $setting->name]));
});

Breadcrumbs::for('settings.create', function (BreadcrumbTrail $trail) {
    $trail->parent('settings.index');
    $trail->push(__('breadcrumbs.settings.create'));
});

Breadcrumbs::for('permissions.index', function (BreadcrumbTrail $trail) {
    $trail->parent('management');
    $trail->push(__('breadcrumbs.permissions.index'), route('permissions.index'));
});

Breadcrumbs::for('permissions.edit', function (BreadcrumbTrail $trail, $permission) {
    $trail->parent('permissions.index');
    $trail->push(__('breadcrumbs.permissions.edit', ['name' => $permission->name]));
});

Breadcrumbs::for('permissions.create', function (BreadcrumbTrail $trail) {
    $trail->parent('permissions.index');
    $trail->push(__('breadcrumbs.permissions.create'));
});

Breadcrumbs::for('roles.index', function (BreadcrumbTrail $trail) {
    $trail->parent('management');
    $trail->push(__('breadcrumbs.roles.index'), route('roles.index'));
});

Breadcrumbs::for('roles.edit', function (BreadcrumbTrail $trail, $role) {
    $trail->parent('roles.index');
    $trail->push(__('breadcrumbs.roles.edit', ['name' => $role->name]));
});

Breadcrumbs::for('roles.create', function (BreadcrumbTrail $trail) {
    $trail->parent('roles.index');
    $trail->push(__('breadcrumbs.roles.create'));
});
