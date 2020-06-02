<?php

namespace App\Helpers;

class Constants {
    const MAX_NAME_LENGTH = 100;
    const MAX_DESCRIPTION_LENGTH = 600;
    const MAX_PHONE_LENGTH = 100;
    const MIN_PASSWORD_LENGTH = 6;
    const MAX_TERM_LENGTH = 30;
    const MAX_HOURLY_RATE = 10000;

    const MAX_RESULT_LIST = 3;

    const ALLOWED_ORDER_BY = ['hourly_rate', 'name'];
}