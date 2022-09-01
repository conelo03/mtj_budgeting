<?php

function is_admin()
{
    $ci = get_instance();
    $role = $ci->session->userdata('role');
    $roles = explode(",", $role);
    $status = false;

    if (in_array("Admin", $roles)) {
        $status = true;
    }

    return $status;
}

function is_owner()
{
    $ci = get_instance();
    $role = $ci->session->userdata('role');
    $roles = explode(",", $role);
    $status = false;

    if (in_array("Owner", $roles)) {
        $status = true;
    }

    return $status;
}

function set_pesan($pesan, $tipe = true)
{
    $ci = get_instance();
    if ($tipe) {
        $ci->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible show fade"><div class="alert-body"><button class="close" data-dismiss="alert"><span>&times;</span></button>'.$pesan.'</div></div>');
    } else {
        $ci->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible show fade"><div class="alert-body"><button class="close" data-dismiss="alert"><span>&times;</span></button>'.$pesan.'</div></div>');
    }
}

function status($status)
{
    $stat = '';
    switch ($status) {
        case 0:
            $stat = '<button class="btn btn-light">Belum Bayar</button>';
            break;
        case 1:
            $stat = '<button class="btn btn-warning">Sudah Bayar</button>';
            break;
        case 2:
            $stat = '<button class="btn btn-info">Proses Packing</button>';
            break;
        case 3:
            $stat = '<button class="btn btn-info">Proses Pengiriman</button>';
            break;
        case 4:
            $stat = '<button class="btn btn-success">Diterima</button>';
            break;
        default:
            $stat = 'Error';
            break;
    }

    return $stat;
}

function color_btn($status)
{
    $stat = '';
    switch ($status) {
        case 0:
            $stat = 'light';
            break;
        case 1:
            $stat = 'warning';
            break;
        case 2:
            $stat = 'info';
            break;
        case 3:
            $stat = 'danger';
            break;
        case 4:
            $stat = 'success';
            break;
        default:
            $stat = 'Error';
            break;
    }

    return $stat;
}

function output_json($data)
{
    $ci = get_instance();
    $data = json_encode($data);
    $ci->output->set_content_type('application/json')->set_output($data);
}
