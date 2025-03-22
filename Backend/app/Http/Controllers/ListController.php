<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Employee;

class ListController extends Controller
{
    public function student()
    {
        return response ()->json(Student::all());
 
   }

   public function employee()
   {
       return response ()->json(Employee::all());
   }

   public function search(Request $request)
    {
        $query = $request->input('query');
        $students = Student::where('first_name', 'LIKE', "%{$query}%")
                            ->orWhere('last_name', 'LIKE', "%{$query}%")
                            ->orWhere('email', 'LIKE', "%{$query}%")
                            ->orWhere('course', 'LIKE', "%{$query}%")
                          
                            ->get();
        return response()->json($students);

        

    




    $query = $request->input('query');
    $emplooyes = Employee::where('first_name', 'LIKE', "%{$query}%")
                        ->orWhere('last_name', 'LIKE', "%{$query}%")
                        ->orWhere('email', 'LIKE', "%{$query}%")
                        ->orWhere('position', 'LIKE', "%{$query}%")
                        ->orWhere('salary', 'LIKE', "%{$query}%")
                        ->get();
    return response()->json($employees);

}
    public function create (Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'position' => 'required',
            'salary' => 'required',
        ]);
        $employee = Employee::create($validatedData);
            return response()->json([
            'message' => 'Employee created successfully',
            'employee' => $employee,
            ],201);
            

          }  public function create_stud (Request $request)
           {
             $validatedData = $request->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required',
                'course' => 'required',
              
            ]);
            $student = Student::create($validatedData);
                return response()->json([
                'message' => 'Student created successfully',
                'student' => $student,
                ],201);
    }

    public function update (Request $request, $id)
    {
        $employee = employee::find($id);
            if (is_null($employee)) {
                return response()->json(['message' => 'Employee not found'], 404);
            }

            $validatedData = $request->validate([
                'first_name' => 'string', 'last_name' => 'string', 'email' =>'string', 'positon' => 'string',  'salary' => 'string']);
            $employee->update($validatedData);
            return response()->json([
              'message' => 'Employee updated successfully', 
              'employee' => $employee

              
            ]);
        }

        public function update_stud (Request $request, $id)
        {
            $student = student::find($id);
                if (is_null($student)) {
                    return response()->json(['message' => 'Student not found'], 404);
                }
    
                $validatedData = $request->validate([
                    'first_name' => 'string', 'last_name' => 'string', 'email' => 'string', 'course' => 'string' ]);
                $student->update($validatedData);
                return response()->json([
                  'message' => 'Student updated successfully', 
                  'student' => $student
    
                  
                ]);


            
            
    }

     public function delete($id)
    {
     $employee = Employee:: find($id);
    if (is_null($employee)) {
    return response()->json(['message' => 'Employee not found'], 404);
    }
    $employee->delete();
    return response()->json([
        
    'message' => 'Employee deleted successfully',
        
    ]);
    }
    
             


    public function delete_stud($id)
{
$student = Student:: find($id);
if (is_null($student)) {
return response()->json(['message' => 'student not found'], 404);
}
$student->delete();
return response()->json([
   
'message' => 'Employee deleted successfully',
   
]);
 
}

    
}