
<?php

use Illuminate\Support\Facades\Route;

 use App\Http\Controllers\AreaController;
use App\Http\Controllers\ApprenticeController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ComputerController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TrainingCenterController;





Route::get('areas', [AreaController::class, 'index']);
Route::post('areas', [AreaController::class, 'store']);
Route::put('areas/{area}', [AreaController::class, 'update']);

 
 Route::get('apprentices', [ApprenticeController::class, 'index']);
Route::get('apprentices/{apprentice}', [ApprenticeController::class, 'show']);
Route::post('apprentices', [ApprenticeController::class, 'store']);
Route::put('apprentices/{apprentice}', [ApprenticeController::class, 'update']);
Route::delete('apprentices/{apprentice}', [ApprenticeController::class, 'destroy']);

 Route::get('courses', [CourseController::class, 'index']);
Route::get('courses/{course}', [CourseController::class, 'show']);
Route::post('courses', [CourseController::class, 'store']);
Route::put('courses/{course}', [CourseController::class, 'update']);
Route::delete('courses/{course}', [CourseController::class, 'destroy']);

 Route::get('computers', [ComputerController::class, 'index']);
Route::get('computers/{computer}', [ComputerController::class, 'show']);
Route::post('computers', [ComputerController::class, 'store']);
Route::put('computers/{computer}', [ComputerController::class, 'update']);
Route::delete('computers/{computer}', [ComputerController::class, 'destroy']);

 Route::get('teachers', [TeacherController::class, 'index']);
Route::get('teachers/{teacher}', [TeacherController::class, 'show']);
Route::post('teachers', [TeacherController::class, 'store']);
Route::put('teachers/{teacher}', [TeacherController::class, 'update']);
Route::delete('teachers/{teacher}', [TeacherController::class, 'destroy']);

 Route::get('trainingCenters', [TrainingCenterController::class, 'index']);
Route::get('trainingCenters/{trainingCenter}', [TrainingCenterController::class, 'show']);
Route::post('trainingCenters', [TrainingCenterController::class, 'store']);
Route::put('trainingCenters/{trainingCenter}', [TrainingCenterController::class, 'update']);
Route::delete('trainingCenters/{trainingCenter}', [TrainingCenterController::class, 'destroy']);
