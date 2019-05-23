<?php

declare(strict_types = 1);

namespace console\components;

use yii\db\TableSchema;

/**
 * Базовый класс для миграций.
 * @author Dmitry Erofeev <dmeroff@gmail.com>
 */
class Migration extends \yii\db\Migration
{
    /**
     * JSON
     * @return \yii\db\ColumnSchemaBuilder
     */
    public function json()
    {
        return $this->getDb()->getSchema()->createColumnSchemaBuilder('JSONB');
    }

    /**
     * @return \yii\db\ColumnSchemaBuilder
     */
    public function point()
    {
        return $this->getDb()->getSchema()->createColumnSchemaBuilder('POINT');
    }

    /**
     * @param $table
     * @param $column
     * @throws \yii\db\Exception
     */
    public function dropNotNull($table, $column)
    {
        echo "    > drop NOT NULL for column $column in table $table ...";
        $time = microtime(true);
        $table = $this->db->quoteTableName($table);
        $column = $this->db->quoteColumnName($column);
        $sql = "ALTER TABLE $table ALTER COLUMN $column DROP NOT NULL;";
        $this->db->createCommand($sql)->execute();
        echo " done (time: " . sprintf('%.3f', microtime(true) - $time) . "s)\n";
    }

    /**
     * @param $table
     * @param $column
     * @throws \yii\db\Exception
     */
    public function setNotNull($table, $column)
    {
        echo "    > set NOT NULL for column $column in table $table ...";
        $time = microtime(true);
        $table = $this->db->quoteTableName($table);
        $column = $this->db->quoteColumnName($column);
        $sql = "ALTER TABLE $table ALTER COLUMN $column SET NOT NULL;";
        $this->db->createCommand($sql)->execute();
        echo " done (time: " . sprintf('%.3f', microtime(true) - $time) . "s)\n";
    }

    /**
     * @param string $name
     * @return bool
     */
    public function hasTable(string $name): bool
    {
        return $this->getDb()->getTableSchema($name) !== null;
    }

    /**
     * @param string $tableName
     * @param string $columnName
     * @return bool
     */
    public function hasColumn(string $tableName, string $columnName): bool
    {
        $schema = $this->getDb()->getTableSchema($tableName);

        if ($schema instanceof TableSchema) {
            return $schema->getColumn($columnName) !== null;
        }

        return false;
    }
}