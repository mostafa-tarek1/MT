<?php

return [
    // General
    'ratings' => 'التقييمات',
    'rating' => 'التقييم',
    'add_rating' => 'إضافة تقييم',
    'edit_rating' => 'تعديل التقييم',
    'delete_rating' => 'حذف التقييم',
    'my_ratings' => 'تقييماتي',
    'user_ratings' => 'تقييمات المستخدم',

    // Fields
    'rater' => 'المشتري',
    'rated_user' => 'البائع المُقيَّم',
    'seller' => 'البائع',
    'buyer' => 'المشتري',
    'ad' => 'الإعلان',
    'comment' => 'التعليق',
    'status' => 'الحالة',
    'reply' => 'الرد',
    'seller_ratings' => 'تقييمات البائع',
    'rate_seller' => 'قيّم البائع',

    // Rating Values
    'one_star' => 'نجمة واحدة',
    'two_stars' => 'نجمتان',
    'three_stars' => 'ثلاث نجوم',
    'four_stars' => 'أربع نجوم',
    'five_stars' => 'خمس نجوم',

    // Status
    'pending' => 'قيد المراجعة',
    'approved' => 'موافق عليه',
    'rejected' => 'مرفوض',

    // Statistics
    'total_ratings' => 'إجمالي التقييمات',
    'average_rating' => 'متوسط التقييم',
    'rating_stats' => 'إحصائيات التقييم',
    'rating_distribution' => 'توزيع التقييمات',

    // Messages
    'rating_created_successfully' => 'تم إضافة التقييم بنجاح',
    'rating_updated_successfully' => 'تم تحديث التقييم بنجاح',
    'rating_deleted_successfully' => 'تم حذف التقييم بنجاح',
    'rating_not_found' => 'التقييم غير موجود',
    'reply_created_successfully' => 'تم إضافة الرد بنجاح',
    'reply_updated_successfully' => 'تم تحديث الرد بنجاح',
    'reply_deleted_successfully' => 'تم حذف الرد بنجاح',
    'reply_not_found' => 'الرد غير موجود',

    // Errors
    'please_login_to_rate' => 'يرجى تسجيل الدخول لتقييم البائع',
    'cannot_rate_yourself' => 'لا يمكنك تقييم نفسك',
    'already_rated' => 'لقد قمت بتقييم هذا البائع من قبل لهذا الإعلان',
    'invalid_rating_value' => 'قيمة التقييم يجب أن تكون بين 1 و 5',
    'unauthorized_action' => 'غير مصرح لك بهذا الإجراء',
    'only_rated_user_can_reply' => 'فقط البائع المُقيَّم يمكنه الرد على التقييم',
    'must_have_transaction' => 'يجب أن يكون لديك تعامل سابق مع البائع لتقييمه',

    // Validation
    'rating_required' => 'التقييم مطلوب',
    'rating_integer' => 'يجب أن يكون التقييم رقم صحيح',
    'rating_between' => 'يجب أن يكون التقييم بين :min و :max',
    'comment_max' => 'يجب ألا يتجاوز التعليق :max حرف',
    'rated_user_required' => 'المستخدم المقيّم مطلوب',
    'rated_user_exists' => 'المستخدم المقيّم غير موجود',

    // Admin
    'all_ratings' => 'كل التقييمات',
    'pending_ratings' => 'التقييمات المعلقة',
    'approved_ratings' => 'التقييمات الموافق عليها',
    'rejected_ratings' => 'التقييمات المرفوضة',
    'rating_approved_successfully' => 'تم الموافقة على التقييم بنجاح',
    'rating_rejected_successfully' => 'تم رفض التقييم بنجاح',
    'global_statistics' => 'الإحصائيات العامة',
    'manage_ratings' => 'إدارة التقييمات',

    // Dashboard Translations
    'dashboard' => 'لوحة التحكم',
    'filters' => 'فلاتر البحث',
    'all' => 'الكل',
    'from_date' => 'من تاريخ',
    'to_date' => 'إلى تاريخ',
    'search' => 'بحث',
    'search_in_comments' => 'البحث في التعليقات',
    'filter' => 'تصفية',
    'reset' => 'إعادة تعيين',
    'id' => 'المعرف',
    'date' => 'التاريخ',
    'actions' => 'الإجراءات',
    'rating_details' => 'تفاصيل التقييم',
    'no_data' => 'لا توجد بيانات',
    'previous' => 'السابق',
    'next' => 'التالي',
    'created_at' => 'تاريخ الإنشاء',
    'are_you_sure' => 'هل أنت متأكد؟',
    'confirm_delete' => 'هل تريد حذف هذا التقييم؟',
];
