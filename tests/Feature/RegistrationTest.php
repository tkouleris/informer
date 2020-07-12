<?php


namespace Tests\Feature;


use App\Models\Setting;
use App\Repositories\SettingRepository;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    private function create_new_user()
    {
        $user = new User();
        $user->name = "testuser";
        $user->email = "testuser@mail.com";
        $user->password = "testpassword";
        $user->save();

        unlink(public_path(config('app.avatar_folder').$user->id.'/avatar.jpg'));
        rmdir(public_path(config('app.avatar_folder').$user->id));
        return $user;
    }

    /** @test */
    public function user_can_be_created()
    {
        $model = new User();
        $user = $this->create_new_user();
        $all_users = $model::all();

        $this->assertEquals(1,$all_users->count());
    }

    /** @test */
    public function registered_user_has_default_active_settings()
    {
        $user = $this->create_new_user();

        $settingsRepository = resolve(SettingRepository::class);

        $settings = $settingsRepository->find_active_by_user($user->id);

        $this->assertEquals(7,$settings->count());
    }

    /** @test */
    public function registered_user_has_all_settings_created()
    {
        $this->create_new_user();
        $setting = new Setting();
        $settings = $setting::all();

        $this->assertEquals(371,$settings->count());
    }
}
