<?php

namespace App\Models\Users;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type_id', 'first_name', 'last_name', 'email', 'password', 'api_token',
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

    private $consolidated = [];

    public function defaultPassword()
    {
        return bcrypt("myaccount");
    }

    public function generateApiToken()
    {
        return Str::random(60);
    }

    public function get($data)
    {
        $filters = [];
        $user_status = [];

        $this->consolidated['data'] = DB::table('users as a')
            ->join('user_types as b', 'b.id', '=', 'a.type_id')
            ->join('user_details as c', 'c.user_id', '=', 'a.id')
            ->join('user_statuses as d', 'd.id', '=', 'c.status_id')
            ->select(
                'a.id',
                'a.type_id',
                'c.status_id',
                'b.name as type',
                'd.name as status',
                'a.last_login',
                'a.active',
                'a.first_name',
                'a.last_name',
                'a.email',
                'c.identifier',
                'c.username',
                'c.middle_name',
                'c.suffix',
                'c.alias',
                'c.birthday',
                'c.image',
                'c.gender',
                'c.nationality',
                'c.religion',
                'c.full_address',
                'c.pres_line_1',
                'c.pres_line_2',
                'c.pres_municipality',
                'c.pres_city',
                'c.pres_province',
                'c.pres_zip',
                'c.perma_line_1',
                'c.perma_line_2',
                'c.perma_municipality',
                'c.perma_city',
                'c.perma_province',
                'c.perma_zip',
                'c.mobile',
                'c.telephone',
                'c.father_name',
                'c.father_mobile',
                'c.mother_name',
                'c.mother_mobile',
            )
            ->when(!empty($filters), function ($query, $filters) {
                return $query->whereIn('a.type_id', $type);
            })
            ->when(!empty($user_status), function ($query, $user_status) {
                return $query->whereIn('a.active', $user_status);
            })
            ->get()->toArray();

        return $this->consolidated;
    }
}
