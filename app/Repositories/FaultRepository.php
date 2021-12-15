<?php namespace App\Repositories;
use App\Http\Requests\FaultCreateRequest;
use App\Http\Requests\FaultEditRequest;
use App\Http\Resources\FaultResource;
use App\Http\Resources\FaultErrorResource;
 
use App\Models\Fault;
use App\Repositories\Interfaces\FaultRepositoryInterface as FaultRepositoryInter;
 
class FaultRepository implements FaultRepositoryInter
{
	public function getAll(){
		//return Fault::all();
		return  FaultResource::collection(Fault::all());
	}
 
	public function getFault($id){
		//return Fault::find($id);
		$data=Fault::find($id);
        //dd($data);
		//return $data;
		if(isset($data))
			return new FaultResource($data);
		else 
        {           
            return new FaultErrorResource("not found to fetch.");
        }
		
	}

	public function addFault(FaultCreateRequest $request){
			//return Fault::create($request->all());
			$data=self::faultData($request);

			$response= Fault::create($data);
			return new FaultResource($response);       
	}
	public function updateFault(FaultEditRequest $request,Fault $fault){
		//return Fault::create($fault->all());
		$data=self::faultData($request);
		   //dd($request->all());
           //dd($data);
	    $faultUpdated=$fault->update($data);
        if(!$faultUpdated)
        {
           return new FaultErrorResource("not found to update.");   // not found to delete it is soft delete or id is not found
        }
		return new FaultResource($fault);	
       
	}
	public function deleteFault(Fault $fault){
		$isDelete=$fault->delete();
        //dd("ff");
        if(!$isDelete)
        {
           return new FaultErrorResource("not found to delete.");   // not found to delete it is soft delete or id is not found
        }
		return new FaultResource($fault);		
	}
	// public function RestoreFault(Fault $fault){
	// 	//return Fault::create($fault->all());
	// 	return $fault->restore();
	// }
	// more 
	public function faultData($request)
    {
        $data=[
			'description' => $request->description,			
			//'course' => $request->course,			
		   ];
		   //dd($request->all());
		return 	$data;
    }
 
}

?>