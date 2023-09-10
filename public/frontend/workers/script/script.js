var workerReceiveCommand = function()
{
    $(document).on('click', '.__worker_receive_btn', function(event){
        event.preventDefault();
        let id = $(this).data('id');
        $('#loader').fadeIn(200);
        $.ajax({
            url: getBaseRoute('action-command/receive?id='+id),
            type: 'POST'
        }).done(function(data){
            let title = data.code == 200 ? 'Thành công' : 'Không thành công';
            let key = data.code == 200 ? 'success' : 'error';
            if (data.code == 100) {
              swal(title, data.message, key);  
            }else{
              swal(title, data.message, key, {
                buttons: {
                  catch: {
                    text: "Chi tiết lệnh đang nhận",
                    value: "received",
                  },
                  OK: true,
                },
                }).then((value) => {
                  switch (value) {
                    case "received":
                      window.location = getBaseRoute('action-command/detail?id='+id);
                      break;
                    default:
                      window.location.reload();	
                  }
              });
            }
        })
        $('#loader').delay(200).fadeOut(500); 
    });
}

$(function(){
    workerReceiveCommand();
});