<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
  function  __construct() {
    parent::__construct();
    $this->load->model('Dashboard_model','dashboard_model');
    $this->load->model('clickmaster','clickmaster');
    $this->data['isLogged'] = $this->session->userdata('isLogged');
    $this->data['email'] = $this->session->userdata('email');
    $this->data['fullName'] = $this->session->userdata('fullName');
    $this->data['ID'] = $this->session->userdata('ID');
    $this->data['approved'] = $this->session->userdata('approved');
    $this->data['clickM'] = $this->session->userdata('clickM');
    $this->data['role'] = $this->session->userdata('role');
    $this->data['lastSeen'] = $this->session->userdata('lastSeen');
    if ($this->data['role'] === 'user') {
      $this->data['user'] = $this->user->getUserById($this->data['ID']);
    }
  }

  public function index()
  {
    if($this->data['isLogged']){
      $cm = 0;
      if($this->data['role']=='user'){
        $this->data['screen_uploaded'] = $this->user->screenStat($this->session->userdata('ID'));
        $this->data['screenshot'] = $this->user->checkScreen($this->session->userdata('ID'));
        $this->data['contract_uploaded'] = $this->user->contStat($this->session->userdata('ID'));
        $cm = $this->data['clickM'];
        $this->data['videoLink'] = $this->config->item('videoTut');
        $this->data['settings'] = $this->dashboard_model->getSettings();
      }
      if($this->data['role']=='clickMaster'){
        $users = $this->dashboard_model->getCMusers($this->data['ID'], 3);
        $this->data['rawUsers'] = $this->dashboard_model->paginateUsers($users);
      }
      if($this->data['role']=='admin'){
        $this->data['cmlist'] = $this->dashboard_model->getCMs(-1);
        $users = $this->dashboard_model->getUsers(3);
        $this->data['rawUsers'] = $this->dashboard_model->paginateUsers($users);

      }

      $this->data['rawMails'] = $this->dashboard_model->getMails($this->data['role'],$this->data['ID'], $cm);
      $this->data['mails'] = json_encode($this->data['rawMails']);
      $nots = $this->dashboard_model->getNot($this->data['ID'], $this->data['role']);
      $this->data['nots'] = json_encode($nots);
      $this->data['cnots'] = count($nots);

      $this->data['pageSpan'] = 6;
      $this->data['pages'] = ceil(count($this->data['rawMails'])/$this->data['pageSpan']);
      $this->data['maxOffset'] = $this->data['pageSpan'] * ($this->data['pages']-1);
      $this->dashboard_model->setView();
      $this->data['lastSeen'] = $this->session->userdata('lastSeen');
      $this->load->view('dashboard', $this->data);
    }else{
      redirect(base_url('signup'));
    }
  }

  public function userlist()
  {
    if($this->data['isLogged']){
      if($this->data['role']!='user'){
        if($this->data['role']=='clickMaster'){
          $users = $this->dashboard_model->getCMusers($this->data['ID'], -1);
          $this->data['fixcode'] = 'style="display: none;"';
        }else{
          $users = $this->dashboard_model->getUsers(-1);
          $this->data['fixcode'] = '""';
        }
        $this->data['rawUsers'] = $this->dashboard_model->paginateUsers($users);

        $this->data["projects_classic"] = $this->dashboard_model->getProjectsClassic();
        $this->data["projects_sc"] = $this->dashboard_model->getProjectsSC();
        $this->data['users'] = json_encode($this->data['rawUsers']);
        $this->data['cnots'] = count($this->dashboard_model->getNot($this->data['ID'], $this->data['role']));
        $this->data['pageSpan'] = 30;
        $this->data['pages'] = ceil(count($users)/$this->data['pageSpan']);
        $this->data['maxOffset'] = $this->data['pageSpan'] * ($this->data['pages']-1);
        $this->load->view('userlist', $this->data);
      }else{
        redirect(base_url('dashboard'));
      }
    }else{
      redirect(base_url('signup'));
    }
  }

  public function profile()
  {
    if($this->data['isLogged']){
      if($this->data['role']=='user'){
        $this->data['cnots'] = count($this->dashboard_model->getNot($this->data['ID'], $this->data['role']));
        $this->data['user'] = $this->user->getUserById($this->data['ID']);
        $this->data['referral'] = $this->session->userdata('referral');
        $this->data['referredUsers'] = $this->user->getReferredUsers($this->data['ID']);
        $this->data['settings'] = $this->dashboard_model->getSettings();
        $this->load->view('profile', $this->data);
      }else{
        redirect(base_url('dashboard'));
      }
    }else{
      redirect(base_url('signup'));
    }
  }

  public function managecm()
  {
    if($this->data['isLogged']){
      if($this->data['role']=='admin'){
        $this->data['cMs'] = $this->getCMs();
        $this->data['cnots'] = count($this->dashboard_model->getNot($this->data['ID'], $this->data['role']));
        $this->load->view('managecm', $this->data);
      }else{
        redirect(base_url('dashboard'));
      }
    }else{
      redirect(base_url('signup'));
    }
  }

  public function screens()
  {
    if($this->data['isLogged']){
      if($this->data['role']!='user'){
        $this->data['cnots'] = count($this->dashboard_model->getNot($this->data['ID'], $this->data['role']));
        if($this->data['role']=='clickMaster'){
          $this->data['screens'] = $this->dashboard_model->paginateScreens($this->dashboard_model->getScreens($this->session->userdata('ID')));
        }else{
          $this->data['screens'] = $this->dashboard_model->paginateScreens($this->dashboard_model->getScreens(-1));
        }
        $this->data['pageSpan'] = 2;
        $this->data['pages'] = ceil(count($this->data['screens'])/$this->data['pageSpan']);
        $this->data['maxOffset'] = $this->data['pageSpan'] * ($this->data['pages']-1);
        $this->load->view('screens', $this->data);
      }else{
        redirect(base_url('signup'));
      }
    }else{
      redirect(base_url('signup'));
    }
  }

  public function codes($code = NULL)
  {
    if($this->data['isLogged']){
      if($this->data['role'] == 'admin'){
        $this->data['cnots'] = count($this->dashboard_model->getNot($this->data['ID'], $this->data['role']));
        $this->data["projects_classic"] = $this->dashboard_model->getProjectsClassic();
        $this->data["projects_sc"] = $this->dashboard_model->getProjectsSC();
        $this->data['notCodeUsers'] = $this->dashboard_model->get_users_no_code();
        $this->data['code'] = $code;

        $this->load->view('codes', $this->data);
      } else {
        redirect(base_url('signin'));
      }
    }else{
      redirect(base_url('signin'));
    }
  }

  public function settings()
  {
    if($this->data['isLogged']){
      if($this->data['role'] == 'admin'){
        $this->data['cnots'] = count($this->dashboard_model->getNot($this->data['ID'], $this->data['role']));

        $this->data['settings'] = $this->dashboard_model->getSettings();

        $this->load->view('admin_settings', $this->data);
      } else {
        redirect(base_url('signin'));
      }
    }else{
      redirect(base_url('signin'));
    }
  }

  public function projects()
  {
    if($this->data['isLogged']){
      if($this->data['role']=='admin'){
        $this->data['cnots'] = count($this->dashboard_model->getNot($this->data['ID'], $this->data['role']));

        $this->data["projects_classic"] = $this->dashboard_model->getProjectsClassic();
        $this->data["projects_sc"] = $this->dashboard_model->getProjectsSC();

        $this->load->view('projects', $this->data);
      }else{
        redirect(base_url('dashboard'));
      }
    }else{
      redirect(base_url('signup'));
    }
  }

  public function clickmaster($ID = NULL)
  {
    if($this->data['isLogged']) {
      if($this->data['role']=='admin'){
        if(isset($ID)){
          $this->data['cnots'] = count($this->dashboard_model->getNot($this->data['ID'], $this->data['role']));

          $this->data['users'] = $this->fetchUsersByCM($ID);
          $this->load->view('clickmaster', $this->data);
        }else{
          redirect(base_url('dashboard'));
        }
      }else{
        redirect(base_url('dashboard'));
      }
    } else {
      redirect(base_url('signup'));
    }
  }

  public function notify($code = NULL)
  {
    if($this->data['isLogged']){
      $this->index();
    }else{
      $this->data['emailN'] = urldecode($code);
      $this->load->view('index', $this->data);
    }
  }

  public function fillCodes()
  {
    if ($this->data['isLogged']) {
      if ($this->data['role'] == 'admin') {
        $this->user->genereateCodes();
      }
    }
  }
  ///////////////////////////////////////////////////////////

  public function unreadEval()
  {
    $unread = 0;
    if($this->session->userdata('role') == 'user') $cm = $this->session->userdata('clickM');
    else $cm = 0;
    $mails = $this->dashboard_model->getMails($this->session->userdata('role'),$this->session->userdata('ID'), $cm);
    if($this->session->userdata('lastSeen') == NULL){
      $unread = count($mails);
    }else{
      $lastS = intval(strtotime($this->session->userdata('lastSeen')));
      foreach($mails as $mail){
        if(intval(strtotime($mail['time'])) > $lastS) $unread++;
      }
    }
    return $unread;
  }

  public function sendmessage()
  {
    $oggetto = $this->input->post('oggetto');
    $testo = $this->input->post('testo');
    $type = $this->input->post('type');
    $destID = $this->input->post('destID');
    $parent = $this->input->post('parent');
    $id = $this->dashboard_model->sendmessage($oggetto, $testo, $this->data['ID'], $destID, $type, $parent);
    $this->dashboard_model->createNot($id, $type, $this->data['ID'], $destID, $oggetto, $testo);
    echo json_encode(TRUE);
  }

  public function getMessage()
  {
    $id = $this->input->post('id');
    $data = $this->dashboard_model->getMessage($id);
    $this->dashboard_model->deleteNot($data->ID, $this->data['ID'], $this->data['role']);
    if($data->parentID!=-1){
      $data->prec = $this->dashboard_model->getprecMessages($data->parentID, $data->destID, $data->mittID, $data->type, $data->ID);
      if(isset($data->prec))
        foreach($data->prec as &$precedent){
          $precedent['time'] = date('H:i:s d/m/Y', strtotime($precedent['time']));
          $precedent['mitt'] = $this->dashboard_model->getMittName($precedent['mittID'], $precedent['type']);
          $precedent['dest'] = $this->dashboard_model->getDestName($precedent['destID'], $precedent['type']);
          $this->dashboard_model->deleteNot($precedent['ID'], $this->data['ID'], $this->data['role']);
        }
      $data->mother = $this->dashboard_model->getMessage($data->parentID);
      $data->mother->mitt = $this->dashboard_model->getMittName($data->mother->mittID, $data->mother->type);
      $data->mother->dest = $this->dashboard_model->getDestName($data->mother->destID, $data->mother->type);
      $data->mother->time = date('H:i:s d/m/Y', strtotime($data->mother->time));
      $this->dashboard_model->deleteNot($data->mother->ID, $this->data['ID'], $this->data['role']);
    }
    $data->mitt = $this->dashboard_model->getMittName($data->mittID, $data->type);
    $data->dest = $this->dashboard_model->getDestName($data->destID, $data->type);
    $data->time = date('H:i:s d/m/Y', strtotime($data->time));
    //$data->mitt = $this->dashboard_model->getype($id);

    $data->nots = $this->dashboard_model->getNot($this->data['ID'], $this->data['role']);

    echo json_encode($data);
  }

  public function sentMessages()
  {
    $data['mails'] = $this->dashboard_model->getSentMessages($this->data['ID'], $this->data['role']);
    foreach($data['mails'] as &$mail){
      $mail['time'] = date('H:i:s d/m/Y', strtotime($mail['time']));
      $mail['mitt'] = $this->dashboard_model->getMittName($mail['mittID'], $mail['type']);
      $mail['dest'] = $this->dashboard_model->getDestName($mail['destID'], $mail['type']);
    }
    $data['pageSpan'] = 6;
    $data['pages'] = ceil(count($data['mails'])/$data['pageSpan']);
    $data['maxOffset'] = $data['pageSpan'] * ($data['pages']-1);
    echo json_encode($data);
  }

  public function receivedMessages()
  {
    $data['mails'] = $this->dashboard_model->getMails($this->data['role'], $this->data['ID'], 0);
    foreach($data['mails'] as &$mail){
      $mail['dest'] = $this->dashboard_model->getDestName($mail['destID'], $mail['type']);
    }
    $data['pageSpan'] = 6;
    $data['pages'] = ceil(count($data['mails'])/$data['pageSpan']);
    $data['maxOffset'] = $data['pageSpan'] * ($data['pages']-1);
    echo json_encode($data);
  }
  public function receivedMessagesCm()
  {
    $cmid = $this->input->post('id');
    $data['mails'] = $this->dashboard_model->getMailsCM($cmid);
    $data['pageSpan'] = 6;
    $data['pages'] = ceil(count($data['mails'])/$data['pageSpan']);
    $data['maxOffset'] = $data['pageSpan'] * ($data['pages']-1);
    echo json_encode($data);
  }

  public function addCM()
  {
    $usr = $this->input->post();

    $result = $this->clickmaster->createNewCm($usr);
    echo json_encode($result);
  }

  public function getUsersByCM()
  {
    $data['users'] = $this->dashboard_model->paginateUsers($this->dashboard_model->getCMusers($this->input->post('ID'), -1));
    $data['pageSpan'] = 3;
    $data['pages'] = ceil(count($data['users'])/$data['pageSpan']);
    $data['maxOffset'] = $data['pageSpan'] * ($data['pages']-1);
    echo json_encode($data);
  }

  function fetchUsersByCM($ID)
  {
    $data = $this->dashboard_model->paginateUsers($this->dashboard_model->getCMusers($ID, -1));
    return $data;
  }

  // Delete Cm by ID and then deletes its messages and codes
  public function deleteCm()
  {
    $ID = $this->input->post('ID');
    $data = $this->clickmaster->removeCm($ID);
    if(!$data){
      echo json_encode(FALSE);
    }else{
      $result = $this->dashboard_model->deleteMessages($ID, 'clickmaster');
      $result = $this->clickmaster->deleteCodes($ID);
      echo json_encode($result);
    }
  }

  public function deleteUser()
  {
    $data = $this->user->removeUsr($this->input->post('ID'));
    if(!$data){
      $this->output->set_status_header('500');
      echo json_encode(FALSE);
    }else{
      $this->dashboard_model->deleteMessages($this->input->post('ID'), 'user');
      echo json_encode(TRUE);
    }
  }

  public function editCm()
  {
    $usr = array(
      'fullName' => $this->input->post('fullName'),
      'email' => $this->input->post('email'),
      'codes' => $this->input->post('codes')
    );
    $ID = $this->input->post('ID');

    $data = $this->clickmaster->editCmInfo($usr, $ID);
    echo json_encode($data);
  }

  public function getCMs($dispatch = NULL)
  {
    $cMs = $this->dashboard_model->getCMs(-1);
    $data = array();
    foreach($cMs as $cM){
      $obj = array();
      $obj['ID'] = $cM->ID;
      $obj['fullName'] = $cM->fullName;
      $obj['email'] = $cM->email;
      $obj['codes'] = $this->clickmaster->getCMcodes($cM->ID);
      $users = $this->dashboard_model->getAssociatedUser($cM->ID);
      $obj['projRatio'] = count($users['proj']) . ' | '. count($users['noProj']);
      $obj['users'] = count($users['proj']) + count($users['noProj']);
      $data[] = $obj;
    }
    $data = json_encode($data);
    if (isset($dispatch)) {
      echo $data;
    } else {
      return $data;
    }
  }

  public function printList()
  {
    if($this->data['role']=='clickMaster'){
      $users = $this->dashboard_model->getCMusers($this->data['ID'], -1);
    }else{
      $users = $this->dashboard_model->getUsers(-1);
    }
    $this->load->library('excel');
    $this->excel->setActiveSheetIndex(0);
    $this->excel->getActiveSheet()->setTitle('Lista utenti');
    $users = $this->dashboard_model->prepareExcel($users);
    $this->excel->getActiveSheet()->getStyle('A1:L1')->getFont()->setBold(true);
    $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
    $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(22);
    $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(19);
    $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(19);
    $this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(24);
    $this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(18);
    $this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
    $this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('K')->setWidth(28);
    $this->excel->getActiveSheet()->getColumnDimension('L')->setWidth(15);
    $c = count($users);
    $this->excel->getActiveSheet()->getStyle("I1:I$c")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER);
    $this->excel->getActiveSheet()->fromArray($users);
    $filename = 'lista_utenti.xls';
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="'.$filename.'"');
    header('Cache-Control: max-age=0');
    $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
    $objWriter->save('php://output');
  }

  public function printWinnersList()
  {
    $users = $this->dashboard_model->getUsersBankOk();
    $this->load->library('excel');
    $this->excel->setActiveSheetIndex(0);
    $this->excel->getActiveSheet()->setTitle('Lista utenti');
    $users = $this->dashboard_model->prepareWinnersExcel($users);
    $this->excel->getActiveSheet()->getStyle('A1:W1')->getFont()->setBold(true);
    $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
    $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(22);
    $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(19);
    $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(19);
    $this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(24);
    $this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(18);
    $this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
    $this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('K')->setWidth(28);
    $this->excel->getActiveSheet()->getColumnDimension('L')->setWidth(15);
    $this->excel->getActiveSheet()->getColumnDimension('M')->setWidth(15);
    $this->excel->getActiveSheet()->getColumnDimension('N')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('O')->setWidth(32);
    $this->excel->getActiveSheet()->getColumnDimension('P')->setWidth(15);
    $this->excel->getActiveSheet()->getColumnDimension('Q')->setWidth(15);
    $this->excel->getActiveSheet()->getColumnDimension('R')->setWidth(15);
    $this->excel->getActiveSheet()->getColumnDimension('S')->setWidth(15);
    $this->excel->getActiveSheet()->getColumnDimension('T')->setWidth(25);
    $this->excel->getActiveSheet()->getColumnDimension('U')->setWidth(25);
    $this->excel->getActiveSheet()->getColumnDimension('V')->setWidth(32);
    $this->excel->getActiveSheet()->getColumnDimension('W')->setWidth(32);
    $c = count($users);
    $this->excel->getActiveSheet()->getStyle("I1:I$c")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER);
    $this->excel->getActiveSheet()->fromArray($users);
    $filename = 'lista_vincitori.xls';
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="'.$filename.'"');
    header('Cache-Control: max-age=0');
    $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
    $objWriter->save('php://output');
  }

  public function getDetailsUs()
  {
    $data = $this->user->getUserById($this->input->post('ID'));
    echo json_encode($data);
  }

  public function changeScreen()
  {
    $data = $this->dashboard_model->controlScreen($this->input->post('ID'), $this->input->post('action'), $this->input->post('userid'));
    if(!$data){
      $this->output->set_status_header('500');
      echo json_encode(FALSE);
    }else{
      echo json_encode(TRUE);
    }
  }

  public function getPlaceBirth($code)
  {
    $comune =(array)  simplexml_load_file("http://webservices.dotnethell.it/codicefiscale.asmx/NomeComune?CodiceComune=$code");
    if (isset($comune[0])) {
      return ucfirst(strtolower($comune[0]));
    } else {
      return '';
    }
  }

  public function printContract()
  {
    $user = (array)$this->data['user'];
    $this->data['user']->loc = $this->getPlaceBirth(substr($user['cf'], 11,14));
    $html=$this->load->view('pdf_contract', $this->data, true);
    $pdfFilePath = "ContrattoClickday.pdf";
    $this->load->library('m_pdf');
    $pdf = $this->m_pdf->load();
    $pdf->WriteHTML($html);
    $pdf->Output($pdfFilePath, "D");
  }

  public function setcode()
  {
    if($this->input->post('code') == '')
      $assigned = 0;
    else
      $assigned = 1;
    $id = $this->input->post('ID');
    $code = $this->input->post('code');
    $region = $this->input->post('region');
    $this->dashboard_model->setcode($id, $code, $region, $assigned);
    echo json_encode(TRUE);
  }

  public function sendcode()
  {
    $id = $this->input->post('ID');
    $code = $this->input->post('code');
    $region = $this->input->post('region');
    $result = $this->dashboard_model->sendCodeMail($id, $code);
    echo json_encode($result);
  }

  public function deleteUserCode()
  {
    $data = $this->user->removeUsrCode($this->input->post('ID'));
    if(!$data){
      $this->output->set_status_header('500');
      echo json_encode(FALSE);
    }else{
      $this->dashboard_model->deleteMessages($this->input->post('ID'), 'user');
      echo json_encode(TRUE);
    }
  }

  function confirmWinner()
  {
    $ID = $this->input->post('ID');
    $role = $this->input->post('role');
    if($role=='user'){
      $ok = $this->user->setWinnerAgree($ID);
    }
  }

  function getProjClickers($code)
  {
    $clickers = $this->dashboard_model->getProjectClickers($code);
    echo json_encode(count($clickers));
  }

  function getCodeCount()
  {
    $data = array(
      'projects_cl' => $this->dashboard_model->getCodeCount('projects_classic'),
      'projects_sc' => $this->dashboard_model->getCodeCount('projects_sc'),
    );
    echo json_encode($data);
  }

  function assignCodes()
  {
    $data = $this->input->get();
    $codeAssigned = 0;
    foreach ($data['codesToDistrib'] as $code) {
      $result = $this->dashboard_model->set_codes($code['project'], $code['count']);
      if ($result) {
        $codeAssigned = $codeAssigned + $code['count'];
      } else {
        break;
      }
    }
    echo json_encode($codeAssigned);
  }

  function updateSettings()
  {
    $data = $this->input->get();
    $res = $this->dashboard_model->updateSettings($data);
    echo json_encode($res);
  }
}

?>
