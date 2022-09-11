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

function currency($num)
{
    $data = 'Rp. '.number_format($num, 0, ',', '.');
    return $data;
}

function output_json($data)
{
    $ci = get_instance();
    $data = json_encode($data);
    $ci->output->set_content_type('application/json')->set_output($data);
}
