<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Shop;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }


    /**
     * Check if the user has a specific role.
     *
     * @param User $user
     * @param string $role
     * @return bool
     */
    public function hasRole(User $user, string $role): bool
    {
        return $user->role->name === $role;
    }

    /**
     * Check if the user is an admin.
     *
     * @param User $user
     * @return bool
     */
    public function isAdmin(User $user): bool
    {
        return $this->hasRole($user, 'admin');
    }

    /**
     * Check if the user is a shop manager.
     *
     * @param User $user
     * @return bool
     */
    public function isShopManager(User $user): bool
    {
        return $this->hasRole($user, 'shop_manager');
    }

    /**
     * Determine if the user can update the shop.
     *
     * @param User $user
     * @param Shop $shop
     * @return bool
     */
    public function update(User $user, Shop $shop): bool
    {
        // 管理者は無条件で許可
        if ($this->isAdmin($user)) {
            return true;
        }

        // 店舗の管理者であれば許可
        return $user->id === $shop->manager_id;
    }
}
