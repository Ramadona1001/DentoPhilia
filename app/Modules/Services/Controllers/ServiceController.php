<?php

namespace Services\Controllers;

use App\Http\Controllers\Controller;
use Services\Requests\ServiceRequest;
use Illuminate\Support\Facades\Crypt;
use Services\Repositories\ServiceRepository;

class ServiceController extends Controller
{
    public $path;
    private $serviceRepository;

    public function __construct(ServiceRepository $serviceRepository)
    {
        $this->middleware('auth');
        $this->path = 'Services::';
        $this->serviceRepository = $serviceRepository;
    }

    public function index()
    {
        hasPermissions('show_services');
        $title = transWord('Services');
        $pages = [
            [transWord('Services'),'services']
        ];
        $services = $this->serviceRepository->allData();
        return view($this->path.'index',compact('services','pages','title'));
    }

    public function create()
    {
        hasPermissions('create_services');
        $title = transWord('Create Services');
        $pages = [
            [transWord('All Services'),'services'],
            [transWord('Create Services'),'create_services']
        ];
        return view($this->path.'create',compact('pages','title'));
    }

    public function store(ServiceRequest $request)
    {
        hasPermissions('create_services');
        $this->serviceRepository->saveData($request,null);
        return redirect()->route('services')->with('success','');
    }

    public function show($id)
    {
        hasPermissions('show_services');
        $id = Crypt::decrypt($id);
        $services = $this->serviceRepository->getDataId($id);

        $title = transWord('Show Services Data');
        $pages = [
            [transWord('Services'),'services'],
        ];
        return view($this->path.'.show',compact('title','pages','services'));
    }

    public function edit($id)
    {
        hasPermissions('update_services');
        $id = Crypt::decrypt($id);
        $service = $this->serviceRepository->getDataId($id);

        $title = transWord('Edit Services Data');
        $pages = [
            [transWord('Services'),'services'],
        ];
        return view($this->path.'.edit',compact('service','title','pages'));
    }

    public function update(ServiceRequest $request,$id)
    {
        hasPermissions('update_services');
        $id = Crypt::decrypt($id);
        $this->serviceRepository->saveData($request,$id);
        return redirect()->route('services')->with('success','');
    }

    public function destroy($id){
        hasPermissions('delete_services');
        $id = Crypt::decrypt($id);
        $this->serviceRepository->deleteData($id);
        return back()->with('success','');
    }
}
