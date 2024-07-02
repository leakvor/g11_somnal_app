<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Str;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'profile',
        'role_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    //=======
    public function role():BelongsTo{
        return $this->belongsTo(Role::class,'role_id');
    }
    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public static function register($request, $id = null)
    {
        $data = $request->only([
            'name',
            'email',
            'password',
            'role_id',
            'email_verified_at',
            'remember_token',
        ]);

        $data['password'] = bcrypt($request->password);
        $data['email_verified_at'] = now();
        $data['remember_token'] = Str::random(20);

        return self::updateOrCreate(['id' => $id], $data);
    }
}
