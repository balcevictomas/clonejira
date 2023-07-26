<?php

declare(strict_types=1);

namespace App\Enum;

enum TaskStatuses: int
{
    case BACKLOG = 0;
    case PAUSE = 1;
    case IN_PROGRESS = 2;
    case QA_TESTING = 3;
    case LIVE_DEPLOYMENT = 4;

    public static function getValues(): array
    {
        return [
            self::BACKLOG,
            self::PAUSE,
            self::IN_PROGRESS,
            self::QA_TESTING,
            self::LIVE_DEPLOYMENT,
        ];
    }

    public static function getStatusName(self $status): string
    {
        return match ($status) {
            self::BACKLOG => 'Backlog',
            self::PAUSE => 'Pause',
            self::IN_PROGRESS => 'In Progress',
            self::QA_TESTING => 'QA Testing',
            self::LIVE_DEPLOYMENT => 'Live Deployment',
            default => 'Unknown Status',
        };
    }

    public static function getStatusNameById(int $statusId): string
    {
        return match ($statusId) {
            self::BACKLOG->value => 'Backlog',
            self::PAUSE->value => 'Pause',
            self::IN_PROGRESS->value => 'In Progress',
            self::QA_TESTING->value => 'QA Testing',
            self::LIVE_DEPLOYMENT->value => 'Live Deployment',
            default => 'Unknown Status',
        };
    }
}
