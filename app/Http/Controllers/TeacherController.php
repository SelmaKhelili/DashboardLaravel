<?php

namespace App\Http\Controllers;
use App\Models\TeacherModel;
use App\Models\Module;
use App\Models\Module_Teacher;
use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Psy\Readline\Hoa\Console;
use Illuminate\Support\Facades\DB;

class TeacherController extends Controller
{

   public function index()
   { 
    return view('profile.profile');
   }
   public function show($id)
   {
       $teacher = TeacherModel::find($id);
   
       if (! $teacher) {
           return response()->json([
               'error' => 'Teacher not found',
           ], 404);
       }
       $modules = DB::table('modules')
       ->join('module_teacher', 'modules.id', '=', 'module_teacher.module_id')
       ->where('module_teacher.teacher_id', $id)
       ->select('modules.id','modules.name', 'modules.description')
       ->get();
      
   
       return view('profile.profile', compact('teacher', 'modules'));
   }
   public function create(Request $request, $id)
   {
       $teacher = TeacherModel::find($id);
       
       if (! $teacher) {
           return response()->json([
               'error' => 'Teacher not found',
           ], 404);
       }
       $moduleName = $request->ModuleName;
       $moduleDescription = $request->ModuleDescriptionInput;
   
       // Check if the module already exists
       $module = Module::where('name', $moduleName)
           ->where('description', $moduleDescription)
           ->first();
        
        if (!$module) {
        // Create a new module
        $module = DB::table('modules')->insert([
            'name' => $moduleName,
            'description' => $moduleDescription,
        ]);
    }
    $module = Module::where('name', $moduleName)
    ->where('description', $moduleDescription)
    ->first();
   // Create a new record in the module_teacher table if it doesn't exist
    $existingRecord = DB::table('module_teacher')->where('teacher_id', $teacher->id)->where('module_id', $module->id)->first();
    if (!$existingRecord) {
        DB::table('module_teacher')->insert([
            'teacher_id' => $teacher->id,
            'module_id' => $module->id,
        ]);
    }
    return "Module created successfully";
           
   }
   
   public function update(Request $request, $id)
   {
       $teacher = TeacherModel::find($id);
   
       if (!$teacher) {
           return response()->json([
               'error' => 'Teacher not found',
           ], 404);
       }
   
       $moduleNamePrev = $request->ModuleNameInputPrev;
       $updatedModuleName = $request->ModuleName;
       $updatedModuleDescription = $request->ModuleDescription;
   
       // Check if the module exists in the modules table
       $Mymodule = Module::where('name', $moduleNamePrev)->first();
   
       if (!$Mymodule) {
           return response()->json([
               'error' => 'Module was not found',
           ], 404);
       }
   
       DB::table('modules')
        ->where('id', $Mymodule->id)
        ->update([
            'name' => $updatedModuleName,
            'description' => $updatedModuleDescription,
        ]);
        
       // Update the module details in the module_teacher table
       DB::table('module_teacher')
       ->where('teacher_id', $id)
       ->where('module_id', $Mymodule->id)
       ->update([
           'teacher_id' => $teacher->id, // Optional: If you want to update the teacher_id
           'module_id' => $Mymodule->id, // Optional: If you want to update the module_id
       ]);
   
       return "Module updated successfully";
   }
   

// ...


public function chart($id)
{
    $teacher = TeacherModel::find($id);
    
    if (!$teacher) {
        // Handle case when teacher is not found
        return "No teacher found";
    }
    $bookings = Booking::select(DB::raw("COUNT(*) as count"), DB::raw("MONTH(created_at) as month"))
        ->whereYear('created_at', 2023) // Filter by the year 2023
        ->groupBy('month')
        ->pluck('count', 'month');

    // Define an array of month names
    $monthNames = [
        'January', 'February', 'March', 'April', 'May', 'June',
        'July', 'August', 'September', 'October', 'November', 'December'
    ];

    $labels = range(1, 12); // Generate an array of numbers from 1 to 12 for the months
    $data = [];

    foreach ($labels as $month) {
        $data[] = $bookings[$month] ?? 0; // Use 0 if no data is available for the month
    }
    return view('chart', compact('labels', 'data', 'monthNames'));
}

public function EventChart($id)
{
    $teacher = TeacherModel::find($id);
   
       if (! $teacher) {
           return response()->json([
               'error' => 'Teacher not found',
           ], 404);
       }
       $modules = DB::table('modules')
       ->join('module_teacher', 'modules.id', '=', 'module_teacher.module_id')
       ->where('module_teacher.teacher_id', $id)
       ->select('modules.name', 'modules.description')
       ->get();

       $bookings = Booking::select(DB::raw("COUNT(*) as count"), DB::raw("MONTH(created_at) as month"))
        ->whereYear('created_at', 2023) // Filter by the year 2023
        ->groupBy('month')
        ->pluck('count', 'month');

    // Define an array of month names
    $monthNames = [
        'January', 'February', 'March', 'April', 'May', 'June',
        'July', 'August', 'September', 'October', 'November', 'December'
    ];
    $labels = range(1, 12); // Generate an array of numbers from 1 to 12 for the months
    $data = [];
    
    
    foreach ($labels as $month) {
        $data[] = $bookings->get($month) ?? 0;
    }

    dd(compact('teacher', 'modules', 'labels','data','monthNames'));
       return view('profile.profile', compact('teacher', 'modules', 'labels','data','monthNames'));
}






}
