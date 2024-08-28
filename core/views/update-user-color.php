<!-- User list -->
<div class="container py-5 row">




    <div class="col-md-6 col-sm-12 mx-auto border border-1 rounded shadow-sm p-3">

    <?php require (APP_DOCUMENT_ROOT . '/core/views/components/alert.php'); ?>

        <h5 class="mb-3">Informações do usuário</h5>

        <?php foreach ($data['users'] as $user): ?>
            <p class="m-0 my-1">Nome: <span class="fw-bold"><?= htmlspecialchars($user['name']); ?></span> </p>
            <p class="m-0 my-1">Email: <span class="fw-bold"><?= htmlspecialchars($user['email']); ?> </span></p>
        <?php endforeach ?>



        <h5 class="my-3 mb-2    ">Vincular cores</h5>

        <form action="?a=update-user-color/<?= $data['users'][0]['id'] ?>" method="POST">

            <?php foreach ($data['colors'] as $color): ?>

                <div class=" form-check">

                    <input name="<?= $color['color'] ?>" <?= $color['checked'] === true ? 'checked' : '' ?> type="checkbox"
                        class="form-check-input" id="blueCheck">

                    <label class="form-check-label" for="blueCheck">
                        <span class="badge text-bg-<?= $color['bg_color'] ?>"><?= $color['color'] ?> </span>
                    </label>

                </div>

            <?php endforeach ?>
            <div class="d-flex justify-content-between align-items-center mt-4  m-0 p-0">

                <a href="?a=listar-usuarios" class="btn btn-light border border-1 shadow-sm btn-sm">Voltar</a>
                <button type="submit" class="btn btn-success btn-sm ">Vincular</button>
            </div>
        </form>


    </div>

</div>