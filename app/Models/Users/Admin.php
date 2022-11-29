<?php

namespace App\Models\Users;

use App\Extenders\Models\BaseUser as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use App\Notifications\Admin\Auth\ResetPassword;
use Illuminate\Validation\ValidationException;
use Password;

use App\Models\DeniedRequests\DeniedRequest;
use App\Models\ApprovedRequests\ApprovedRequest;

class Admin extends Authenticatable
{
    /* Roles & Permission: https://github.com/spatie/laravel-permission */
    use HasRoles;

    /*
     * Relationship
     */
    
    public function financeable() {
        return $this->morphTo();
    }

    public function superAdminable() {
        return $this->morphTo();
    }

    public function denieds() {
        return $this->morphMany(DeniedRequest::class, 'requestable');
    }

    public function approves() {
        return $this->morphMany(ApprovedRequest::class, 'requestable');
    }

    /**
     * Overrides default reset password notification
     */
    public function sendPasswordResetNotification($token) {
        $this->notify(new ResetPassword($token));
    }

    /* Prevent Role of Admin #1 from being modified */
    public function isRoleEditable(): bool {
        return $this->id !== 1;
    }

    /* Prevent Admin #1 from being archived */
    public function isArchiveable(): bool {
        return $this->id !== 1;
    }

    /* Prevent Admin #1 from being restored */
    public function isRestorable(): bool {
        return $this->id !== 1;
    }

    /* Overrides default forgot password */
    public function broker() {
        return Password::broker('admins');
    }

    /**
     * @Renders
     */

    /* Show associated role's name */
    public function renderRoleNames() {
        $result = 'None';

        if (count($this->getRoleNames())) {
            $result = implode(', ', $this->getRoleNames()->toArray());
        }

        return $result;
    }

    public function renderShowUrl() {
        return route('admin.admin-users.show', $this->id);
    }

    public function renderArchiveUrl() {
        return route('admin.admin-users.archive', $this->id);
    }

    public function renderRestoreUrl() {
        return route('admin.admin-users.restore', $this->id);
    }

    public function isSuperAdmin() {
        $isSuperAdmin = $this->roles->where('id', 1)->first() ? true : false;

        return $isSuperAdmin;
    }
}