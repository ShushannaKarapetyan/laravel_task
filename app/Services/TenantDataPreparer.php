<?php

namespace App\Services;

use App\Http\Requests\TenantRequest;
use Illuminate\Support\Facades\Storage;

class TenantDataPreparer
{
    /**
     * @param TenantRequest $request
     * @return array
     */
    public static function prepareDataToSave(TenantRequest $request)
    {
        $tenantData = $request->only(['name', 'phone']);

        if ($request->hasFile('image')) {
            $tenantData['image'] = $request->image->hashName();

            if ($request->route()->hasParameter('tenant')) {
                $currentImage = $request->route('tenant')->image;

                if ($request->image !== $currentImage) {
                    Storage::disk('public')->delete("images/{$currentImage}");
                }
            }

            $request->image->store('public/images');
            $tenantData += ['user_id' => auth()->id()];
        }

        return $tenantData;
    }
}
