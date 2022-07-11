<?php

if (! function_exists('authMember')) {
    function authMember(): Domain\Member\Models\Member
    {
        return \Domain\Member\Models\Member::firstWhere('global_id', auth()->id());
    }
}
