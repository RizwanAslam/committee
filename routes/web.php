<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['middleware' => 'auth'], function () {
    Route::resource('dashboard', 'DashboardController');
    Route::get('/', function () {
        return redirect(route('dashboard.index'));
    });
    Route::get('/company/{id}', 'DashboardController@store')->name('companies.switch');
    Route::get('/committees/datatable', 'CommitteeController@datatable')->name('committees.datatable');
    Route::get('/members/datatable', 'MemberController@datatable')->name('members.datatable');
    Route::resource('committees', 'CommitteeController');
    Route::resource('members', 'MemberController');
    Route::get('committee/{id}/create', 'CommitteeMemberController@create')->name('committee-members.create');
    Route::resource('pays', 'PayController')->only([
        'show', 'update', 'destroy', 'edit', 'store'
    ]);
    Route::get('committee/{committeeId}/pays/{memberId}/status/{id}', 'PayController@index')->name('pays.index');
    Route::get('committee/{committee_id}/Details/{member_id}', 'MemberController@detail')->name('member-details.index');
    Route::resource('committee-members', 'CommitteeMemberController')->only([
        'index', 'show', 'update', 'destroy', 'edit', 'store'
    ]);
    Route::get('committee/{committeeId}/confirms/{memberId}/status/{id}', 'CommitteeMemberController@confirm')->name('committee-members.confirm');

    Route::get('/committee-reports/datatable/{id}', 'CommitteeReportController@datatable')->name('committee-reports.datatable');
    Route::resource('committee-reports', 'CommitteeReportController');
    Route::post('/committee-reports', 'CommitteeReportController@search');
    Route::post('/committees/{id}', 'CommitteeController@search');

});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
