<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function roles()
    {
        return $this->belongsToMany('App\Models\Role', 'users_roles', 'user_id', 'role_id');
    }
    /**
     * Проверка принадлежит ли пользователь к какой либо роли
     *
     * @return boolean
     */
    public function isEmployee()
    {
        $roles = $this->roles->toArray();
        return !empty($roles);
    }
    /**
     * Проверка имеет ли пользователь определенную роль
     *
     * @return boolean
     */
    public function hasRole($check)
    {
        return in_array($check, array_pluck($this->roles->toArray(), 'name'));
        // начиная с версии 5.1 метода array_fetch не существует
        //return in_array($check, array_fetch($this->roles->toArray(), 'name'));
    }
    /**
     * Получение идентификатора роли
     *
     * @return int
     */
    private function getIdInArray($array, $term)
    {
        foreach ($array as $key => $value) {
            if ($value == $term) {
                return $key + 1;
            }
        }
        return false;
    }
    /**
     * Добавление роли пользователю
     *
     * @return boolean
     */
    public function makeEmployee($title)
    {
        $assigned_roles = array();
        $roles = array_fetch(Role::all()->toArray(), 'name');
        switch ($title) {
            case 'admin':
                $assigned_roles[] = $this->getIdInArray($roles, 'admin');
            case 'client':
                $assigned_roles[] = $this->getIdInArray($roles, 'client');
                break;
            default:
                $assigned_roles[] = false;
        }
        $this->roles()->attach($assigned_roles);
    }
    /****/

}
