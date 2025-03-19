   <div>
       <div class="collection-item avatar" href="#!">
           <a href="{{ $contato['imagem'] ? $getImagem($contato['imagem'], 'contatos') : asset('assets/img/usuario.png') }}"
               data-fancybox="gallery_{{ $contato['id'] }}" data-caption="{{ $contato['name'] }}" class="circle left">
               <div class="quadrado"
                   style="background-image: url({{ $contato['imagem'] ? $getImagem($contato['imagem'], 'contatos') : asset('assets/img/usuario.png') }})">
               </div>
           </a>
           <a href="#!" class="dropdown-trigger title black-text darken-4"
               data-target="dropdown{{ $contato['id'] }}">
               {{ $contato['name'] }}
           </a>

           <ul id="dropdown{{ $contato['id'] }}" class='dropdown-content' data-beloworigin='true'>
               <li>
                   <a href="{{ route('detalhar-contato', ['id' => $encrypt($contato['id'])]) }}">
                       Editar
                   </a>
               </li>
               <li>
                   <a href="#!"
                       onclick="discar('{{ $contato['name'] }}', '{{ $contato['celular'] }}', '{{ $contato['email'] }}')">
                       Chamar contato
                   </a>
               </li>
               @if ($contato['latitude'] && $contato['longitude'])
                   <li>
                       <a href="#!"
                           onclick="centralizar('{{ $contato['latitude'] }}', '{{ $contato['longitude'] }}', '{{ $contato['name'] }}')">
                           Mostrar no mapa
                       </a>
                   </li>
                   <li>
                       <a href="#!"
                           onclick="abrirMaps('{{ $contato['latitude'] }}', '{{ $contato['longitude'] }}')">
                           Abrir no Google Maps
                       </a>
                   </li>
               @endif
           </ul>

           <div class="row no-margin dados-adicionais">
               <div class="col m9 s12 no-padding-left tooltipped" data-position="top" data-tooltip="E-mail">
                   <span class="btn btn-flat btn-small disabled no-padding-left">
                       <i class="fa fa-2x fa-at left"></i>
                       {{ $contato['email'] }}
                   </span>
               </div>

               @if ($contato['distancia'] != 0.0)
                   <div class="col m3 s12 no-padding-left tooltipped" data-position="top"
                       data-tooltip="Distância de você">
                       <a href="#!"
                           onclick="centralizar('{{ $contato['latitude'] }}', '{{ $contato['longitude'] }}', '{{ $contato['name'] }}')"
                           class="btn btn-flat btn-small disabled no-padding-left">
                           <i class="fa fa-2x fa-location-pin left"></i>
                           {{ $contato['distancia'] != 0.0 ? $contato['distancia'] . ' km' : '' }}
                       </a>
                   </div>
               @endif
               <div class="col m6 s12 no-padding-left tooltipped" data-position="top" data-tooltip="CPF">
                   <span class="btn btn-flat btn-small disabled no-padding-left">
                       <i class="fa fa-2x fa-id-card left"></i>
                       {{ $formatar($contato['cpf_cnpj'], 'cpfcnpj') }}
                   </span>
               </div>
               <div class="col m6 s12 no-padding-left tooltipped" data-position="top" data-tooltip="Celular">
                   <a href="#!" onclick="discar('{{ $contato['celular'] }}')"
                       class="btn btn-flat btn-small disabled no-padding-left">
                       <i class="fa fa-2x fa-phone left"></i>
                       {{ $formatar($contato['celular'], 'telefone') }}
                   </a>
               </div>
           </div>
       </div>
   </div>
