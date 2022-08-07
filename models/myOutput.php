  <!----- MODAL OUTPUT ----->
  <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <div id="outputTable" >
                            <table class="table table-dark table-hover">
                                <button type="button" style="background-color: #ffffff00!important" class=" modal-header btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                <tr>
                                    <th>NAME IN LTU</th>
                                    <th>NAME IN LOT</th>
                                    <th>IS IT A TREE?</th>
                                    <th>AGE</th>
                                    <th>HEIGHT</th>
                                    <th>EDIT</th>
                                    <th>DELETE</th>
                                </tr>
                                <?php 
                                foreach ($users as $user) { ?>
                                    <tr>
                                        <td><?= $user->name ?></td>
                                        <td><?= $user->surname ?></td>
                                        <td><?= $user->bool == 1 ? "TREE" : " SOMETHING ELSE"?></td>
                                        <td><?= $user->age ?></td>
                                        <td><?= $user->height ?></td>
                                        <td>
                                            <form action="" method="post">
                                                <input type="hidden" name="id" value="<?= $user->id ?>">
                                                <button type="submit" class="btn btn-success" name="edit" value=" <?= $user->id ?> "> edit</button>
                                            </form>
                                        </td>
                                        <td>
                                            <form action="" method="post">
                                                <input type="hidden" name="id" value="<?= $user->id ?>">
                                                <button type="submit" class="btn btn-danger" name="destroy">delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>