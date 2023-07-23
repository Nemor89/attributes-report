<?php

namespace App\Cache\Enum;

enum CacheStrategy: string
{
    case Readonly = 'readonly';
    case ReadWrite = 'read-write';
}
