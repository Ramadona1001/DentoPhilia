<?php

namespace App\Http\Livewire;

use Courses\Models\Course;
use Livewire\Component;

class CourseSearch extends Component
{
    public $searchCourse = '';

    public function render()
    {
        $results = Course::where('title', 'LIKE', "%{$this->searchCourse}%")
                                ->orWhere('content','LIKE',"%{$this->searchCourse}%")
                                ->orWhere('slug','LIKE',"%{$this->searchCourse}%")
                                ->get();

        return view('livewire.course-search',[
            'results' => $results
        ]);
    }
}
