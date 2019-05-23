<?php

namespace frontend\modules\builder\enums;

use frontend\enums\BaseEnum;

/**
 * Class ClassEnum
 * @author Daniil Ilin <daniil.ilin@gmail.com>
 */
class ClassEnum extends BaseEnum
{
    const DRAGONKNIGHT_ID = 1;
    const SORCERER_ID     = 2;
    const NIGHTBLADE_ID   = 3;
    const TEMPLAR_ID      = 4;
    const WARDEN_ID       = 5;

    const DRAGONKNIGHT = 'Рыцарь дракона';
    const SORCERER     = 'Чародей';
    const NIGHTBLADE   = 'Ночной клинок';
    const TEMPLAR      = 'Храмовник';
    const WARDEN       = 'Варден';

    /**
     * @return array
     */
    public static function getItems(): array
    {
        return [
            self::DRAGONKNIGHT_ID => self::DRAGONKNIGHT,
            self::SORCERER_ID     => self::SORCERER,
            self::NIGHTBLADE_ID   => self::NIGHTBLADE,
            self::TEMPLAR_ID      => self::TEMPLAR,
            self::WARDEN_ID       => self::WARDEN,
        ];
    }
}