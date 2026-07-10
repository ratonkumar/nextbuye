@extends('backend.master')

@section('maincontent')
    @section('title')
        {{ env('APP_NAME') }}- Admins
    @endsection
<style>
    div#roleinfo_length {
        color: red;
    }
    div#roleinfo_filter {
        color: red;
    }
    div#roleinfo_info {
        color: red;
    }
</style>

<div class="container-fluid pt-4 px-4">
    <div class="row">
        <div class="col-sm-12 col-md-12 col-xl-12">
            <div class="h-100 bg-third rounded p-4 pb-0">
                <div class="d-flex align-items-center justify-content-between"  style="width: 50%;float:left;">
                    <h6 class="mb-0">Admins List</h6>
                </div>
                @can('admin.create') 
                <div class="" style="width: 50%;float:left;">
                    <a href="{{ route('admin.admins.create') }}" class="btn btn-dark" style="color:red;float: right"> + Create Admin</a>
                </div>
                @endcan
            </div>
        </div>

        <div class="col-sm-12 col-md-12 col-xl-12">
            <div class="bg-third rounded h-100 p-4">
                <div class="data-tables">
                    <table class="table table-dark" id="roleinfo" width="100%"  style="text-align: center;">
                        <thead class="thead-light">
                            <tr>
                                <th>SL</th>
                                <th>Admin</th>
                                <th>Email</th>
                                <th>Roles</th>
                                 <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $roleName = ''; @endphp
                            @forelse ($admins as $admin)
                                <tr class="">
                                    <td>{{ $admin->id }}</td>
                                    <td>{{ $admin->name }}</td>
                                    <td>{{ $admin->email }}</td>
                                    <td style="width:600px">
                                    
                                        @forelse ($admin->roles as $role)
                                            <span class="badge badge-info mr-2" style="    background: #790707;">
                                                {{  $role->name }}
                                            </span>
                                            
                                            @php $roleName = $role->name; @endphp
                                        @empty

                                        @endforelse
                                    </td>
                                    <td>
                                        @php 
                                            $user = auth()->user(); // 
                                            $role = $user->getRoleNames()->first();
                                           
                                        @endphp
                                        
                                        @if($role == 'superadmin')
                                            @role('superadmin')
                                               <select onchange="buttonBrowser('{{ $admin->id }}')"   id="options_{{ $admin->id }}" name="options_{{ $admin->id }}">
                                                    <option value="0">Select Item</option>
                                                    <option value="Active" @if($admin->status == 'Active') selected @endif >Active</option>
                                                    <option value="Inactive" @if($admin->status == 'Inactive') selected @endif >Inactive <Blacklist/option>
                                                </select>
                                          
                                            @endrole
                                            
                                        @elseif($role == 'admin' && in_array($roleName, ['user','manager']))
                                        
                                                <select onchange="buttonBrowser('{{ $admin->id }}')"   id="options_{{ $admin->id }}" name="options_{{ $admin->id }}">
                                                    <option value="0">Select Item</option>
                                                    <option value="Active" @if($admin->status == 'Active') selected @endif >Active</option>
                                                    <option value="Inactive" @if($admin->status == 'Inactive') selected @endif >Inactive <Blacklist/option>
                                                </select>
                                        @elseif($role == 'manager' && in_array($roleName, ['user']))
                                                <select onchange="buttonBrowser('{{ $admin->id }}')"   id="options_{{ $admin->id }}" name="options_{{ $admin->id }}">
                                                    <option value="0">Select Item</option>
                                                    <option value="Active" @if($admin->status == 'Active') selected @endif >Active</option>
                                                    <option value="Inactive" @if($admin->status == 'Inactive') selected @endif >Inactive <Blacklist/option>
                                                </select>
                                        @endif
                                        
                                    
                                         
                                    </td>
                                    <td>
                                        
                                        
                                        @if($role == 'superadmin')
                                            @can('admin.edit')  
                                                <a href="{{ route('admin.admins.edit',$admin->id) }}" type="button" class="btn btn-primary btn-sm mt-2"><i class="bi bi-pencil-square"></i></a>
                                            @endcan
                                            @can('admin.delete') 
                                                <a href="{{ route('admin.admins.destroy',$admin->id) }}" onclick="event.preventDefault(); document.getElementById('delete-admin-{{ $admin->id }}').submit(); " class="btn btn-primary btn-sm mt-2"><i class="bi bi-archive"></i></a>
                                                <form id="delete-admin-{{ $admin->id }}" action="{{ route('admin.admins.destroy',$admin->id) }}" method="post">
                                                    @method('delete')
                                                    @csrf
                                                </form>
                                            @endcan
                                        @elseif($role == 'admin' && $roleName != 'superadmin')
                                            @can('admin.edit')  
                                                <a href="{{ route('admin.admins.edit',$admin->id) }}" type="button" class="btn btn-primary btn-sm mt-2"><i class="bi bi-pencil-square"></i></a>
                                            @endcan
                                           @can('admin.delete') 
                                                <a href="{{ route('admin.admins.destroy',$admin->id) }}" onclick="event.preventDefault(); document.getElementById('delete-admin-{{ $admin->id }}').submit(); " class="btn btn-primary btn-sm mt-2"><i class="bi bi-archive"></i></a>
                                                <form id="delete-admin-{{ $admin->id }}" action="{{ route('admin.admins.destroy',$admin->id) }}" method="post">
                                                    @method('delete')
                                                    @csrf
                                                </form>
                                            @endcan
                                         @elseif($role == 'manager' && in_array($roleName, ['user']))
                                           
                                                <a href="{{ route('admin.admins.edit',$admin->id) }}" type="button" class="btn btn-primary btn-sm mt-2"><i class="bi bi-pencil-square"></i></a>
                                           
                                          
                                                <a href="{{ route('admin.admins.destroy',$admin->id) }}" onclick="event.preventDefault(); document.getElementById('delete-admin-{{ $admin->id }}').submit(); " class="btn btn-primary btn-sm mt-2"><i class="bi bi-archive"></i></a>
                                                <form id="delete-admin-{{ $admin->id }}" action="{{ route('admin.admins.destroy',$admin->id) }}" method="post">
                                                    @method('delete')
                                                    @csrf
                                                </form>
                                           
                                        @endif
                                    </td>
                                </tr>
                            @empty

                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


    </div>
</div>
<script type="text/javascript">
    function buttonBrowser(id) {
        
        var status = $('#options_'+ id).val();
        $.ajax({
            type: 'GET',
            url: "{{ url('admin/status/update/') }}" + '/'+id+'?status='+status ,

            success: function(data) {
                
            },
            error: function(error) {
                console.log('error');
            }


        });
          
    }


$(document).ready( function () {
    $('#roleinfo').DataTable();
} );
</script>

@endsection
