<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Role;
use App\Models\PlanOffering;
use App\Models\Review;
use App\Models\PractitionerReading;
use App\Models\PractitionerCourseWorkshop;
use App\Models\PracticeExpertise;
use Cviebrock\EloquentSluggable\Sluggable;
use Auth;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable ,Sluggable;

    protected $guard = 'user';
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['first_name','last_name','slug', 'email', 'password', 'status', 'email_verified_at','confirmation_code', 'remember_token', 'created_at', 'updated_at','confirmation_code','confirmed','phone_number','street_address','street_address2','city','pincode','state','country', 'confirmation_code','social_id', 'social_type', 'email_verified'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = ['password', 'email_verified_at', 'created_at', 'updated_at'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = ['email_verified_at' => 'datetime'];

    public function sluggable() : array
    {
        return [
            'slug' => [
                'source' => 'first_name'
            ]
        ];
    }
    public function scopeActive($query)
    {
        return $query->where('users.status', 1);
    }
    public function scopeInActive($query)
    {
        return $query->where('users.status', 0);
    }
    public static function getUserInfo()
    {
        return self::find(Auth::guard('user')->user()->id);
    }

    public static function confirmationCode($code) {
        $user = User::where('confirmation_code', $code)->first();
        $confirmstatus = 0;
        if($user) {
            $confirmstatus = 1;
            if(!$user->confirmed){
                User::where('id', $user->id)->update(['confirmed' => 1]);
                $confirmstatus = 2;
            }
        }
        return $confirmstatus;
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id')->select(array('id','role'));
    }

    /**
     * Table Relationship Method
     * @author Hitesh Khandar
     * The practiceExpertises that belong to the User.
     */
    public function practiceExpertises()
    {
        return $this->belongsToMany(PracticeExpertise::class);
    }

    /**
      * Table Relationship Method
     * @author Hitesh Khandar
     * The planOfferings that belong to the User.
     */
    public function planOfferings()
    {
        return $this->belongsToMany(PlanOffering::class);
    }

    public function myreviews()
    {
        return $this->hasMany(Review::class,'to_id','id')->orderBy('created_at', 'DESC');
    }

    public function Readings()
    {
        return $this->hasMany(PractitionerReading::class,'user_id','id');
    }

    public function courseWorkshops()
    {
        return $this->hasMany(PractitionerCourseWorkshop::class,'user_id','id');
    }
}
