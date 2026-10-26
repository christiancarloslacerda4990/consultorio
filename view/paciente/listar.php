```php
<?php
use App\Paciente;

include('../includes/cabecalho.php');
include('../includes/menu.php');

$pacientes = Paciente::listar();

// Ordena os pacientes pelo nome em ordem alfabética
usort($pacientes, function ($a, $b) {
    return strcasecmp($a->nome, $b->nome);
});
?>

<main class="container">
    <h1 class="text-center">Lista de Pacientes</h1>

    <div class="text-end my-2">
        <a href="novo.php" class="btn btn-success">Novo Paciente</a>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover">
            <thead class="table-dark">
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
                <?php if (!empty($pacientes)): ?>
                    <?php foreach ($pacientes as $paciente): ?>
                        <tr>
                            <td><?= htmlspecialchars($paciente->nome ?? '', ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= htmlspecialchars($paciente->cpf ?? '', ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= htmlspecialchars($paciente->data_nascimento ?? '', ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= htmlspecialchars($paciente->telefone ?? '', ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= htmlspecialchars($paciente->email ?? '', ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= htmlspecialchars($paciente->endereco ?? '', ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= htmlspecialchars($paciente->convenio ?? '', ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= htmlspecialchars($paciente->observacao ?? '', ENT_QUOTES, 'UTF-8') ?></td>

                            <td>
                                <a
                                    href="editar.php?id=<?= (int) $paciente->id ?>"
                                    class="btn btn-primary btn-sm"
                                >
                                    Editar
                                </a>

                                <a
                                    href="/consultorio/action/action_paciente.php?action=excluir&id=<?= (int) $paciente->id ?>"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Deseja realmente excluir este paciente?')"
                                >
                                    Excluir
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="9" class="text-center">
                            Nenhum paciente cadastrado.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="pb-5"></div>
</main>

<?php include('../includes/rodape.php'); ?>
```