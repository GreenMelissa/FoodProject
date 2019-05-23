<?php

namespace frontend\enums;

/**
 * Class BaseEnum
 * @author Daniil Ilin <daniil.ilin@gmail.com>
 */
abstract class BaseEnum
{
    /**
     * @return array
     */
    abstract public static function getItems() : array;

    /**
     * @return array
     */
    public static function getKeys() : array
    {
        return \array_keys(static::getItems());
    }

    /**
     * @param mixed $id
     * @param mixed $defaultValue
     * @return mixed|null
     */
    public static function getItem($id, $defaultValue = null)
    {
        return static::getItems()[$id] ?? $defaultValue;
    }
}