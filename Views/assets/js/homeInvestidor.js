$(function () {
  $('.inicio').click(function (e) {
    $('.formulario').show();
    $('.cards-projetos').empty();
    $.ajax({
      method: "POST",
      url: "../Controladores/buscarTodososProjetos.php",
      dataType: "json",
      success: function (dados) {
        alert("deu certo");
        for (let projeto in dados) {
          projeto = parseInt(projeto)
          $('.cards-projetos').append(`<div class="</div> col-12 col-md-5 mt-md-3" style="max-width: 540px;">
                <div class="row no-gutters">
                    <div class="col-md-4">
                    <img src="${dados[projeto].imagem}" class="card-img" alt="">
                    </div>
                    <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">${dados[projeto].nome}</h5>
                        <p class="card-text"> Descrição: ${dados[projeto].descricao}</p>
                        <p class="card-text"> Pontos de avaliação: ${dados[projeto].avaliacao}</p>
                        <p class="card-text"><small class="text-muted">${dados[projeto].areaatuacao}</small></p>
                        <div class="container estrelas">
                          <i class=" estrela_um  fas fa-star "></i>
                          <i class="fas fa-star estrela_dois" ></i>
                          <i class="fas fa-star estrela_tres"></i>
                          <i class="fas fa-star estrela_quatro"></i>
                          <i class="fas fa-star estrela_cinco"></i>
                        </div>    
                      </div>
                    </div>
                </div>
            </div>`);
        }
        $('.estrela_um').click(function () {
          $(this).addClass('selecionada')
        })
        $('.estrela_dois').click(function () {
          $(this).parents('.estrelas').find('.estrela_um').addClass('selecionada')
          $(this).addClass('selecionada')
        })
        $('.estrela_tres').click(function () {
          $(this).parents('.estrelas').find('.estrela_um').addClass('selecionada')
          $(this).parents('.estrelas').find('.estrela_dois').addClass('selecionada')
          $(this).addClass('selecionada')
        })

        $('.estrela_quatro').click(function () {
          $(this).parents('.estrelas').find('.estrela_um').addClass('selecionada')
          $(this).parents('.estrelas').find('.estrela_dois').addClass('selecionada')
          $(this).parents('.estrelas').find('.estrela_tres').addClass('selecionada')
          $(this).addClass('selecionada')
        })

        $('.estrela_cinco').click(function () {          
          $(this).parents('.estrelas').find('.estrela_um').addClass('selecionada')
          $(this).parents('.estrelas').find('.estrela_dois').addClass('selecionada')
          $(this).parents('.estrelas').find('.estrela_tres').addClass('selecionada')
          $(this).parents('.estrelas').find('.estrela_quatro').addClass('selecionada')
          $(this).addClass('selecionada')

        })
      },
      error: function () {
        alert('houve algum erro interno recaregue a página');
      }
    })
  });
  $('.mys-projects').click(function () {
    $('.formulario').hide();
    $('.cards-projetos').empty();
    $.ajax({
      method: "POST",
      url: "../Controladores/CarregarProjetosInvestidos.php",
      dataType: "json",
      success: function (myinvestimentos) {
        for (let myprojets in myinvestimentos) {
          myprojets = parseInt(myprojets)
          $('.cards-projetos').append(`<div class="tirar-projeto </div> col-12 col-md-6 mt-md-3" style="max-width: 540px;">
            <div class="row no-gutters">
                <div class="col-md-4">
                <img src="${myinvestimentos[myprojets].imagem}" class="card-img" id='imagem-perfil' alt="">
                </div>
                <div class="col-md-8">
                <div class="card-body ">
                    <h5 class="card-title">${myinvestimentos[myprojets].nome}</h5>
                    <p class="card-text">${myinvestimentos[myprojets].descricao}</p>
                    <p class="card-text"> Score: ${myinvestimentos[myprojets].avaliacao}</p>
                    <p class="card-text"><small class="text-muted">${myinvestimentos[myprojets].areaatuacao}</small></p>
                    <input class="" type="hidden" name="id" value="${myinvestimentos[myprojets].idprojeto}">
                    <a href="#" class=" canc-investimento btn btn-danger btn-sm"><i class="fas fa-user-times"></i> Cancelar Investimento</a>
                    </div>
                </div>
                
            </div>
        </div>`)
        }
        $('.canc-investimento').click(function(){
          let id =$(this).parents('.card-body').find("input[name=id]").val();
          let bt= $(this)
         alert(id)
         if(confirm("deseja realmete deixar de ser investidor"))
           $.ajax({
             method:"POST",
             url:"../Controladores/retirarInvestimento.php",
             data: {idprojeto:id},
             success:function(){
               $(bt).parents('.tirar-projeto').fadeOut(1000)
             },
             Error: function(){
               alert("houve um erro por favor recaregue a página")
             }

           })
         })
      },
      error: function () {
        alert('deu errado')
      }
    })
  })
  $('.listar-top-ten').click(function () {
    $('.formulario').hide();
    $('.cards-projetos').empty();
    $.ajax({
      method: "POST",
      url: "../Controladores/listartop10.php",
      dataType: "json",
      success: function (top) {
        alert("deu certo");
        $('.cards-projetos').append(`<table class="table table-hover">
              <thead>
                <tr>
                  <th scope="col">Posição</th>
                  <th scope="col">Pontos de avaliação</th>
                  <th scope="col">Nome</th>
                  <th scope="col">Empreendedor responsável</th>
                  <th scope="col">Orcamento total</th>
                </tr>
                <tbody>
                </tbody>
              </thead>
              </table>`)            
        for (let cada in top) {
          cada= parseInt(cada)
          cont=cada+1;
          $('tbody').append(`
                <tr>
                  <th scope="row">${cont}⁰</th>
                  <td>${top[cada].avaliacao}</td>
                  <td>${top[cada].nome}</td>
                  <td>${top[cada].empreendedor}</td>
                  <td>${top[cada].orcamento}</td>
                </tr> `);
        }
      },
      error: function () {
        alert('houve algum erro interno recaregue a página');
      }
    })

  })
  
  $('.mydados').click(function () {
    $('.formulario').hide();
    $('.cards-projetos').empty();
    $.ajax({
      method: "POST",
      url: "../Controladores/MostrarDados.php",
      dataType: "json",
      success: function (dadosPerfil) {
        alert("deu certo");
        $('.cards-projetos').append(`
        <div class="container mt-3 ">
        <div class=" add-form row">
          <div class ="col-4">
          <a href="#" class="alterar-imagem"> <img  class="img-projeto-dados rounded"src="${dadosPerfil.imagem}" alt="..." class="img-thumbnail"></a>
          </div>
          <div class="col-4">
            <h1 class="h4">Nome:</h1> <p class="newnome">${dadosPerfil.nome} <i class=" nome fas fa-pencil-alt ml-5"></i></p>
            <h1 class="h4">Email:</h1> <p class ="newemail">${dadosPerfil.email} <i class="email fas fa-pencil-alt ml-5"></i></p>
            <h1 class="h4">Localização:</h1> <p class="newlocalizacao">${dadosPerfil.local} <i class=" localizacao fas fa-pencil-alt ml-5"></i></p>
            <h1 class="h4">Telefone:</h1> <p class="newtelefone">${dadosPerfil.telefone} <i class=" telefone fas fa-pencil-alt ml-5"></i></p>
            <h1 class="h4">OutrosMeios de contato:</h1> <p class="newoutros">${dadosPerfil.outrosmeios} <i class=" outros fas fa-pencil-alt ml-5"></i></p>
        </div>    
              `)
        $('.nome').click(function () {
          $(this).parents('.mostrado').remove('.add-form');
          $(this).parents('.add-form').append(`<div class=" mostrado col-4>
                <form class="formulario">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Nome</label>
                    <input type="text" class="form-control" id="nome" name='nome' aria-describedby="emailHelp" placeholder="Seu nome" required="required">
                    <button type="button" class=" enviar btn btn-primary mt-2">Atualizar</button>
                    <button type="button" class="cancelar btn btn-danger mt-2"> Cancelar</button>
                    </div>
                </form>
                </div>`)
          $('.cancelar').click(function () {
            $(this).parents('.mostrado').hide();
          })
          $('.enviar').click(function () {
            $.ajax({
              method: "POST",
              url: "../Controladores/atualizarDadosUsuarios.php",
              data: { nome: nome.value },
              success: function () {
                alert('Atualização feita')
                $('.nomeuser').empty();
                $('.nomeuser').append(`${nome.value}`) 
                $('.newnome').empty()
                $('.newnome').append(`${nome.value } <p class="text-muted"> Campo atualizado</p>`)
              },
              error: function () {

              }
            })
            $(this).parents('.mostrado').hide();
          })
        })
        $('.email').click(function () {
          $(this).parents('.add-form').append(`<div class=" mostrado col-4>
                <form class="formulario">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Endereço de email</label>
                    <input type="email" class="form-control" id="email" name='email' aria-describedby="emailHelp" required="required" >
                    <button type="button" class=" enviar btn btn-primary mt-2">Atualizar</button>
                    <button type="button" class="cancelar btn btn-danger mt-2"> Cancelar</button>
                  </div>
                </form>
                </div>`)
          $('.cancelar').click(function () {
            $(this).parents('.mostrado').hide();
          })
          $('.enviar').click(function () {
            $.ajax({
              method: "POST",
              url: "../Controladores/atualizarDadosUsuarios.php",
              data: { email: email.value },
              success: function () {
                alert('Atualização feita')
                $('.newemail').empty()
                $('.newemail').append(`${email.value} <p class="text-muted"> Campo atualizado</p>`)
              },
              error: function () {

              }
            })
            $(this).parents('.mostrado').hide();
          })
        })
        $('.localizacao').click(function () {
          $(this).parents('.add-form').append(`<div class=" mostrado col-4>
                <form class="formulario">
                  <div class="form-group">
                    <label for="exampleInputEmail1">localização</label>
                    <input type="text" class="form-control" id="localizacao" name='localizacao' aria-describedby="emailHelp" required="required">
                    <button type="button" class=" enviar btn btn-primary mt-2">Atualizar</button>
                    <button type="button" class="cancelar btn btn-danger mt-2"> Cancelar</button>
                    </div>
                </form>
                </div>`)
          $('.cancelar').click(function () {
            $(this).parents('.mostrado').hide();
          })
          $('.enviar').click(function () {
            $(this).parents('.mostrado').hide();
            $.ajax({
              method: "POST",
              url: "../Controladores/atualizarDadosUsuarios.php",
              data: { localizacao: localizacao.value },
              success: function () {
                alert('Atualização feita')
                $('.newlocalizacao').empty()
                $('.newlocalizacao').append(`${localizacao.value} <p class="text-muted"> Campo atualizado</p>`)
              },
              error: function () {

              }
            })
            $(this).parents('.mostrado').hide();
          })
        })
        $('.telefone').click(function () {
          $(this).parents('.add-form').append(`<div class=" mostrado col-4>
                <form class="formulario">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Telefone</label>
                    <input type="text" class="form-control" id="telefone" name='telefone' aria-describedby="emailHelp" required="required" >
                    <button type="button" class=" enviar btn btn-primary mt-2">Atualizar</button>
                    <button type="button" class="cancelar btn btn-danger mt-2"> Cancelar</button>
                    </div>
                </form>
                </div>`)
          $('.cancelar').click(function () {
            $(this).parents('.mostrado').hide();
          })
          $('.enviar').click(function () {
            $.ajax({
              method: "POST",
              url: "../Controladores/atualizarDadosUsuarios.php",
              data: { telefone: telefone.value },
              success: function () {
                alert('Atualização feita')
                $('.newtelefone').empty()
                $('.newtelefone').append(`${telefone.value} <p class="text-muted"> Campo atualizado</p>`)
              },
              error: function () {
              }
            })
            $(this).parents('.mostrado').hide();
          })
        })
        $('.outros').click(function () {
          $(this).parents('.add-form').append(`<div class=" mostrado col-4>
                <form class="formulario">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Outros meios de contato</label>
                    <input type="text" class="form-control" id="outrosmeiosdecontato" name='outrosmeiosdecontato' aria-describedby="emailHelp" required="required">
                    <button type="button" class=" enviar btn btn-primary mt-2">Atualizar</button>
                    <button type="button" class="cancelar btn btn-danger mt-2"> Cancelar</button>
                    </div>
                </form>
                </div>`)
          $('.cancelar').click(function () {
            $(this).parents('.mostrado').hide();
          })
          $('.enviar').click(function () {
            $.ajax({
              method: "POST",
              url: "../Controladores/atualizarDadosUsuarios.php",
              data: { outrosmeiosdecontato: outrosmeiosdecontato.value },
              success: function () {
                alert('Atualização feita')
                $('.newoutros').empty()
                $('.newoutros').append(`${outrosmeiosdecontato.value} <p class="text-muted"> Campo atualizado</p>`)
              },
              error: function () {

              }
            })
            $(this).parents('.mostrado').hide();
          })
        })
      },

    })
  })
  $('.parceiros').click(function(){
    $('.formulario').hide();
    $('.cards-projetos').empty();
    $.ajax({
       method:"POST",
       url: "../Controladores/carregarParcerias.php",
       dataType: "json",
       success: function(parceiros){
          alert("deu certo")
        for(let parceiro in parceiros){
          parceiro=parseInt(parceiro)
         $('.cards-projetos').append(`<div class="investidor col-xs-12 co l-sm-6 col-md-4 mt-4" >
         <div class="image-flip" ontouchstart="this.classList.toggle('hover');">
             <div>
                 <div class="frontside">
                     <div class="card border-0">
                         <div class="card-body text-center">
                             <p><img class="img-propocional rounded-circle  img-fluid" src="${parceiros[parceiro].imagem}" alt="card image"></p>
                             <h4 class="card-title">${parceiros[parceiro].nome}</h4>
                             <p> Email: ${parceiros[parceiro].email} </p>
                             <p> Telefone: ${parceiros[parceiro].telefone} </p>
                             <p> Localização: ${parceiros[parceiro].localizacao} </p>
                             <input class="idin" type="hidden" name="id" value="${parceiros[parceiro].idinvestidor}">
                             <a href="#" class=" canc btn btn-danger btn-sm"><i class="fas fa-user-times"></i> Cancelar Parceria</a>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
     `)
        }
        $('.canc').click(function(){
           let id =$(this).parents('.frontside').find("input[name=id]").val();
           let bt= $(this)
          alert(id)
          if(confirm("deseja realmete desfazer parceria"))
            $.ajax({
              method:"POST",
              url:"../Controladores/desfazerParceria.php",
              data: {idinvestidor:id},
              success:function(){
                $(bt).parents('.investidor').fadeOut(1000)
              },
              Error: function(){
                alert("houve um erro por favor recaregue a página")
              }

            })
          })
        },
        error: function(){
          alert("Houve um erro interno por favor recaregue a página")
        }
      })
      
      /* $("input[type=text][name=id]").val();
  */
  })

})