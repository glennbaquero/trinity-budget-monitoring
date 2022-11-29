<?php

namespace App\Models\Users;

use App\Extenders\Models\BaseUser as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Tymon\JWTAuth\Contracts\JWTSubject;
use App\Notifications\Web\Auth\ResetPassword;
use App\Notifications\Web\Auth\VerifyEmail;
use Password;

use App\Models\Positions\Position;
use App\Models\Managers\Manager;
use App\Models\Requests\PoRequest;

class User extends Authenticatable implements MustVerifyEmail, JWTSubject
{
    const FILLABLE = ['first_name', 'last_name', 'email','contact_number','image_path'];


    /*
     * Relationship
     */
    
    public function position() {
        return $this->belongsTo(Position::class)->withTrashed();
    }

    public function manager() {
        return $this->belongsTo(Manager::class)->withTrashed();
    }

    public function poRequests() {
        return $this->hasMany(PoRequest::class)->withTrashed();
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
        return $this->morphMany(DeviceToken::class, 'user');
    }

    public function providers() {
        return $this->morphMany(SocialiteProvider::class, 'user');
    }

    /* Overrides default forgot password */
    public function broker() {
        return Password::broker('users');
    }

    /**
     * JWT Configurations
     */
    public function getJWTCustomClaims(): array {
        return [
            'guard' => 'web',
        ];
    }

    public function getJWTIdentifier() {
        return $this->getKey();
    }


    public static function formatItem($item) {
        return [
            'id' => $item->id,
            'fullname' => $item->renderName(),
            'firstname' => $item->first_name,
            'lastname' => $item->last_name,
            'email' => $item->email,
            'position_id' => $item->position_id,
            'position_name' => $item->position->name,
            'contact_number' => $item->contact_number,
            'manager_id' => $item->manager_id,
            'manager_name' => $item->manager->renderName(),
            'status' => $item->renderStatus(),
            'status_class' => $item->renderStatus(false),
            'verified_at' => $item->renderDate('verified_at'),
            'created_at' => $item->renderDate(),
            'showUrl' => $item->renderShowUrl(),
            'deleted_at' => $item->deleted_at,
            'archiveUrl' => $item->renderArchiveUrl(),
            'restoreUrl' => $item->renderRestoreUrl(),
        ];
    }

    /**
     * @Renders
     */
    

    public function renderName() {
           return ucwords($this->first_name . ' ' . $this->last_name);
    }

    /* User Verification Status */
    public function renderStatus($showLabel = true) {
        $result = $showLabel ? 'Unverified' : 'bg-danger';

        if ($this->email_verified_at) {
            $result = $showLabel ? 'Verified' : 'bg-success';
        }

        return $result;
    }

    public function renderShowUrl($prefix = 'admin') {
        if (in_array($prefix, ['web'])) {
            return route($prefix . '.profiles.show');
        }
        
        return route($prefix . '.users.show', $this->id);
    }

    public function renderArchiveUrl($prefix = 'admin') {
        if (in_array($prefix, ['web'])) {
            return;
        }

        return route($prefix . '.users.archive', $this->id);
    }

    public function renderRestoreUrl($prefix = 'admin') {
        if (in_array($prefix, ['web'])) {
            return;
        }

        return route($prefix . '.users.restore', $this->id);
    }
}