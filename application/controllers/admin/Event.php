<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Event extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_akses();
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->model('M_event');
        $this->load->helper('form');
    }

    public function index()
    {
        $data['pengguna'] = $this->db->get_where('pengguna', ['username' => $this->session->userdata('username')])->row_array();
        $data["event"] = $this->M_event->getAll();
        $data['judul'] = 'Tambah Event';
        $this->load->view('admin/event/tambahevent.php', $data);
    }

    public function addevent()
    {
        $event = $this->M_event;
        $validation = $this->form_validation;
        $validation->set_rules($event->rules());

        if ($validation->run()) {
            $event->save();
            $this->session->set_flashdata('success', '<div class="alert alert-success" role="alert">Data Berhasil Disimpan :)</div>');
            redirect('admin/Event/dataevent');
        } else {
            $this->session->set_flashdata('error', '<div class="alert alert-danger" role="alert">Data Gagal Disimpan!</div>');
            redirect('admin/Event');
        }

        $this->load->view("admin/event/tambahevent");
    }

    public function dataevent()
    {
        $data['pengguna'] = $this->db->get_where('pengguna', ['username' => $this->session->userdata('username')])->row_array();
        $data["event"] = $this->M_event->getAll();
        $data['judul'] = 'Data Event';
        $this->load->view('admin/event/dataevent', $data);
    }

    public function hapus($id_event = null)
    {
        if (!isset($id_event)) show_404($id_event);

        if ($this->M_event->delete($id_event)) {
            redirect(site_url('admin/Event/dataevent'));
        }
    }



    public function editevent($id_event = null)
    {
        if (!isset($id_event)) redirect('admin/Event/dataevent');

        $editevent = $this->M_event;
        $validation = $this->form_validation;
        $validation->set_rules($editevent->rules());

        if ($validation->run()) {
            $editevent->update();
            $this->session->set_flashdata('success', '<div class="alert alert-success" role="alert">Data Berhasil Disimpan :)</div>');
            redirect('admin/Event/dataevent');
        }

        $data['pengguna'] = $this->db->get_where('pengguna', ['username' => $this->session->userdata('username')])->row_array();
        $data['judul'] = 'Edit Event';
        $data["event"] = $editevent->getById($id_event);
        if (!$data["event"]) {
            show_404();
        }

        $this->load->view("admin/event/editevent", $data);
    }
    public function editan()
    {
        $event = $this->M_event;
        $event->update();
        $this->session->set_flashdata('success', '<div class="alert alert-success" role="alert">Data Berhasil Disimpan :)</div>');
        redirect('admin/Event/dataevent');
    }
}
