
$(function(){  //btn animation
    $('.hide').hide();
    $btn = $('.btn');
	
	$btn.on('click', function(event) {
      event.preventDefault();
      $btn.not(this).next().slideUp(400);
      $(this).next().slideToggle(400);
    });
	
});


function resetCap(){   // refresh capcha
	$(".myimg").attr("src", "php/captcha.php");	

}


function senddata() {    // sends and process's the data on server from reg form
event.preventDefault(); 	
	var msg   = $('#formx').serialize();
        $.ajax({
          type: 'POST',
          url: 'php/register.php',
          data: msg,
          success: function(data) {
			$('.info').css('color','rgb(255,0,0)');
            $('.info').html(data);
          },
          error:  function(xhr, str){
	    alert('Возникла ошибка: ' + xhr.responseCode);
          }
        });

	
}
	

function modalOpen() {	// open modal window
	event.preventDefault();
	$('#overlay')
		.fadeIn(400,
			function(){
				$('#modal_form').css('display', 'block').animate({opacity: 1, top: '50%'}, 200); 
		});
}

function modalClose() {	// close modal window
	$('#modal_form')
		.animate({opacity: 0, top: '45%'}, 200,
			function(){
				$(this).css('display', 'none');
				$('#overlay').fadeOut(400);
			}
		);

}



