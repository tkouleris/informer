<?php


namespace Tests\Feature;


use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class UploadImageTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
        $this->user->email_verified_at = Carbon::now();
    }

    /** @test */
    public function request_should_fail_when_image_extension_not_acceptable()
    {
        $response = $this->actingAs($this->user)
            ->postJson(route('image.upload'), [
                'image' => 'test.fff'
            ]);
        $response->assertJsonValidationErrors('image');
        $this->clear_testing_folder();
    }

    /** @test */
    public function request_should_redirect_back_when_image_extension_acceptable()
    {
        // given
        $stub = __DIR__.'/test_files/test_avatar.jpg';
        $name = 'test_8x.'.substr($stub, -3);;
        $path = sys_get_temp_dir().'/'.$name;
        copy($stub, $path);
        $file = new UploadedFile($path, $name, filesize($path), null, null, true);

        // when
        $response = $this->actingAs($this->user)->json('POST', '/image-upload', ['image' => $file]);

        // then
        $response->assertStatus(302);
        $response->isRedirect(url('/'));
        $this->clear_testing_folder();
    }

    private function clear_testing_folder()
    {
        unlink(public_path(config('app.avatar_folder').$this->user->id.'/avatar.jpg'));
        rmdir(public_path(config('app.avatar_folder').$this->user->id));
    }

}
