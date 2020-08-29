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
            ->join('user_details as b', 'b.user_id', '=', 'a.id')
            ->join('user_types as c', 'c.id', '=', 'a.type_id')
            ->join('user_statuses as d', 'd.id', '=', 'b.status_id')
            ->select(
                'a.id',
                'a.type_id',
                'b.status_id',
                'c.name as type',
                'd.name as status',
                'a.last_login',
                'a.active',
                'a.first_name',
                'a.last_name',
                'a.email',
                'b.identifier',
                'b.username',
                'b.middle_name',
                'b.suffix',
                'b.alias',
                'b.birthday',
                'b.image',
                'b.gender',
                'b.nationality',
                'b.religion',
                'b.full_address',
                'b.pres_line_1',
                'b.pres_line_2',
                'b.pres_municipality',
                'b.pres_city',
                'b.pres_province',
                'b.pres_zip',
                'b.perma_line_1',
                'b.perma_line_2',
                'b.perma_municipality',
                'b.perma_city',
                'b.perma_province',
                'b.perma_zip',
                'b.mobile',
                'b.telephone',
                'b.father_name',
                'b.father_mobile',
                'b.mother_name',
                'b.mother_mobile',
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

    public function getById($id)
    {
        $this->consolidated['data'] = DB::table('users as a')
            ->join('user_details as b', 'b.user_id', '=', 'a.id')
            ->join('user_types as c', 'c.id', '=', 'a.type_id')
            ->join('user_statuses as d', 'd.id', '=', 'b.status_id')
            ->select(
                'a.id',
                'a.type_id',
                'b.status_id',
                'c.name as type',
                'd.name as status',
                'a.last_login',
                'a.active',
                'a.first_name',
                'a.last_name',
                'a.email',
                'b.identifier',
                'b.username',
                'b.middle_name',
                'b.suffix',
                'b.alias',
                'b.birthday',
                'b.image',
                'b.gender',
                'b.nationality',
                'b.religion',
                'b.full_address',
                'b.pres_line_1',
                'b.pres_line_2',
                'b.pres_municipality',
                'b.pres_city',
                'b.pres_province',
                'b.pres_zip',
                'b.perma_line_1',
                'b.perma_line_2',
                'b.perma_municipality',
                'b.perma_city',
                'b.perma_province',
                'b.perma_zip',
                'b.mobile',
                'b.telephone',
                'b.father_name',
                'b.father_mobile',
                'b.mother_name',
                'b.mother_mobile',
            )
            ->where([
                'a.id' => $id
            ])
            ->get()->first();

        return $this->consolidated;
    }
}
