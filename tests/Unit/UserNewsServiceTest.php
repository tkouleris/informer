<?php


namespace Tests\Unit;


use App\Models\Setting;
use App\Repositories\Interfaces\ISettingRepository;
use App\Services\UserNewsService;
use App\User;
use App\Utils\GuzzleUtil;
use stdClass;
use Tests\TestCase;

class UserNewsServiceTest extends TestCase
{
    protected $SettingsCollection;
    protected $User;

    protected function setUp(): void
    {
        parent::setUp();

        $this->User = new User;
        $this->User->id = 1;

        $UserSettingsCollection_greek = new Setting;
        $UserSettingsCollection_greek->CountryShortName = "GR";
        $UserSettingsCollection_greek->CategoryShort = "general";

        $UserSettingsCollection_us = new Setting;
        $UserSettingsCollection_us->CountryShortName = "US";
        $UserSettingsCollection_us->CategoryShort = "general";

        $this->SettingsCollection = collect([$UserSettingsCollection_greek,$UserSettingsCollection_us]);
    }

    /** @test */
    public function active_user_must_return_results()
    {
        // given
        $GuzzleMock = $this->createMock(GuzzleUtil::class);
        $NewsApiResponse = new stdClass();
        $Article_1 = new stdClass();
        $Article_1->id = "bloomberg";
        $Article_1->category = "general";

        $Article_2 = new stdClass();
        $Article_2->id = "nba";
        $Article_2->category = "sports";

        $NewsApiResponse->articles = [
            "article_1"=>$Article_1,
            "article_2"=>$Article_2
        ];
        $GuzzleMock->method('getRequest')
            ->willReturn($NewsApiResponse);
        $SettingsMock = $this->createMock(ISettingRepository::class);
        $SettingsMock->method('find_active_by_user')
            ->willReturn($this->SettingsCollection);

        // when
        $userNewsService = new UserNewsService($SettingsMock, $GuzzleMock);
        $news_results = $userNewsService->fetch($this->User->id);

        // then
        $this->assertEquals(2,$news_results->count());
    }
}
