<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use Notifiable;
    protected $table = 'admins';
    protected $guard = 'admin';
    protected $fillable = [
        'name', 'email', 'password', 'profile_image', 'is_super', 'status'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
	 * Custom Scope Method
	 * @author Hitesh Khandar
	 */
	public function scopeActive($query) {
		return $query->where('status', 1);
	}

	public function scopeInActive($query) {
		return $query->where('status', 0);
	}

    /**
     * Table Relationship Method
     * @author Hitesh Khandar
     */
}
