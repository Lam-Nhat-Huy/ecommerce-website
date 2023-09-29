<div class="container-fluid mt-5 mb-5">
    <div class="d-flex justify-content-center row">

        <div class="d-flex flex-column col-md-8">
            <div class="coment-bottom bg-white p-2 px-4">

                <div class="d-flex flex-row add-comment-section mt-4 mb-4"><img class="img-fluid img-responsive rounded-circle mr-2" src="../../../admin/upload/avt.jpg" width="38">
                    <form action="./index.php?pages=execution-4" method="post" class="d-flex">

                        <?php
                        getIdHidden();
                        ?>

                        <input type="text" name="comments" class="form-control mr-3">
                        <button class="btn btn-primary" name="comment" type="submit">Comment</button>
                    </form>
                </div>

                <?php
                commentView()
                ?>
            </div>


        </div>
    </div>
</div>
</div>