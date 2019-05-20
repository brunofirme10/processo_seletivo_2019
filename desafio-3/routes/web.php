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

Auth::routes();
Route::redirect("", "home");
Route::get("home", "UsuarioController@listarUsuario")->name("home");
Route::get("create", "UsuarioController@criarUsuario");
Route::get("edit", "UsuarioController@editarUsuario");
Route::get("home", "UsuarioController@deletarUsuario");
Route::get("home", "UsuarioController@salvarUsuario");
