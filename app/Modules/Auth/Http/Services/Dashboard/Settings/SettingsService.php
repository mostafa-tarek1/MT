<?php

namespace App\Modules\Auth\Http\Services\Dashboard\Settings;

use App\Modules\Auth\Repository\ManagerRepositoryInterface;
use App\Modules\Auth\Repository\SettingsRepositoryInterface;
use App\Modules\Base\Http\Traits\FileTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SettingsService
{
    use FileTrait;

    public function __construct(
        private readonly SettingsRepositoryInterface $settingsRepository,
        private ManagerRepositoryInterface $repository,
    ) {}

    public function update($id, $request)
    {

        $data = $request->validated();

        $manager = $this->repository->getById($id);

        if ($request->hasFile('image')) {
            $data['image'] = $this->image($request->file('image'), 'profiles/members/images', $manager->image);
        }

        $this->settingsRepository->update($id, $data);

        return redirect()->back()->with(['success' => __('messages.updated_successfully')]);
    }

    public function updatePassword($request)
    {
        DB::beginTransaction();
        try {
            // Get the user ID from the authenticated manager
            $user = auth('manager')->user();

            if (! $user) {
                return back()->with(['error' => __('messages.Unauthorized')]);
            }

            // Hash the new password
            $data = [
                'password' => Hash::make($request->new_password),
            ];

            $this->settingsRepository->update($user->id, $data);

            DB::commit();

            return redirect()->back()->with(['success' => __('messages.updated_successfully')]);
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with(['error' => __('messages.Something went wrong')]);
        }
    }
}
