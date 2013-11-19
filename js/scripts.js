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

/**/


function mascara(o,f){
    v_obj=o
    v_fun=f
    setTimeout("execmascara()",1)
}

function execmascara(){
    v_obj.value=v_fun(v_obj.value)
}

function leech(v){
    v=v.replace(/o/gi,"0")
    v=v.replace(/i/gi,"1")
    v=v.replace(/z/gi,"2")
    v=v.replace(/e/gi,"3")
    v=v.replace(/a/gi,"4")
    v=v.replace(/s/gi,"5")
    v=v.replace(/t/gi,"7")
    return v
}

function SoLetras(v){
    v=v.replace(/0/gi,"")
    v=v.replace(/1/gi,"")
    v=v.replace(/2/gi,"")
    v=v.replace(/3/gi,"")
    v=v.replace(/4/gi,"")
    v=v.replace(/5/gi,"")
    v=v.replace(/6/gi,"")
    v=v.replace(/7/gi,"")
    v=v.replace(/8/gi,"")
    v=v.replace(/9/gi,"")
    return v
}

function SoNumeros(v){
    v=v.replace(/a/gi,"")
    v=v.replace(/b/gi,"")
    v=v.replace(/c/gi,"")
    v=v.replace(/d/gi,"")
    v=v.replace(/e/gi,"")
    v=v.replace(/f/gi,"")
    v=v.replace(/g/gi,"")
    v=v.replace(/h/gi,"")
    v=v.replace(/i/gi,"")
    v=v.replace(/j/gi,"")
    v=v.replace(/k/gi,"")
    v=v.replace(/l/gi,"")
    v=v.replace(/m/gi,"")
    v=v.replace(/n/gi,"")
    v=v.replace(/o/gi,"")
    v=v.replace(/p/gi,"")
    v=v.replace(/q/gi,"")
    v=v.replace(/r/gi,"")
    v=v.replace(/s/gi,"")
    v=v.replace(/t/gi,"")
    v=v.replace(/u/gi,"")
    v=v.replace(/v/gi,"")
    v=v.replace(/x/gi,"")
    v=v.replace(/y/gi,"")
    v=v.replace(/w/gi,"")
    v=v.replace(/z/gi,"")
    v=v.replace(/A/gi,"")
    v=v.replace(/B/gi,"")
    v=v.replace(/C/gi,"")
    v=v.replace(/D/gi,"")
    v=v.replace(/E/gi,"")
    v=v.replace(/F/gi,"")
    v=v.replace(/G/gi,"")
    v=v.replace(/H/gi,"")
    v=v.replace(/I/gi,"")
    v=v.replace(/J/gi,"")
    v=v.replace(/K/gi,"")
    v=v.replace(/L/gi,"")
    v=v.replace(/M/gi,"")
    v=v.replace(/N/gi,"")
    v=v.replace(/O/gi,"")
    v=v.replace(/P/gi,"")
    v=v.replace(/Q/gi,"")
    v=v.replace(/R/gi,"")
    v=v.replace(/S/gi,"")
    v=v.replace(/T/gi,"")
    v=v.replace(/U/gi,"")
    v=v.replace(/V/gi,"")
    v=v.replace(/X/gi,"")
    v=v.replace(/Y/gi,"")
    v=v.replace(/W/gi,"")
    v=v.replace(/Z/gi,"")
    return v
}

function SoMinusculas(v){
    v=v.replace(/A/gi,"a")
    v=v.replace(/B/gi,"b")
    v=v.replace(/C/gi,"c")
    v=v.replace(/D/gi,"d")
    v=v.replace(/E/gi,"e")
    v=v.replace(/F/gi,"f")
    v=v.replace(/G/gi,"g")
    v=v.replace(/H/gi,"h")
    v=v.replace(/I/gi,"i")
    v=v.replace(/J/gi,"j")
    v=v.replace(/K/gi,"k")
    v=v.replace(/L/gi,"l")
    v=v.replace(/M/gi,"m")
    v=v.replace(/N/gi,"n")
    v=v.replace(/O/gi,"o")
    v=v.replace(/P/gi,"p")
    v=v.replace(/Q/gi,"q")
    v=v.replace(/R/gi,"r")
    v=v.replace(/S/gi,"s")
    v=v.replace(/T/gi,"t")
    v=v.replace(/U/gi,"u")
    v=v.replace(/V/gi,"v")
    v=v.replace(/W/gi,"w")
    v=v.replace(/X/gi,"x")
    v=v.replace(/Y/gi,"y")
    v=v.replace(/Z/gi,"z")
    return v
}


function Telefone(v){
    v=v.replace(/\D/g,"")                 //Remove tudo o que nÃƒÂ£o ÃƒÂ© dÃƒÂ­gito
    v=v.replace(/^(\d\d)(\d)/g,"($1) $2") //Coloca parÃƒÂªnteses em volta dos dois primeiros dÃƒÂ­gitos
    v=v.replace(/(\d{4})(\d)/,"$1-$2")    //Coloca hÃƒÂ­fen entre o quarto e o quinto dÃƒÂ­gitos
    return v
}

