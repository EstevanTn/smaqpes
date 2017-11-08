<?php
/**
 * Created by PhpStorm.
 * User: Tunaqui
 * Date: 6/11/2017
 * Time: 11:51
 */

namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Result extends Model
{
    use Notifiable;

    protected $fillable = [
        'codigo', 'success', 'message'
    ];
}