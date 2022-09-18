<?php

function is_administrator()
{
    $ci = get_instance();
    $access = $ci->session->userdata('userAccess');
    $status = false;

    if (in_array("Administrator", $access)) {
        $status = true;
    }

    return $status;
}

function is_project_manager()
{
    $ci = get_instance();
    $access = $ci->session->userdata('userAccess');
    $status = false;

    if (in_array("Project Manager", $access)) {
        $status = true;
    }

    return $status;
}

function is_finance()
{
    $ci = get_instance();
    $access = $ci->session->userdata('userAccess');
    $status = false;

    if (in_array("Finance", $access)) {
        $status = true;
    }

    return $status;
}

function is_pengawas_lapangan()
{
    $ci = get_instance();
    $access = $ci->session->userdata('userAccess');
    $status = false;

    if (in_array("Pengawas Lapangan", $access)) {
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

function badge_status($status)
{
    $class = '';
    switch ($status) {
        case 'PENDING':
            $class = "badge badge-warning";
            break;
        case 'APPROVED':
            $class = "badge badge-success";
            break;
        case 'ON GOING':
            $class = "badge badge-info";
            break;
        case 'COMPLETED':
            $class = "badge badge-success";
            break;
        case 'REJECTED':
            $class = "badge badge-danger";
            break;
        default:
            $class = "";
            break;
    }

    return '<span class="'.$class.'">'.$status.'</span>';
}

function output_json($data)
{
    $ci = get_instance();
    $data = json_encode($data);
    $ci->output->set_content_type('application/json')->set_output($data);
}
