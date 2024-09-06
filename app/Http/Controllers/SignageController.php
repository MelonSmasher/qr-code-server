<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Ppsk;

class SignageController extends Controller {
    public function view(string $uuid): View {
        $ppsk = Ppsk::where('uuid', $uuid)->firstOrFail();
        $settings = $ppsk->settings;

        if (empty($settings)) {
            return view('signage.default');
        }

        return view('signage.view', ['ppsk' => $ppsk, 'settings' => $settings]);
    }
}
