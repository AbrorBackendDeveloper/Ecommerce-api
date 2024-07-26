<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::create(['name' => 'admin']);
        
        $this->createPermission('role:viewAny');
        $this->createPermission('role:view');
        $this->createPermission('role:assign');
        $this->createPermission('role:create');
        $this->createPermission('role:update');
        $this->createPermission('role:delete');
        $this->createPermission('role:restore');
        $this->createPermission('permission:viewAny');
        $this->createPermission('permission:view');
        $this->createPermission('permission:assign');
        $this->createPermission('permission:create');
        $this->createPermission('permission:update');
        $this->createPermission('permission:delete');
        $this->createPermission('permission:restore');
        $this->createPermission('user:viewAny');
        $this->createPermission('user:view');
        $this->createPermission('user:create');
        $this->createPermission('user:update');
        $this->createPermission('user:delete');
        $this->createPermission('user:restore');

        $statsPermission = $this->createPermission('stats:view');
        
        $role = Role::create(['name' => 'editor']);
        
        $permissions = [
            $this->createPermission('post:viewAny'),
            $this->createPermission('post:view'),
            $this->createPermission('post:create'),
            $this->createPermission('post:update'),
            $this->createPermission('post:delete'),
            $this->createPermission('post:restore'),
        ];
        $role->syncPermissions($permissions);

        
        $role = Role::create(['name' => 'customer']);
        
        $permissions = [
            $this->createPermission('order:viewAny'),
            $this->createPermission('order:view'),
            $this->createPermission('order:create'),
            $this->createPermission('order:update'),
            $this->createPermission('order:delete'),
            $this->createPermission('order:restore'),
        ];
        $role->syncPermissions($permissions);

        
        $role = Role::create(['name' => 'shop-manager']);

                
        $permissions = [
            $this->createPermission('category:viewAny'),
            $this->createPermission('category:view'),
            $this->createPermission('category:create'),
            $this->createPermission('category:update'),
            $this->createPermission('category:delete'),
            $this->createPermission('category:restore'),
            $this->createPermission('product:viewAny'),
            $this->createPermission('product:view'),
            $this->createPermission('product:create'),
            $this->createPermission('product:update'),
            $this->createPermission('product:delete'),
            $this->createPermission('product:restore'),
            $this->createPermission('stock:viewAny'),
            $this->createPermission('stock:view'),
            $this->createPermission('stock:create'),
            $this->createPermission('stock:update'),
            $this->createPermission('stock:delete'),
            $this->createPermission('stock:restore'),
            $this->createPermission('order:viewAny'),
            $this->createPermission('order:view'),
            $this->createPermission('order:create'),
            $this->createPermission('order:update'),
            $this->createPermission('order:delete'),
            $this->createPermission('order:restore'),
            $this->createPermission('review:viewAny'),
            $this->createPermission('review:view'),
            $this->createPermission('review:create'),
            $this->createPermission('review:update'),
            $this->createPermission('review:delete'),
            $this->createPermission('review:restore'),
            $this->createPermission('attribute:viewAny'),
            $this->createPermission('attribute:view'),
            $this->createPermission('attribute:create'),
            $this->createPermission('attribute:update'),
            $this->createPermission('attribute:delete'),
            $this->createPermission('attribute:restore'),
            $this->createPermission('value:viewAny'),
            $this->createPermission('value:view'),
            $this->createPermission('value:create'),
            $this->createPermission('value:update'),
            $this->createPermission('value:delete'),
            $this->createPermission('value:restore'),
            $this->createPermission('delivery-method:viewAny'),
            $this->createPermission('delivery-method:view'),
            $this->createPermission('delivery-method:switch'),
            $this->createPermission('delivery-method:create'),
            $this->createPermission('delivery-method:update'),
            $this->createPermission('delivery-method:delete'),
            $this->createPermission('delivery-method:restore'),
            $this->createPermission('payment-type:viewAny'),
            $this->createPermission('payment-type:view'),
            $this->createPermission('payment-type:switch'),
            $this->createPermission('payment-type:create'),
            $this->createPermission('payment-type:update'),
            $this->createPermission('payment-type:delete'),
            $this->createPermission('payment-type:restore'),
        ];

        $role->syncPermissions($permissions);
        $role->givePermissionTo($statsPermission);

        $role = Role::create(['name' => 'helpdesk-support']);

        $permissions = [
            $this->createPermission('chat:viewAny'),
            $this->createPermission('chat:view'),
            $this->createPermission('chat:create'),
            $this->createPermission('chat:update'),
            $this->createPermission('chat:delete'),
            $this->createPermission('chat:restore'),
            $this->createPermission('email:viewAny'),
            $this->createPermission('email:view'),
            $this->createPermission('email:create'),
            $this->createPermission('email:update'),
            $this->createPermission('email:delete'),
            $this->createPermission('email:restore'),
        ];

        $role->syncPermissions($permissions);        
    }

    private function createPermission(string $name)
    {
        $guardName = 'web';
        if (!Permission::where('name', $name)->where('guard_name', $guardName)->exists()) {
            return Permission::create(['name' => $name, 'guard_name' => $guardName]);
        }
        return Permission::where('name', $name)->where('guard_name', $guardName)->first();
    }
}
