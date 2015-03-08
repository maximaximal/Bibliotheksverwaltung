<?php namespace App;

use ORM;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of User
 *
 * @author maximaximal
 */
class User {
    private $username = "";
    private $name = "";
    private $hashedPW = "";
    private $id = 0;
    private $permissions = array();

    public function loadFromUsername($username)
    {
        $user = ORM::for_table("users")
            ->where_equal("username", $username)
            ->find_one();

        if($user) {
            $this->hashedPW = $user->password;
            $this->username = $username;
            $this->name = $user->name;
            $this->permissions = \json_decode($user->permissions);
            $this->id = $user->id();

            return true;
        } else {
            return false;
        }
    }
    public function createInDB()
    {
        if(!$this->loadFromUsername($this->username)) {
            $user = ORM::for_table("users")
                ->create(array(
                    "username" => $this->username,
                    "password" => $this->hashedPW,
                    "name" => $this->name,
                    "permissions" => \json_encode($this->permissions)
                ));
            
            $user->save();

            $this->id = $user->id();
            
            return true;
        }
        return false;
    }
    public function register($username, $name, $password) 
    {
        if(!$this->loadFromUsername($username)) {
            $this->hashedPW = password_hash($password, PASSWORD_BCRYPT);
            $this->username = $username;
            $this->name = $name;

            return $this->createInDB();
        }   
        return false;
    }
    public function login($username, $password) 
    {
        if($this->loadFromUsername($username)) {
            if(($this->isPasswordvalid($password))) {
                return true;       
            }
        }
        return false;
    }
    public function getName()
    {
        return $this->name;
    }
    public function hasPermission($perm) 
    {
        foreach($this->permissions as $permission)
        {
            if($permission === $perm) {
                return true;
            }
        }
        return false;
    }
    private function isPasswordvalid($password) 
    {
        if(\password_verify($password, $this->hashedPW)) {
            return true;
        } else {
            return false;
        }
    }
}
