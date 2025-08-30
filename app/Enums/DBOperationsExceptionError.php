<?php

namespace App\Enums;

enum DBOperationsExceptionError: string
{
    case FETCHING_DATA_EXCEPTION = 'Something went wrong while fetching data from the database.';
}
