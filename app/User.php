<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','name', 'email', 'password','account_picture'
    ];
    protected $appends = ['picture'];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function social()
    {
        return $this->hasMany('App\Model\Social');
    }
    public function getPictureAttribute(){
        if($this->account_picture){
            return $this->account_picture;
        }
        return "/assets/img/avatar1.png";
    }


    public function role()
    {
        return $this->hasOne('App\Model\Role', 'id', 'role_id');
    }

    public function hasRole($roles)
    {

        $this->have_role = $this->getUserRole();


        if(is_array($roles)){
            foreach($roles as $need_role){
                if($this->checkIfUserHasRole($need_role)) {
                    return true;
                }
            }
        } else{
            return $this->checkIfUserHasRole($roles);
        }
        return false;
    }

    private function getUserRole()
    {
        return $this->role()->getResults();
    }

    private function checkIfUserHasRole($need_role)
    {
        return (strtolower($need_role)==strtolower($this->have_role->name)) ? true : false;
    }

}
