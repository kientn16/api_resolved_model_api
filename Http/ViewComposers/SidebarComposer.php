<?php
namespace App\Http\ViewComposers;

use App\Repositories\Eloquents\SidebarRepository;
use Illuminate\View\View;

class SidebarComposer
{
    /**
     * The user repository implementation.
     *
     * @var UserRepository
     */
    protected $users;

    /**
     * Create a new profile composer.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct(SidebarRepository $sidebarRepository)
    {
        // Dependencies automatically resolved by service container...
        $this->sidebarRepository = $sidebarRepository;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $categoriesKbn = $this->sidebarRepository->getCategories();
        $view->with(['howToPlays'=> [], 'categoriesKbn' => $categoriesKbn]);
    }
}
