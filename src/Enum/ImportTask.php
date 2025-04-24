<?php declare(strict_types = 1);

namespace Adbros\Exam\Enum;

enum ImportTask: string {
    case USER_CSV = 'user_csv';
    case ARTICLE_JSON = 'article_json';
}