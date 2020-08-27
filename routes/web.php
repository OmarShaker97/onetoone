<?php

use App\User;
use App\Address;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/insert/{id}/{address_name}', function($id,$address_name){

    $user = User::findOrFail($id);

    $address = new Address(['user_id'=>$id, 'name'=>$address_name]);

    $user->address()->save($address);

});

Route::get('/update/{id}/{address_name}', function($id,$address_name){

    $address = Address::where('user_id', $id)->first();

    $address->name = $address_name;

    $address->save();

});

Route::get('/read/{id}', function($id){

    $user = User::findOrFail($id);

    return $user->address->name;

});

Route::get('/delete/{id}', function($id){

    $user = User::findOrFail($id);

    $user->address->delete();

});