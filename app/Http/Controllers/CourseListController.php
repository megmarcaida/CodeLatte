<?php

namespace App\Http\Controllers;

use App\CourseList;
use App\Tutorials;
use Illuminate\Http\Request;

class CourseListController extends Controller
{
    public function add(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'description' => 'required',
            'tutorials_id' => 'required',

        ]);

        $courselist = CourseList::create([
            'name' => $request->name,
            'description' => $request->description,
            'tutorials_id' => $request->tutorials_id,
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

        $courselist = CourseList::with('tutorials')->paginate(10);

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

    public function delete($id)
    {
        $courselist = CourseList::find($id)->delete();

        return response()->json([
            'message'=>'Course List deleted successfully'
        ]);
    }

    public function update(Request $request,$id)
    {
        $this->validate($request,[
            'name' => 'required',
            'description' => 'required',
            'tutorials_id' => 'required',
        ]);

        $courselist = CourseList::find($id);

        $courselist->update($request->all());

        return response()->json([
            'message' => 'Course List updated successfully'
        ]);
    }
}
