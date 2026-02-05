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
        $header = $this->structureService->get('header', data_needed: true);
        $hero = $this->structureService->get('hero', data_needed: true);
        $stats = $this->structureService->get('stats', data_needed: true);
        $services = $this->structureService->get('services', data_needed: true);
        $whyChooseUs = $this->structureService->get('why_choose_us', data_needed: true);
        $cta = $this->structureService->get('cta', data_needed: true);
        $footer = $this->structureService->get('footer', data_needed: true);
        $quoteModal = $this->structureService->get('quote_modal', data_needed: true);

        return view('structure::landing', compact(
            'header',
            'hero',
            'stats',
            'services',
            'whyChooseUs',
            'cta',
            'footer',
            'quoteModal'
        ));
    }
}
