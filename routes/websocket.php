<!-- websocket.php -->

<?php
/* abra uma conexão websocket na rota ws/ */

use Illuminate\Routing\Route;

Route::websocket('ws', function ($connection) {

});