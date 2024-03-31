<?php
$action = array_key_exists('action', $_GET) ? $_GET['action'] : 'home';

switch($action) {
    case 'home':
        include './views/home.php';
        break;
    case 'agents':
        include './views/agents.php';
        break;
    case 'patient':
        if(!empty($_GET['id'])) {
            $id = $_GET['id'];
            
            $patient = getOnePatient($id);
            if($patient instanceof StdClass) {
                $data = getPatientData($patient->id_inter_sys);
                include './views/patient.php';
                break;
            }
        }
    case 'patients':
        include './views/patients.php';
        break;
    case 'transfert':
        include './views/transfert.php';
        break;
    default:
        include './views/home.php';
        break;
        
}