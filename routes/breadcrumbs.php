<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

//Dashboard
Breadcrumbs::for('dashboard', function (BreadcrumbTrail $trail) {
     $trail->push('Dashboard', route('dashboard'));
});

// Profile
Breadcrumbs::for('profile', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Profile');
});

//Setting
Breadcrumbs::for('setting', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Setting','#');
});

    //Activity
    Breadcrumbs::for('log-activity', function (BreadcrumbTrail $trail) {
        $trail->parent('setting');
        $trail->push('Activity Log', route('log-activity.index'));
    });
    Breadcrumbs::for('log-activity.show', function (BreadcrumbTrail $trail, $data) {
        $trail->parent('log-activity');
        $trail->push($data->id);
    });

    //Role User
    Breadcrumbs::for('role-user', function (BreadcrumbTrail $trail) {
        $trail->parent('setting');
        $trail->push('Role User', route('role-user.index'));
    });
    Breadcrumbs::for('role-user.edit', function (BreadcrumbTrail $trail, $data) {
        $trail->parent('role-user');
        $trail->push($data->name);
    });

    //User
    Breadcrumbs::for('user', function (BreadcrumbTrail $trail) {
        $trail->parent('setting');
        $trail->push('User', route('user.index'));
    });
    Breadcrumbs::for('user.edit', function (BreadcrumbTrail $trail, $data) {
        $trail->parent('user');
        $trail->push($data->name);
    });
