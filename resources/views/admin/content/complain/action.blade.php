<?php
use App\Models\Admin;
$admin = Admin::where('email', Auth::guard('admin')->user()->email)->first();
$users = Admin::where('status', 'Active')
    ->inRandomOrder()
    ->get();
?>
<a href='javascript:void(0);' data-id='{{ $complains->id }}' class='action-icon btn-editcomplain'> <i class='fas fa-1x fa-edit'></i></a>

@if ( $admin->hasrole('superadmin') )
<a href='javascript:void(0);' data-id='{{ $complains->id }}' id='deleteComplainBtn' class='action-icon '> <i class='fas fa-trash-alt'></i></a>
@else
                            @endif
