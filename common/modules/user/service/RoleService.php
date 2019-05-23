<?php

namespace common\modules\user\service;

use common\modules\user\models\User;

/**
 * Class RoleService
 * @package common\modules\user\service
 */
class RoleService
{
    /**
     * @return string
     */
    public function getDefaultRole()
    {
        return User::ROLE_USER;
    }

    /**
     * @param string $role
     * @return string
     */
    public function getRoleLabel(string $role): string
    {
        return $this->getAllLabels()[$role] ?? '';
    }

    /**
     * Возвращает все роли и их названия.
     *
     * @return array
     */
    public function getAllLabels(): array
    {
        return [
            User::ROLE_USER => 'Пользователь',
            User::ROLE_ADMIN => 'Администратор',
        ];
    }

    /**
     * @param array $roles
     * @return array
     */
    public function getLabels(array $roles): array
    {
        $data = [];

        foreach ($roles as $role) {
            $data[$role] = $this->getAllLabels()[$role] ?? '';
        }

        return $data;
    }

    /**
     * Возвращает все доступные роли.
     *
     * @return array
     */
    public function getAllAvailableRoles(): array
    {
        return [
            User::ROLE_USER,
            User::ROLE_ADMIN,
        ];
    }

    /**
     * Возвращает роли, доступные для выбора менеджерами.
     *
     * @return array
     */
    public function getSelectableRolesByManagers(): array
    {
        $data = [];
        foreach ($this->getAllAvailableRoles() as $role) {
            if (\can($role)) {
                $data[] = $role;
            }
        }
        return $data;
    }

    /**
     * Возвращает роли, доступные для выбора пользователями.
     *
     * @return array
     */
    public function getSelectableRoles(): array
    {
        return [
            User::ROLE_USER,
        ];
    }
}