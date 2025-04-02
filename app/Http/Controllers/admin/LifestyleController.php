<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LifestyleController extends Controller
{
    public function index()
    {
        $page_title = 'Lifestyle Master';
        $page_description = '';

        return view('admin.pages.lifestyle.list', compact('page_title', 'page_description'));
    }
    public function add()
    {
        $page_title = 'Lifestyle Master';
        $page_description = 'Add New Lifestyle';

        return view('admin.pages.lifestyle.add', compact('page_title', 'page_description'));
    }
    public function edit()
    {
        $page_title = 'Lifestyle Master';
        $page_description = 'Edit Lifestyle';

        return view('admin.pages.lifestyle.edit', compact('page_title', 'page_description'));
    }
}
