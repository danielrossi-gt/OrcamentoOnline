   function formatar_mascara(src, mascara) {
 	 var campo = src.value.length;
	 var saida = mascara.substring(0,1);
	 var texto = mascara.substring(campo);
	 if(texto.substring(0,1) != saida) {
		src.value += texto.substring(0,1);
	 }
   }

  function formataTel(evt) {
  var obj;
    if (navigator.appName.indexOf("Netscape") != -1) obj = evt.target;
    else obj = evt.srcElement;
    qtd = obj.value.length;
    if (qtd == 2) obj.value = "("+obj.value+") ";
    if (qtd == 9) obj.value = obj.value+"-";
    if (qtd == 12 && evt.keyCode == 8) {
    character = tiraChar(obj.value, "-");
        obj.value = character.substring(0,7)+"-"+character.substring(7,12);
    }
    if (qtd == 13) {
    character = tiraChar(obj.value, "-");
    obj.value = character.substring(0,8)+"-"+character.substring(8,12);
    }
  }

  function validaempresa() {
    f = document.frm_cadastro;

    //Valida Razão Social
    if (f.RAZSOC.value == "") {
      alert("O campo Razão Social deve ser preenchido!");
      f.RAZSOC.focus();
      return false;
    }

    //Valida CNPJ
    if (f.NRCNPJ.value == "") {
      alert("O campo CNPJ deve ser preenchido!");
      f.NRCNPJ.focus();
      return false;
    }

    f.submit();
  }

  function validafornecedores() {
    f = document.frm_cadastro;
    
    //Valida Razão Social
    if (f.RAZSOC.value == "") {
      alert("O campo Razão Social deve ser preenchido!");
      f.RAZSOC.focus();
      return false;
    }

    //Valida CNPJ
    if (f.NRCNPJ.value == "") {
      alert("O campo CNPJ deve ser preenchido!");
      f.NRCNPJ.focus();
      return false;
    }

    f.submit();
  }

  function validausuarios() {
    f = document.frm_cadastro;

    //Valida Login
    if (f.NOMUSU.value == "") {
      alert("O campo Login deve ser preenchido!");
      f.NOMUSU.focus();
      return false;
    }

    //Valida Senha
    if (f.PASSWD.value == "") {
      alert("O campo Senha deve ser preenchido!");
      f.PASSWD.focus();
      return false;
    }
    
    //Nome do Usuário
    if (f.DESCRI.value == "") {
      alert("O campo Nome do Usuário deve ser preenchido!");
      f.DESCRI.focus();
      return false;
    }

    f.submit();
  }

  function validaprodutos() {
    f = document.frm_cadastro;

    //Valida Descrição
    if (f.DESCRI.value == "") {
      alert("O campo Descrição deve ser preenchido!");
      f.DESCRI.focus();
      return false;
    }

    //Valida Un. de Medida
    if (f.UNIMED.value == "") {
      alert("O campo Unidade de Medida deve ser preenchido!");
      f.UNIMED.focus();
      return false;
    }

    f.submit();
  }

  function validaorcamentos() {
    f = document.frm_cadastro;

    //Valida Descrição
    if (f.DESCRI.value == "") {
      alert("O campo Descrição deve ser preenchido!");
      f.DESCRI.focus();
      return false;
    }

    //Data
    if (f.DATORC.value == "") {
      alert("O campo Data deve ser preenchido!");
      f.DATORC.focus();
      return false;
    }

    f.submit();
  }
  
  function validaorcprod() {
    f = document.frm_cadastro;
    f.submit();
  }
  
  function validaorcforn() {
    f = document.frm_cadastro;
    f.submit();
  }

  function validalogin() {
    f = document.frm_login;

    //Valida Login
    if (f.login.value == "") {
      alert("O campo Login deve ser preenchido!");
      f.login.focus();
      return false;
    }

    //Valida Senha
    if (f.senha.value == "") {
      alert("O campo Senha deve ser preenchido!");
      f.senha.focus();
      return false;
    }

    f.submit();
  }


