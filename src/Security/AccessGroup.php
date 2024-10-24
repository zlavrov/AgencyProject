<?php

declare(strict_types=1);

namespace App\Security;

class AccessGroup {

    public const USER_READ = 'user:read';
    public const USER_SIGN = 'user:sign';
    public const USER_SIGN_RESPONSE = 'user:sign:response';
    public const USER_EMAIL_VERIFY = 'user:email:verify';
    public const USER_WRITE = 'user:write';
    public const USER_WRITE_EMAIL = 'user:write:email';
    public const USER_CONFIRM_EMAIL = 'user:confirm:email';
    public const USER_WRITE_PASSWORD = 'user:write:password';
    public const USER_CHANGE_PASSWORD = 'user:change:password';
    public const USER_FORGOT_PASSWORD = 'user:forgot:password';
    public const USER_ACTIVE_READ = 'user:active:read';
    public const USER_ACTIVE_WRITE = 'user:active:write';

    public const USER_VERIFY_ADMIN_READ = 'user:verufy:admin:read';
    public const USER_VERIFY_ADMIN_WRITE = 'user:verufy:admin:write';
}
