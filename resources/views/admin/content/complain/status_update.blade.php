   <select onchange="complainChange('{{ $complains->id }}')"   id="options_{{ $complains->id }}" name="options_{{ $complains->id }}" >
            <option value="0">Select Item</option>
            <option value="Pending" @if($complains->status == 'Pending') selected @endif >Pending</option>
            <option value="Solved"  @if($complains->status == 'Solved') selected @endif >Solved</option>
            
        </select>
        
                                
                                
<script type="text/javascript">
      //assign user
        function complainChange(complainsId) {
            
            let complainStatus = $("#options_"+complainsId).val();

            $.ajax({
                type: 'PUT',
                url: 'complainstatus',
                data: {
                    complain_id: complainsId,
                    status: complainStatus,
                },

                success: function(data) {
                    swal({
                        title: "Status updated !",
                        icon: "success",
                        showCancelButton: true,
                        focusConfirm: false,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Yes",
                        cancelButtonText: "No",
                    });
                    complaininfotbl.ajax.reload();
                },
                error: function(error) {
                    console.log('error');
                }

            });

        }

</script>