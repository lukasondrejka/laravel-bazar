<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'username', 'name', 'password',
        'avatar',  'bio', 'city',
        'phone', 'phone_verified',
        'facebook_id', 'google_id', 'email_verified_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function products()
    {
        return $this->hasMany('App\Product');
    }

    public function avatar($size = 'normal')
    {
        $avatar = $this->avatar;

        if(!$avatar){
            return null;
        }

        if(filter_var($avatar, FILTER_VALIDATE_URL)){
            return $avatar;
        }
         else{
            $folder = url('/') . '/' . 'avatar/';
            if ($size == 'normal'){
                return $folder . $avatar;
            }
            else {
                $file = pathinfo($avatar);

                // if ($size == 'small'){}
                return $folder . $file['filename'] . '-small' . '.' . $file['extension'];

            }


        }
    }
}
