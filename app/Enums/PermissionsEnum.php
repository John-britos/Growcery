<?php

namespace App\Enums;

enum PermissionsEnum: string
{
 // Admin Permissions
 case ApproveVendor = 'ApproveVendor';
 case ManageUsers = 'ManageUsers';
 case ManageProducts = 'ManageProducts';
 case ViewOrders = 'ViewOrders';
 case ManageOrders = 'ManageOrders';
 case ViewDashboard = 'ViewDashboard';
 case AssignRoles = 'AssignRoles';
 case ManageCategories = 'ManageCategories';

 // Vendor (Farmer) Permissions
 case SellProducts = 'SellProducts';
 case ManageOwnProducts = 'ManageOwnProducts';
 case ViewOwnOrders = 'ViewOwnOrders';
 case UpdateOrderStatus = 'UpdateOrderStatus';
 case ViewSalesStats = 'ViewSalesStats';

 // Customer Permissions
 case ViewProducts = 'ViewProducts';
 case PlaceOrders = 'PlaceOrders';
 case TrackOrders = 'TrackOrders';
 case RateVendors = 'RateVendors';
}
