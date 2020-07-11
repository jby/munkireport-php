<?php

namespace Tests\Feature;

use App\Http\Controllers\UnitController;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class UnitControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
    }

    protected function tearDown(): void
    {
        $this->user = null;
        parent::tearDown(); // TODO: Change the autogenerated stub
    }

    public function testListing()
    {

    }

    public function testIndex()
    {

    }

    public function testReports()
    {

    }

    public function testGet_machine_groups()
    {

    }

    public function testGet_data()
    {

    }
}
