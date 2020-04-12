<?php

namespace agungsugiarto\boilerplate\Models;

use Myth\Auth\Authorization\GroupModel;

/**
 * Class Group.
 */
class Group extends GroupModel
{
    /**
     * Returns an array of all groups that a user is a member of.
     *
     * @param $userId
     *
     * @return object
     */
    public function getGroupsForUser(int $userId)
    {
        $group = $this->builder()
                ->join('auth_groups_users', 'auth_groups_users.group_id = auth_groups.id', 'left')
                ->where('user_id', $userId)
                ->get()
                ->getResultObject();

        $found = [];
        foreach ($group as $row) {
            $found[$row->id] = strtolower($row->name);
        }

        return $found;
    }
}
