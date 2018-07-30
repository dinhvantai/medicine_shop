<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Schema;
use App\Eloquent\InforWebsite;
use App\Eloquent\Category;

class DataComposer
{
	
	protected $infoWebsite;
	protected $category;

	/**
     * Create a new profile composer.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct(
    	InforWebsite $infoWebsite,
    	Category $category
    ){
        $this->infoWebsite = $infoWebsite;
        $this->category = $category;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        if (Schema::hasTable($this->infoWebsite->getTable())) {
            $infoWebsite = $this->infoWebsite->getInfoWebsite()->first();
            if (!$infoWebsite) $infoWebsite = $this->$infoWebsite;
            $view->with('frontendInfoWebsite', $infoWebsite);
        }
        
        if (Schema::hasTable($this->category->getTable())) {
            $parentCategories = $this->category->with('getSubCategories')->allParentCategories()->get();
            $view->with('frontendAllParentCategories', $parentCategories);
        }
    }
}
