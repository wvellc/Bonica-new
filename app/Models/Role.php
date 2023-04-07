<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Role extends Model
{
    use HasFactory;
    protected $fillable = ['role'];

    public static function getRoleId($role) : int
    {
        return self::where('role',$role)->value('id');
    }
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
