<div class="container-fluid py-5 row">



    <form class="col-md-6 col-sm-12 mx-auto" action="?a=create_user" method="POST">
        <?php require (APP_DOCUMENT_ROOT . '/core/views/components/alert.php'); ?>

        <h5>Criar usuário</h5>

        <div class="mb-3">

            <!-- Text inputs -->
            <div class="mb-3">
                <label for="exampleInputName" class="form-label">Nome</label>
                <input required name="name" type="text" class="input-name form-control" id="exampleInputName" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email</label>
                <input required name="email" type="email" class="input-email form-control" id="exampleInputEmail1"
                    aria-describedby="emailHelp">
            </div>



         <!-- Inputs checks -->
            <div class=" form-check">
                <input name="Blue" type="checkbox" class="form-check-input" id="blueCheck">
                <label class="form-check-label" for="blueCheck">
                    <span class="badge text-bg-primary">Azul</span>
                </label>
            </div>
            <div class="form-check">
                <input name="Red" class="form-check-input" type="checkbox" id="redCheck">
                <label class="form-check-label" for="redCheck">
                    <span class="badge text-bg-danger">Vermelho</span>
                </label>
            </div>
            <div class="form-check">
                <input name="Yellow" class="form-check-input" type="checkbox" id="yellowCheck">
                <span class="badge text-bg-warning">Amarelo</span>
            </div>
            <div class="form-check">
                <input name="Green" class="form-check-input" type="checkbox" id="greenCheck">
                <span class="badge text-bg-success">Verde</span>
            </div>

            <button type="submit" class="btn btn-success mt-3">Criar</button>
        </div>


    </form>


</div>