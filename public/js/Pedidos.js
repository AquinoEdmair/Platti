	$('.verPedidos').click(function(event){
	    event.preventDefault();
	    var url = this.href;
	    $.ajax({
	      type: 'GET',
	      url: url,  
	      cache: false,
	      dataType: 'json',
	      success: function(data) { 
	          $('#pedidos_detalle').html(data['msg']);
	          $('#myModalPedidos').modal('show');
	       }  
	    });
	});