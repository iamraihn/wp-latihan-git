<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    // Konstruktor kelas Admin
    public function __construct()
    {
        parent::__construct();
        cek_login(); // Memeriksa apakah pengguna sudah login
    }

    // Fungsi untuk halaman utama (dashboard)
    public function index()
    {
        // Menyiapkan data untuk dikirim ke view
        $data['judul'] = 'Dashboard'; // Judul halaman
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array(); // Data pengguna yang sedang login
        $data['anggota'] = $this->ModelUser->getUserLimit()->result_array(); // Mengambil data anggota dengan batas tertentu
        $data['buku'] = $this->ModelBuku->getBuku()->result_array(); // Mengambil data buku

        // Memuat view dengan data yang sudah disiapkan
        $this->load->view('templates/header', $data); // Memuat header
        $this->load->view('templates/sidebar', $data); // Memuat sidebar
        $this->load->view('templates/topbar', $data); // Memuat topbar
        $this->load->view('admin/index', $data); // Memuat konten utama (dashboard)
        $this->load->view('templates/footer'); // Memuat footer
    }
}
?>
