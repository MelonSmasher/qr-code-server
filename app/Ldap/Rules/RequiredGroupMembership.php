<?php

namespace App\Ldap\Rules;

use Illuminate\Database\Eloquent\Model as Eloquent;
use LdapRecord\Laravel\Auth\Rule;
use LdapRecord\Models\Model as LdapRecord;

class RequiredGroupMembership implements Rule {
    /**
     * Check if the rule passes validation.
     */
    public function passes(LdapRecord $user, Eloquent $model = null): bool {
        // Get the required groups from the configuration.
        $group_dns = config('ldap.groups.required', []);
        // If no groups are required, the user passes.
        if (empty($group_dns)) return true;
        // Check if the user is a member of any of the required groups.
        return $user->groups()->contains($group_dns);
    }
}
