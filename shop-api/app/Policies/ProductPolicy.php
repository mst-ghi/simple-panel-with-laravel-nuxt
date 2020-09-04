<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can list any products.
     *
     * @param  User  $user
     * @return mixed
     */
    public function list(User $user)
    {
        return $user->canUser('product_list');
    }

    /**
     * Determine whether the user can show the product.
     *
     * @param  User  $user
     * @param  Product  $product
     * @return mixed
     */
    public function show(User $user, Product $product)
    {
        return $user->canUser('product_show');
    }

    /**
     * Determine whether the user can store products.
     *
     * @param  User  $user
     * @return mixed
     */
    public function store(User $user)
    {
        return $user->canUser('product_store');
    }

    /**
     * Determine whether the user can update the product.
     *
     * @param  User  $user
     * @param  Product  $product
     * @return mixed
     */
    public function update(User $user, Product $product)
    {
        return $user->canUser('product_update');
    }

    /**
     * Determine whether the user can destroy the product.
     *
     * @param  User  $user
     * @param  Product  $product
     * @return mixed
     */
    public function destroy(User $user, Product $product)
    {
        return $user->canUser('product_destroy');
    }

    /**
     * Determine whether the user can status the product.
     *
     * @param  User  $user
     * @param  Product  $product
     * @return mixed
     */
    public function status(User $user, Product $product)
    {
        return $user->canUser('product_status');
    }

}
