<?php


namespace App\Repositories\Interfaces;


interface ISettingRepository
{
    public function create($data);
    public function find_active_by_user($UserID);
}
