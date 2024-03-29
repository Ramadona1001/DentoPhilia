<?php

use App\User;
use BusinessAccounts\Models\BusinessAccount;
use Cases\Models\Cases;
use Courses\Models\Course;
use CourseSections\Models\CourseSection;
use CourseSessions\Models\CourseSession;
use Doctors\Models\Doctor;
use Friends\Models\Friend;
use Items\Models\Item;
use ItemsCategories\Models\FirstCat;
use ItemsCategories\Models\SecondCat;
use ModelAttachments\Models\ModelAttachment;
use ModelQuizzes\Models\ModelQuiz;
use Pages\Models\Page;
use Questions\Models\Question;
use QuizQuestions\Models\QuizQuestions;
use Stichoza\GoogleTranslate\GoogleTranslate;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Students\Models\Student;
use StudentSubcriptions\Models\StudentSubscribe;

// use Auth;

function BuildFields($name , $value = null , $type="text" ,$other = null){
    $lang = \Mcamara\LaravelLocalization\Facades\LaravelLocalization::getSupportedLanguagesKeys();
    $out = "";
    if($other != null)
    {
        $others = "";
        foreach($other as $key => $o){
            $others .= "$key ='$o' ";
        }
    }else{
        $others = null;
    }
    foreach($lang as  $key => $lan){
        $newValue = $value != null ? $value[$lan] : null;
        $out .='<div class="form-item">';
        $out .='<div class="form-input small active">';
        $out .='<label for="'.$name.'['.$lan.']" >'.ucfirst($name).' Language ['.$lan.']</label >';
        if($type != 'textarea'){
            $out .='<input type = "'.$type.'" class="form-control"  name="'.$name.'['.$lan.']" id = "'.$name.'['.$lan.']"  '.$others.' value="'.$newValue.'"  />';
        }else{
            $out .='<textarea name="'.$name.'['.$lan.']" id="'.$name.'['.$lan.']" class="form-control ckeditor">'.$newValue.'</textarea>';
        }
        $out .='</div>';
        $out .='</div>';
    }
    return $out;
}

function BuildField($name , $value = null , $type="text" ,$other = null){
    $out = "";
    if($other != null)
    {
        $others = "";
        foreach($other as $key => $o){
            $others .= "$key ='$o' ";
        }
    }else{
        $others = null;
    }
    $newValue = $value != null ? $value : null;
    $out .='<div class="form-item">';
    $out .='<div class="form-input small active">';
    $out .='<label for="'.$name.'" >'.ucfirst($name).'</label >';
    if($type != 'textarea'){
        $out .='<input type = "'.$type.'" class="form-control"  name="'.$name.'" id = "'.$name.'"  '.$others.' value="'.$newValue.'"  />';
    }else{
        $out .='<textarea name="'.$name.'" id="'.$name.'" class="form-control ckeditor">'.$newValue.'</textarea>';
    }
    $out .='</div>';
    $out .='</div>';
    return $out;
}

function megaMenu($chunk = 4 , $mainName = 'Cats'  , $field = 'title' , $url = 'cat/' , $urlFiled = 'id' , $data){
    $chunkArray = [
        4 => 3,
        3 => 4,
        6 => 2,
        2 => 6 ,
        12 =>1
    ];
    if(!$chunkArray[$chunk]){
        dd('This number of cols not valid');
    }
    $out ='<li class="nav-item dropdown">';
    $out .='<a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
    $out .= $mainName;
    $out .='</a>';
    $out .='<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">';
    foreach($data->chunk($chunk) as $d){
        $out .='<div class="col-lg-'.$chunkArray[$chunk].'">';
        foreach($d as $item){
            $out .='<a class="dropdown-item" href="'.url($url.$item->{$urlFiled}).'">'.$item->{$field}.'</a>';
        }
        $out .='</div>';
    }
    $out .='</div>';
    $out .='</li>';
    return $out;
}

function getDir()
{
      return \Mcamara\LaravelLocalization\Facades\LaravelLocalization::getCurrentLocaleDirection();
}

function getDirection()
{
      $cD = getDir();
      return $cD == 'rtl' ? 'right' : 'left';
}

function getReverseDirection()
{
      $cD = getDir();
      return $cD == 'rtl' ? 'left' : 'right';
}

