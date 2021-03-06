<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Register extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_akses();
        $this->load->model("M_superuser");
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->helper('form');
    }

    public function index()
    {
        $data['pengguna'] = $this->db->get_where('pengguna', ['username' =>
        $this->session->userdata('username')])->row_array();
        $data['judul'] = 'SUPERUSER';





        $email = $this->db->get_where('pengguna', ['username' =>
        $this->session->userdata('username')]);
        $role_id = $this->db->get_where('pengguna', ['role_id' =>
        $this->session->userdata('role_id')]);

        $cek_id_akses3 = $this->M_superuser->cek_akses_3($email, $role_id);
        if ($cek_id_akses3 == 1) {
            $data['admin'] = $this->M_superuser->getUserId();
            $this->load->view("admin/superuser/new_form", $data);
        } else {
            $this->session->unset_userdata('email');
            $this->session->unset_userdata('role_id');

            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Kesalahan Tidak Di Ketahui</div>');
            redirect('user/Login');
        }
    }

    public function add()
    {
        $data['pengguna'] = $this->db->get_where('pengguna', ['username' =>
        $this->session->userdata('username')])->row_array();
        $data['judul'] = 'SUPERUSER';


        $admin = $this->M_superuser;
        $validation = $this->form_validation;
        $validation->set_rules($admin->rules());

        if ($validation->run()) {
            $admin->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }

        $this->load->view("admin/superuser/new_form", $data);
    }
    public function delete($id_pengguna = null)
    {
        if (!isset($id_pengguna)) show_404();

        if ($this->M_superuser->delete($id_pengguna)) {
            redirect(site_url('admin/register/'));
        }
    }
}
