    function notify(msg, speed, fadeSpeed, type) {
        //Borra cualquier mensaje existente
        $('.notify').remove();
        //Si el temporizador para hacer desaparecer el mensaje estÃ¡
        //activo, lo desactivamos.
        if (typeof fade != "undefined") {
            clearTimeout(fade);
        }
        //Creamos la notificaciÃ³n con la clase (type) y el texto (msg)
        $('#notify_h').append('<div class="notify ' + type + '" style="display:none;position:absolut;left:0;width:100%;heigth:400px"><p>' + msg + '</p></div>');
        //Calculamos la altura de la notificaciÃ³n.
        notifyHeight = $('.notify').outerHeight();
        //Creamos la animaciÃ³n en la notificaciÃ³n con la velocidad
        //que pasamos por el parametro speed
        $('.notify').css('top', -notifyHeight).animate({ top: 155, opacity: 'toggle' }, speed);
        //Creamos el temporizador para hacer desaparecer la notificaciÃ³n
        //con el tiempo almacenado en el parametro fadeSpeed
        fade = setTimeout(function () {
            $('.notify').animate({ top: notifyHeight + 155, opacity: 'toggle' }, speed);

        }, fadeSpeed);
    }

setInterval(function(){
    $.ajax({
      type: 'GET',
      url: 'notificacionesNuevosPedidos',  
      cache: false,
      dataType: 'json',
      success: function(data) { 
      	 if(data['msg'] == 1)
      	 {
      	   var audio = new Audio('notificacion_windows_10.mp3');
		   audio.play();
           notify('Tienes nuevos pedidos',500,3000,'');
       	 }
       }  
    }); 


}, 10000);
