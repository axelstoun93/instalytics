<?php
namespace Tests\Unit;

use App\Http\Controllers\CronController;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CronControllerTest extends TestCase{

    public function testGetAndroidTaskTest(){
        $cronController = new CronController();
        $res = $cronController->getAndroidTaskTest();
        $this->assertNotNull($res);
    }

}
