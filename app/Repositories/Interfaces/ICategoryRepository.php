<?php


namespace App\Repositories\Interfaces;


interface ICategoryRepository
{
    public function find_by_id($CategoryID);
    public function all();
}