function checkIfLinkyouTube($url){
    $rx = '~
                ^(?:https?://)?              # Optional protocol
                 (?:www\.)?                  # Optional subdomain
                 (?:youtube\.com|youtu\.be)  # Mandatory domain name
                 /watch\?v=([^&]+)           # URI with video id as capture group 1
                 ~x';
    $has_match = preg_match($rx,  $url , $matches);
    if(isset($matches[1]) && $matches[1] != ''){
      return true;
    }else{
        return false;
    }
}


function statisticsWidget($data){
    $statisticsHtml = '';
    for ($i=0; $i < count($data); $i++) {
        ($data[$i][3] == '') ? $data[$i][3] = 'azura' : $data[$i][3] = $data[$i][3];
        if (hasPermissionsStatistics($data[$i][4]) != 'hasnot' && hasPermissionsStatistics($data[$i][4]) != 'notfound') {
            $statisticsHtml .= '
                <div class="col-lg-3 col-md-6">
                    <div class="card" style="border-top: 3px solid;">
                        <div class="body">
                            <div class="d-flex align-items-center">
                                <div style="width: 40px; height: 40px;" class="icon-in-bg bg-'.$data[$i][3].' text-white rounded-circle"><i class="fa fa-'.$data[$i][2].'"></i></div>
                                <div class="ml-4" style="margin-left:0.7rem !important">
                                    <span style="font-size: 14px;color: white;">'.$data[$i][1].'</span>
                                    <h4 class="mb-0 font-weight-medium">'.$data[$i][0].'</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            ';
        }

    }
    return $statisticsHtml;
}

function breadcrumbWidget($currentPageName,$pages){
    $breadcrumb = '';
    if (count($pages) == 0) {
        $breadcrumb = '<h1>'.$currentPageName.'</h1>';
    }else{
        $breadcrumb .= '
        <h1>'.$currentPageName.'</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">';
            $breadcrumb .= '<li class="breadcrumb-item"><a href="'.route("home").'">'.transWord('Home').'</a></li>';
            for ($i=0; $i < count($pages); $i++) {
                if ($pages[$i][1] == '' || $pages[$i][1] == '#') {
                    $breadcrumb .= '<li class="breadcrumb-item"><a href="">'.$pages[$i][0].'</a></li>';
                }else if(is_array($pages[$i][1])){
                    $breadcrumb .= '<li class="breadcrumb-item"><a href="'.route($pages[$i][1][0],$pages[$i][1][1]).'">'.$pages[$i][0].'</a></li>';
                }else{
                    $breadcrumb .= '<li class="breadcrumb-item"><a href="'.route($pages[$i][1]).'">'.$pages[$i][0].'</a></li>';
                }
            }
            $breadcrumb .= '</ol>
        </nav>
        ';
    }
    return $breadcrumb;
}

function getLang(){
    $lang = \Mcamara\LaravelLocalization\Facades\LaravelLocalization::getSupportedLanguagesKeys();
    return $lang;
}

function datatableLang(){
    $lang = \Lang::getLocale();
    if($lang == 'ar')
        return '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Arabic.json';
    else
        return '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/English.json';
}

function menuActive($name,$arrange){
    if(request()->segment($arrange) == $name){
        return "active";
    }
}

function getUserRole($userId){
    $user = \App\User::findOrfail($userId);
    $roles = [];
    foreach ($user->getRoleNames() as $role) {
        array_push($roles,$role);
    }
    return $roles;
}

function getDataFromJson($json){
    $data = json_decode($json, true);
    return $data;
}

function getDataFromJsonByLanguage($json){
    $lang = \Lang::getLocale();
    $data = json_decode($json, true)[$lang];
    return $data;
}

function changeLanguageMenu(){
    $menu = '';
    foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties){
        $menu .= '<a class="dropdown-item pt-2 pb-2" href="'.LaravelLocalization::getLocalizedURL($localeCode, null, [], true).'">'.$properties["native"].'</a>';
    }
    return $menu;
}

function socialMediaInputs($data){
    $socials = getDataFromJson($data);
    $socialsOutput = '';
    foreach($socials as $key => $value){
        $socialsOutput .= '<div class="col-lg-6" style="margin-bottom:10px;">';
        $socialsOutput .= '<label for="'.$key.'">'.ucfirst($key).'</label>';
        $socialsOutput .= '<input id="'.$key.'" type="url" name="soicalmedia['.$key.']" class="form-control" value="'.$value.'" placeholder="'.__("tr.".ucfirst($key)).'">';
        $socialsOutput .= '</div>';
    }
    return $socialsOutput;
}

function checkHasValue($data){
    if (isset($data)) {
        if ($data != null) {
            return $data;
        }
    }
}

function translateWords($word){
    $lang = \Lang::getLocale();
    return GoogleTranslate::trans($word, $lang, 'en');
}

