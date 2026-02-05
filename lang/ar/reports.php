<?php

return [
    // General
    'report' => 'بلاغ',
    'reports' => 'البلاغات',
    'create_report' => 'إنشاء بلاغ',
    'report_details' => 'تفاصيل البلاغ',
    'my_reports' => 'بلاغاتي',
    'all_reports' => 'جميع البلاغات',

    // Reportable Types
    'ad' => 'إعلان',
    'user' => 'مستخدم',
    'message' => 'رسالة',

    // Report Status
    'pending' => 'قيد الانتظار',
    'under_review' => 'قيد المراجعة',
    'resolved' => 'محلول',
    'rejected' => 'مرفوض',

    // Report Reasons
    'reason' => 'السبب',
    'reasons' => 'الأسباب',
    'report_reason' => 'سبب البلاغ',

    // Fields
    'reporter' => 'المبلغ',
    'reportable' => 'المبلغ عنه',
    'description' => 'الوصف',
    'status' => 'الحالة',
    'admin_notes' => 'ملاحظات الإدارة',
    'resolved_at' => 'تاريخ الحل',
    'replies' => 'الردود',
    'reply' => 'رد',

    // Messages - Success
    'report_created' => 'تم إرسال البلاغ بنجاح',
    'report_updated' => 'تم تحديث البلاغ بنجاح',
    'report_deleted' => 'تم حذف البلاغ بنجاح',
    'status_updated' => 'تم تحديث حالة البلاغ بنجاح',
    'reply_added' => 'تم إضافة الرد بنجاح',
    'report_retrieved' => 'تم جلب البلاغ بنجاح',
    'reports_retrieved' => 'تم جلب البلاغات بنجاح',
    'reasons_retrieved' => 'تم جلب أسباب البلاغ بنجاح',

    // Messages - Errors
    'report_not_found' => 'البلاغ غير موجود',
    'reportable_not_found' => 'المحتوى المبلغ عنه غير موجود',
    'already_reported' => 'لقد قمت بالإبلاغ عن هذا المحتوى من قبل',
    'cannot_report_own_content' => 'لا يمكنك الإبلاغ عن المحتوى الخاص بك',

    // Validation
    'reportable_type_required' => 'نوع المحتوى مطلوب',
    'reportable_type_invalid' => 'نوع المحتوى غير صحيح',
    'reportable_id_required' => 'معرف المحتوى مطلوب',
    'reportable_id_invalid' => 'معرف المحتوى غير صحيح',
    'reason_required' => 'سبب البلاغ مطلوب',
    'reason_not_found' => 'سبب البلاغ غير موجود',
    'description_max' => 'الوصف يجب ألا يتجاوز 1000 حرف',
    'status_required' => 'الحالة مطلوبة',
    'status_invalid' => 'الحالة غير صحيحة',
    'admin_notes_max' => 'ملاحظات الإدارة يجب ألا تتجاوز 1000 حرف',
    'message_required' => 'الرسالة مطلوبة',
    'message_max' => 'الرسالة يجب ألا تتجاوز 1000 حرف',

    // Common Report Reasons (Arabic)
    'inappropriate_content' => 'محتوى غير لائق',
    'spam' => 'رسائل مزعجة',
    'scam' => 'احتيال',
    'fake_listing' => 'إعلان وهمي',
    'wrong_category' => 'تصنيف خاطئ',
    'duplicate' => 'مكرر',
    'offensive_language' => 'لغة مسيئة',
    'harassment' => 'مضايقة',
    'violence' => 'عنف',
    'hate_speech' => 'خطاب كراهية',
    'other' => 'أخرى',

    // Dashboard Messages
    'status_updated_successfully' => 'تم تحديث حالة البلاغ بنجاح',
    'reply_added_successfully' => 'تم إضافة الرد بنجاح',
];
