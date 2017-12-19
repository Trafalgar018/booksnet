<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invitacion extends Model {
    protected $table = 'invitacion';
    protected $fillable = ['email', 'used'];
}