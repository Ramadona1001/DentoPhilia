<?php

namespace App\Http\Controllers\Backend;

use App\Charts\CourseCategory;
use App\Http\Controllers\Controller;
use App\User;
use Attachments\Models\Attachment;
use Categories\Models\Category;
use Contacts\Models\Contact;
use Courses\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Pages\Models\Page;
use Questions\Models\Question;
use Quizes\Models\Quiz;
use Services\Models\Service;
use Students\Models\Student;
use StudentSubcriptions\Models\StudentSubscribe;
use Translates\Models\Translate;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $title = transWord('Home');
        $pages = [];

        $users_count = User::count();
        $students_count = Student::count();
        $students_subscribes_count = StudentSubscribe::count();
        $active_students_subscribes_count = StudentSubscribe::where('publish',1)->count();
        $deactivate_students_subscribes_count = StudentSubscribe::where('publish',2)->count();
        $categories_count = Category::count();
        $courses_count = Course::count();
        $quiz_count = Quiz::count();
        $question_count = Question::count();
        $attachment_count = Attachment::count();
        $page_count = Page::count();
        $services_count = Service::count();
        $contacts_count = Contact::count();
        $translate_count = Translate::count();


        $components = [
            [$users_count,transWord('Users'),'users','indigo','show_statistics_users'],
            [$students_count,transWord('Students'),'users','azura','show_statistics_students'],
            [$students_subscribes_count,transWord('Subscribers'),'users','orange','show_statistics_subscribers'],
            [$active_students_subscribes_count,transWord('Active (Sub)'),'users','pink','show_statistics_active_subscribers'],

            [$deactivate_students_subscribes_count,transWord('Not Active (Subs)'),'users','indigo','show_statistics_not_active_subscribers'],
            [$categories_count,transWord('Categories'),'image','azura','show_statistics_categories'],
            [$courses_count,transWord('Courses'),'play','orange','show_statistics_courses'],
            [$quiz_count,transWord('Quizzes'),'question-circle','pink','show_statistics_quizzes'],

            [$question_count,transWord('Questions'),'question','indigo','show_statistics_questions'],
            [$attachment_count,transWord('Attachments'),'cloud-upload','azura','show_statistics_attachments'],
            [$page_count,transWord('Pages'),'file-powerpoint-o','orange','show_statistics_pages'],
            [$services_count,transWord('Quizzes'),'life-ring','pink','show_statistics_services'],

            [$contacts_count,transWord('Contacts'),'phone','indigo','show_statistics_contacts'],
            [$translate_count,transWord('Translates'),'language','azura','show_statistics_translates'],


        ];

        //Course Category Pie Chart
        $courseCategoryChart = new CourseCategory;
        $categories = Category::all();
        $categoriesNames = [];
        $coursesCount = [];
        foreach ($categories as $cat){
            array_push($categoriesNames,getDataFromJsonByLanguage($cat->title));
        }
        $query = DB::select('SELECT COUNT(`courses`.`id`) AS "count" , `categories`.`title` AS "title" FROM `courses` INNER JOIN `categories` ON `categories`.`id` = `courses`.`category_id` GROUP BY `courses`.`category_id`');
        $courseCategoryChart->labels($categoriesNames);
        foreach ($query as $q){
            array_push($coursesCount,$q->count);
        }
        $courseCategoryChart->dataset(translateWords('Courses Category'), 'pie', $coursesCount)->options([
            'backgroundColor' => '#034a91',
        ]);

        //Student Subscribers
        $subscribersChart = new CourseCategory;
        $subscribersChart->labels(['Students', 'Subscribers', 'Unsubscribers']);
        $subscribersChart->dataset(transWord('Count'), 'line', [$students_count,$students_subscribes_count,($students_count - $students_subscribes_count)]);


        return view('backend.index',compact('components','pages','title','courseCategoryChart','subscribersChart'));
    }
}
