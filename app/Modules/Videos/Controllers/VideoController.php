<?php

namespace Videos\Controllers;

use App\Http\Controllers\Controller;
use Videos\Repositories\VideoRepository;
use Illuminate\Support\Facades\Crypt;
use Videos\Requests\VideoRequest;

class VideoController extends Controller
{
    public $path;
    private $videoRepository;

    public function __construct(VideoRepository $videoRepository)
    {
        $this->middleware('auth');
        $this->path = 'Videos::';
        $this->videoRepository = $videoRepository;
    }

    public function index()
    {
        hasPermissions('show_videos');

        $title = transWord('All Videos');
        $pages = [
            [transWord('All Videos'),'videos']
        ];
        $videos = $this->videoRepository->allData();
        return view($this->path.'index',compact('videos','pages','title'));
    }

    public function profileVideos($username)
    {
        hasPermissions('show_videos');

        $title = transWord('All Videos');
        $pages = [
            [transWord('All Videos'),'videos']
        ];
        $videos = $this->videoRepository->meVideos($username);
        return view('Users::videos',compact('videos','pages','title'));
    }


    public function create()
    {
        hasPermissions('upload_videos');
        $title = transWord('Upload Videos');
        $pages = [
            [transWord('Upload Videos'),'videos']
        ];
        return view($this->path.'create',compact('pages','title'));
    }

    public function store(VideoRequest $request)
    {
        hasPermissions('upload_videos');
        $this->videoRepository->saveData($request,null);
        return redirect()->route('videos')->with('success','');
    }

    public function edit($id)
    {
        hasPermissions('update_videos');
        $id = Crypt::decrypt($id);
        $title = transWord('Update Videos');
        $pages = [
            [transWord('BusinessAccounts'),'videos']
        ];
        $videos = $this->videoRepository->getDataId($id);
        return view($this->path.'edit',compact('pages','title','videos'));
    }

    public function update(VideoRequest $request,$id)
    {
        hasPermissions('update_videos');
        $id = Crypt::decrypt($id);
        $this->videoRepository->saveData($request,$id);

        return redirect()->route('videos')->with('success','');
    }

    public function delete($id)
    {
        hasPermissions('delete_videos');
        $id = Crypt::decrypt($id);
        $this->videoRepository->deleteData($id);
        return back()->with('success','');
    }

}
