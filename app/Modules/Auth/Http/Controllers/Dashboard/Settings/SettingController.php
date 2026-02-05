<?php

namespace App\Modules\Auth\Http\Controllers\Dashboard\Settings;

use App\Http\Controllers\Controller;
use App\Modules\Auth\Http\Requests\Dashboard\Auth\UpdatePasswordRequest;
use App\Modules\Auth\Http\Requests\Dashboard\Settings\InfoSettingsRequest;
use App\Modules\Auth\Http\Services\Dashboard\Settings\SettingsService;
use App\Modules\Auth\Repository\SettingsRepositoryInterface;

class SettingController extends Controller
{
    private SettingsRepositoryInterface $settingsRepository;

    private SettingsService $settingsService;

    public function __construct(SettingsRepositoryInterface $settingsRepository, SettingsService $settingsService)
    {
        $this->settingsService = $settingsService;
        $this->settingsRepository = $settingsRepository;
    }

    public function edit(string $id)
    {
        $user = $this->settingsRepository->getById(auth()->id());

        return view('base::dashboard.profile.edit', compact('user'));

    }

    public function update(InfoSettingsRequest $request, string $id)
    {
        return $this->settingsService->update(auth()->id(), $request);
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        return $this->settingsService->updatePassword($request);
    }
}
