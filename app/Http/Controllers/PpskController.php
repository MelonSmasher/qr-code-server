<?php

namespace App\Http\Controllers;

use App\Models\Ppsk;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Str;

class PpskController extends Controller {

    /**
     * Display ppsk creation form
     *
     * @return View
     */
    public function new(): View {
        return view('ppsk.new');
    }

    /**
     * Store a new Ppsk
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse {
        // Generate a new UUID
        $uuid = Str::uuid() . '-' . Str::uuid();
        // ensure that the uuid is unique
        while (Ppsk::where('uuid', $uuid)->exists()) {
            $uuid = Str::uuid() . '-' . Str::uuid();
        }
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        // Create a new Ppsk
        $ppsk = new Ppsk([
            'name' => $request->name,
            'uuid' => $uuid,
        ]);
        // Save the Ppsk
        $ppsk->save();
        // Redirect to the edit page
        return redirect()->route('ppsk.edit', $ppsk->id);
    }

    /**
     * Display the Ppsk edit form
     *
     * @param int $id
     * @return View
     */
    public function edit(int $id): View {
        return view('ppsk.edit', [
            'ppsk' => Ppsk::findOrFail($id),
        ]);
    }

    /**
     * Update the Ppsk
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(Request $request, int $id): RedirectResponse {
        // Find the Ppsk
        $ppsk = Ppsk::findOrFail($id);
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        // Update the Ppsk
        $ppsk->name = $request->name;
        // Save the Ppsk
        $ppsk->save();
        // Redirect to the edit page
        return redirect()->route('ppsk.edit', $ppsk->id);
    }

    /**
     * Delete the Ppsk
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse {
        // Find the Ppsk
        $ppsk = Ppsk::findOrFail($id);
        // Delete the Ppsk
        $ppsk->delete();
        // Redirect to the new page
        return redirect()->route('welcome');
    }
}
