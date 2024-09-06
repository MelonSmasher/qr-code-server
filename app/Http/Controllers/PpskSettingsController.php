<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PpskSettings;
use App\Models\Ppsk;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Http\JsonResponse;

class PpskSettingsController extends Controller {

    /**
     * Get the image type from the base64 encoded image.
     *
     * @param string $image_base64
     * @return string|null
     */
    private function get_image_type(string $image_base64): ?string {
        $image_bytes = base64_decode($image_base64, true);
        $types = [
            'jpg' => "\xFF\xD8\xFF",
            'gif' => 'GIF',
            'png' => "\x89\x50\x4e\x47\x0d\x0a",
            'bmp' => 'BM',
            'psd' => '8BPS',
            'swf' => 'FWS'
        ];
        foreach ($types as $type => $header) {
            if (str_starts_with($image_bytes, $header)) {
                return $type;
            }
        }
        return null;
    }

    /**
     * Store PPSK Settings.
     *
     * @param Request $request
     * @param string $uuid
     * @return JsonResponse
     */
    public function store(Request $request, string $uuid): JsonResponse {
        $ppsk = Ppsk::where('uuid', $uuid)->firstOrFail();
        $request->validate([
            'ssid' => 'required|string',
            'created_for' => 'required|string',
            'identity' => 'nullable|string',
            'hidden' => 'nullable|boolean',
            'passphrase' => 'nullable|string',
            'security' => 'required|string',
            'eap_method' => 'nullable|string',
            'phase_two_auth' => 'nullable|string',
            'anonymous_outer_identity' => 'nullable|string',
            'base64_image' => 'nullable|string'
        ]);

        $ppskSettings = $ppsk->settings;
        if (empty($ppskSettings)) {
            // Create new PpskSettings
            $ppskSettings = new PpskSettings([
                'ssid' => $request->ssid,
                'ppsk_id' => $ppsk->id,
                'created_for' => $request->created_for,
                'identity' => empty($request->identity) ? null : $request->identity,
                'hidden' => empty($request->hidden) ? false : $request->hidden,
                'passphrase' => empty($request->passphrase) ? null : $request->passphrase,
                'security' => $request->security,
                'eap_method' => empty($request->eap_method) ? null : $request->eap_method,
                'phase_two_auth' => empty($request->phase_two_auth) ? null : $request->phase_two_auth,
                'anonymous_outer_identity' => empty($request->anonymous_outer_identity) ? false : $request->anonymous_outer_identity
            ]);
        } else {
            // Update existing PpskSettings
            $ppskSettings->update([
                'ssid' => $request->ssid,
                'ppsk_id' => $ppsk->id,
                'created_for' => $request->created_for,
                'identity' => empty($request->identity) ? null : $request->identity,
                'hidden' => empty($request->hidden) ? false : $request->hidden,
                'passphrase' => empty($request->passphrase) ? null : $request->passphrase,
                'security' => $request->security,
                'eap_method' => empty($request->eap_method) ? null : $request->eap_method,
                'phase_two_auth' => empty($request->phase_two_auth) ? null : $request->phase_two_auth,
                'anonymous_outer_identity' => empty($request->anonymous_outer_identity) ? false : $request->anonymous_outer_identity
            ]);
        }
        $image = null;
        $image_name = Str::uuid() . '-' . Str::uuid();
        $image_extension = null;
        $base64_image = $request->get('base64_image');
//        Log::debug('Base64 image: ' . $base64_image);
        if (!empty($base64_image)) {
            $data = explode(',', $base64_image);
            if (count($data) == 2) {
                // Grab the base64 image header and the image data
                $image_header = $data[0];
                $image = $data[1];
            }
            if (count($data) == 1) {
                // Grab the image data as the first element if there is no header
                $image_header = null;
                $image = $data[0];
            }
            if (count($data) < 1 or count($data) > 2) {
                // If we have nothing or more than one comma separated value, return an error
                return response()->json([
                    'message' => 'Invalid base64 image'
                ], 400);
            }

            // Check if the image is a valid base64 encoded image
            if (base64_encode(base64_decode($image, true)) === $image) {
                // If the image is valid, save it to the storage
                $image_extension = $this->get_image_type($image);
                if (!in_array($image_extension, ['jpg', 'png'])) {
                    // If the image is not a valid image type, return an error
                    if (empty($image_extension)) $image_extension = 'unknown';
                    return response()->json([
                        'message' => 'Invalid image type: ' . $image_extension . " valid_types: ['jpg', 'png']"
                    ], 400);
                }
            } else {
                // If the image is invalid, return an error
                return response()->json([
                    'message' => 'Invalid base64 image'
                ], 400);
            }
        }

        // Save the image to the storage
        if (!empty($image) and !empty($image_extension)) {
            // Save the image to the storage
            $image_path = $image_name . '.' . $image_extension;
            $image_full_path = storage_path('app/public/' . $image_path);
            file_put_contents($image_full_path, base64_decode($image));
            $ppskSettings->qr_code_path = $image_name . '.' . $image_extension;
        } else {
            // If there is no image, remove the image path
            $ppskSettings->qr_code_path = null;
        }
        // Save the PpskSettings
        $ppskSettings->save();
        if (!empty($ppsk->settings)) {
            if (!empty($ppsk->settings->qr_code_path)) {
                $ppsk->settings->qr_code_path = url('storage/' . $ppsk->settings->qr_code_path);
            }
            $ppsk->settings->hidden = (bool)$ppsk->settings->hidden;
            $ppsk->settings->anonymous_outer_identity = (bool)$ppsk->settings->anonymous_outer_identity;
        }
        // Return the PpskSettings
        return response()->json($ppsk);
    }

    /**
     * Show PPSK Settings.
     *
     * @param string $uuid
     * @return JsonResponse
     */
    public function show(string $uuid): JsonResponse {
        $ppsk = Ppsk::where('uuid', $uuid)->with('settings')->firstOrFail();
        if (empty($ppsk)) {
            return response()->json([
                'message' => 'PPSK not found'
            ], 404);
        }
        if (!empty($ppsk->settings)) {
            if (!empty($ppsk->settings->qr_code_path)) {
                $ppsk->settings->qr_code_path = url('storage/' . $ppsk->settings->qr_code_path);
            }
            $ppsk->settings->hidden = (bool)$ppsk->settings->hidden;
            $ppsk->settings->anonymous_outer_identity = (bool)$ppsk->settings->anonymous_outer_identity;
        }
        return response()->json($ppsk);
    }
}
