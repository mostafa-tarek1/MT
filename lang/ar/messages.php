<?php

return [
    // ========================================
    // General Messages
    // ========================================
    'success' => 'تمت العملية بنجاح',
    'error' => 'حدث خطأ ما',
    'created' => 'تم الإنشاء بنجاح',
    'updated' => 'تم التحديث بنجاح',
    'deleted' => 'تم الحذف بنجاح',
    'saved' => 'تم الحفظ بنجاح',
    'not_found' => 'غير موجود',
    'No data found' => 'لا توجد بيانات',
    'unauthorized' => 'غير مصرح',
    'forbidden' => 'محظور',
    'validation_error' => 'خطأ في البيانات المدخلة',
    'server_error' => 'خطأ في الخادم',

    // API specific messages (used in code)
    'Phone already exists' => 'رقم الهاتف مسجل بالفعل',
    'created successfully' => 'تم الإنشاء بنجاح',
    'created_successfully' => 'تم الإنشاء بنجاح',
    'updated_successfully' => 'تم التحديث بنجاح',
    'deleted_successfully' => 'تم الحذف بنجاح',
    'Something went wrong' => 'حدث خطأ ما',
    'Unauthorized' => 'غير مصرح',
    'User not found' => 'المستخدم غير موجود',
    'Invalid or expired OTP' => 'رمز التحقق غير صحيح أو منتهي الصلاحية',
    'Phone verified successfully' => 'تم التحقق من الهاتف بنجاح',
    'Successfully loggedOut' => 'تم تسجيل الخروج بنجاح',
    'Unauthenticated' => 'غير مصرح',

    // ========================================
    // Actions
    // ========================================
    'create' => 'إنشاء',
    'edit' => 'تعديل',
    'update' => 'تحديث',
    'delete' => 'حذف',
    'save' => 'حفظ',
    'cancel' => 'إلغاء',
    'confirm' => 'تأكيد',
    'send' => 'إرسال',
    'search' => 'بحث',
    'filter' => 'تصفية',
    'sort' => 'ترتيب',
    'export' => 'تصدير',
    'import' => 'استيراد',
    'print' => 'طباعة',
    'download' => 'تحميل',
    'upload' => 'رفع',
    'view' => 'عرض',
    'back' => 'رجوع',
    'next' => 'التالي',
    'previous' => 'السابق',
    'submit' => 'إرسال',
    'reset' => 'إعادة تعيين',
    'clear' => 'مسح',
    'close' => 'إغلاق',
    'refresh' => 'تحديث',

    // ========================================
    // Status
    // ========================================
    'active' => 'نشط',
    'inactive' => 'غير نشط',
    'pending' => 'قيد المراجعة',
    'approved' => 'مقبول',
    'rejected' => 'مرفوض',
    'published' => 'منشور',
    'draft' => 'مسودة',
    'archived' => 'مؤرشف',
    'enabled' => 'مفعل',
    'disabled' => 'معطل',

    // ========================================
    // Common
    // ========================================
    'yes' => 'نعم',
    'no' => 'لا',
    'all' => 'الكل',
    'none' => 'لا شيء',
    'select' => 'اختر',
    'choose' => 'اختيار',
    'optional' => 'اختياري',
    'required_field' => 'حقل مطلوب',
    'loading' => 'جاري التحميل...',
    'processing' => 'جاري المعالجة...',
    'please_wait' => 'الرجاء الانتظار...',

    // ========================================
    // Confirmations
    // ========================================
    'are_you_sure' => 'هل أنت متأكد؟',
    'delete_confirmation' => 'هل تريد حذف هذا العنصر؟',
    'cannot_be_undone' => 'لا يمكن التراجع عن هذا الإجراء',

    // ========================================
    // Pagination
    // ========================================
    'showing' => 'عرض',
    'to' => 'إلى',
    'of' => 'من',
    'results' => 'نتيجة',
    'no_results' => 'لا توجد نتائج',

    // ========================================
    // Dates
    // ========================================
    'created_at' => 'تاريخ الإنشاء',
    'updated_at' => 'تاريخ التحديث',
    'deleted_at' => 'تاريخ الحذف',
    'date' => 'التاريخ',
    'time' => 'الوقت',

    // ========================================
    // Profile Image
    // ========================================
    'profile_image_required' => 'صورة الملف الشخصي مطلوبة',
    'profile_image_must_be_image' => 'الملف يجب أن يكون صورة',
    'profile_image_invalid_format' => 'صيغة الصورة غير صحيحة. الصيغ المسموحة: jpeg, png, jpg, gif',
    'profile_image_max_size' => 'حجم الصورة يجب ألا يتجاوز 2 ميجابايت',
    'profile_image_updated_successfully' => 'تم تحديث صورة الملف الشخصي بنجاح',
    'profile_image_deleted_successfully' => 'تم حذف صورة الملف الشخصي بنجاح',
    'no_profile_image_found' => 'لا توجد صورة للملف الشخصي',
    'Profile image updated successfully' => 'تم تحديث صورة الملف الشخصي بنجاح',
    'Profile image deleted successfully' => 'تم حذف صورة الملف الشخصي بنجاح',

    // ========================================
    // Profile
    // ========================================
    'Profile updated successfully' => 'تم تحديث الملف الشخصي بنجاح',
    'Data retrieved successfully' => 'تم جلب البيانات بنجاح',
    'name_must_be_string' => 'الاسم يجب أن يكون نص',
    'name_max_length' => 'الاسم يجب ألا يتجاوز 255 حرف',
    'phone_must_be_string' => 'رقم الهاتف يجب أن يكون نص',
    'phone_must_be_11_digits' => 'رقم الهاتف يجب أن يكون 11 رقم',
    'phone_already_exists' => 'رقم الهاتف موجود بالفعل',
    'User_already_subscribed' => 'المستخدم مشترك بالفعل',

];
