
<?php

use App\Paciente;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('../includes/cabecalho.php');
require_once('../includes/menu.php');

$pacientes = Paciente::listar();

?>

<main class="container">

    <h1>Lista de Pacientes</h1>

    <!-- Botão para cadastrar um novo paciente -->
    <div class="mb-3">
        <a href="cadastrar.php" class="btn btn-success">
            + Adicionar Paciente
        </a>
    </div>

    <!-- Tabela de pacientes -->
    <table class="table table-striped table-bordered">

        <thead>
            <tr>
                <th>Nome</th>
                <th>CPF</th>
                <th>Data de Nascimento</th>
                <th>Telefone</th>
                <th>Email</th>
                <th>Endereço</th>
                <th>Convênio</th>
                <th>Observação</th>
                <th>Ações</th>
            </tr>
        </thead>

        <tbody>

            <?php if (!empty($pacientes)) { ?>

                <?php foreach ($pacientes as $paciente) { ?>

                    <tr>
                        <td>
                            <?= htmlspecialchars($paciente->nome ?? '') ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($paciente->cpf ?? '') ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($paciente->data_nascimento ?? '') ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($paciente->telefone ?? '') ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($paciente->email ?? '') ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($paciente->endereco ?? '') ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($paciente->convenio ?? '') ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($paciente->observacao ?? '') ?>
                        </td>

                        <td>
                            <a
                                href="editar.php?id=<?= (int) $paciente->id ?>"
                                class="btn btn-primary btn-sm">
                                Editar
                            </a>

                            <a
                                href="/consultorio/action/action_paciente.php?action=excluir&id=<?= (int) $paciente->id ?>"
                                class="btn btn-danger btn-sm"
                                onclick="return confirm('Deseja realmente excluir este paciente?')">
                                Excluir
                            </a>
                        </td>
                    </tr>

                <?php } ?>

            <?php } else { ?>

                <tr>
                    <td colspan="9" class="text-center">
                        Nenhum paciente cadastrado.
                    </td>
                </tr>

            <?php } ?>

        </tbody>

    </table>

    <div class="pb-5"></div>

</main>

<?php require_once('../includes/rodape.php'); ?>
