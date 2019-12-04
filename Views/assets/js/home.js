$(function () {
 /*  $('.inicio').click(function (e) {
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
          $('.cards-projetos').append(`<div class=" col-12 col-md-5 mt-md-3" style="max-width: 540px;">
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
  }) */
  $('.mys-projects').click(function (e) {
    $('.formulario').hide();
    $('.cards-projetos').empty();
    $.ajax({
      method: "POST",
      url: "../Controladores/listarMeusProjetos.php",
      dataType: "json",
      success: function (dadosmyprojects) {
        alert("deu certo");
        for (let myprojets in dadosmyprojects) {
          myprojets = parseInt(myprojets)
          $('.cards-projetos').append(`<div class="projetos </div> col-12 col-md-6 mt-md-5" style="max-width: 540px;">
            <div class=" projetos row no-gutters">
                <div class="col-md-4">
                <img src="${dadosmyprojects[myprojets].imagem}" class="card-img" id='imagem-perfil' alt="">
                </div>
                <div class="projetos col-md-8">
                  <div class="card-body">
                      <h5 class="card-title">${dadosmyprojects[myprojets].nome}</h5>
                      <p class="card-text">${dadosmyprojects[myprojets].descricao}</p>
                      <p class="card-text"> Score: ${dadosmyprojects[myprojets].avaliacao}</p>
                      <p class="card-text"><small class="text-muted">${dadosmyprojects[myprojets].areaatuacao}</small></p>                  
                  </div>
                </div>
                <input class="idProject" type="hidden" name="id" value="${dadosmyprojects[myprojets].idprojeto}">
                <button type="button" class="ver-detalhes btn btn-primary btn-sm mr-3">Ver detalhes do projeto <i class="fas fa-eye"></i></button>
                <button type="button" class=" ver-investidores btn btn-primary btn-sm">Ver Investidores <i class="fas fa-eye"></i></button> 
                <button type="button" class=" apagar btn btn-danger btn-sm ml-3"> Apagar Projeto <i class="fas fa-trash-alt"></i></button>
              </div>
        </div>`)
        }
        $('.apagar').click(function () {
          let id = $(this).parents('.projetos').find("input[name=id]").val();
          alert(id)
          alert('Estão me apertando aki');
          bt = $(this)
          if (confirm('Tem certeza que deseja excluir esse projeto')) {
            $.ajax({
              method: "POST",
              url: "../Controladores/excluirProjeto.php",
              data: { idProjeto: id },
              success: function () {
                $(bt).parents('.projetos').fadeOut(1000)
              },
              Error: function () {
                alert("houve um erro por favor recaregue a página")
              }

            })
          }
        })
        $('.ver-detalhes').click(function () {
          let id = $(this).parents('.projetos').find("input[name=id]").val();
          $.ajax({
            method: "POST",
            url: "../Controladores/buscarProjetoParadetalhar.php",
            dataType: "json",
            data: { idprojeto: id },
            success: function (buscaprojetounico) {
              let disponivel;
              let classe;
              if(buscaprojetounico.disponibilidade==false){
                disponivel="Não";
                classe="disponibilidade btn btn-danger btn-sm"
              }else{
                disponivel="Sim";
                classe="disponibilidade btn btn-success btn-sm"
              }
              alert("deu certo");
              $('.cards-projetos').empty();
              $('.cards-projetos').append(`<div class=" projeto-dados container mt-3 ">
              <div class=" formulario-dados-projeto add-form row">
              <input class="idProject" type="hidden" name="id" value="${buscaprojetounico.idprojeto}">
              <header class="col-4">
              <a href="#" class="alterar-imagem"> <img  class="img-projeto-dados rounded"src="${buscaprojetounico.imagem}" alt="..." class="img-thumbnail"></a>
                  <ul class="list-group mt-4">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      Avaliação 
                      <span class="badge badge-primary badge-pill">${buscaprojetounico.avaliacao}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      Orçamento
                      <span class="badge badge-primary badge-pill">${buscaprojetounico.orcamento}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      Disponibilidade Para Investimento
                      <div id="bddis"class="${classe}">${disponivel}</div>
                    </li>
                </ul>
                  </header>  
                <div class="col-4">
                <h1 class="h4">Nome:</h1> <p class="newnomeprojeto">${buscaprojetounico.nome} <i class=" nome-projeto fas fa-pencil-alt ml-5"></i></p>
                  <h1 class="h4">Área de atuação:</h1> <p class ="newarea">${buscaprojetounico.areatuacao} <i class="area-atuacao fas fa-pencil-alt ml-5"></i></p>
                  <h1 class="h4">Descrição:</h1> <p class="newdescricao">${buscaprojetounico.descricao} <i class=" descricao fas fa-pencil-alt ml-5"></i></p>                  
              </div>
              <div class="campos-atualizar col-4"> </div>
              
              </div>  `)
              $('#bddis').click(function(){
                let valorenviar;
                texto=$(this).text()
                if(texto=="Sim"){
                  valorenviar=false
                }else{
                  valorenviar= true
                }
                let idprojetodisponi=$(this).parents('.projeto-dados ').find('input[name=id]').val()
                let botao=$(this)
                if(confirm('Deseja realmente alterar a disponibilidade')){
                  $.ajax({
                    method:"POST",
                    url: "../Controladores/alterarDisponibilidadeDoProjeto.php",
                    data: {idprojeto:idprojetodisponi,valor:valorenviar},
                    success: function () {
                      if(texto=="Sim"){
                        $(botao).removeClass('disponibilidade btn btn-success btn-sm').addClass('disponibilidade btn btn-danger btn-sm')
                        $(botao).empty()
                        $(botao).append("Não")
                      }else{
                        $(botao).removeClass('disponibilidade btn btn-danger btn-sm').addClass('disponibilidade btn btn-success btn-sm')
                        $(botao).empty()
                        $(botao).append("Sim")
                      }
                    },
                    error:function(){
                      alert("Ocorreu um error interno recaregue a página")
                    }
                  });
                }
              })
              $('.newnomeprojeto').click(function () {
                $(this).parents('.formulario-dados-projeto').find('.campos-atualizar').append(`<div class=" mostrado col-6>
                      <form class="formulario">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Nome do projeto</label>
                          <input type="text" class="form-control" id="nomeprojeto" name='nomeprojeto' aria-describedby="emailHelp" required="required">
                          <button type="button" class=" enviar-name btn btn-primary mt-2">Atualizar</button>
                          <button type="button" class="cancelar btn btn-danger mt-2"> Cancelar</button>
                          </div>
                      </form>
                      </div>`)
                $('.cancelar').click(function () {
                  $(this).parents('.mostrado').hide();
                })
                $('.enviar-name').click(function () {
                  alert('tão me apertando aki')
                  let idprojetoAtualizar= $(this).parents('.projeto-dados').find("input[name=id]").val()
                   alert(idprojetoAtualizar)
                   $.ajax({
                    method: "POST",
                    url: "../Controladores/alterarDadosDoProjeto.php",
                    data: {idprojeto:idprojetoAtualizar,dado:"nome", valor: nomeprojeto.value },
                    success: function () {
                      alert('Atualização feita')
                      $('.newnomeprojeto').html('')
                      $('.newnomeprojeto').append(`${nomeprojeto.value} <p class="text-muted"> Campo atualizado</p>`)
                    },
                    error: function () {
                      alert('houve um erro por favor recarregue a página')
                    }
                  }) 
                  $(this).parents('.mostrado').hide();
                })
              })
              $('.newarea').click(function () {
                $(this).parents('.formulario-dados-projeto').find('.campos-atualizar').append(`<div class=" mostrado col-6>
                      <form class="formulario">
                        <div class="form-group">
                        <label for="area">Área do Projeto</label>
                        <select id="area" class="form-control" required="required" name ='area'>
                        <option value="" disabled selected> Selecione... </option>
                          <option>Saúde</option>
                          <option>Educação</option>
                          <option>TI</option>
                          <option>Mercado Imobiliário</option>
                          <option>Mobilidade urbana</option>
                          <option>Saúde</option>
                        </select>
                          <button type="button" class=" enviar btn btn-primary mt-2">Atualizar</button>
                          <button type="button" class="cancelar btn btn-danger mt-2"> Cancelar</button>
                          </div>
                      </form>
                      </div>`)
                $('.cancelar').click(function () {
                  $(this).parents('.mostrado').hide();
                })
                $('.enviar').click(function () {
                  let idprojetoAtualizar= $(this).parents('.projeto-dados').find("input[name=id]").val()
                  alert(idprojetoAtualizar)
                  $.ajax({
                    method: "POST",
                    url: "../Controladores/alterarDadosDoProjeto.php",
                    data: {idprojeto:idprojetoAtualizar ,dado:'areaatuacao', valor: area.value },
                    success: function () {
                      alert('Atualização feita')
                      $('.newarea').empty()
                      $('.newarea').append(`${area.value} <p class="text-muted"> Campo atualizado</p>`)
                    },
                    error: function () {
      
                    }
                  })
                  $(this).parents('.mostrado').hide();
                })
              })
              $('.newdescricao').click(function () {
                $(this).parents('.formulario-dados-projeto').find('.campos-atualizar').append(`<div class=" mostrado col-6>
                      <form class="formulario">
                        <div class="form-group">
                        <label for="area">Nova descrição do projeto</label>
                        <textarea class="form-control" id="descricao" name='descricao' rows="3"></textarea>
                          <button type="button" class=" enviar btn btn-primary mt-2">Atualizar</button>
                          <button type="button" class="cancelar btn btn-danger mt-2"> Cancelar</button>
                          </div>
                      </form>
                      </div>`)
                $('.cancelar').click(function () {
                  $(this).parents('.mostrado').hide();
                })
                $('.enviar').click(function () {
                  let idprojetoAtualizar= $(this).parents('.projeto-dados').find("input[name=id]").val()
                  alert(idprojetoAtualizar)
                  $.ajax({
                    method: "POST",
                    url: "../Controladores/alterarDadosDoProjeto.php",
                    data: {idprojeto:idprojetoAtualizar ,dado:'descricao', valor: descricao.value },
                    success: function () {
                      alert('Atualização feita')
                      $('.newdescricao').empty()
                      $('.newdescricao').append(`${descricao.value} <p class="text-muted"> Campo atualizado</p>`)
                    },
                    error: function () {
      
                    }
                  })
                  $(this).parents('.mostrado').hide();
                })
                
              })
              $('.alterar-imagem').click(function(){
                $(this).parents('.formulario-dados-projeto').find('.campos-atualizar').append(`<div class=" mostrado col-6>
                <form class="formulario" enctype="multipart/form-data">
                  <div class="form-group">
                  <label for="area">Selecione uma imagem para atualizar</label>
                  <input type="file" class="form-control-file" id='imgprojeto' name='imagem'>
                    <button type="button" class=" enviar btn btn-primary mt-2">Atualizar</button>
                    <button type="button" class="cancelar btn btn-danger mt-2"> Cancelar</button>
                    </div>
                </form>
                </div>`)
          $('.cancelar').click(function () {
            $(this).parents('.mostrado').hide();
          })
          $('.enviar').click(function () {
            let idprojetoAtualizar= $(this).parents('.projeto-dados').find("input[name=id]").val()
            let imagem= $("input[name=imagem]")[0].files;
            alert(imagem)
            alert(idprojetoAtualizar) 
            $.ajax({
              method: "POST", 
              url: "../Controladores/alterarDadosDoProjeto.php",
              data: {idprojeto:idprojetoAtualizar ,dado:'imagem', imagem: imagem },
              dataType:"text",
              success: function (texto) {
                $(".img-projeto-dados ").attr("src",texto) 
              },
              error: function () {

              }
            })
            $(this).parents('.mostrado').hide();
              })
            })
            },
            error: function () {
              alert('Ocorreu um erro interno por favor recaregue a página')
            }
          })
        })
        $('.ver-investidores').click(function () {
          let idParaVerInvestidores = $(this).parents('.projetos').find("input[name=id]").val();
          $.ajax({
            method: "POST",
            url: "../Controladores/mostrarInvestidoresDoProjeto.php",
            dataType: "json",
            data: { idprojeto: idParaVerInvestidores },
            success: function (Investidoresmeuprojeto) {
              alert("deu certo");
              $('.cards-projetos').empty();
              for (let investidor in Investidoresmeuprojeto) {
                investidor = parseInt(investidor)
                $('.cards-projetos').append(`<div class="investidor col-xs-12 co l-sm-6 col-md-4 mt-4" >
                    <div class="image-flip" ontouchstart="this.classList.toggle('hover');">
                        <div>
                            <div class="frontside">
                                <div class="card border-0">
                                    <div class="card-body text-center">
                                        <p><img class="img-propocional rounded-circle  img-fluid" src="${Investidoresmeuprojeto[investidor].imagem}" alt="card image"></p>
                                        <h4 class="card-title">${Investidoresmeuprojeto[investidor].nome}</h4>
                                        <p> Email: ${Investidoresmeuprojeto[investidor].email} </p>
                                        <p> Telefone: ${Investidoresmeuprojeto[investidor].telefone} </p>
                                        <p> Localização: ${Investidoresmeuprojeto[investidor].localizacao} </p>
                                        <input class="idin" type="hidden" name="id" value="${Investidoresmeuprojeto[investidor].idInvestidor}">
                                        <a href="#" class=" cancelarin btn btn-danger btn-sm"><i class="fas fa-user-times"></i> Retirar Investidor</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                `)
              }
              $('.cancelarin').click(function () {
                let id = $(this).parents('.frontside').find("input[name=id]").val();
                let bt = $(this)
                if (confirm("deseja realmete excluir investidor")) {
                  $.ajax({
                    method: "POST",
                    url: "../Controladores/excluirInvestidor.php",
                    data: { idinvestidor: id, idprojeto: idParaVerInvestidores },
                    success: function () {
                      $(bt).parents('.investidor').fadeOut(1000)
                    },
                    Error: function () {
                      alert("houve um erro por favor recaregue a página")
                    }

                  })
                }
              })
            },
            error: function () {
              alert('Ocorreu um erro interno por favor recaregue a página')
            }
          })
        })

      },
      error: function () {
        alert('houve algum erro interno recaregue a página');
      }
    })
  });
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
          cada = parseInt(cada)
          cont = cada + 1;
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
          $(this).parents('.mostrado').hide();
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
                $('.newnome').append(`${nome.value} <p class="text-muted"> Campo atualizado</p>`)
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
  $('.cancelar').click(function () {
    $(this).parents('.mostrado').hide();
  })
})

