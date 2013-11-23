$(document).ready(function(){
	$("#entrar_admin").click(function() {
		var email_login = $("#email_login").val();
		var senha_login = $("#senha_login").val();
		$("#resultadoLogin").html("<div id='carregando_post'>Carregando, aguarde...</div>").fadeIn('slow');
		$.post('modulos/postLogin.php', {email_login: email_login, senha_login: senha_login}, function(resposta) {
				$("#resultadoLogin");
				if (resposta != false) {
					$("#resultadoLogin").html(resposta);
				} 
		});
	});
});

$(document).ready(function(){
	$("#enviar_recup").click(function() {
		var email_recup = $("#email_recup").val();
		$("#resultadoRecup").html("<div id='carregando_post'>Carregando, aguarde...</div>").fadeIn('slow');
		$.post('modulos/postRecup.php', {email_recup: email_recup}, function(resposta) {
				$("#resultadoRecup");
				if (resposta != false) {
					$("#resultadoRecup").html(resposta);
				} 
		});
	});
});


$(document).ready(function(){
    $("#enviarInsertRep").click(function() {
        var permissaoRep   = $("#permissaoRep").val();
        var nomeRep        = $("#nomeRep").val();
        var sobreNomeRep   = $("#sobreNomeRep").val();
        var emailRep       = $("#emailRep").val();
        var telefoneRep    = $("#telefoneRep").val();
        var senhaRep       = $("#senhaRep").val();
        var senhaConfRep   = $("#senhaConfRep").val();
        var tipoForm       = "insert";
        $("#resultRep").html("<div id='carregando_post'>Carregando, aguarde...</div>");
        $.post('posts/postRep.php', {permissaoRep: permissaoRep, nomeRep: nomeRep, sobreNomeRep: sobreNomeRep,emailRep: emailRep, telefoneRep: telefoneRep, senhaRep: senhaRep, senhaConfRep: senhaConfRep, tipoForm: tipoForm}, function(resposta) {
                $("#resultRep");
                if (resposta != false) {
                    $("#resultRep").html(resposta);
                } 
        });
    });
});


/*tooltip*/
$(function () {
	$("[rel='tooltip']").tooltip();
});
/*tooltip*/

/*alert*/
$(".alert").alert();
/*alert*/

/* tab */
$('#tabs a').click(function (e) {
  e.preventDefault();
  $(this).tab('show');
})
/* tab */

/*Mask*/
jQuery(function($){
   $("#telefoneRep").mask("(99)9999-9999");
});
/*mask*/

