<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;
use PhpOption\None;
use PhpParser\Node\Expr\ArrayItem;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $guarded = [
        'id',
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

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getRouteKeyName()
    {
        return 'username';
    }

    //Relation to pipeline one to many
    public function pipeline()
    {
        return $this->hasMany(Pipeline::class, 'user_id');
    }

    //Relation to team-sales-group one to one
    public function groupTeam()
    {
        return $this->hasOne(TeamSalesGroup::class, 'user_id');
    }

    //Relation to team-sales one to one
    public function teamSPV()
    {
        return $this->hasOne(TeamSales::class, 'spv_id');
    }

    public static function exportUsers()
    {
        $users = DB::table('users')->select('id', 'name', 'username', 'email', 'no_handphone', 'user_role')->get();

        $TeamsSalesInfo = DB::table('team_sales_groups')
            ->select(['team_sales_groups.user_id', 'team_sales.team_name'])
            ->join('team_sales', 'team_sales.id', '=', 'team_sales_groups.team_id')
            ->join('users', 'users.id', '=', 'team_sales.spv_id')
            ->get();

        $TeamsSpvInfo = DB::table('team_sales')
            ->select(['users.id as user_id', 'team_sales.team_name'])
            ->join('users', 'users.id', '=', 'team_sales.spv_id')
            ->get();

        $TeamsInfo = $TeamsSalesInfo->merge($TeamsSpvInfo);

        foreach ($users as $user) {
            if ($user->user_role == 0) {
                $user->user_role = 'Admin';
            } else if ($user->user_role == 1) {
                $user->user_role = 'Manager';
            } else if ($user->user_role == 2) {
                $user->user_role = 'Supervisor';
            } else if ($user->user_role == 3) {
                $user->user_role = 'Sales';
            }
        }

        foreach ($users as $user) {
            foreach ($TeamsInfo as $TeamInfo) {
                if ($TeamInfo->user_id == $user->id) {
                    $user->user_team = $TeamInfo->team_name;
                } 
            }
        }

        return $users;
    }
}
