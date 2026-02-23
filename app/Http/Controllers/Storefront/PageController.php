<?php

namespace App\Http\Controllers\Storefront;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\View\View;

class PageController extends Controller
{
    /**
     * Catégories partagées avec le layout (nav + footer).
     */
    private function getCategories()
    {
        return Category::where('is_active', true)
            ->whereNull('parent_id')
            ->orderBy('name')
            ->get();
    }

    /**
     * Chi Siamo — À propos de Yasser Elettronica
     */
    public function about(): View
    {
        return view('storefront.pages.about', [
            'categories' => $this->getCategories(),
        ]);
    }

    /**
     * Contattaci — Page de contact
     */
    public function contact(): View
    {
        return view('storefront.pages.contact', [
            'categories' => $this->getCategories(),
        ]);
    }

    /**
     * Informativa sulla Privacy — Politique de confidentialité (RGPD)
     */
    public function privacy(): View
    {
        return view('storefront.pages.privacy', [
            'categories' => $this->getCategories(),
        ]);
    }

    /**
     * Politica di Rimborso e Resi — Politique de remboursement
     */
    public function refund(): View
    {
        return view('storefront.pages.refund', [
            'categories' => $this->getCategories(),
        ]);
    }
}

