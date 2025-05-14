<?php

namespace App\Services;

use App\Models\Status;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Gate;

class StatusService
{
    public function getAllStatuses(){
        return Status::paginate(3);
    }

    public function createNewStatus(array $data){
        $status = Status::create($data);
        return $status ;
    }

    public function getStatusById($id){
        return Status::findOrFail($id);
    }

    public function deleteStatus($id){
        $status = Status::findOrFail($id);
        
        if(Gate::allows('status-destroy')){
            $status->delete();
        }else{
            throw new AuthorizationException('You are not allowed to delete this status.');
        }
    }
}
