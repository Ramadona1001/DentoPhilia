<?php


namespace Videos\Repositories;

use App\User;
use Videos\Models\Video;
use File;

class VideoRepository implements VideoRepositoryInterface
{
    public function allData()
    {
        return Video::all();
    }

    public function meVideos($id)
    {
        $user = User::where('username',$id)->get()->first();
        return Video::where('user_id',$user->id)->get();
    }

    public function getDataId($id)
    {
        return Video::findOrfail($id);
    }


    public function saveData($request,$id=null)
    {
        if ($id == null) {
            $video = new Video();
        }
        else{
            $video = $this->getDataId($id);
        }
        $pathVideo = public_path().'/uploads/videos/';
        File::makeDirectory($pathVideo, $mode = 0777, true, true);

        $video->title = $request->title;
        $video->content = $request->content;
        $video->user_id = \Auth::user()->id;
        uploadImage($pathVideo,'video','video_',$video);
        $video->save();
    }

    public function deleteData($id)
    {
        $video = $this->getDataId($id);
        $image_path = public_path('uploads/videos/'.$video->video);
        if (File::exists($image_path)) {
            File::delete($image_path);
        }
        $video->delete();
    }
}
