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

  function RedirectToCancelar(id){
      swal({
        title: "Estas seguro de cancelar el pedido?",
        text: "El pedido no podra recuperarse",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Si, Cancelar",
        closeOnConfirm: true
      },
      function(){
          $( "#a"+id).hide(); 
          window.location.href = 'cancelarPedidos/'+id;
      });
  };


