<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;

class ContactMessageController extends Controller
{
    public function index()
    {
        $messages = Contact::latest()->paginate(15);
        return view('dashboard.messages.index', compact('messages'));
    }
}