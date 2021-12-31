<?php

namespace app\helpers;

abstract class HttpCode
{
    const HTTP_OK = 200;

    const HTTP_CREATED = 201;

    const HTTP_ACCEPTED = 202;

    const HTTP_NON_AUTHORITATIVE_INFORMATION = 203;

    const HTTP_NO_CONTENT = 204;

    const HTTP_BAD_REQUEST = 400;

    const HTTP_UNAUTHORIZED = 401;

    const HTTP_FORBIDDEN = 403;

    const HTTP_NOT_FOUND = 404;

    const HTTP_INTERNAL_SERVER_ERROR = 500;

    const HTTP_BAD_GATEWAY = 502;

    const HTTP_GATEWAY_TIMEOUT = 504;
}
