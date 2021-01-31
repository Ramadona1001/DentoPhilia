<?php


namespace Attachments\Repositories;

use Attachments\Models\Attachment;
use File;

class AttachmentRepository implements AttachmentRepositoryInterface
{
    public function allData(){
        return Attachment::all();
    }

    public function getDataId($id){
        return Attachment::findOrfail($id);
    }

    public function saveData($request,$id = null)
    {
        if ($id == null) {
            $attachment = new Attachment();
        }else{
            $attachment = $this->getDataId($id);
            if ($attachment->type == 'file') {
                $image_path = public_path('uploads\\backend\\attachments\\'.$attachment->data);
                if (File::exists($image_path)) {
                    File::delete($image_path);
                }
            }
        }
        $attachment->title = json_encode($request->title);
        if ($request->type == 'file') {
            $pathImage = public_path().'/uploads/backend/attachments/';
            File::makeDirectory($pathImage, $mode = 0777, true, true);
            if ($request->hasFile('file')) {
                $imageName = time().'.'.request()->file->getClientOriginalExtension();
                $request->file->move($pathImage, $imageName);
                $attachment->data = $imageName;
                $attachment->type = 'file';
            }
        }else{
            $attachment->data = $request->link;
            $attachment->type = 'link';
        }
        $attachment->save();
    }

    public function deleteData($id)
    {
        $attachment = Attachment::findOrfail($id);
        if ($attachment->type == 'file') {
            $image_path = public_path('uploads\\backend\\attachments\\'.$attachment->data);
            if (File::exists($image_path)) {
                File::delete($image_path);
            }
        }
        $attachment->delete();
    }

}
