<!-- User list -->
<div style="min-height: 100vh" class="container py-5">


    <?php require(APP_DOCUMENT_ROOT . '/core/views/components/alert.php'); ?>

    <div class="d-flex justify-content-between">
        <h5>Lista de usuários</h5>
        <a href="?a=criar-usuario" class="btn btn-success btn-sm">Criar usuário</a>
    </div>

    <?php if (!empty($data)): ?>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Email</th>
                    <th scope="col">Cores</th>

                </tr>
            </thead>
            <tbody>

                <?php foreach ($data as $user): ?>

                    <tr>
                        <th scope="row"><?= $user['id']; ?> </th>
                        <td><?= $user['name']; ?> </td>
                        <td><?= $user['email']; ?> </td>

                        <td style="width:100px;">

                            <div class=" d-flex w-100 pt-2 align-items-center gap-1">

                                <?php foreach ($user['colors'] as $user_color): ?>

                                    <?php if ($user_color === 'Blue'): ?>
                                        <span id="azul" class="badge-color badge text-bg-primary">Azul</span>
                                    <?php elseif ($user_color === 'Red'): ?>
                                        <span id="vermelho" class="badge-color badge text-bg-danger">Vermelho</span>
                                    <?php elseif ($user_color === 'Yellow'): ?>
                                        <span id="amarelo" class="badge-color badge text-bg-warning">Amarelo</span>
                                    <?php elseif ($user_color === 'Green'): ?>
                                        <span id="verde" class="badge-color badge text-bg-success">Verde</span>
                                    <?php endif ?>

                                <?php endforeach ?>
                            </div>


                        </td>

                        <td class="d-flex gap-2">

                            <!-- Ver -->
                            <a href="?a=informacoes-usuario/<?= $user['id']; ?>"
                                class="btn btn-success border border-1  shadow-sm btn-sm d-flex align-items-center gap-1">

                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-search" viewBox="0 0 16 16">
                                    <path
                                        d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                                </svg>
                                Ver
                            </a>


                        </td>

                    </tr>

                <?php endforeach ?>

            </tbody>
        </table>
    <?php else: ?>
        <p>Ainda não há usuários cadastrados</p>
    <?php endif ?>




</div>