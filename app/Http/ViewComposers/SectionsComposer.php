<?php

namespace App\Http\ViewComposers;

use App\Models\Section;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Repositories\UserRepository;

class SectionsComposer
{
    /**
     * The user repository implementation.
     *
     * @var UserRepository
     */
    protected $users;

    /**
     * Create a new sections composer.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct(UserRepository $users)
    {
        // Dependencies automatically resolved by service container...
        $this->users = $users;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $user = Auth::user();

        $sections = Section::all();

        $view->with('user', $user)->with('sections', $sections);
    }

}