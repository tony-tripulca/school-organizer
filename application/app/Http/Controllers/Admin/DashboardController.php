<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct() {
        $this->getCurrentUser();
        $this->data['tab_title'] = "School Organizer | Admin";
    }

    public function new_dashboard() {
        // This is a test code
    }

    public function index() {
        $this->data['page_title'] = "DASHBOARD";

        return view('admin/dashboard/index', $this->data);
    }
}
