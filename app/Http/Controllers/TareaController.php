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
   		
      return response()->json([
              'message' => 'Se creo, Satisfactoriamente',
              'status' => 'ok'
      ]);
   	}

      public function update(Request $request,$id)
      {          
          $tarea = Tarea::find($id);
          $tarea->description = $request->description;
          $tarea->save();
         return response()->json([
              'message' => 'Se Actualizo, Satisfactoriamente',
              'status' => 'ok'
         ]);

      }

      public function destroy($id)
      {        
         $tarea = Tarea::find($id);
         $tarea->delete();

         return response()->json([
              'message' => 'Se Elimino, Satisfactoriamente',
              'status' => 'ok'
         ]);
      }
}
