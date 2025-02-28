@inject('funcoes', 'App\Services\Funcoes')

<select id="{{ $id }}" name="{{ $name }}">
    <option value="" selected >Selecione uma opção</option>
    <option value="AC" {{ $funcoes->setSelected($objeto, $atributo, 'AC', $old_value) }}>Acre</option>
    <option value="AL" {{ $funcoes->setSelected($objeto, $atributo, 'AL', $old_value) }}>Alagoas</option>
    <option value="AP" {{ $funcoes->setSelected($objeto, $atributo, 'AP', $old_value) }}>Amapá</option>
    <option value="AM" {{ $funcoes->setSelected($objeto, $atributo, 'AM', $old_value) }}>Amazonas</option>
    <option value="BA" {{ $funcoes->setSelected($objeto, $atributo, 'BA', $old_value) }}>Bahia</option>
    <option value="CE" {{ $funcoes->setSelected($objeto, $atributo, 'CE', $old_value) }}>Ceará</option>
    <option value="DF" {{ $funcoes->setSelected($objeto, $atributo, 'DF', $old_value) }}>Distrito Federal</option>
    <option value="ES" {{ $funcoes->setSelected($objeto, $atributo, 'ES', $old_value) }}>Espírito Santo </option>
    <option value="GO" {{ $funcoes->setSelected($objeto, $atributo, 'GO', $old_value) }}>Goiás</option>
    <option value="MA" {{ $funcoes->setSelected($objeto, $atributo, 'MA', $old_value) }}>Maranhão</option>
    <option value="MT" {{ $funcoes->setSelected($objeto, $atributo, 'MT', $old_value) }}>Mato Grosso</option>
    <option value="MS" {{ $funcoes->setSelected($objeto, $atributo, 'MS', $old_value) }}>Mato Grosso do Sul</option>
    <option value="MG" {{ $funcoes->setSelected($objeto, $atributo, 'MG', $old_value) }}>Minas Gerais</option>
    <option value="PA" {{ $funcoes->setSelected($objeto, $atributo, 'PA', $old_value) }}>Pará</option>
    <option value="PB" {{ $funcoes->setSelected($objeto, $atributo, 'PB', $old_value) }}>Paraíba</option>
    <option value="PR" {{ $funcoes->setSelected($objeto, $atributo, 'PR', $old_value) }}>Paraná</option>
    <option value="PE" {{ $funcoes->setSelected($objeto, $atributo, 'PE', $old_value) }}>Pernambuco</option>
    <option value="PI" {{ $funcoes->setSelected($objeto, $atributo, 'PI', $old_value) }}>Piauí</option>
    <option value="RJ" {{ $funcoes->setSelected($objeto, $atributo, 'RJ', $old_value) }}>Rio de Janeiro</option>
    <option value="RN" {{ $funcoes->setSelected($objeto, $atributo, 'RN', $old_value) }}>Rio Grande do Norte</option>
    <option value="RS" {{ $funcoes->setSelected($objeto, $atributo, 'RS', $old_value) }}>Rio Grande do Sul</option>
    <option value="RO" {{ $funcoes->setSelected($objeto, $atributo, 'RO', $old_value) }}>Rondônia</option>
    <option value="RR" {{ $funcoes->setSelected($objeto, $atributo, 'RR', $old_value) }}>Roraima</option>
    <option value="SC" {{ $funcoes->setSelected($objeto, $atributo, 'SC', $old_value) }}>Santa Catarina</option>
    <option value="SP" {{ $funcoes->setSelected($objeto, $atributo, 'SP', $old_value) }}>São Paulo</option>
    <option value="SE" {{ $funcoes->setSelected($objeto, $atributo, 'SE', $old_value) }}>Sergipe</option>
    <option value="TO" {{ $funcoes->setSelected($objeto, $atributo, 'TO', $old_value) }}>Tocantins</option>
    <option value="EX" {{ $funcoes->setSelected($objeto, $atributo, 'EX', $old_value) }}>Estrangeiro</option>
</select>
