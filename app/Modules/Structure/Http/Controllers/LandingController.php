<?php

namespace App\Modules\Structure\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Structure\Http\Services\Api\V1\StructureService;

class LandingController extends Controller
{
    protected StructureService $structureService;

    public function __construct(StructureService $structureService)
    {
        $this->structureService = $structureService;
    }

    public function index()
    {
        $hero = $this->structureService->get('hero', data_needed: true);
        $header = $this->structureService->get('header', data_needed: true);
        $features = $this->structureService->get('features', data_needed: true);
        $whoIsThisFor = $this->structureService->get('who_is_this_for', data_needed: true);
        $flexibleSystem = $this->structureService->get('flexible_system', data_needed: true);
        $customerReviews = $this->structureService->get('customer_reviews', data_needed: true);
        $cta = $this->structureService->get('cta', data_needed: true);
        $contact = $this->structureService->get('contact', data_needed: true);
        $footer = $this->structureService->get('footer', data_needed: true);

        return view('structure::landing', compact(
            'hero',
            'header',
            'features',
            'whoIsThisFor',
            'flexibleSystem',
            'customerReviews',
            'cta',
            'contact',
            'footer'
        ));
    }
}
