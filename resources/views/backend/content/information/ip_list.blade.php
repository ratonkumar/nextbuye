@extends('backend.master')

@section('maincontent')
@section('title')
    {{ $title }}
@endsection

<div class="container-fluid pt-4 px-4">
    <div class="row">

        <div class="col-sm-12 col-md-12 col-xl-12 mb-4">
            <div class="card">
            <div class="card-body">
                
                <table id="example" class="display table table-bordered border-primary" style="width:100%">
        
                    <thead>
                        <th style="display:none"> SL</th>
                        <th> Browser</th>
                        <th> Device Info</th>
                        <th> IP Address</th>
                        <th> Phone </th>
                        <th> Action </th>
                    </thad>
                    <tbody>
                        @foreach($blackList as $list)
                         @php
                                    $totalBlackList= DB::table('blocklist')
                                    ->where('ip_address', $list->ip_address)
                                    ->count();
                                @endphp
                        <tr>
                            <td style="display:none">{{ $totalBlackList }}</td>
                            <td>{{ $list->browser_fingerprint }}</td>
                            <td>{{ $list->device_info }}</td>
                            <td>{{ $list->ip_address }} 
                               
                                ( {{ $totalBlackList }} )
                            
                            </td>
                            <td>{{ $list->phone }}</td>
                            <td>
                                <select onchange="buttonBrowser('{{ $list->id }}')"   id="options_{{ $list->id }}" name="options_{{ $list->id }}">
                                    <option value="0">Select Item</option>
                                    <option value="1" @if($list->status == 1) selected @endif >Short time Blacklist</option>
                                    <option value="2"  @if($list->status == 2) selected @endif >Permanent  Blacklist</option>
                                    <option value="0" @if($list->status == 0) selected @endif >Unblock <Blacklist/option>
                                </select>
                            </td>
                        </tr>
                        @endforeach
                       
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
                url: "{{ url('admin/ip/block/added/') }}" + '/'+id+'?status=' + status,

                success: function(data) {
                    
                },
                error: function(error) {
                    console.log('error');
                }


            });
          
        }
    initSample();
    $(document).ready(function() {
        $('.ckeditor').ckeditor();
    });
</script>
 <script>
        $(document).ready(function () {
            $('#example').DataTable({
                order: [[0, 'desc']] // Sorts by the second column (index 1) in ascending order
            });

            // $('#example').DataTable();
        });
    </script>

@endsection
