<?php
use Flywheel\Factory;
use Flywheel\Filter\Input as Filter;

class AccountController extends V1ApiController {

    /**
     * get detail account
     * ROUTE: GET /api/v1/account/detail/{uk}
     */
    public function getDetail() {}

    /**
     * create new account
     * ROUTE: POST /api/v1/account
     */
    public function post() {}

    /**
     * delete account
     * ROUTE: PUT /api/v1/account/delete/{uk}
     */
    public function putDelete() {}

    /**
     * frozen account
     * Router: PUT /api/v1/account/frozen/{uk}
     */
    public function putFrozen() {}

    /**
     * reactive account (change status to normal)
     * ROUTE: PUT /api/v1/account/reactive/{uk}
     */
    public function putReactive() {}
}
