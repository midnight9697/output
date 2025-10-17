<?php

namespace App\Policies;

use App\Models\Supplier;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SupplierPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function updateView(User $user, $supplier_id) {
        $id = decryptUrlSafe($supplier_id);
        $supplier = Supplier::where('id', $id)->first();
        return $user->role == 'superadmin' || $user->role == 'admin';
    }

    public function supplierView(User $user) {
        return $user->role == 'superadmin' || $user->role == 'admin';
    }
}
