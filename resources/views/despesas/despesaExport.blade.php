<style>
    th {
        font-weight: bold;
    }
</style>

<table>
    <thead>
    <tr>
        <th width="20">DATA</th>
        <th width="10">VALOR</th>
        <th width="20">CONTA DEBITO</th>
        <th width="60">HISTRICO</th>
    </tr>
    </thead>
    <tbody>
    @foreach($despesas as $despesa)
        <tr>
            <td>{{ date('d/m/Y', strtotime($despesa->data_cadastro) ) }}</td>

            <td>{{ number_format($despesa->valor, 2, ',', '.')  }}</td>

            <td>{{ $despesa->tipo_despesa->planoConta->conta_contabil }}</td>

            <td>{{ $despesa->historico }}</td>

{{--            <td>{{ $despesa->tipo_despesa->descricao }}</td>--}}
        </tr>
    @endforeach
    </tbody>
</table>
