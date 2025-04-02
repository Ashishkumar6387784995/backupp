<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    public function index()
    {
        $page_title = 'Payment Master';
        $page_description = '';

        return view('admin.pages.payments.list', compact('page_title', 'page_description'));
    }
    public function add()
    {
        $page_title = 'Payment Master';
        $page_description = 'Add New Payment Type';

        return view('admin.pages.payments.add', compact('page_title', 'page_description'));
    }
    public function edit()
    {
        $page_title = 'Payment Master';
        $page_description = 'Edit Payment Type';

        return view('admin.pages.payments.edit', compact('page_title', 'page_description'));
    }
}
