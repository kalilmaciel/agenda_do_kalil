   <div>
       <div class="collection-item avatar" href="#!">
           <a href="{{ $contato['imagem'] ? $getImagem($contato['imagem'], 'contatos') : asset('assets/img/usuario.png') }}"
               data-fancybox="gallery_{{ $contato['id'] }}" data-caption="{{ $contato['name'] }}" class="circle left">
               <div class="quadrado"
                   style="background-image: url({{ $contato['imagem'] ? $getImagem($contato['imagem'], 'contatos') : asset('assets/img/usuario.png') }})">
               </div>
           </a>
           <a href="{{ route('detalhar-contato', ['id' => $encrypt($contato['id'])]) }}" class="title black-text darken-4">
               {{ $contato['name'] }}
           </a>

           <div class="row no-margin dados-adicionais">
               <div class="col m4 s12 no-padding-left tooltipped" data-position="top" data-tooltip="E-mail">
                   <span class="btn btn-flat btn-small disabled no-padding-left">
                       <i class="fa fa-2x fa-at left"></i>
                       {{ $contato['email'] }}
                   </span>
               </div>
               <div class="col m4 s6 no-padding-left tooltipped" data-position="top" data-tooltip="CPF">
                   <span class="btn btn-flat btn-small disabled no-padding-left">
                       <i class="fa fa-2x fa-id-card left"></i>
                       {{ $formatar($contato['cpf_cnpj'], 'cpfcnpj') }}
                   </span>
               </div>
               <div class="col m4 s6 no-padding-left tooltipped" data-position="top" data-tooltip="Celular">
                   <span class="btn btn-flat btn-small disabled no-padding-left">
                       <i class="fa fa-2x fa-phone left"></i>
                       {{ $formatar($contato['celular'], 'telefone') }}
                   </span>
               </div>
           </div>
       </div>
   </div>
