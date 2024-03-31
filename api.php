<?php
session_start();

include_once 'functions.php';

if(!empty($_GET['id'])) {
    $id = $_GET['id'];

    $patient = getOnePatient($id);
    if($patient instanceof StdClass) {
        $result = getAllConsultByPatientId($patient->id_inter_sys);
        $consultations = [];
        foreach($result as $consultation) {
            $consultation['prescriptions'] = getAllPrescriptByConsultId($consultation['id_inter_sys']);
            $consultations[] = $consultation;
        }

        $result = [
            'status' => 'sucess',
            'data' => [
                'patient' => $patient,
                'consultations' => $consultations
                ]
            ];
        
        echo json_encode($result);
    }
} else {
    // header('status: 503');
    $result = [
        'status' => 'faillure',
        'message' => 'Bad Request'
    ];

    echo json_encode($result);
}

?>