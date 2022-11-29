<?php

namespace App\Models\Managers;

use App\Extenders\Models\BaseUser as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Tymon\JWTAuth\Contracts\JWTSubject;
use App\Notifications\Manager\Auth\ResetPassword;
use App\Notifications\Manager\Auth\VerifyEmail;
use Password;

use App\Models\Users\User;
use App\Models\Positions\Position;
use App\Models\Requests\PppRequest;
use App\Models\Specializations\Specialization;
use App\Models\DeniedRequests\DeniedRequest;
use Carbon\Carbon;

class Manager extends Authenticatable implements MustVerifyEmail, JWTSubject
{

    protected $appends = [ 'fullname' ];
    /*
     * Relationship
     */
    
    public function managereable() {
        return $this->morphTo();
    }

    // public function distmanagerable() {
    //     return $this->morphTo();
    // }
	
    public function denieds() {
        return $this->morphMany(DeniedRequest::class, 'deniedable');
    }

	public function salesRepresentatives() {
		return $this->hasMany(User::class);
	}

    public function assistantManagers() {
        return $this->belongsToMany(Manager::class, 'managers_assist_managers', 'assist_manager_id', 'manager_id');
    }

    public function managers() {
        return $this->belongsToMany(Manager::class, 'managers_assist_managers', 'manager_id', 'assist_manager_id');
    }

    public function position() {
        return $this->belongsTo(Position::class);
    }

    public function pppRequests() {
        return $this->hasMany(PppRequest::class);
    }

    public function specializations() {
        return $this->belongsToMany(Specialization::class, 'manager_specializations', 'manager_id', 'specialization_id');
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray() {
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
        ];
    }

    /**
     * Overrides default reset password notification
     */
    public function sendPasswordResetNotification($token) {
        $this->notify(new ResetPassword($token));
    }

    /* Overrides default verification notification */
    public function sendEmailVerificationNotification() {
        $this->notify(new VerifyEmail);
    }

    public function device_tokens() {
        return $this->morphMany(DeviceToken::class, 'manager');
    }

    public function providers() {
        return $this->morphMany(SocialiteProvider::class, 'manager');
    }

    /* Overrides default forgot password */
    public function broker() {
        return Password::broker('managers');
    }

    /**
     * JWT Configurations
     */
    public function getJWTCustomClaims(): array {
        return [
            'guard' => 'managers',
        ];
    }

    public function getJWTIdentifier() {
        return $this->getKey();
    }

    public static function storeRequest($request, $item = null, $columns = ['first_name', 'last_name', 'position_id', 'email', 'contact_number']) 
    {   
        $vars = $request->only($columns);

        if (!$item) {
            $vars['password'] = uniqid();
            $vars['email_verified_at'] = Carbon::now();
            $item = static::create($vars);
            $broker = $item->broker();
            $broker->sendResetLink($request->only('email'));
        } else {
            $item->update($vars);
        }

        if($request->specialization_ids) {
            $item->specializations()->sync($request->specialization_ids);
        }        

        if ($request->hasFile('image_path')) {
            $item->storeImage($request->file('image_path'), 'image_path', 'admin-avatars');
        }

        return $item;
    }
    /*
     * Append Data
     */
    
    public function getFullnameAttribute() {
        return $this->first_name.' '.$this->last_name;
    }

    /**
     * @Renders
     */
    
    /* User Verification Status */
    public function renderStatus($showLabel = true) {
        $result = $showLabel ? 'Unverified' : 'bg-danger';

        if ($this->email_verified_at) {
            $result = $showLabel ? 'Verified' : 'bg-success';
        }

        return $result;
    }

    /**
     * @Render
     */
    
    public function renderName() {
        return ucwords($this->first_name . ' ' . $this->last_name);
    }    
    
    public function renderShowUrl($prefix = 'admin') {
        return route($prefix . '.managers.show', $this->id);
    }

    public function renderArchiveUrl($prefix = 'admin') {
        return route($prefix . '.managers.archive', $this->id);
    }

    public function renderRestoreUrl($prefix = 'admin') {
        return route($prefix . '.managers.restore', $this->id);
    }	

    public function getPosition() {
        return $this->position->name;
    }	

    public function isManager() {
        $manager = true;
        if($this->is_assistant_manager && $this->position->id == 2) {
            $manager = false;
        }
        return $manager;
    }
}