function datax(v){
    v=v.replace(/\D/g,"") 
    v=v.replace(/(\d{2})(\d)/,"$1/$2")  
    v=v.replace(/(\d{2})(\d)/,"$1/$2")  
    return v
}

function Cep(v){
    v=v.replace(/\D/g,"")                 //Remove tudo o que nÃƒÂ£o ÃƒÂ© dÃƒÂ­gito
    v=v.replace(/(\d{5})(\d)/,"$1-$2")    //Coloca hÃƒÂ­fen entre o quarto e o quinto dÃƒÂ­gitos
    return v
}

function CPF(v){
    v=v.replace(/\D/g,"")                    //Remove tudo o que nÃƒÂ£o ÃƒÂ© dÃƒÂ­gito
    v=v.replace(/(\d{3})(\d)/,"$1.$2")       //Coloca um ponto entre o terceiro e o quarto dÃƒÂ­gitos
    v=v.replace(/(\d{3})(\d)/,"$1.$2")       //Coloca um ponto entre o terceiro e o quarto dÃƒÂ­gitos
                                             //de novo (para o segundo bloco de nÃƒÂºmeros)
    v=v.replace(/(\d{3})(\d{1,2})$/,"$1-$2") //Coloca um hÃƒÂ­fen entre o terceiro e o quarto dÃƒÂ­gitos

    return v
}

function RG(v){
    v=v.replace(/\D/g,"")                    //Remove tudo o que nÃƒÂ£o ÃƒÂ© dÃƒÂ­gito
    v=v.replace(/(\d{2})(\d)/,"$1.$2")       //Coloca um ponto entre o terceiro e o quarto dÃƒÂ­gitos
    v=v.replace(/(\d{3})(\d)/,"$1.$2")       //Coloca um ponto entre o terceiro e o quarto dÃƒÂ­gitos
                                             //de novo (para o segundo bloco de nÃƒÂºmeros)
    v=v.replace(/(\d{3})(\d{1,2})$/,"$1-$2") //Coloca um hÃƒÂ­fen entre o terceiro e o quarto dÃƒÂ­gitos
    return v
}
function cnpj(v){
    v=v.replace(/\D/g,"")                           //Remove tudo o que nÃƒÂ£o ÃƒÂ© dÃƒÂ­gito
    v=v.replace(/^(\d{2})(\d)/,"$1.$2")             //Coloca ponto entre o segundo e o terceiro dÃƒÂ­gitos
    v=v.replace(/^(\d{2})\.(\d{3})(\d)/,"$1.$2.$3") //Coloca ponto entre o quinto e o sexto dÃƒÂ­gitos
    v=v.replace(/\.(\d{3})(\d)/,".$1/$2")           //Coloca uma barra entre o oitavo e o nono dÃƒÂ­gitos
    v=v.replace(/(\d{4})(\d)/,"$1-$2")              //Coloca um hÃƒÂ­fen depois do bloco de quatro dÃƒÂ­gitos
    return v
}

function romanos(v){
    v=v.toUpperCase()             //MaiÃƒÂºsculas
    v=v.replace(/[^IVXLCDM]/g,"") //Remove tudo o que nÃƒÂ£o for I, V, X, L, C, D ou M
    //Essa ÃƒÂ© complicada! Copiei daqui: http://www.diveintopython.org/refactoring/refactoring.html
    while(v.replace(/^M{0,4}(CM|CD|D?C{0,3})(XC|XL|L?X{0,3})(IX|IV|V?I{0,3})$/,"")!="")
        v=v.replace(/.$/,"")
    return v
}

function site(v){
    //Esse sem comentarios para que vocÃƒÂª entenda sozinho ;-)
    v=v.replace(/^http:\/\/?/,"")
    dominio=v
    caminho=""
    if(v.indexOf("/")>-1)
        dominio=v.split("/")[0]
        caminho=v.replace(/[^\/]*/,"")
    dominio=dominio.replace(/[^\w\.\+-:@]/g,"")
    caminho=caminho.replace(/[^\w\d\+-@:\?&=%\(\)\.]/g,"")
    caminho=caminho.replace(/([\?&])=/,"$1")
    if(caminho!="")dominio=dominio.replace(/\.+$/,"")
    v="http://"+dominio+caminho
    return v
}
function dinheiro(v){
        v=v.replace(/\D/g,"") //Remove tudo o que nÃ£o Ã© dÃ­gito
        v=v.replace(/^([0-9]{3}\.?){3}-[0-9]{2}$/,"$1,$2");
        //v=v.replace(/(\d{3})(\d)/g,"$1,$2")
        v=v.replace(/(\d)(\d{2})$/,"$1,$2") //Coloca ponto antes dos 2 Ãºltimos digitos
        return v
}
function Site2(v){
        v=v.replace("www","")
        v=v.replace("http://","")
        v=v.replace("https://","")
        v=v.replace("http://www","")
        v=v.replace("https://www","")
        return v
}
function Hora(v){                       //SEM SEGUNDOS
    if (v.length >= 6){
        v=v.substring(0,5);
        }
    v=v.replace(/\D/g,"")                    //Remove tudo o que nÃ£o Ã© dÃ­gito
    v=v.replace(/(\d{2})(\d)/,"$1:$2")
    return v
}