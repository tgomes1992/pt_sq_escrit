@extends("layouts.masterlayout")


@section('content')
   
<form action="#">
  <label for="filtropapelcota">FILTRAR</label>

  <input type="text" class="filtropapelcota" id="filtropapelcota" />
  <button type="submit">Baixar Arquivo</button>

</form>

<h1>Fundos Jcot</h1>

<p>Exibe o Papel Cota no JCOT e a sua respectiva data no sistema de Passivo</p>

<table>

<th>
    <tr>
        <td> Codigo </td>
        <td> Nome </td>
        <td> Administrador </td>
        <td> Tipo Fundo </td>
    </tr>

    </th>
        @foreach ($fundos as $fundo)
        <tr class="detalhes">
            <td>{{ $fundo['codigo'] }}</td>
            <td>{{ $fundo['razaoSocial'] }}</td>
            <td>{{ $fundo['administrador'] }}</td>
            <td>{{ $fundo['tipoFundo'] }}</td>
        </tr>
        @endforeach


</table>


<script src="app.js"></script>

@endsection

