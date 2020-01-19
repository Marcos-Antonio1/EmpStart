$(function(){
    $('.pro').click(function(){
        alert('funcionando')
        $.ajax({
            method: "POST",
            url: "../Controladores/buscarTodososProjetos.php",
            dataType: "json",
            success: function (dados) {
                $('.cards-projetos').empty();
                for(let minhabusca in dados){
                    minhabusca=parseInt(minhabusca)
                    if(dados[minhabusca].hasOwnProperty("idprojeto")){
                        $('.cards-projetos').append(`<div class="projetos </div> col-12 col-md-6 mt-md-5" style="max-width: 540px;">
                        <div class=" row no-gutters">
                            <div class="col-md-4">
                            <img src="${dados[minhabusca].imagem}" class="card-img" id='imagem-perfil' alt="">
                            </div>
                            <div class="projetos-card col-md-8">
                              <div class="card-body">
                                  <h5 class="card-title">${dados[minhabusca].nome}</h5>
                                  <p class="card-text">${dados[minhabusca].descricao}</p>
                                  <p class=" score card-text"> Score: ${dados[minhabusca].avaliacao}</p>                 
                                  <div class="container estrelas">
                                    <i class=" fas fa-star estrela_um "></i>
                                    <i class="fas fa-star estrela_dois"></i>
                                    <i class="fas fa-star estrela_tres"></i>
                                    <i class="fas fa-star estrela_quatro"></i>
                                    <i class="fas fa-star estrela_cinco"></i>   
                                </div>    
                            </div>
                            </div>
                            <input class="idProject" type="hidden" name="id" value="${dados[minhabusca].idprojeto}">
                            <button type="button" class="ver-detalhes-lista-de-projetos btn btn-primary btn-sm mr-3">Ver detalhes do projeto <i class="fas fa-eye"></i></button>
                          </div>
                    </div>`)
                    }
                    $('.ver-detalhes-lista-de-projetos').click(function(){
                        $('.cards-projetos').empty();
                        let idprojetojainvestido
                        $.ajax({
                            method:"POST",
                            url:"../Controladores/listarIdsdeProjetosInvestidos.php",
                            dataType:"json",
                            success:function(projetosinvestidos){
                                idprojetojainvestido=projetosinvestidos;
                            },
                            
                        })
                        id=$(this).parents('.projetos').find("input[name=id]").val();
                        id=parseInt(id)
                        $.ajax({
                            method: "POST",
                            url: "../Controladores/buscarProjetoParadetalhar.php",
                            dataType: "json",
                            data: { idprojeto: id },
                            success: function (buscaprojetounico) {
                            let classe;
                            let disponivel;
                            let btativo;
                            let textativo;
                               
                            if(buscaprojetounico.disponibilidade==false){
                                disponivel="Não";
                                classe="disponibilidade btn btn-danger btn-sm"
                                btativo="d-none"
                            }else{
                                disponivel="Sim";
                                classe="disponibilidade btn btn-success btn-sm"
                                btativo=""
                            }
                           if(Array.isArray(idprojetojainvestido)){
                                if(idprojetojainvestido.includes(id)){
                                    textativo=""
                                    btativo="d-none"
                                }else{
                                    textativo="d-none"
                                }
                           }
                            $('.formulario').hide()
                            $('.cards-projetos').empty();
                            $('.cards-projetos').append(`<div class=" projeto-dados container mt-5 ">
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
                                <div class="iniciar-investimento-ativo col-4">
                                <h1 class="h4">Nome:</h1> <p class="newnomeprojeto">${buscaprojetounico.nome} </p>
                                <h1 class="h4">Área de atuação:</h1> <p class ="newarea">${buscaprojetounico.areatuacao} </p>
                                <h1 class="h4">Descrição:</h1> <p class="newdescricao">${buscaprojetounico.descricao} </p>                
                                <button type="button" class=" iniciar-investimento ${btativo} btn btn-primary">Iniciar Investimento</button>
                                <p class="muted ${textativo}"> Voce já é investidor desse projeto</p>
                                </div>
                            <div class="campos-atualizar col-4"> </div>
                            
                            </div>  `)
                            $('.iniciar-investimento ').click(function(){
                                $('.campos-atualizar').append(`<form class="sumir">
                                <div class=" formulario-invetimento form-group">
                                  <label for="exampleInputEmail1">Valor Investimento</label>
                                  <input type="number" class="form-control" id="valor" name="investimento"  placeholder="informe o valor do investimento">                        
                                    <button class=" enviar-oferta btn btn-primary">Enviar Oferta</button>
                                    <button  class=" cancelar btn btn-danger">Cancelar</button>
                                </div>
                                </form>`)
                                let formcontexto;
                              $('.cancelar').click(function(e){
                                  e.preventDefault();
                                $(this).parents('.sumir').hide()
                               formcontexto=$(this);
                            })
                            $('.enviar-oferta').click(function(e){
                                e.preventDefault();
                                let valor=$(this).parents('form').find("input[name=investimento]").val()
                                $.ajax({
                                    method:"POST",
                                    url:"../Controladores/investirEmProjeto.php",
                                    data:{idProjeto:id,valor:valor},
                                    success:function(){
                                        $('.sumir').hide()
                                        $('.iniciar-investimento').hide()
                                        alert("oferta enviada")
                                        
                                    },
                                    error:function(){
                                        alert("Erro interno por favor recarregue o nosso site")
                                    }
                                })
                                
                            })

                            })
                              
                        },
                            error:function(){
                                alert ("deu errado aki")
                            }
                            
                        })
                       
                    })
                    
                    }
                    $('.estrela_um').click(function () {
                        $(this).addClass('selecionada')
                        let id=$(this).parents('.projetos').find("input[name=id]").val()
                        let contexto1=$(this)
                        $.ajax({
                            method:"POST",
                            url:"../Controladores/AvaliarProjeto.php",
                            data:{projetoid:id, valor:1},
                            success:function(){
                                let teste=$(contexto1).parents('.projetos-card').find('.score').html()
                                let numero=teste.slice(8);
                                numero=parseInt(numero)
                                numero=numero+1;
                                $(contexto1).parents('.projetos-card').find('.score').empty()
                                $(contexto1).parents('.projetos-card').find('.score').append(`Score : ${numero}`)
                                $(contexto1).parents('.projetos').find('.estrelas').fadeOut(1000);
                            },
                            error:function(){
                                alert('Não foi possivel enviar a avaliação, por favor recarregue o site ');
                            }
                        })
                    })
                      $('.estrela_dois').click(function () {
                        $(this).parents('.estrelas').find('.estrela_um').addClass('selecionada')
                        $(this).addClass('selecionada')
                         alert('aki')
                        let id=$(this).parents('.projetos').find("input[name=id]").val()
                        let contexto2=$(this)
                        $.ajax({
                            method:"POST",
                            url:"../Controladores/AvaliarProjeto.php",
                            data:{projetoid:id, valor:2},
                            success:function(){
                                $(contexto2).parents('.projetos').find('.estrelas').fadeOut(1000);
                                let teste=$(contexto2).parents('.projetos-card').find('.score').html()
                                let numero=teste.slice(8);
                                numero=parseInt(numero)
                                numero=numero+2;
                                $(contexto2).parents('.projetos-card').find('.score').empty()
                                $(contexto2).parents('.projetos-card').find('.score').append(`Score : ${numero}`)
                            },
                            error:function(){
                                alert('Não foi possivel enviar a avaliação, por favor recarregue o site ');
                            }
                        })
                      })
                      $('.estrela_tres').click(function () {
                        $(this).parents('.estrelas').find('.estrela_um').addClass('selecionada')
                        $(this).parents('.estrelas').find('.estrela_dois').addClass('selecionada')
                        $(this).addClass('selecionada')
                        let contexto3=$(this)
                        let id=$(this).parents('.projetos').find("input[name=id]").val()
                        $.ajax({
                            method:"POST",
                            url:"../Controladores/AvaliarProjeto.php",
                            data:{projetoid:id, valor:3},
                            success:function(){
                                $(contexto3).parents('.projetos').find('.estrelas').fadeOut(1000);
                                let teste=$(contexto3).parents('.projetos-card').find('.score').html()
                                let numero=teste.slice(8);
                                numero=parseInt(numero)
                                numero=numero+3;
                                $(contexto3).parents('.projetos-card').find('.score').empty()
                                $(contexto3).parents('.projetos-card').find('.score').append(`Score : ${numero}`)
                            },
                            error:function(){
                                alert('Não foi possivel enviar a avaliação, por favor recarregue o site ');
                            }
                        })
                      })
              
                      $('.estrela_quatro').click(function () {
                        $(this).parents('.estrelas').find('.estrela_um').addClass('selecionada')
                        $(this).parents('.estrelas').find('.estrela_dois').addClass('selecionada')
                        $(this).parents('.estrelas').find('.estrela_tres').addClass('selecionada')
                        $(this).addClass('selecionada')
                        let id=$(this).parents('.projetos').find("input[name=id]").val()
                        let contexto4=$(this)
                        $.ajax({
                            method:"POST",
                            url:"../Controladores/AvaliarProjeto.php",
                            data:{projetoid:id, valor:4},
                            success:function(){
                                $(contexto4).parents('.projetos').find('.estrelas').fadeOut(1000);
                                let teste=$(contexto4).parents('.projetos-card').find('.score').html()
                                let numero=teste.slice(8);
                                numero=parseInt(numero)
                                numero=numero+4;
                                $(contexto4).parents('.projetos-card').find('.score').empty()
                                $(contexto4).parents('.projetos-card').find('.score').append(`Score : ${numero}`)
                            },
                            error:function(){
                                alert('Não foi possivel enviar a avaliação, por favor recarregue o site ');
                            }
                        })
                      })
              
                      $('.estrela_cinco').click(function () {
                        $(this).parents('.estrelas').find('.estrela_um').addClass('selecionada')
                        $(this).parents('.estrelas').find('.estrela_dois').addClass('selecionada')
                        $(this).parents('.estrelas').find('.estrela_tres').addClass('selecionada')
                        $(this).parents('.estrelas').find('.estrela_quatro').addClass('selecionada')
                        $(this).addClass('selecionada')
                        let id=$(this).parents('.projetos').find("input[name=id]").val()
                        let contexto5=$(this)
                        $.ajax({
                            method:"POST",
                            url:"../Controladores/AvaliarProjeto.php",
                            data:{projetoid:id, valor:5},
                            success:function(){
                                $(contexto5).parents('.projetos').find('.estrelas').fadeOut(1000); 
                                let teste=$(contexto5).parents('.projetos-card').find('.score').html()
                                let numero=teste.slice(8);
                                numero=parseInt(numero)
                                numero=numero+5;
                                $(contexto5).parents('.projetos-card').find('.score').empty()
                                $(contexto5).parents('.projetos-card').find('.score').append(`Score : ${numero}`)
                            },
                            error:function(){
                                alert('Não foi possivel enviar a avaliação, por favor recarregue o site ');
                            }
                        })
                      })
            },
            error:function(){
                alert("algo deu errado por favor recarregue a página")
            }
        });
    })
    $('.pessoas').click(function(){
        $.ajax({
            method: "POST",
            url: "../Controladores/listartodososusuarios.php",
            dataType: "json",
            success: function (dados) {
                $('.cards-projetos').empty();
                for(let minhabusca in dados){
                    minhabusca=parseInt(minhabusca)
                     if(dados[minhabusca].hasOwnProperty("idInvestidor")){
                        $('.cards-projetos').append(`<div class="investidor col-xs-12 co l-sm-6 col-md-4 mt-4" >
                        <div class="image-flip" ontouchstart="this.classList.toggle('hover');">
                            <div>
                                <div class="frontside">
                                    <div class="card border-0">
                                        <div class="card-body text-center">
                                            <p> Investidor </p>
                                            <p><img class="img-propocional rounded-circle  img-fluid" src="${dados[minhabusca].imagem}" alt="card image"></p>
                                            <h4 class="card-title">${dados[minhabusca].nome}</h4>
                                            <input class="idin" type="hidden" name="id" value="${dados[minhabusca].idInvestidor}">
                                            <a href="#" class=" detalhar btn btn-primary btn-sm"><i class="fas fa-eye"></i> ver detalhes</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>`)
                     $('.detalhar').click(function(){
                        let id=$(this).parents('.frontside').find("input[name=id]").val()
                        id=parseInt(id)
                        let idsinvestidores;
                        $.ajax({
                            method:"POST",
                            url:"../Controladores/listarIdsDosinvestidoresparceiros.php",
                            dataType:"json",
                            success:function(idsinvestidoresparceiros){
                                idsinvestidores=idsinvestidoresparceiros
                            }
                        })
                        let classe;
                        let texto;
                        $.ajax({
                            method:"POST",
                            url:"../Controladores/detalharInvestidor.php",
                            dataType: "json",
                            data:{idInvestidor:id},
                            success: function(dados){
                                    if(idsinvestidores.includes(id)){
                                        classe="d-none"
                                        texto=`Voces já possuem vinculo de parceria`
                                    }else{
                                        texto=''
                                    }
                                    $('.formulario').hide();
                                    $('.cards-projetos').empty()
                                    $('.cards-projetos').append(`
                                    <div class="container mt-3 mt-4">
                                    <div class=" add-form row">
                                      <div class ="col-4">
                                      <a href="#" class="alterar-imagem"> <img  class="img-projeto-dados rounded"src="${dados.imagem}" alt="..." class="img-thumbnail"></a>
                                      </div>
                                      <div class="col-4">
                                        <h1 class="h4">Nome:</h1> <p class="newnome">${dados.nome} </p>
                                        <h1 class="h4">Email:</h1> <p class ="newemail">${dados.email} </p>
                                        <h1 class="h4">Localização:</h1> <p class="newlocalizacao">${dados.localizacao} </i></p>
                                        <h1 class="h4">Telefone:</h1> <p class="newtelefone">${dados.telefone} </p>
                                        <button type="button" class=" ${classe} solicitar btn btn-success">Enviar solicitação de parceria</button>
                                        <p class="muted"> ${texto} </p>
                                    </div>    
                                          `)
                                $('.solicitar').click(function(){
                                    alert('tão me apertando')
                                    $.ajax({
                                        method:"POST",
                                        url:"../Controladores/solicitarParceria.php",
                                        data:{idinvestidor:id},
                                        success:function(){
                                            alert('solicitação enviada com sucesso')
                                            $('.solicitar').hide();
                                        },
                                        error:function(){
                                            alert('solicitação não enviada')
                                        }
                                    })
                                })
                            },
                            error:function(){
                                alert('não foi')
                            }
                        })
                    }) 
                    }else{
                        $('.cards-projetos').append(`<div class="investidor col-xs-12 co l-sm-6 col-md-4 mt-4" >
                        <div class="image-flip" ontouchstart="this.classList.toggle('hover');">
                            <div>
                                <div class="frontside">
                                    <div class="card border-0">
                                        <div class="card-body text-center">
                                            <p> Empreendor </p>
                                            <p><img class="img-propocional rounded-circle  img-fluid" src="${dados[minhabusca].imagem}" alt="card image"></p>
                                            <h4 class="card-title">${dados[minhabusca].nome}</h4>
                                            <input class="idin" type="hidden" name="id" value="${dados[minhabusca].idempreendedor}">
                                            <a href="#" class=" detalhar-empreendedor btn btn-primary btn-sm"><i class="fas fa-eye"></i> ver detalhes</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>`)
                    }
                    $('.detalhar-empreendedor').click(function(){
                        let id=$(this).parents('.frontside').find("input[name=id]").val()
                        $.ajax({
                            method:"POST",
                            url:"../Controladores/detaharEmpreendero.php",
                            dataType: "json",
                            data:{idEmpreendedor:id},
                            success: function(dados){
                                    $('.formulario').hide();
                                    $('.cards-projetos').empty()
                                    $('.cards-projetos').append(`
                                    <div class="container mt-3 mt-4">
                                    <div class=" add-form row">
                                      <div class ="col-4">
                                      <a href="#" class="alterar-imagem"> <img  class="img-projeto-dados rounded"src="${dados.imagem}" alt="..." class="img-thumbnail"></a>
                                      </div>
                                      <div class="col-4">
                                        <h1 class="h4">Nome:</h1> <p class="newnome">${dados.nome} </p>
                                        <h1 class="h4">Area de interesse:</h1> <p class ="newemail">${dados.areainterese} </p>
                                        <h1 class="h4">Localização:</h1> <p class="newlocalizacao">${dados.localizacao} </i></p>
                                        <h1 class="h4">Telefone:</h1> <p class="newtelefone">${dados.telefone} </p>
                                        <h1 class="h4">Outros meios de contato</h1> <p class="newtelefone">${dados.outrosmeiosdecontato} </p>
                                    </div>    
                                          `)
                            },
                            error:function(){
                                alert('não foi')
                            }
                        })
                    }) 
                }
            },
            error:function(){
                alert("houve algum erro recarregue a página")
            }
        });
    })
})