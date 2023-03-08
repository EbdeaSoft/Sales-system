<?php

namespace Database\Seeders;
use Spatie\Permission\Models\Permission;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    
    
    $permissions = [
    
            'العمليات',
            'الرئيسية' ,
            'التقارير',
            'الحسابات',
          
        
            'المستخدمين و الفروع',
            'قائمة المستخدمين',
            'صلاحيات المستخدمين',
            'الاعدادات',
            'المنتجات',
            'الاقسام',
    
    
            'اضافة فاتورة',
            'حذف الفاتورة',
            'تصدير EXCEL',
            'تغير حالة الدفع',
            'تعديل الفاتورة',
            'ارشفة الفاتورة',
            'طباعةالفاتورة',
            'اضافة مرفق',
            'حذف المرفق',
            'طباعة',
            'اضافة مستخدم',
            'تعديل مستخدم',
            'حذف مستخدم',
    
            'عرض صلاحية',
            'اضافة صلاحية',
            'تعديل صلاحية',
            'حذف صلاحية',
    
            'اضافة منتج',
            'تعديل منتج',
            'حذف منتج',
    
            'اضافة مستخدم',
            'تعديل مستخدم',
            'حذف مستخدم',
            'الاشعارات',
    
    ];
    
    
    
    foreach ($permissions as $permission) {
    
    Permission::create(['name' => $permission]);
    }
    
    
    }
    }

