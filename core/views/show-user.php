<!-- User list -->
<div style="min-height:100vh;" class="container py-5 row">

    <div class="col-md-6 col-sm-12 mx-auto">

        <div class="p-3 border border-1 rounded shadow-sm">
            <h5>Informações do usuario</h5>

            <?php foreach ($data as $user): ?>
                <p class="m-0 my-1">Nome: <span class="fw-bold"><?= htmlspecialchars($user['name']); ?></span> </p>
                <p class="m-0 my-1">Email: <span class="fw-bold"><?= htmlspecialchars($user['email']); ?> </span></p>

                <h5 class=" m-0 mt-3 mb-2">Cores vinculadas</h5>

                <?php foreach ($user['colors'] as $user_color): ?>
                    <?php if ($user_color === 'Blue'): ?>
                        <span class="badge text-bg-primary">Azul</span>
                    <?php elseif ($user_color === 'Red'): ?>
                        <span class="badge text-bg-danger">Vermelho</span>
                    <?php elseif ($user_color === 'Yellow'): ?>
                        <span class="badge text-bg-warning">Amarelo</span>
                    <?php elseif ($user_color === 'Green'): ?>
                        <span class="badge text-bg-success">Verde</span>
                    <?php endif ?>
                <?php endforeach ?>

                <!-- Actions btns -->
                <div class="d-flex mt-5 justify-content-between ">

                    <a href="?a=listar-usuarios" class="btn btn-light border border-1 shadow-sm btn-sm">Voltar</a>

                    <div class="d-flex justify-content-center gap-2">
                        <!-- Vincular cores -->
                        <a href="?a=editar-cor/<?= $user['id']; ?>"
                            class="btn btn-light border border-1 text-dark shadow-sm btn-sm d-flex align-items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-arrow-repeat" viewBox="0 0 16 16">
                                <path
                                    d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41m-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9" />
                                <path fill-rule="evenodd"
                                    d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5 5 0 0 0 8 3M3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9z" />
                            </svg>
                            Vincular cor
                        </a>

                        <!-- Editar -->
                        <a href="?a=editar-usuario/<?= $user['id']; ?>"
                            class="btn btn-light border border-1 text-dark shadow-sm btn-sm d-flex align-items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-pencil" viewBox="0 0 16 16">
                                <path
                                    d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325" />
                            </svg>
                            Editar
                        </a>
                        <!-- Excluir -->
                        <a href="?a=delete-user/<?= $user['id']; ?>"
                            class="btn-delete btn btn-light border border-1 text-dark shadow-sm btn-sm d-flex align-items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-trash3" viewBox="0 0 16 16">
                                <path
                                    d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5" />
                            </svg>
                            Excluir
                        </a>
                    </div>


                </div>
            <?php endforeach ?>


        </div>
    </div>


</div>