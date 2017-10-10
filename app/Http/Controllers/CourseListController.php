<?php

namespace App\Http\Controllers;

use App\CourseLists;
use App\Tutorials;
use Illuminate\Http\Request;

class CourseListController extends Controller
{

    public function add(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'description' => 'required',
            'plan_id' => 'required'

        ]);

        $courselist = CourseLists::create([
            'name' => $request->name,
            'description' => $request->description,
            'plan_id' => $request->plan_id,
            'slug' => str_slug($request->name),
            'status' => 1
        ]);

        return response()->json([
            'message' => 'Course List created successfully',
            'courselist' =>$request->plan_id
        ]);
    }

    public function courseList()
    {

        $courselist = CourseLists::with('plans')->paginate(10);

        $response = [
            'pagination' => [
                'total' => $courselist->total(),
                'per_page' => $courselist->perPage(),
                'current_page' => $courselist->currentPage(),
                'last_page' => $courselist->lastPage(),
                'from' => $courselist->firstItem(),
                'to' => $courselist->lastItem()
            ],
            'courselist' => $courselist
        ];

        return response()->json([
            'courselist' => $response
        ]);
    }

    public function courseDetails($id)
    {

        $coursedetails = Tutorials::where('course_id','=',$id)->paginate(10);

        $response = [
            'pagination' => [
                'total' => $coursedetails->total(),
                'per_page' => $coursedetails->perPage(),
                'current_page' => $coursedetails->currentPage(),
                'last_page' => $coursedetails->lastPage(),
                'from' => $coursedetails->firstItem(),
                'to' => $coursedetails->lastItem()
            ],
            'coursedetails' => $coursedetails
        ];

        return response()->json([
            'coursedetails' => $response
        ]);
    }

    public function delete($id)
    {
        $courselist = CourseLists::find($id)->delete();

        return response()->json([
            'message'=>'Course List deleted successfully'
        ]);
    }

    public function update(Request $request,$id)
    {
        $this->validate($request,[
            'name' => 'required',
            'description' => 'required',
            'plan_id' => 'required',

        ]);

        $courselist = CourseLists::find($id);

        $courselist->update($request->all());

        return response()->json([
            'message' => 'Course List updated successfully'
        ]);
    }

    public function getCurriculum()
    {

        $curriculums = CourseLists::with('plans')->paginate(10);

        $response = [
            'pagination' => [
                'total' => $curriculums->total(),
                'per_page' => $curriculums->perPage(),
                'current_page' => $curriculums->currentPage(),
                'last_page' => $curriculums->lastPage(),
                'from' => $curriculums->firstItem(),
                'to' => $curriculums->lastItem()
            ],
            'curriculums' => $curriculums
        ];

        return response()->json([
            'curriculums' => $response
        ]);
    }

    public function index($slug)
    {
        $courselist = CourseLists::where('slug',$slug)->first();
        $tutorials = Tutorials::orderBy('id')->with(['programminglanguage','media','courselist'])->where('course_id','=',$courselist->id)->get();
        /*$tutorials = Tutorials::leftjoin('programming_languages', 'tutorials.programminglanguage_id', '=', 'programming_languages.id')
                ->leftjoin('media', 'tutorials.media_id', '=', 'media.id')
                ->leftjoin('course_lists', 'tutorials.course_id', '=', 'course_lists.id')
                ->where('course_lists.id',"=",$course->id);*/
        return view('users.take-curriculum')->with(['tutorials' => $tutorials,'courselist' => $courselist]);
    }

    public function starttutorial($course_slug,$tutorial_slug){

        $courselist = CourseLists::with('plans')->where('slug',$course_slug)->first();
        $tutorials = Tutorials::orderBy('id')->with(['programminglanguage','media','courselist'])
            ->where('course_id','=',$courselist->id)->where('slug','=',$tutorial_slug)->get();
        return view('users.start-tutorials')->with(['tutorials' => $tutorials,'courselist' => $courselist]);
    }
}
