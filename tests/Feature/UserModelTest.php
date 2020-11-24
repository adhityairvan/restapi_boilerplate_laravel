<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class UserModelTest extends TestCase
{
    protected function setUp(): void{
        parent::setUp();
        $this->user = User::create([
            'name' => 'irvan',
            'email' => 'irvan@mail.com',
            'password' => bcrypt('123456')
        ]);
    }

    protected function tearDown(): void
    {
        $this->user->delete();
        parent::tearDown();
    }
    /**
     * A basic model fetching data test.
     *
     * @return void
     */
    public function testModelFetch()
    {
        $user = User::find($this->user->id);
        $this->assertEquals($this->user->email, $user->email);
    }

    /**
     * test User Model returns correct payload for needed jwt payload
     *
     * @return void
     */
    public function testJWTPayload(){
        $this->assertEquals($this->user->getJWTIdentifier(), $this->user->id);
    }

    /**
     * test function on user model to return correct extra claims for JWT payload
     *
     * @return void
     */
    public function testJWTExtraPayload(){
        $this->assertEquals($this->user->getJWTCustomClaims(), ['name' => $this->user->name]);
    }

}