function mainSettingsData(){
    if(\MainSettings\Models\MainSetting::count() > 0)
    {
        $settings = \MainSettings\Models\MainSetting::findOrfail(1);
        $main_settings = [];
        $main_settings['title'] = getDataFromJsonByLanguage($settings->title);
        $main_settings['content'] = getDataFromJsonByLanguage($settings->content);
        $main_settings['address'] = getDataFromJsonByLanguage($settings->address);
        $main_settings['meta_title'] = getDataFromJsonByLanguage($settings->meta_title);
        $main_settings['meta_desc'] = getDataFromJsonByLanguage($settings->meta_desc);
        $main_settings['meta_keywords'] = getDataFromJsonByLanguage($settings->meta_keywords);
        $main_settings['logo'] = getDataFromJsonByLanguage($settings->logo);
        $main_settings['mobile'] = $settings->mobile;
        $main_settings['email'] = $settings->email;
        $main_settings['banner_title'] = getDataFromJsonByLanguage($settings->banner_title);
        $main_settings['banner_content'] = getDataFromJsonByLanguage($settings->banner_content);
        $main_settings['banner_button_name'] = getDataFromJsonByLanguage($settings->banner_button_name);
        $main_settings['banner_button_link'] = $settings->banner_button_link;
        return $main_settings;
    }else{
        return null;
    }
}

function transWord($word){
    $lang = \Lang::getLocale();
    if(\Translates\Models\Translate::where('word',$word)->where('key',$lang)->count() > 0){
        $transData = \Translates\Models\Translate::where('word',$word)->where('key',$lang)->get()->first();
        return $transData->translation;
    }else{
        return $word;
    }
}

function convertToTags($text){
    if(strpos($text,",") != null){
        $tags = explode(',',$text);
        $tags_html = '';
        foreach ($tags as $tag) {
            $tags_html .= '<span class="badge badge-primary" style="font-weight: bold;">'.$tag.'</span>';
        }
        return $tags_html;
    }else{
        return $text;
    }
}

function hasPermissions($permission){
    $getPermission = Permission::where('name',$permission)->limit(1)->count();
    if ($getPermission > 0) {
        if(!Auth::user()->hasPermissionTo($permission))
            abort(403);
    }else{
        abort(404);
    }
}

function hasPermissionsStatistics($permission){
    $getPermission = Permission::where('name',$permission)->limit(1)->count();
    if ($getPermission > 0) {
        if(!Auth::user()->hasPermissionTo($permission))
            return 'hasnot';
    }else{
        return 'notfound';
    }
}

function menuHasChildren($rows,$id) {
    foreach ($rows as $row) {
        if ($row['parent'] == $id)
            return true;
    }
    return false;
}
function buildMainMenu($rows,$parent=0)
{
    $result = "<li class='nav-item'>";
    foreach ($rows as $row)
    {
        $page = Page::where('menu_id',$row['id'])->where('publish',1)->get()->first();
        // var_dump($page);
        if ($row['parent'] == $parent){
            $slug = isset($page->slug) ? route('website_page',getDataFromJsonByLanguage($page->slug)) : '#';
            $title = isset($page->title) ? getDataFromJsonByLanguage($page->title) : getDataFromJsonByLanguage($row['title']);
            $result.= "<a href='".$slug."' class='nav-link'>".$title."</a>";
            if (menuHasChildren($rows,$row['id']))
                $result.= "<ul class='dropdown-menu'>".buildMainMenu($rows,$row['id']);
            $result.= "</ul>";
        }
    }
    $result.= "</li>";
    return $result;
}

function checkDataisNull($data,$alternative){
    if ($data != null)
        return $data;
    else
        return $alternative;
}

function getGender(){
    return [
        'Male' => transWord('Male'),
        'Female' => transWord('Female'),
    ];
}

function convertYoutubeLinkEmbed($link)
{
    return str_replace("watch?v=","embed/",$link);
}

function getRoles(){
    $roles = [];
    foreach (Role::all() as $role) {
        if ($role->name == 'Doctor' || $role->name == 'Business Account') {
            array_push($roles,$role->name);
        }
    }
    return $roles;
}

function getPosition(){
    return [
        'Student' => transWord('Student'),
        'Operator' => transWord('Operator'),
    ];
}

function checkDoctorProfileIsComplete()
{
    $cols = \DB::getSchemaBuilder()->getColumnListing('doctors');
    $empty = [];
    foreach ($cols as $key => $value) {
        if ($cols[$key] == 'id' || $cols[$key] == 'created_at' || $cols[$key] == 'updated_at' || $cols[$key] == 'end_study' || $cols[$key] == 'user_id') {
            unset($cols[$key]);
        }
    }

    $cols = implode(' is null or ',$cols).' is null';
    $query = \DB::select('select * from doctors where '.$cols.' and user_id = '.\Auth::user()->id);

    if (count($query) > 0) {
        foreach ($query[0] as $key => $value) {
            if ($key != 'end_study') {
                if ($value == null) {
                    array_push($empty,$key);
                }
            }
        }
        return $empty;
    }else{
        return $query;
    }

}

