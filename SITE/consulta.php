<?php
    include "conn/conection.php";
    include "admin/acesso_com.php";

    $profissional_id = $_POST['profissional_id'] ?? 0;

    $agendamento = $conn->query("SELECT * FROM tipo_agendamento");
    $profissional = $conn->query("SELECT * FROM usuarios WHERE cargo_id = 3");

    // Busca os dias disponíveis com base no profissional escolhido
    $diasDisponiveis = $conn->query("SELECT dia FROM escala WHERE disponivel = 1");

    $datasDisponiveis = [];
    if($diasDisponiveis->num_rows > 0){
        while($row = $diasDisponiveis->fetch_assoc()){
            $datasDisponiveis[] = $row['dia'];
        }
    }

    $datas_json = json_encode($datasDisponiveis);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/cadastroStyle.css">
    <link rel="icon" href="images/IconSemNome.png" type="image/png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <title>PSICOMIND - Agendamento</title>
</head>
<body>

    <?php include "menu.php"?>

    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="row border rounded-5 p-4 bg-white shadow box-area">
            <div class="col-md-12 right-box">
                <div class="header-text mb-4">
                    <h1>Agendamento de Consulta</h1>
                </div>
                <form action="consulta.php" method="POST">
                    <div class="row mb-3">
                        <div class="col-md-6 mb-4">
                            <label style="color: var(--cor-primaria);" for="tipo_agendamento">Tipo de Agendamento</label>
                            <select id="tipo_agendamento" name="tipo_agendamento_id" class="form-select form-select-lg bg-light fs-6">
                                <option selected disabled>Selecione o tipo de consulta</option>
                                <?php while ($tipoAgendamento = $agendamento->fetch_assoc()) { ?>
                                    <option value="<?php echo $tipoAgendamento['id']; ?>"><?php echo $tipoAgendamento['tipo_agendamento']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-6 mb-4">
                            <label style="color: var(--cor-primaria);" for="profissional_id">Profissional</label>
                            <select name="profissional_id" id="profissional_id" class="form-select form-select-lg bg-light fs-6">
                                <option selected disabled>Selecione o profissional</option>
                                <?php while ($profissionalLista = $profissional->fetch_assoc()) { ?>
                                    <option value="<?php echo $profissionalLista['id']; ?>"><?php echo $profissionalLista['nome']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-6 mb-4">
                            <label style="color: var(--cor-primaria);" for="data_agendamento">Data</label>
                            <input type="text" id="data_agendamento" name="data_agendamento" class="form-control">
                        </div>
                        <div class="col-md-6 mb-4 d-flex align-items-end justify-content-end">
                            <input type="submit" value="Consultar Horários" class="btn btn-primary">
                        </div>

                        <div class="col-md-12 mb-4">
                            <label style="color: var(--cor-primaria);" for="horarios">Horários</label>
                            <select name="horario_id" id="horarios" class="form-select form-select-lg bg-light fs-6">
                                <option selected disabled>Selecione o Horário</option>
                                <!-- Preencha com os horários disponíveis após a seleção da data -->
                            </select>
                        </div>

                        <div class="col-md-12 mb-4 d-flex align-items-end justify-content-end">
                            <input type="submit" value="Continuar Agendamento" class="btn btn-primary">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener("DOMContentLoaded", function() {
        // Receba as datas disponíveis do PHP
        const datasDisponiveis = <?php echo $datas_json; ?>;

        // Função para formatar a data no padrão YYYY-MM-DD
        const formatDate = (date) => {
            let d = new Date(date);
            let month = '' + (d.getMonth() + 1);
            let day = '' + d.getDate();
            let year = d.getFullYear();

            if (month.length < 2) month = '0' + month;
            if (day.length < 2) day = '0' + day;

            return [year, month, day].join('-');
        };

        const availableDates = datasDisponiveis.map(date => formatDate(date));

        // Inicialize o Flatpickr
        flatpickr("#data_agendamento", {
            dateFormat: "Y-m-d",
            disable: [
                function(date) {
                    // Habilite apenas as datas disponíveis
                    return !availableDates.includes(formatDate(date));
                }
            ],
            onDayCreate: function(dObj, dStr, fp, dayElem) {
                // Destaca as datas disponíveis
                if (availableDates.includes(dayElem.dateObj.toISOString().split('T')[0])) {
                    dayElem.style.backgroundColor = "lightgreen";
                    dayElem.style.color = "black";
                }
            }
        });
    });
</script>

</body>
</html>
