<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

/**
 * Class DashboardController.
 */
class DashboardController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function dashboard()
    {
        return "This is the Admin Dashboard. With great power comes greater responsibility!";
    }
}
