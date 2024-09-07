<?php

$signos = simplexml_load_file("signos.xml");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dataNascimento = $_POST['dataNascimento'];

    // Validação básica da data de nascimento (opcional)
    if (!preg_match('/^\d{2}\/\d{2}\/\d{4}$/', $dataNascimento)) {
        echo "<div class='alert alert-danger mt-4' role='alert'>Formato de data inválido. Use o formato dd/mm/aaaa.</div>";
    } else {
        $signo = descobrirSigno($dataNascimento);
        echo "<div class='alert alert-info mt-4' role='alert'>Seu signo é: <strong>$signo</strong></div>";
    }
}


function descobrirSigno($dataNascimento) {
    global $signos;

    $data = DateTime::createFromFormat('d/m/Y', $dataNascimento);
    if (!$data) {
        return "Data de nascimento inválida";
    }

    $dia = $data->format('d');
    $mes = $data->format('m');

    foreach ($signos->signo as $signo) {
        $dataInicio = DateTime::createFromFormat('d/m/Y', $signo->dataInicio . '/' . $data->format('Y'));
        $dataFim = DateTime::createFromFormat('d/m/Y', $signo->dataFim . '/' . $data->format('Y'));

        // Ajusta o ano da data final se o signo começar em um ano e terminar no próximo
        if ($dataInicio > $dataFim) {
            $dataFim->modify('+1 year');
        }

        if ($data >= $dataInicio && $data <= $dataFim) {
            return $signo->signoNome;
        }
    }

    return "Signo não encontrado"; 
}
?>