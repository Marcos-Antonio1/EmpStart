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
        alert('deu certo')
      },
      error: function () {
        alert('deu errado')
      }
    })
  })
  $('.listar-top-ten').click(function () {
    $('.formulario').show();
    $('.cards-projetos').empty();
    $.ajax({
      method: "POST",
      url: "../Controladores/listartop10.php",
      dataType: "json",
      success: function (dadosmyprojects) {
        alert("deu certo");
        for (let myprojets in dadosmyprojects) {
          myprojets = parseInt(myprojets)
          $('.cards-projetos').append(`<table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Primeiro</th>
                  <th scope="col">Último</th>
                  <th scope="col">Nickname</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope="row">1</th>
                  <td>Mark</td>
                  <td>Otto</td>
                  <td>@mdo</td>
                </tr>
              </tbody>
            </table>`);
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
                      <div class="col-6">
                        <h1 class="h4">Nome:</h1> <p>${dadosPerfil.nome} <i class=" nome fas fa-pencil-alt ml-5"></i></p>
                        <h1 class="h4">Email:</h1> <p>${dadosPerfil.email} <i class="email fas fa-pencil-alt ml-5"></i></p>
                        <h1 class="h4">Localização:</h1> <p>${dadosPerfil.local} <i class=" localizacao fas fa-pencil-alt ml-5"></i></p>
                        <h1 class="h4">Telefone:</h1> <p>${dadosPerfil.telefone} <i class=" telefone fas fa-pencil-alt ml-5"></i></p>
                        <h1 class="h4">OutrosMeios de contato:</h1> <p>${dadosPerfil.outrosmeios} <i class=" outros fas fa-pencil-alt ml-5"></i></p>
                    </div>   
              `)
        $('.nome').click(function () {
          $(this).parents('.mostrado').hide();
          $(this).parents('.add-form').append(`<div class=" mostrado col-6>
                <form class="formulario">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Nome</label>
                    <input type="text" class="form-control" id="nome" name='nome' aria-describedby="emailHelp" placeholder="Seu nome" required="required">
                    <button type="button" class=" enviar btn btn-primary mt-2">Atualizar</button>
                    <button type="button" class="cancelar btn btn-danger mt-2"> Cancelar</button>
                    </div>
                </form>
                </div>`)
          $('.enviar').click(function () {
            alert(nome.value)
            $.ajax({
              method: "POST",
              url: "../Controladores/atualizarDadosUsuarios.php",
              data: { nome: nome.value },
              success: function () {
                alert('Atualização feita')
              },
              error: function () {

              }
            })
            $(this).parents('.mostrado').hide();
          })
        })
        $('.email').click(function () {
          $(this).parents('.add-form').append(`<div class=" mostrado col-6>
                <form class="formulario">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Endereço de email</label>
                    <input type="email" class="form-control" id="email" name='email' aria-describedby="emailHelp" required="required" >
                    <button type="button" class=" enviar btn btn-primary mt-2">Atualizar</button>
                    <button type="button" class=" na btn btn-primary mt-2">Atualizar</button>
                    <button type="button" class="cancelar btn btn-danger mt-2"> Cancelar</button>
                  </div>
                </form>
                </div>`)
          $('.enviar').click(function () {
            alert(email.value)
            $.ajax({
              method: "POST",
              url: "../Controladores/atualizarDadosUsuarios.php",
              data: { email: email.value },
              success: function () {
                alert('Atualização feita')
              },
              error: function () {

              }
            })
            $(this).parents('.mostrado').hide();
          })
        })
        $('.localizacao').click(function () {
          $(this).parents('.add-form').append(`<div class=" mostrado col-6>
                <form class="formulario">
                  <div class="form-group">
                    <label for="exampleInputEmail1">localização</label>
                    <input type="email" class="form-control" id="localizacao" name='localizacao' aria-describedby="emailHelp" required="required">
                    <button type="button" class=" enviar btn btn-primary mt-2">Atualizar</button>
                    <button type="button" class="cancelar btn btn-danger mt-2"> Cancelar</button>
                    </div>
                </form>
                </div>`)
          $('.enviar').click(function () {
            $(this).parents('.mostrado').hide();
            alert(localizacao.value)
            $.ajax({
              method: "POST",
              url: "../Controladores/atualizarDadosUsuarios.php",
              data: { email: localizacao.value },
              success: function () {
                alert('Atualização feita')
              },
              error: function () {

              }
            })
            $(this).parents('.mostrado').hide();
          })
        })
        $('.telefone').click(function () {
          $(this).parents('.add-form').append(`<div class=" mostrado col-6>
                <form class="formulario">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Telefone</label>
                    <input type="email" class="form-control" id="telefone" name='telefone' aria-describedby="emailHelp" required="required" >
                    <button type="button" class=" enviar btn btn-primary mt-2">Atualizar</button>
                    <button type="button" class="cancelar btn btn-danger mt-2"> Cancelar</button>
                    </div>
                </form>
                </div>`)
          $('.enviar').click(function () {
            alert(localizacao.value)
            $.ajax({
              method: "POST",
              url: "../Controladores/atualizarDadosUsuarios.php",
              data: { email: localizacao.value },
              success: function () {
                alert('Atualização feita')
              },
              error: function () {

              }
            })
            $(this).parents('.mostrado').hide();
          })
        })
        $('.outros').click(function () {
          $(this).parents('.add-form').append(`<div class=" mostrado col-6>
                <form class="formulario">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Outros meios de contato</label>
                    <input type="email" class="form-control" id="outrosmeiosdecontato" name='outrosmeiosdecontato' aria-describedby="emailHelp" required="required">
                    <button type="button" class=" enviar btn btn-primary mt-2">Atualizar</button>
                    <button type="button" class="cancelar btn btn-danger mt-2"> Cancelar</button>
                    </div>
                </form>
                </div>`)
          $('.enviar').click(function () {
            alert(outrosmeiosdecontato.value)
            $.ajax({
              method: "POST",
              url: "../Controladores/atualizarDadosUsuarios.php",
              data: { email: outrosmeiosdecontato.value },
              success: function () {
                alert('Atualização feita')
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

})