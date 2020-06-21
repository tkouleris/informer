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

        $UserSettingsCollection_greek_general = new Setting;
        $UserSettingsCollection_greek_general->CountryShortName = "GR";
        $UserSettingsCollection_greek_general->CategoryShort = "general";

        $UserSettingsCollection_greek_sports = new Setting;
        $UserSettingsCollection_greek_sports->CountryShortName = "GR";
        $UserSettingsCollection_greek_sports->CategoryShort = "sports";

        $this->SettingsCollection = collect([$UserSettingsCollection_greek_general,$UserSettingsCollection_greek_sports]);
    }

    /** @test */
    public function fetch_without_filters_brings_back_two_results()
    {
        // given
        $GuzzleMock = $this->createMock(GuzzleUtil::class);

        $Article_1 = new stdClass();
        $Article_1->id = "bloomberg";
        $Article_1->category = "general";

        $Article_2 = new stdClass();
        $Article_2->id = "nba";
        $Article_2->category = "sports";

        $NewsApiResponse_1 = new stdClass();
        $NewsApiResponse_1->articles = [
            "article_1"=>$Article_1,
        ];

        $NewsApiResponse_2 = new stdClass();
        $NewsApiResponse_2->articles = [
            "article_2"=>$Article_2
        ];
        // First setting call
        $GuzzleMock->expects($this->at(0))->method('getRequest')
            ->willReturn($NewsApiResponse_1);
        // Second settign call
        $GuzzleMock->expects($this->at(1))->method('getRequest')
            ->willReturn($NewsApiResponse_2);
        $SettingsMock = $this->createMock(ISettingRepository::class);
        $SettingsMock->method('find_active_by_user')
            ->willReturn($this->SettingsCollection);

        // when
        $userNewsService = new UserNewsService($SettingsMock, $GuzzleMock);
        $news_results = $userNewsService->fetch($this->User->id);

        // then
        $this->assertEquals(2,$news_results->count());
    }

    /** @test */
    public function fetch_filters_sports_brings_back_zero_results()
    {
        // given
        $GuzzleMock = $this->createMock(GuzzleUtil::class);

        $Article_1 = new stdClass();
        $Article_1->id = "bloomberg";
        $Article_1->category = "general";

        $Article_2 = new stdClass();
        $Article_2->id = "nba";
        $Article_2->category = "sports";

        $NewsApiResponse_1 = new stdClass();
        $NewsApiResponse_1->articles = [
            "article_1"=>$Article_1,
        ];

        $NewsApiResponse_2 = new stdClass();
        $NewsApiResponse_2->articles = [
            "article_2"=>$Article_2
        ];
        // First setting call
        $GuzzleMock->expects($this->at(0))->method('getRequest')
            ->willReturn($NewsApiResponse_1);
        // Second setting call
        $GuzzleMock->expects($this->at(1))->method('getRequest')
        ->willReturn($NewsApiResponse_2);
        $SettingsMock = $this->createMock(ISettingRepository::class);
        $SettingsMock->method('find_active_by_user')
            ->willReturn($this->SettingsCollection);

        // when
        $userNewsService = new UserNewsService($SettingsMock, $GuzzleMock);
        $news_results = $userNewsService->fetch($this->User->id,"","sports");

        // then
        $this->assertEquals(1,$news_results->count());
    }
}
