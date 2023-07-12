<?php
session_start();
include '../../config.php';

verificaAcesso();

// Verificar a quantidade de vídeos armazenados
$sqlCount = "SELECT COUNT(*) as total FROM videos";
$totalVideos = retornaDados($sqlCount)[0]['total'];
$limiteVideos = 5; // Limite máximo de vídeos permitidos

// Verificar se o limite de vídeos foi atingido
$excedeuLimite = $totalVideos >= $limiteVideos;
?>

<!DOCTYPE html>
<html lang="pt-br">

<?php include_once path('template/head.php'); ?>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include_once path('template/sidebar.php'); ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include_once path('template/navbar.php'); ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Content Row -->
                    <div class="row">

                        <div class="col-12 mb-4">

                            <!-- Illustrations -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Cadastro de vídeos</h6>
                                </div>
                                <div class="card-body">
                                    <?php if ($excedeuLimite) : ?>
                                        <div class="alert alert-warning" role="alert">
                                            Você atingiu o limite máximo de vídeos armazenados (<?= $limiteVideos ?>). Para adicionar mais vídeos, você precisa apagar algum vídeo existente.
                                        </div>
                                    <?php endif; ?>

                                    <div class="text-right mb-3">
                                        <a class="btn btn-primary" href="inserir.php">Inserir</a>
                                    </div>

                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr class="thead-dark">
                                                <th>#</th>
                                                <th>Nome</th>
                                                <th>Sobre</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $pdo = Banco::conectar();
                                            $sql = 'SELECT * FROM videos';

                                            foreach ($pdo->query($sql) as $row) { ?>
                                                <tr>
                                                    <th scope="row"><?= $row['id'] ?></th>
                                                    <td><?= $row['nome'] ?></td>
                                                    <td><?= $row['sobre'] ?></td>
                                                    <td width='250' class="text-center">
                                                        <a class="btn btn-sm btn-primary" href="visualizar.php?id=<?= $row['id'] ?>">Ver</a>
                                                    </td>
                                                </tr>
                                            <?php }

                                            Banco::desconectar();
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.container-fluid -->
                </div>
                <!-- End of Main Content -->

                <!-- Footer -->
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Academia Araçatubense De Letras &copy; 2022</span>
                        </div>
                    </div>
                </footer>
                <!-- End of Footer -->

            </div>
            <!-- End of Content Wrapper -->

        </div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Logout Modal-->
        <?php include path('template/logout.php'); ?>

        <?php include path('template/importacoes-js.php'); ?>
</body>

</html>
