<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Enums\PermissionsEnum;
use App\Enums\RolesEnum;


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userRole = Role::create(['name' => RolesEnum::User->value]);
        $vendorRole = Role::create(['name' => RolesEnum::Vendor->value]);
        $adminRole = Role::create(['name' => RolesEnum::Admin->value]);
        //admin roles
        $ApproveVendor = Permission::create(['name' => PermissionsEnum::ApproveVendor->value]);
        $ManageUsers = Permission::create(['name' => PermissionsEnum::ManageUsers->value]);
        $ManageProducts = Permission::create(['name' => PermissionsEnum::ManageProducts->value]);
        $ManageOrders = Permission::create(['name' => PermissionsEnum::ManageOrders->value]);
        $ViewOrders = Permission::create(['name' => PermissionsEnum::ViewOrders->value]);
        $ViewDashboard = Permission::create(['name' => PermissionsEnum::ViewDashboard->value]);
        $AssignRoles = Permission::create(['name' => PermissionsEnum::AssignRoles->value]);
        $ManageCategories = Permission::create(['name' => PermissionsEnum::ManageCategories->value]);
        //vendor roles
        $SellProducts = Permission::create(['name' => PermissionsEnum::SellProducts->value]);
        $ManageOwnProducts = Permission::create(['name' => PermissionsEnum::ManageOwnProducts->value]);
        $ViewOwnOrders = Permission::create(['name' => PermissionsEnum::ViewOwnOrders->value]);
        $UpdateOrderStatus = Permission::create(['name' => PermissionsEnum::UpdateOrderStatus->value]);
        $ViewSalesStats = Permission::create(['name' => PermissionsEnum::ViewSalesStats->value]);
        //customer roles
        $ViewProducts = Permission::create(['name' => PermissionsEnum::ViewProducts->value]);
        $PlaceOrders = Permission::create(['name' => PermissionsEnum::PlaceOrders->value]);
        $TrackOrders = Permission::create(['name' => PermissionsEnum::TrackOrders->value]);
        $RateVendors = Permission::create(['name' => PermissionsEnum::RateVendors->value]);
        
        $userRole -> syncPermissions([
            $ViewProducts,
            $PlaceOrders,
            $TrackOrders,
            $RateVendors,
        ]);

        $vendorRole -> syncPermissions([
            $ViewProducts,
            $PlaceOrders,
            $TrackOrders,
            $RateVendors,
            $SellProducts,
            $ManageOwnProducts,
            $ViewOwnOrders,
            $UpdateOrderStatus,
            $ViewSalesStats,
        ]);
        $adminRole -> syncPermissions([
            $ApproveVendor,
            $ManageUsers,
            $ManageProducts,
            $ViewOrders,
            $ManageOrders,
            $ViewDashboard,
            $AssignRoles,
            $ManageCategories,
        ]);
    }
}
