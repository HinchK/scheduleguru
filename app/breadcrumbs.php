<?php

Breadcrumbs::register('home', function($breadcrumbs) {
    $breadcrumbs->push('Home', route('dashboard_primary'));
});

Breadcrumbs::register('students', function($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Students', route('student_management'));
});

//Breadcrumbs::register('category', function($breadcrumbs, $category) {
//    $breadcrumbs->parent('students');
//
//    foreach ($category->ancestors as $ancestor) {
//        $breadcrumbs->push($ancestor->title, route('category', $ancestor->id));
//    }
//
//    $breadcrumbs->push($category->title, route('category', $category->id));
//});

Breadcrumbs::register('studentpage', function($breadcrumbs, $student) {
    $breadcrumbs->parent('students');
    $breadcrumbs->push($student->name, route('student_page', $student->url()));
});

Breadcrumbs::register('page', function($breadcrumbs, $page) {
    $breadcrumbs->parent('category', $page->category);
    $breadcrumbs->push($page->title, route('page', $page->id));
});
