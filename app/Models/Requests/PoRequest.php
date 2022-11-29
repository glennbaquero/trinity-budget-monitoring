<?php

namespace App\Models\Requests;

use App\Extenders\Models\BaseModel as Model;

use App\Models\Managers\Manager;
use App\Models\DeniedRequests\DeniedRequest;
use App\Models\ApprovedRequests\ApprovedRequest;
use App\Models\Users\User;
use App\Models\Files\File;

use Carbon\Carbon;

class PoRequest extends Model
{
    /*
	 * Relationship
	 */
	
	public function user() {
		return $this->belongsTo(User::class);
	}
	
	public function pppRequest() {
		return $this->belongsTo(PppRequest::class);
	}

	// public function districtManagers() {
 //        return $this->morphMany(Manager::class, 'distmanagerable');
 //    }

 //    public function managers() {
 //        return $this->morphMany(Manager::class, 'managereable');
 //    }

    public function files() {
        return $this->morphMany(File::class, 'fileable');
    }

    public function denieds() {
        return $this->morphMany(DeniedRequest::class, 'requestable');
    }

    public function approves() {
        return $this->morphMany(ApprovedRequest::class, 'requestable');
    }

    /*
     * Renderers
     */
    public function renderRequestOrderNumber () {
    	$idLength = strlen($this->id);
    	$orderNumber = 'PO-';

    	switch ($idLength) {
    		case 1:
    			$orderNumber .= '000'.$this->id;
    			break;
    		case 2:
    			$orderNumber .= '00'.$this->id;
    			break;
    		case 3:
    			$orderNumber .= '0'.$this->id;
    			break;
    		default:
    			$orderNumber .= $this->id;
    			break;
    	}
    	return $orderNumber;
    }

    /*
     * Renderers
     */
    
    public function renderRequestAmount($with_pesosign = true) {
        $amount = '₱ '.number_format($this->request_amount, 2, '.', ',');
        if(!$with_pesosign) {
            $amount = number_format($this->request_amount, 2, '.', ',');
        }
        return $amount;
    }
    
    public function renderShowUrl($prefix = 'admin.') {
        return route($prefix.'po-request.show', $this->id);
    }

    public function renderRestoreUrl() {
        return route('web.po-request.restore', $this->id);
    }

    public function renderArchiveUrl() {
        return route('web.po-request.archive', $this->id);
    }

    public function renderResubmitUrl() {
        return route('web.po-request.resubmit', $this->id);
    }

    public function downloadToPDFUrl() {
        return route('web.po-request.download', $this->id);
    }

    public function canResubmit() {
        $boolean = (auth()->guard('web')->user()->id === $this->user_id) &&  $this->denied_at;

        return $boolean;
    }

    public function renderDateColumn($column) {
        return Carbon::parse($this->column)->format('F d Y h:i A');
    }

    public function canApproved($middleware) {
        $user = auth()->guard($middleware)->user();
        $can_approved = false;
        switch ($middleware) {
            case 'manager':
                if($user->is_assistant_manager && $user->position_id === 2 && !$this->district_manager_approved_at) {
                    $can_approved = true;
                } elseif (!$user->is_assistant_manager && $user->position_id === 1 && $this->district_manager_approved_at && !$this->manager_approved_at) {
                    $can_approved = true;
                }
                break;
            
            default:
                if($this->district_manager_approved_at && $this->manager_approved_at && !$this->super_admin_approved_at && $user->isSuperAdmin()) {
                    $can_approved = true;
                }
                break;
        }

        if($this->denied_at) {
            $can_approved = false;            
        }

        return $can_approved;
    }

    public function canApprovedLabel($middleware) {
        $user = auth()->guard($middleware)->user();
        $response = null;
        $response['btn'] = 'SEND TO ADMIN';
        $response['modal_message'] = 'The details stated in the PO will be send to Admin. This action cannot be undo once done';
        $response['modal_title'] = 'Send this PO to Admin';
        $response['success_title'] = 'Succefully sent';
        $response['success_message'] = 'The pending PO was succcessfully sent to Admin';

        switch ($middleware) {
            case 'manager':
                if($user->is_assistant_manager && $user->position_id === 2 && !$this->district_manager_approved_at) {
                    $response['btn'] = 'SEND TO MANAGER';
                    $response['modal_message'] = 'The details stated in the PO will be send to Manager. This action cannot be undo once done';
                    $response['modal_title'] = 'Send this PO to Manager';
                    $response['success_title'] = 'Succefully sent';
                    $response['success_message'] = 'The pending PO was succcessfully sent to Manager';
                } elseif (!$user->is_assistant_manager && $user->position_id === 1 && $this->district_manager_approved_at) {
                    $response['btn'] = 'SEND TO ADMIN';
                    $response['modal_message'] = 'The details stated in the PO will be send to Admin. This action cannot be undo once done';
                    $response['modal_title'] = 'Send this PO to Admin';
                    $response['success_title'] = 'Succefully sent';
                    $response['success_message'] = 'The pending PO was succcessfully sent to Admin';
                }
                break;
            
            default:
                if($this->district_manager_approved_at && $this->manager_approved_at) {
                    $response['btn'] = 'Approved';
                    $response['modal_message'] = 'The details stated in the PO will be send to Admin. This action cannot be undo once done';
                    $response['modal_title'] = 'Approved PO';
                    $response['success_message'] = 'PO successfuly approved';
                    $response['success_title'] = 'The pending PO was succcessfully approved ';
                }
                break;
        }

        return $response;
    }

    public function updateStatus($status, $user, $class, $request) {
        switch ($status) {
            case 3:
                $this->update([
                    'denied_at' => Carbon::now(),
                    'status' => 3
                ]);

                $this->denieds()->create([
                    'deniedable_type' => $class,
                    'deniedable_id' => $user->id,
                    'reason' => $request->reason,
                    'denied_at' => Carbon::now()
                ]);
                break;
            case 2:
                $this->update([
                    'denied_at' => null,
                    'resubmitted_at' => null,
                    'status' => 2,
                    'approval_status' => 3,
                    'super_admin_approved_at' => Carbon::now()
                ]);

                $this->approves()->create([
                    'approvable_type' => $class,
                    'approvable_id' => $user->id,
                    'approved_at' => Carbon::now()
                ]);
                break;
            
            default:
                $this->update([
                    'denied_at' => null,
                    'status' => 1,
                ]);
                break;
        }

        return $this;
    }

    public function renderShortAmountLabel() {
        $label = null;
        $amount = $this->request_amount;
        $units = ['', 'K', 'M', 'B', 'T'];
        for ($i = 0; $amount >= 1000; $i++) {
            $amount /= 1000;
        }
        
        return round($amount, 1) . $units[$i];

    }

    public function getPercentage($with_percentage = false) {
        $request_amount = $this->request_amount;
        $ppp_budget = $this->pppRequest->requested_amount;

        $dividend = $request_amount / $ppp_budget;
        $total = $dividend * 100;
        $label = round($total);

        if($with_percentage) {
            $label .= '%';
        }
        return $label;           
    }
}
