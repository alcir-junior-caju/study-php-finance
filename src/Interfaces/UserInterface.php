<?php

namespace Caju\Finance\Interfaces;

interface UserInterface
{
    public function getID(): int;
    public function getFullName(): string;
    public function getEmail(): string;
    public function getPassword(): string;
}