function checkBusinessAccountProfileIsComplete()
{
    $cols = \DB::getSchemaBuilder()->getColumnListing('business_accounts');


    $empty = [];
    foreach ($cols as $key => $value) {
        if ($cols[$key] == 'id' || $cols[$key] == 'created_at' || $cols[$key] == 'updated_at' || $cols[$key] == 'user_id' || $cols[$key] == 'approve') {
            unset($cols[$key]);
        }
    }

    $cols = implode(' is null or ',$cols).' is null';
    $query = \DB::select('select * from business_accounts where '.$cols.' and user_id = '.\Auth::user()->id);

    // dd('select * from business_accounts where '.$cols.' and user_id = '.\Auth::user()->id);

    if (count($query) > 0) {

        foreach ($query[0] as $key => $value) {
            if ($key != 'approve') {
                if ($value == null) {
                    array_push($empty,$key);
                }
            }
        }
        return $empty;
    }else{
        return $query;
    }

}

function businessAccountTypes()
{
    return [
        'Shop' => trans('Shop'),
        'Education' => trans('Education'),
        'Lab' => trans('Lab'),
    ];
}

function checkApproveBusinessAccount($id)
{
    $user = User::findOrfail($id);
    $businessAccount = BusinessAccount::where('user_id',$user->id)->get()->first();
    return $businessAccount->approve;
}

function getBusinessAcountTypeByUser($id)
{
    $user = User::findOrfail($id);
    $businessAccount = BusinessAccount::where('user_id',$user->id)->get()->first();
    return $businessAccount->type;
}

function uploadImage($path,$name,$filename,$model)
{
    if (request()->hasFile($name)) {
        $imageName = $filename.time().'.'.request()->$name->getClientOriginalExtension();
        request()->$name->move($path, $imageName);
        $model->$name = $imageName;
    }
}

function uploadImageAndDeleteOld($delete_path,$path,$name,$filename,$model)
{
    if (request()->hasFile($name)) {
        $image_path = public_path($delete_path.$model->$name);
        if (\File::exists($image_path)) {
            \File::delete($image_path);
        }

        $imageName = $filename.time().'.'.request()->$name->getClientOriginalExtension();
        request()->$name->move($path, $imageName);
        $model->$name = $imageName;
    }
}

function getFirstCategory() // Add Item For Shop User
{
    return FirstCat::where('item_for',0)->where('species',0)->get();
}

function getFirstCategoryLab() // Add Item For Shop User
{
    return FirstCat::where('item_for',1)->where('species',0)->get();
}

function getFirstCategoryForLabUser() // Add Item For Lab User
{
    return FirstCat::where('species',1)->get();
}

function getCases()
{
    return [
        'endo',
        'pedo',
        'dentaldesigner',
        'dentalphotography',
        'implants',
        'operative',
        'ortho',
        'perio',
        'prothesis',
        'surgery'
    ];
}

function getCasesAndPermissions($type,$permission)
{
    $cases = [
        'endo',
        'pedo',
        'dentaldesigner',
        'dentalphotography',
        'implants',
        'operative',
        'ortho',
        'perio',
        'prothesis',
        'surgery'
    ];

    foreach ($cases as $case) {
        if ($type == $case) {
            return hasPermissions($permission.'_cases_'.$type);
        }
    }
}

function getUserData($userid)
{
    return User::findOrfail($userid);
}

function checkIsFriend($touser){
    $friend = Friend::where('to_user',$touser)->where('from_user',Auth::user()->id)->get();

    if (count($friend) > 0) {
        $friend = $friend->first();
        if ($friend->status == 0) {
            return 'pending';
        }else{
            return 'firend';
        }
    }else{
        return 'not firend';
    }
}

function getUserAvatar($userid)
{
    $user = User::findOrfail($userid);
    if ($user->hasRole('Doctor')) {
        if($user->gender == 'Male'){
            return 'dento/img/avatar/doctor_male.png';
        }else{
            return 'dento/img/avatar/doctor_female.png';
        }
    }

    if ($user->hasRole('Business Account')) {
        if($user->gender == 'Male'){
            return 'dento/img/avatar/businessman.png';
        }else{
            return 'dento/img/avatar/businesswoman.png';
        }
    }

    if ($user->hasRole('Admin')) {
        return 'dento/img/avatar/admin.png';
    }
}

function getCategoryItemCount($cattype,$catid)
{
    return Item::where($cattype,$catid)->count();
}

function getCaseItemCount($type)
{
    return Cases::where('type',$type)->count();
}

function getSecondCategory($catid)
{
    if (is_array($catid)) {
        return SecondCat::whereIn('id',$catid)->get();
    }else{
        return SecondCat::where('id',$catid)->get();
    }
}

function getMaxItemPrice($species = 0)
{
    return \DB::select('select max(price) as "max" from items where species = '.$species)[0]->max;
}
