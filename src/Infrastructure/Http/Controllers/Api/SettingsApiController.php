<?php

namespace YourVendor\WebSettings\Infrastructure\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use YourVendor\WebSettings\Application\Services\SettingsService;
use YourVendor\WebSettings\Infrastructure\Http\Requests\UpdateSettingRequest;
use YourVendor\WebSettings\Infrastructure\Http\Resources\SettingResource;

class SettingsApiController extends Controller
{
    public function __construct(
        protected SettingsService $service
    ) {}

    public function index(): JsonResponse
    {
        $settings = $this->service->all();
        return response()->json(SettingResource::collection($settings));
    }

    public function show(string $key): JsonResponse
    {
        $value = $this->service->get($key);
        return response()->json(['key' => $key, 'value' => $value]);
    }

    public function update(UpdateSettingRequest $request, string $key): JsonResponse
    {
        $setting = $this->service->set(
            $key,
            $request->input('value'),
            $request->input('type'),
            $request->input('group'),
            $request->input('description')
        );

        return response()->json(new SettingResource($setting));
    }

    public function destroy(string $key): JsonResponse
    {
        $deleted = $this->service->forget($key);
        return response()->json(['deleted' => $deleted]);
    }
}
