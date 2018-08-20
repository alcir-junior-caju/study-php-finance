<?php

declare(strict_types = 1);

namespace Caju\Finance\Models;

use Illuminate\Database\Eloquent\Model;
use Jasny\Auth\User as JasnyUser;
use Caju\Finance\Interfaces\UserInterface;

class User extends Model implements JasnyUser, UserInterface
{
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password'
    ];

    /**
     * Get User id
     *
     * @return int|string
     */
    public function getId(): int
    {
        return (int) $this->id;
    }

    /**
     * Get user's username
     *
     * @return string
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * Get user's hashed password
     *
     * @return string
     */
    public function getHashedPassword(): string
    {
        return (string) $this->password;
    }

    /**
     * Event called on login
     *
     * @return boolean false cancels the login
     */
    public function onLogin()
    {

    }

    /**
     * Event called on logout
     *
     * @return void
     */
    public function onLogout()
    {

    }

    public function getFullName(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}
