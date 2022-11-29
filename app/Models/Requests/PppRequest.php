<?php

namespace App\Models\Requests;

use App\Extenders\Models\BaseModel as Model;

use App\Models\Budgets\Budget;
use App\Models\Managers\Manager;
use App\Models\Products\Product;
use App\Models\Files\File;
use App\Models\DeniedRequests\DeniedRequest;
use App\Models\ApprovedRequests\ApprovedRequest;
use App\Models\Requests\PoRequest;

use Carbon\Carbon;

class PppRequest extends Model
{
    /*
     * Relationship
     */
    
    public function poRequests() {
        return $this->hasMany(PoRequest::class);
    }

    public function budget() {
        return $this->belongsTo(Budget::class)->withTrashed();
    }

    public function manager() {
        return $this->belongsTo(Manager::class)->withTrashed();
    }

    public function product() {
        return $this->belongsTo(Product::class)->withTrashed();
    }

    public function files() {
        return $this->morphMany(File::class, 'fileable');
    }

    public function denieds() {
        return $this->morphMany(DeniedRequest::class, 'requestable');
    }

    public function approves() {
        return $this->morphMany(ApprovedRequest::class, 'requestable');
    }

	public function getItem() {
		$item = $this;
		$item->date = Carbon::parse($this->period_start_at)->format('F d, Y');
		$item->ppp_total_balance = 'PHP '.number_format($this->total_balance, 2, '.', ',');
		$item->ppp_current_balance = 'PHP '.number_format($this->current_balance, 2, '.', ',');
		$item->ppp_total_cash = 'PHP '.number_format($this->requested_amount, 2, '.', ',');
		$item->ppp_value = 'PHP '.number_format($this->requested_amount, 2, '.', ',');
		return $item;
	}

    public function updateStatus($status, $user, $class, $request) {
        switch ($status) {
            case 3:
                $this->update([
                    'denied_at' => Carbon::now(),
                    'status' => $status
                ]);

                $this->denieds()->create([
                    'deniedable_type' => $class,
                    'deniedable_id' => $user->id,
                    'reason' => $request->reason,
                    'denied_at' => Carbon::now()
                ]);

                break;
            case 2:
                if(!$user->isSuperAdmin()) {
                    $this->update([
                        'denied_at' => null,
                        'status' => $status,
                        'finance_approved_at' => Carbon::now(),
                        'approval_status' => 1 // superadmin
                    ]);
                } else {
                    $this->update([
                        'denied_at' => null,
                        'status' => $status,
                        'super_admin_approved_at' => Carbon::now(),
                        'approval_status' => 2 // done 
                    ]);
                    $this->budget->decrement('budget_amount', $this->requested_amount);
                }
                
                $this->approves()->create([
                    'approvable_type' => $class,
                    'approvable_id' => $user->id,
                    'approved_at' => Carbon::now()
                ]);
                break;
            
            default:
                $this->update([
                    'denied_at' => null,
                    'status' => $status,
                ]);
                break;
        }

        return $this;
    }

    public function canApprovedByLoggedUser($user) {
        $isFinanceApproved = $this->finance_approved_at != null ? true : false;
        $isSuperAdminApproved = $this->super_admin_approved_at != null ? true : false;
        $isDenied = $this->denied_at ? true : false;

        if($user->isSuperAdmin() && !$isSuperAdminApproved && $isFinanceApproved && !$isDenied) {
            return true;
        } elseif (!$user->isSuperAdmin() && !$isFinanceApproved && !$isDenied) {
            return true;
        }

        return false;
    }

	/*
     * Renderers
     */

    public function renderShowUrl($prefix = 'admin.') {
        return route($prefix.'ppp-request.show', $this->id);
    }

    public function renderRequestAmount() {
        return '₱ '.number_format($this->requested_amount, 2, '.', ',');
    }

    public function renderCurrentBalance() {
        return '₱ '.number_format($this->current_balance, 2, '.', ',');
    }

    public function renderRequestOrderNumber () {
        $idLength = strlen($this->id);
        $orderNumber = 'PPP-';

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

    public function getDatePeriod() {
        $start = Carbon::parse($this->period_start_at)->format('Y-m-d');
        $end = Carbon::parse($this->period_end_at)->format('Y-m-d');

        return $start.' to '.$end; 
    }

    public function getAttachment() {
        $attachment_count = $this->files->count();
        $return_label = $attachment_count.' attachment';
        if($attachment_count > 1) {
            $return_label = $attachment_count.' attachments';
        }

        if($attachment_count < 1) {
            $return_label = '---';  
        }
        
        return $return_label;
    }

    public function getAttachments() {
        $attachments = $this->files;
        $response = [];
        foreach ($attachments as $attachment) {
            array_push($response, [
                'name' => $attachment->name,
                'file_path' => $attachment->renderFilePath()
            ]);
        }

        return $response;
    }

    /**
     * @Render
     */
    
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
        $request_amount = $this->requested_amount;
        // $po_budget = $this->poRequests->request_amount;
        $po_budget = $this->requested_amount;
        $dividend = $request_amount / $po_budget;
        $total = $dividend * 100;   
        $label = round($total);

        if($with_percentage) {
            $label .= '%';
        }
        return $label;           
    } 
}
