<?php

declare(strict_types=1);

namespace backend\components\enums;

class RoutesEnum
{
    public const HOME = '/';
    public const LOGIN = '/site/login';
    public const LOGOUT = '/site/logout';
    public const CLIENTS = '/client/index';
    public const COMPANIES = '/company/index';

    public const COMPANY_LIST_FOR_SELECT2 = '/company/get-list-for-select2';
    public const CLIENT_LIST_FOR_SELECT2 = '/client/get-list-for-select2';

}
