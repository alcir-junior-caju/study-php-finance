<?php
namespace Caju\Finance\Auth;

use Jasny\Auth;
use Jasny\User;
use Jasny\Auth\Sessions;
use Caju\Finance\Interfaces\RepositoryInterface;

class JasnyAuth extends Auth
{
    use Sessions;

    private $repository;

    /**
     * JasnyAuth constructor
     *
     * @param RepositoryInterface $repository
     */
    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Fetch a user by ID
     *
     * @param int|string $id
     * @return User|null
     */
    public function fetchUserById($id)
    {
        return $this->repository->find($id, false);
    }

    /**
     * Fetch a user by username
     *
     * @param string $username
     * @return User|null
     */
    public function fetchUserByUsername($username)
    {
        return $this->repository->findByField('email', $username)[0];
    }
}