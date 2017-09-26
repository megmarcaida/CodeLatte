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

        ]);

        $courselist = CourseLists::create([
            'name' => $request->name,
            'description' => $request->description,
            'views' => 1,
            'status' => 1
        ]);

        return response()->json([
            'message' => 'Course List created successfully',
            'courselist' =>$courselist
        ]);
    }

    public function courseList()
    {

        $courselist = CourseLists::paginate(10);

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

        ]);

        $courselist = CourseLists::find($id);

        $courselist->update($request->all());

        return response()->json([
            'message' => 'Course List updated successfully'
        ]);
    }
}
