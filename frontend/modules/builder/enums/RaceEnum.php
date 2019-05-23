<?php

namespace frontend\modules\builder\enums;

use frontend\enums\BaseEnum;

/**
 * Class RaceEnum
 * @author Daniil Ilin <daniil.ilin@gmail.com>
 */
class RaceEnum extends BaseEnum
{
    const BRETON_ID   = 1;
    const HIGHELF_ID  = 2;
    const ARGONIAN_ID = 3;
    const ORC_ID      = 4;
    const WOODELF_ID  = 5;
    const DARKELF_ID  = 6;
    const REDGUARD_ID = 7;
    const KHAJIT_ID   = 8;
    const NORD_ID     = 9;
    const IMPERIAL_ID = 10;

    const BRETON   = 'Бретон';
    const HIGHELF  = 'Высокий эльф';
    const ARGONIAN = 'Аргонианин';
    const ORC      = 'Орк';
    const WOODELF  = 'Лесной эльф';
    const DARKELF  = 'Темный эльф';
    const REDGUARD = 'Редгард';
    const KHAJIT   = 'Каджит';
    const NORD     = 'Норд';
    const IMPERIAL = 'Имперец';

    /**
     * @return array
     */
    public static function getItems(): array
    {
        return [
            self::BRETON_ID   => self::BRETON,
            self::HIGHELF_ID  => self::HIGHELF,
            self::ARGONIAN_ID => self::ARGONIAN,
            self::ORC_ID      => self::ORC,
            self::WOODELF_ID  => self::WOODELF,
            self::DARKELF_ID  => self::DARKELF,
            self::REDGUARD_ID => self::REDGUARD,
            self::KHAJIT_ID   => self::KHAJIT,
            self::NORD_ID     => self::NORD,
            self::IMPERIAL_ID => self::IMPERIAL,
        ];
    }
}