function myFunction(id){
                swal({
                  title: "Estas seguro de eliminar?",
                  text: "el registro no podra recuperarse",
                  type: "warning",
                  showCancelButton: true,
                  confirmButtonClass: "btn-danger",
                  confirmButtonText: "Si, Eliminar",
                  closeOnConfirm: true
                },
                function(){ 
                    $( "#frm"+id).hide();  
                    $( "#frm"+id).submit();
                });
            };