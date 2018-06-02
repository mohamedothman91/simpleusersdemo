<?php


class UsersCest
{
    public function _before(ApiTester $I)
    {
    }

    public function _after(ApiTester $I)
    {
    }

    // tests
    public function getUsers(ApiTester $I)
    {
        $I->haveHttpHeader('Accept', 'application/json');
        $I->sendGET('/users');
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseIsJson();
        $I->seeResponseJsonMatchesJsonPath('$[0].id');
        $I->seeResponseJsonMatchesJsonPath('$[0].first_name');
        $I->seeResponseJsonMatchesJsonPath('$[0].last_name');
        $I->seeResponseJsonMatchesJsonPath('$[0].email');
        $I->seeResponseJsonMatchesJsonPath('$[0].company');
        $I->seeResponseJsonMatchesJsonPath('$[0].title');
        $I->seeResponseJsonMatchesJsonPath('$[0].address');
        $I->seeResponseJsonMatchesJsonPath('$[0].city');
        $I->seeResponseJsonMatchesJsonPath('$[0].phone');
    }

    public function createUser(ApiTester $I)
    {
        $I->haveHttpHeader('Accept', 'application/json');
        $I->haveHttpHeader('Content-Type', 'application/x-www-form-urlencoded');
        $I->sendPOST('/users', [
                                'first_name' => rand().'test',
                                'last_name' => rand().'test',
                                'email' => rand().'test@ahmed.com',
                                'password' => rand(),
        ]);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseIsJson();
        $I->seeResponseContains('{"result":"ok"}');
    }

    public function updateUser(ApiTester $I)
    {
        $I->haveHttpHeader('Accept', 'application/json');
        $I->haveHttpHeader('Content-Type', 'application/x-www-form-urlencoded');
        $I->sendPUT('/users', [
                                'id' => '1',
                                'first_name' => rand().'test',
                                'last_name' => rand().'test',
                                'email' => rand().'test@ahmed.com',
        ]);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseIsJson();
        $I->seeResponseContains('{"result":"ok"}');
    }

    public function deleteUser(ApiTester $I)
    {
        $I->haveHttpHeader('Accept', 'application/json');
        $I->haveHttpHeader('Content-Type', 'application/x-www-form-urlencoded');
        $I->sendDELETE('/users?id=1');
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseIsJson();
        $I->seeResponseContains('{"result":"ok"}');
    }

    //endregion
}
