<?php


namespace App\Repositories\Interfaces;


interface ISettingRepository
{
    public function create($data);
    public function find_active_by_user($UserID);
    public function find_by_countryID_and_userID($country_id, $user_id);
    public function find_by_userID_countryID_categoryID($userid,$countryid,$categoryid);
    public function update($data);
    public function find_active_user_active_categories($user_id);
}
