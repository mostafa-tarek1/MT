<?php

return [
    /*
  |--------------------------------------------------------------------------
  | Notification Language Lines (Arabic)
  |--------------------------------------------------------------------------
  */

    // Notification Types
    'new_message' => 'رسالة جديدة',
    'new_rating' => 'تقييم جديد',
    'ad_status' => 'حالة الإعلان',
    'commission_reminder' => 'تذكير بالعمولة',
    'report_response' => 'رد على البلاغ',
    'favorite_ad_status' => 'تحديث الإعلان المفضل',

    // Ad Status Notifications
    'ad_approved' => 'تم الموافقة على إعلانك',
    'ad_rejected' => 'تم رفض إعلانك',
    'ad_rejected_with_reason' => 'تم رفض إعلانك. السبب: :reason',
    'ad_expired' => 'انتهت صلاحية إعلانك',
    'ad_status_changed' => 'تم تغيير حالة إعلانك',

    // Rating Notifications
    'new_rating_message' => 'تلقيت تقييم جديد من :rater بتقدير :rating نجوم',

    // Commission Notifications
    'commission_reminder_message' => 'تذكير بالعمولة المستحقة: :amount ريال. متبقي :days أيام حتى تاريخ الاستحقاق',

    // Report Notifications
    'report_under_review' => 'بلاغك قيد المراجعة',
    'report_resolved' => 'تم حل بلاغك',
    'report_rejected' => 'تم رفض بلاغك',
    'report_status_changed' => 'تم تغيير حالة بلاغك',
    'report_reply_added' => 'تم الرد على بلاغك',
    'report_reply_message' => 'تلقيت ردًا على بلاغك من الإدارة',

    // Favorite Ad Notifications
    'favorite_ad_sold' => 'تم بيع الإعلان المفضل لديك',
    'favorite_ad_price_reduced' => 'تم تخفيض سعر الإعلان المفضل لديك',
    'favorite_ad_back_available' => 'الإعلان المفضل لديك أصبح متاحًا مجددًا',
    'favorite_ad_updated' => 'تم تحديث الإعلان المفضل لديك',

    // General
    'notifications' => 'الإشعارات',
    'no_notifications' => 'لا توجد إشعارات',
    'mark_all_as_read' => 'تعليم الكل كمقروء',
    'mark_as_read' => 'تعليم كمقروء',
    'delete_notification' => 'حذف الإشعار',
    'notification_deleted' => 'تم حذف الإشعار بنجاح',
    'all_notifications_marked_read' => 'تم تعليم جميع الإشعارات كمقروءة',
    'notification_settings' => 'إعدادات الإشعارات',

    // Error Messages
    'notification_not_found' => 'الإشعار غير موجود',
    'failed_to_load_notifications' => 'فشل في تحميل الإشعارات',
    'failed_to_mark_as_read' => 'فشل في تعليم الإشعار كمقروء',
    'failed_to_delete_notification' => 'فشل في حذف الإشعار',
];
