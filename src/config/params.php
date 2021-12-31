<?php

return [
    'jwt_key' => getenv('JWT_KEY'),
    'jwt_issuer' => getenv('JWT_ISSUER'),
    'jwt_audience' => getenv('JWT_AUDIENCE'),
    'jwt_expiration_seconds' => getenv('JWT_EXPIRATION_SECONDS'),
    'rate_limit_quantity' => getenv('RATE_LIMIT_QUANTITY'),
    'rate_limit_seconds' => getenv('RATE_LIMIT_SECONDS'),
    'format_excluded_controllers' => explode(',', getenv('FORMAT_EXCLUDED_CONTROLLERS')),
    'api_token' => getenv('API_TOKEN'),
    'general_cache_expiration' => getenv('GENERAL_CACHE_EXPIRATION'),
];
