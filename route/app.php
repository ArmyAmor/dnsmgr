<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\facade\Route;

Route::pattern([
    'id'   => '\d+',
]);

Route::any('/install', 'install/index')
->middleware(\app\middleware\ViewOutput::class);

Route::get('/verifycode', 'auth/verifycode')->middleware(\think\middleware\SessionInit::class)
->middleware(\app\middleware\ViewOutput::class);
Route::any('/login', 'auth/login')->middleware(\think\middleware\SessionInit::class)
->middleware(\app\middleware\ViewOutput::class);
Route::get('/logout', 'auth/logout');
Route::any('/quicklogin', 'auth/quicklogin');

Route::group(function () {
    Route::any('/', 'index/index');
    Route::post('/changeskin', 'index/changeskin');
    Route::get('/cleancache', 'index/cleancache');
    Route::any('/setpwd', 'index/setpwd');

    Route::post('/user/data', 'user/user_data');
    Route::post('/user/op', 'user/user_op');
    Route::get('/user', 'user/user');
    
    Route::post('/log/data', 'user/log_data');
    Route::get('/log', 'user/log');

    Route::post('/account/data', 'domain/account_data');
    Route::post('/account/op', 'domain/account_op');
    Route::get('/account', 'domain/account');

    Route::post('/domain/data', 'domain/domain_data');
    Route::post('/domain/op', 'domain/domain_op');
    Route::post('/domain/list', 'domain/domain_list');
    Route::get('/domain', 'domain/domain');

    Route::post('/record/data/:id', 'domain/record_data');
    Route::post('/record/add/:id', 'domain/record_add');
    Route::post('/record/update/:id', 'domain/record_update');
    Route::post('/record/delete/:id', 'domain/record_delete');
    Route::post('/record/status/:id', 'domain/record_status');
    Route::post('/record/remark/:id', 'domain/record_remark');
    Route::post('/record/batch/:id', 'domain/record_batch');
    Route::any('/record/log/:id', 'domain/record_log');
    Route::get('/record/:id', 'domain/record');

})->middleware(\app\middleware\CheckLogin::class)
->middleware(\app\middleware\ViewOutput::class);

Route::group('api', function () {
    Route::post('/domain/:id', 'domain/domain_info');
    Route::post('/domain', 'domain/domain_data');
    
    Route::post('/record/data/:id', 'domain/record_data');
    Route::post('/record/add/:id', 'domain/record_add');
    Route::post('/record/update/:id', 'domain/record_update');
    Route::post('/record/delete/:id', 'domain/record_delete');
    Route::post('/record/status/:id', 'domain/record_status');
    Route::post('/record/remark/:id', 'domain/record_remark');
    Route::post('/record/batch/:id', 'domain/record_batch');

})->middleware(\app\middleware\AuthApi::class);

Route::miss(function() {
    return response('404 Not Found')->code(404);
});
