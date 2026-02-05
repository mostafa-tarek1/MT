<?php

use App\Modules\Structure\Http\Controllers\Api\V1\AboutUsController;
use App\Modules\Structure\Http\Controllers\Api\V1\BranchController;
use App\Modules\Structure\Http\Controllers\Api\V1\CustomerReviewController;
use App\Modules\Structure\Http\Controllers\Api\V1\FooterController;
use App\Modules\Structure\Http\Controllers\Api\V1\HeaderController;
use App\Modules\Structure\Http\Controllers\Api\V1\MobileSectionController;
use App\Modules\Structure\Http\Controllers\Api\V1\OurAdvantagesController;
use App\Modules\Structure\Http\Controllers\Api\V1\OurServicesController;
use App\Modules\Structure\Http\Controllers\Api\V1\PrivacyPolicyController;
use App\Modules\Structure\Http\Controllers\Api\V1\StructureServiceController;
use App\Modules\Structure\Http\Controllers\Api\V1\TermsAndConditionsController;
use Illuminate\Support\Facades\Route;

Route::prefix('structures')->group(function () {
    Route::get('header', HeaderController::class);
    Route::get('about', AboutUsController::class);
    Route::get('our_services', OurServicesController::class);
    Route::get('our_advantages', OurAdvantagesController::class);
    Route::get('struct_branches', BranchController::class);
    Route::get('our_partners', CustomerReviewController::class);
    Route::get('mobile_section', MobileSectionController::class);
    Route::get('footer', FooterController::class);
    Route::get('terms_and_conditions', TermsAndConditionsController::class);
    Route::get('privacy_policy', PrivacyPolicyController::class);
    Route::get('structure_service', StructureServiceController::class);
});
