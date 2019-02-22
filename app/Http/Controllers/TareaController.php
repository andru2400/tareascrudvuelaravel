<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tarea;

class TareaController extends Controller
{
   	public function getTareas()
   	{
   		return Tarea::orderBy('id','DESC')->get();
   	}

   	public function store(Request $request)
   	{

   		$this->validate($request,[
   			'description' => 'required'
   		]);

   		Tarea::create($request->all());   		
   		return;
   	}

      public function update(Request $request,$id)
      {  

          dd($request->all());
          $tarea = Tarea::find($id);
          $tarea->description = $request->description;
          $tarea->save();
          return;
      }

      public function destroy($id)
      {        
         $tarea = Tarea::find($id);
         $tarea->delete();
         return;
      }
}
