<?php

namespace App\Modules\Structure\Http\Services\Api\V1;

use App\Modules\Base\Http\Traits\Responser;
use App\Modules\Structure\Repository\StructureRepositoryInterface;

class StructureService
{
    use Responser;

    protected StructureRepositoryInterface $structureRepository;

    public function __construct(
        StructureRepositoryInterface $structureRepository,
    ) {
        $this->structureRepository = $structureRepository;
    }

    public function get($key, $resource = null, array $with = [null => [null]], $data_needed = false)
    {
        $structure = $this->structureRepository->structure($key);
        if ($structure?->exists()) {
            $structure = $this->safeArray(json_decode($structure->content)->{app()->getLocale()});
            $withSections = [];
            foreach ($with as $key => $sections) {
                if (is_array($sections)) {
                    foreach ($sections as $section) {
                        $withSections[$key][$section] = $this->getSection($key, $section);
                    }
                }
            }
            if ($data_needed) {
                return json_decode(json_encode($structure), true);
            }

            return $this->responseSuccess(
                data: $resource != null
                ? new $resource($structure, $withSections)
                : json_decode(json_encode($structure), true) + $withSections
            );
        } else {
            if ($data_needed) {
                return [];
            }

            return $this->responseSuccess(
                message: __('messages.structure.not_found', ['key' => $key]),
            );
        }

    }

    private function getSection($key, $section)
    {
        $structure = $this->structureRepository->structure($key);
        if ($structure?->exists() && $section != null) {
            return $this->safeArray(json_decode($structure->content)->{app()->getLocale()}->$section) ?? null;
        }

        return null;
    }

    private function safeArray($value): array
    {
        if (is_array($value)) {
            return $value;
        }
        if (is_object($value)) {
            return json_decode(json_encode($value), true) ?? [];
        }

        return [];
    }
}
