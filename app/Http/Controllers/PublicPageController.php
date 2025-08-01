<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Inertia\Inertia;

class PublicPageController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(Page $page)
    {
        if (!$page->is_published) {
            abort(404);
        }

        return Inertia::render('page', [
            'page' => $page
        ]);
    }
}