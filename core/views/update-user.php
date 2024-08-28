<!-- User list -->
<div style="min-height:100vh;" class="container py-5 row">

    <div class="col-md-6 col-sm-12 mx-auto">

        <div class="p-3 pb-0 border border-1 rounded shadow-sm">


            <?php foreach ($data['user'] as $user): ?>

                <form action="?a=update-user/<?=$user['id']?>" method="POST">

                    <?php require(APP_DOCUMENT_ROOT . '/core/views/components/alert.php'); ?>

                    <h5>Editar usuário</h5>

                    <div class="mb-3">

                        <!-- Name -->
                        <div class="mb-3">
                            <label for="exampleInputName" class="form-label">Nome</label>
                            <input required value="<?= $user['name'] ?>" name="name" type="text" class="input-name form-control"
                                id="exampleInputName" aria-describedby="emailHelp">
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email</label>
                            <input  requiredvalue="<?= $user['email'] ?>" name="email" type="email" class="input-email form-control"
                                id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>


                        <!-- Colors -->
                        <p class="m-0 mb-1 mt-3">Cores vinculadas:</p>

                        <?php foreach ($data['colors'] as $color): ?>

                            <div class=" form-check">

                                <input name="<?= $color['color'] ?>" <?= $color['checked'] === true ? 'checked' : '' ?>
                                    type="checkbox" class="form-check-input" id="blueCheck">

                                <label class="form-check-label" for="blueCheck">
                                    <span class="badge text-bg-<?= $color['bg_color'] ?>"><?= $color['color'] ?> </span>
                                </label>

                            </div>

                        <?php endforeach ?>



                        <div class="d-flex justify-content-between align-items-center mt-4  m-0 p-0">

                            <a href="?a=listar-usuarios" class="btn btn-light border border-1 shadow-sm btn-sm">Voltar</a>
                            <button type="submit" class="btn btn-success btn-sm ">Editar</button>

                        </div>


                    </div>


                </form>

            <?php endforeach ?>



        </div>
    </div>


</div>