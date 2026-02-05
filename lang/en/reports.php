<?php

return [
    // General
    'report' => 'Report',
    'reports' => 'Reports',
    'create_report' => 'Create Report',
    'report_details' => 'Report Details',
    'my_reports' => 'My Reports',
    'all_reports' => 'All Reports',

    // Reportable Types
    'ad' => 'Ad',
    'user' => 'User',
    'message' => 'Message',

    // Report Status
    'pending' => 'Pending',
    'under_review' => 'Under Review',
    'resolved' => 'Resolved',
    'rejected' => 'Rejected',

    // Report Reasons
    'reason' => 'Reason',
    'reasons' => 'Reasons',
    'report_reason' => 'Report Reason',

    // Fields
    'reporter' => 'Reporter',
    'reportable' => 'Reportable',
    'description' => 'Description',
    'status' => 'Status',
    'admin_notes' => 'Admin Notes',
    'resolved_at' => 'Resolved At',
    'replies' => 'Replies',
    'reply' => 'Reply',

    // Messages - Success
    'report_created' => 'Report submitted successfully',
    'report_updated' => 'Report updated successfully',
    'report_deleted' => 'Report deleted successfully',
    'status_updated' => 'Report status updated successfully',
    'reply_added' => 'Reply added successfully',
    'report_retrieved' => 'Report retrieved successfully',
    'reports_retrieved' => 'Reports retrieved successfully',
    'reasons_retrieved' => 'Report reasons retrieved successfully',

    // Messages - Errors
    'report_not_found' => 'Report not found',
    'reportable_not_found' => 'Reported content not found',
    'already_reported' => 'You have already reported this content',
    'cannot_report_own_content' => 'You cannot report your own content',

    // Validation
    'reportable_type_required' => 'Reportable type is required',
    'reportable_type_invalid' => 'Invalid reportable type',
    'reportable_id_required' => 'Reportable ID is required',
    'reportable_id_invalid' => 'Invalid reportable ID',
    'reason_required' => 'Report reason is required',
    'reason_not_found' => 'Report reason not found',
    'description_max' => 'Description must not exceed 1000 characters',
    'status_required' => 'Status is required',
    'status_invalid' => 'Invalid status',
    'admin_notes_max' => 'Admin notes must not exceed 1000 characters',
    'message_required' => 'Message is required',
    'message_max' => 'Message must not exceed 1000 characters',

    // Common Report Reasons (English)
    'inappropriate_content' => 'Inappropriate Content',
    'spam' => 'Spam',
    'scam' => 'Scam',
    'fake_listing' => 'Fake Listing',
    'wrong_category' => 'Wrong Category',
    'duplicate' => 'Duplicate',
    'offensive_language' => 'Offensive Language',
    'harassment' => 'Harassment',
    'violence' => 'Violence',
    'hate_speech' => 'Hate Speech',
    'other' => 'Other',

    // Dashboard Messages
    'status_updated_successfully' => 'Report status updated successfully',
    'reply_added_successfully' => 'Reply added successfully',
];
