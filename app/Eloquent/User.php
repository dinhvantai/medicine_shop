<?php

namespace App\Eloquent;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Eloquent\Relations\UserRelation;
use Laravel\Scout\Searchable;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes, UserRelation;

    const PERMISSION_USER = 0;
    const PERMISSION_ADMIN = 1;
    const PERMISSION_DOCTER = 2;

    const GENDER_MALE = 'male';
    const GENDER_FEMALE = 'female';
    const GENDER_OTHER = 'other';

    const PATH_AVATAR = '/uploads/avatars/';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'display_name',
        'email',
        'phone',
        'address',
        'permission',
        'position',
        'gender',
        'specialize',
        'certificate',
        'experience',
        'workplace',
        'about_you',
        'birthday',
        'provider',
        'provider_user_id',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'provider',
        'provider_user_id',
    ];

    public static function getPermissionOption()
    {
        return [
            self::PERMISSION_USER => __('Normal User'),
            self::PERMISSION_ADMIN => __('Admin'),
            self::PERMISSION_DOCTER => __('Doctor'),
        ];
    }

    public static function getGenderOption()
    {
        return [
            self::GENDER_MALE => __('Male'),
            self::GENDER_FEMALE => __('Female'),
            self::GENDER_OTHER => __('Other'),
        ];
    }

    public function searchableAs()
    {
        return 'display_name';
    }

    public function toSearchableArray()
    {
        $array = $this->toArray();
        return $array;
    }
    
    public function getAllDoctorOption()
    {
        $doctors = $this->where('permission', self::PERMISSION_DOCTER)->get();
        $result = [];
        foreach ($doctors as $doctor) {
            $textView = $doctor->display_name;

            if ($doctor->specialize) {
                $textView .= ' - ' . __('Specialize: :text', ['text' => $doctor->specialize]);
            }
            if ($doctor->certificate) {
                $textView .= ' - ' . __('Certificate: :text', ['text' => $doctor->certificate]);
            }

            $result[$doctor->id] = $textView;
        }

        return $result;
    }
}
