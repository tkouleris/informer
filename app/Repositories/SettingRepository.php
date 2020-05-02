<?php


namespace App\Repositories;


use App\Models\Setting;
use App\Repositories\Interfaces\ISettingRepository;

class SettingRepository implements ISettingRepository
{
    protected $model;

    /**
     * SettingRepository constructor.
     * @param $model
     */
    public function __construct(Setting $model)
    {
        $this->model = $model;
    }

    public function create($data)
    {
        return $this->model->create($data);
    }

    public function find_active_by_user($UserID)
    {
        return $this->model::where('setting_active',true)
            ->leftJoin('category','CategoryID','setting_categoryid')
            ->leftJoin('country','CountryID','setting_countryid')
            ->where('setting_userid',$UserID)
            ->get();
    }

    public function find_by_countryID_and_userID($country_id, $user_id)
    {
        return $this->model::where('setting_countryid',$country_id)
            ->where('setting_userid',$user_id)
            ->get();
    }

    public function find_by_userID_countryID_categoryID($userid,$countryid,$categoryid)
    {
        return $this->model::where('setting_userid',$userid)
            ->where('setting_countryid',$countryid)
            ->where('setting_categoryid',$categoryid)
            ->first();
    }

    public function update($data)
    {
        $setting_id = $data['setting_id'];
        $setting = $this->model::findOrFail($setting_id);

        if(isset($data['setting_active'])) $setting->setting_active = $data['setting_active'];
        $setting->save();

        $setting = $this->model::findOrFail($setting_id);
        return $setting;
    }
}
