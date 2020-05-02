<?php


namespace App\Repositories\Interfaces;


interface ISettingRepository
{
    public function create($data);
    public function find_active_by_user($UserID);
    public function find_by_countryID_and_userID($country_id, $user_id);
}
