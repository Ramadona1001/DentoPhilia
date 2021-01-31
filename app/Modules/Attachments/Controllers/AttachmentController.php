<?php

namespace Attachments\Controllers;

use App\Http\Controllers\Controller;
use Attachments\Repositories\AttachmentRepository;
use Attachments\Requests\AttachmentRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class AttachmentController extends Controller
{
    public $path;
    private $attachemntRepository;

    public function __construct(AttachmentRepository $attachemntRepository)
    {
        $this->middleware('auth');
        $this->path = 'Attachments::';
        $this->attachemntRepository = $attachemntRepository;
    }

    public function index()
    {
        hasPermissions('show_attachments');
        $title = transWord('Attachments');
        $pages = [
            [transWord('Attachments'),'attachments']
        ];
        $attachments = $this->attachemntRepository->allData();
        return view($this->path.'index',compact('attachments','pages','title'));
    }

    public function create()
    {
        hasPermissions('create_attachments');
        $title = transWord('Create Attachments');
        $pages = [
            [transWord('All Attachments'),'attachments'],
            [transWord('Create Attachments'),'create_attachments']
        ];
        return view($this->path.'create',compact('pages','title'));
    }

    public function store(AttachmentRequest $request)
    {
        hasPermissions('create_attachments');
        $this->attachemntRepository->saveData($request,null);
        return redirect()->route('attachments')->with('success','');
    }

    public function show($id)
    {
        hasPermissions('show_attachments');
        $id = Crypt::decrypt($id);
        $attachment = $this->attachemntRepository->getDataId($id);
        $title = transWord('Show Attachments Data');
        $pages = [
            [transWord('Attachments'),'attachments'],
        ];
        return view($this->path.'.show',compact('attachment','title','pages'));
    }

    public function edit($id)
    {
        hasPermissions('update_attachments');
        $id = Crypt::decrypt($id);
        $attachment = $this->attachemntRepository->getDataId($id);
        $title = transWord('Edit Attachments Data');
        $pages = [
            [transWord('Edit Attachments Data'),'attachments'],
        ];
        return view($this->path.'.edit',compact('title','pages','attachment'));
    }

    public function update(AttachmentRequest $request,$id)
    {
        hasPermissions('update_attachments');
        $id = Crypt::decrypt($id);
        $this->attachemntRepository->saveData($request,$id);
        return redirect()->route('attachments')->with('success','');
    }

    public function destroy($id){
        hasPermissions('delete_attachments');
        $id = Crypt::decrypt($id);
        $this->attachemntRepository->deleteData($id);
        return back()->with('attachments','')->with('success','');
    }


}
