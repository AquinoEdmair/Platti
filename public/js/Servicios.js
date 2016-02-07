function Modales()
{
	$('.verNotificaciones').click(function(event){
	    event.preventDefault();
	    var url = this.href;
	    $.ajax({
	      type: 'GET',
	      url: url,  
	      cache: false,
	      dataType: 'json',
	      success: function(data) { 	      	
	          $('#notificaciones_pedidos').html(data['msg']);
	          $('#notificaciones_pedidos_submit').html(data['msg2']);
	          $('#myModalNotificaciones').modal('show');
	       }  
	    });
	});

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
	          $('#pedidos_detalle_submit').html(data['msg2']);
	          $('#myModalPedidos').modal('show');
	       }  
	    });
	});
}

     $.ajax({
      type: 'GET',
      url: 'verMesasHtml',  
      cache: false,
      dataType: 'json',
      success: function(data) { 
          $('#paint_mesas').html(data['msg']);
          Modales();
       }  
    });
 setInterval(function(){
    $.ajax({
      type: 'GET',
      url: 'verMesasHtml',  
      cache: false,
      dataType: 'json',
      success: function(data) { 
          $('#paint_mesas').html(data['msg']);
          Modales();
       }  
    }); }, 3000);
Modales();

