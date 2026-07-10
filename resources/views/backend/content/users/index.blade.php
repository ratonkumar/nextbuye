@extends('backend.master')

@section('maincontent')
    @section('title')
        {{ env('APP_NAME') }}- Users
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
            <div class="h-100 bg-secondary rounded p-4 pb-0">
                <div class="d-flex align-items-center justify-content-between"  style="width: 50%;float:left;">
                    <h6 class="mb-0">Users List</h6>
                </div>
                <div class="" style="width: 50%;float:left;">
                    <a href="{{ route('admin.users.create') }}" class="btn btn-dark" style="color:red;float: right"> + Create User</a>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-md-12 col-xl-12">
            <div class="bg-secondary rounded h-100 p-4">
                <div class="data-tables">
                    <table class="table table-dark" id="roleinfo" width="100%"  style="text-align: center;">
                        <thead class="thead-light">
                            <tr>
                                <th>SL</th>
                                <th>User</th>
                                <th>Email</th>
                                <th>Roles</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                <tr class="">
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td style="width:600px">
                                        @forelse ($user->roles as $role)
                                            <span class="badge badge-info mr-2" style="    background: #790707;">
                                                {{  $role->name }}
                                            </span>
                                        @empty

                                        @endforelse
                                    </td>
                                    <td>
                                         <select onchange="buttonBrowser('{{ $user->id }}')"   id="options_{{ $user->id }}" name="options_{{ $user->id }}">
                                            <option value="0">Select Item</option>
                                            <option value="Active" @if($user->status == 'Active') selected @endif >Active</option>
                                            <option value="Inactive" @if($user->status == 'Inactive') selected @endif >Inactive <Blacklist/option>
                                        </select>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.users.edit',$user->id) }}" type="button" class="btn btn-primary btn-sm mt-2"><i class="bi bi-pencil-square"></i></a>
                                        <a href="{{ route('admin.users.destroy',$user->id) }}" onclick="event.preventDefault(); document.getElementById('delete-user-{{ $user->id }}').submit(); " class="btn btn-primary btn-sm mt-2"><i class="bi bi-archive"></i></a>

                                        <form id="delete-user-{{ $user->id }}" action="{{ route('admin.users.destroy',$user->id) }}" method="post">
                                            @method('delete')
                                            @csrf
                                        </form>
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

</script
<script>
$(document).ready( function () {
    $('#roleinfo').DataTable();
} );
</script>

@endsection
