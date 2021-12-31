<?php

use app\helpers\HttpCode;

class UserCest
{
    private const HOTEL_ID = 1;
    private const NOT_EXISTENT_HOTEL_ID = 9999;

    /**
     * @param ApiTester $I
     */
    public function shouldDisplayAllUsersBookedByHotelOk(ApiTester $I): void
    {
        //I don't know because it is not configured
        //$I->haveHttpHeader('Authorization', 'Bearer TokenRandom');

        $I->sendGet(sprintf('/hotels/%u/users/booked', self::HOTEL_ID));
        $I->canSeeResponseIsJson();
        $I->seeResponseCodeIs(HttpCode::HTTP_OK);
    }

    /**
     * @param ApiTester $I
     */
    public function shouldThrowNotFoundHotel(ApiTester $I): void
    {
        $I->sendGet(sprintf('/hotels/%u/users/booked', self::NOT_EXISTENT_HOTEL_ID));
        $I->canSeeResponseIsJson();
        $I->seeResponseCodeIs(HttpCode::HTTP_NOT_FOUND);
    }
}
