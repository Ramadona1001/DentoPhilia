<?php

namespace Contacts\Controllers;

use App\Http\Controllers\Controller;
use Contacts\Models\Contact;

class ContactController extends Controller
{
    public $path;

    public function __construct()
    {
         $this->middleware('auth');
        $this->path = 'Contacts::';
    }

    public function index()
    {
        $title = transWord('Contacts');
        $lang = \Lang::getLocale();
        $pages = [
            [transWord('Contacts'),'contacts'],
        ];
        $contacts = Contact::all();
        return view($this->path.'index',compact('contacts','pages','title'));
    }
}
