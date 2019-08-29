<!DOCTYPE html>
<html lang="en">

<head>

    <?php $this->load->view("admin/_partials/head.php"); ?>

</head>

<body class="hold-transition skin-blue sidebar-mini">
    <?php $this->load->view("admin/_partials/topbar/topbar.php") ?>
    <div class="wrapper">
        <?php $this->load->view('admin/_partials/sidebar/sidebar.php'); ?>

        <div class="content-wrapper">
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header">
                                <h3><?= $this->session->flashdata('success'); ?></h3>
                                <h3 class="box-title">View Tabel Data Event</h3>
                            </div>
                            <div class="box-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Judul Event</th>
                                            <th>Isi_Event</th>
                                            <th>Foto</th>
                                            <th>Tanggal Mulai</th>
                                            <th>Tanggal Selesai</th>
                                            <th>Dusun</th>
                                            <th>RT</th>
                                            <th>RW</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($event as $ev) : ?>
                                        <tr>
                                            <th><?= $ev->judul_event ?></th>
                                            <th><?= $ev->isi_event ?></th>
                                            <th><?= $ev->foto ?></th>
                                            <th><?= $ev->tanggal_mulai ?></th>
                                            <th><?= $ev->Tanggal_selesai ?></th>
                                            <th><?= $ev->dusun ?></th>
                                            <th><?= $ev->rt ?></th>
                                            <th>
                                                <a onclick="deleteConfirm" href="<?php echo site_url('admin/Datapengguna/hapus/' . $pengguna->id_pengguna) ?>" class="btn btn-small text-danger"><i class="fa fa-trash"></i> Hapus</a>
                                            </th>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
            </section>
        </div>




        <?php $this->load->view("admin/_partials/footer/footer.php"); ?>
    </div>

    <?php $this->load->view("admin/_partials/footer/js.php"); ?>