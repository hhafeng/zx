<?php

/**
 * Created by PhpStorm.
 * User: afeng
 * Date: 18/4/18
 * Time: 上午9:56
 */

use think\Route;

Route::resource('case', 'xcx/Case');
Route::resource('designer', 'xcx/Designer');
Route::resource('case_category', 'xcx/CaseCategory');
Route::resource('adv', 'xcx/Adv');
Route::resource('article', 'xcx/Article');
Route::resource('topic', 'xcx/Topic');
Route::resource('nav', 'xcx/Nav');
Route::resource('profile', 'xcx/Profile');
Route::resource('tool', 'xcx/Tool');
Route::resource('baojia', 'xcx/Baojia');
Route::resource('login', 'xcx/Login');