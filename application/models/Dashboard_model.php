<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Dashboard_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

	public function getCMusers($ID, $limit){
		$this->db->order_by("joinDate", "desc");
		if($limit==-1)
			$query = $this->db->get_where('users', array('clickM' => $ID));
		else
			$query = $this->db->get_where('users', array('clickM' => $ID), $limit);
		return $query->result();

	}

	public function getUsers($limit)
	{
		$this->db->order_by('joinDate', "desc");
		if($limit!=-1)
			$this->db->limit($limit);
		$query = $this->db->get('users');
		return $query->result();
	}

	public function getUser($id)
	{
		$query = $this->db->get_where('users', array('ID' => $id));
		return $query->row();
	}

	public function getCMs($limit)
	{
		$this->db->order_by('ID', 'desc');
		if($limit!=-1)
			$this->db->limit($limit);
		$query = $this->db->get('clickmasters');
		return $query->result();
	}

	public function getScreens($ID)
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->join('screenshots', 'users.ID = screenshots.user');
		$this->db->where('screenshots.approved', 0);
		if($ID!=-1)
			$this->db->where('users.clickM', $ID);
		$query = $this->db->get();
		return $query->result();
	}

	public function controlScreen($ID, $action, $userID)
	{
		$this->db->set('approved', $action)->where('ID', $ID)->update('screenshots');
		$this->db->set('screen_uploaded', $action)->where('ID', $userID)->update('users');
		if ($this->db->affected_rows() > 0){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function paginateUsers($users)
	{
		$data = array();
		$this->load->helper('date');
		foreach($users as $user){
			$obj = array();
			$obj['ID'] = $user->ID;
			$obj['status'] = $this->getStatus($user->ID);

			$complete_name = '';
			$name = explode(' ', $user->name);
			$surname = explode(' ', $user->surname);

			for($i=0;$i<count($name);$i++)
				$name[$i] = ucfirst(strtolower($name[$i]));

			for($i=0;$i<count($surname);$i++)
				$surname[$i] = ucfirst(strtolower($surname[$i]));


			$obj['name'] = implode(' ', $name) .' '. implode(' ', $surname);

			$obj['inverted_name'] = $user->surname .' '.$user->name ;
			$obj['email'] = $user->email;
			$obj['code'] = $user->code;
			$obj['region'] = $user->region;
			$obj['join'] = date('d/m/Y', strtotime($user->joinDate));
			if($user->clickM != -1)
				$obj['clickM'] = $this->clickmaster->getCompleteName($user->clickM);
			else
				$obj['clickM'] = 'Nessuno';
			if($user->approved == 1) $obj['approved'] = 'Si'; else $obj['approved'] = 'No';
			//if($user->code != NULL) $obj['code_rec'] = 'Si'; else $obj['code_rec'] = 'No';
			if($user->code_received == 1) $obj['code_rec'] = 'Si'; else $obj['code_rec'] = 'No';
			if($user->screen_uploaded == 1) $obj['screen'] = 'Si'; else $obj['screen'] = 'No';
			if($user->cont_uploaded == 1) $obj['contract'] = 'Si'; else $obj['contract'] = 'No';
			$data[] = $obj;
		}
		return $data;
	}

  public function prepareExcel($users)
  {
    $data = array();
		$this->load->helper('date');
    $headers = array(
      'User',
      'Data registrazione',
      'ClickMaster associato',
      'Conferma registrazione',
      'Codice ricevuto',
      'Screenshot',
      'Contratto',
      'Email',
      'Telefono'
    );
    $data[] = $headers;
		foreach($users as $user){
		  $obj = array();
      $obj['name'] = $user->name .' '. $user->surname;
      $obj['join'] = date('d/m/Y', strtotime($user->joinDate));
      if($user->clickM != -1)
				$obj['clickM'] = $this->clickmaster->getCompleteName($user->clickM);
			else
				$obj['clickM'] = 'Nessuno';
      if($user->approved == 1) $obj['approved'] = 'Si'; else $obj['approved'] = 'No';
      ($user->code == NULL) ? $obj['code_rec'] = 'No' : $obj['code_rec'] = $user->code;
			if($user->screen_uploaded == 1) $obj['screen'] = 'Si'; else $obj['screen'] = 'No';
			if($user->cont_uploaded == 1) $obj['contract'] = 'Si'; else $obj['contract'] = 'No';
			$obj['email'] = $user->email;
      $obj['phone'] = $user->phone;
			$data[] = $obj;
		}
		return $data;
  }

	public function paginateCMs($cMs)
	{
		$data = array();
		foreach($cMs as $cM){
			$obj = array();
			$obj['ID'] = $cM->ID;
			$obj['name'] = $cM->name .' '. $cM->surname;
			$obj['email'] = $cM->email;
			$obj['code'] = $cM->code;
			$obj['users'] = count($this->getAssociatedUser($cM->ID));
			$data[] = $obj;
		}
		return $data;
	}

	public function paginateScreens($screens)
	{
		$data = array();
		foreach($screens as $screen){
			$obj= array();
			$obj['ID'] = $screen->ID;
			$obj['name'] = $screen->name . " " . $screen->surname;
			$obj['filename'] = $screen->filename;
			$obj['userID'] = $screen->user;
			$data[] = $obj;
		}
		return $data;
	}

	public function getAssociatedUser($ID)
	{
		$query = $this->db->get_where('users', array('clickM' => $ID));
		return $query->result();
	}

	public function getStatus($ID){
		$query = $this->db->get_where('users', array('ID' => $ID));
		return $query->row()->approved + $query->row()->code_received + $query->row()->screen_uploaded;
	}

	public function sendNotMail($email, $oggetto, $testo, $mitt)
	{
		$data = array( 'base_url' => base_url(), 'email' => urlencode($email), 'oggetto' => $oggetto, 'testo' => $testo, 'mitt' => $mitt);
		$this->load->library('email');
		$this->load->helper('url');
		//$config['protocol'] = 'sendmail';
		$config['protocol']    = 'smtp';
        $config['smtp_host']    = 'emcwhosting.hwgsrl.it';
        $config['smtp_port']    = '25';
        $config['smtp_timeout'] = '7';
        $config['smtp_user']    = 'notification@clickdayats.it';
        $config['smtp_pass']    = 'Clickday1';
		$config['validate'] = 'FALSE';
		$config['mailtype'] = 'html';
		$this->email->initialize($config);
		$this->email->from('notification@clickdayats.it', 'ClickDay 2016');
		$this->email->to($email);
		$this->email->subject('Nuovo messaggio ricevuto da '. $mitt);
		$content = $this->load->view('emails/notmail', $data, TRUE);
		$this->email->message($content);
		$this->email->send();
	}

	public function sendmessage($oggetto, $testo, $mittID, $destID, $type, $parent)
	{
		$this->load->helper('date');
		$datestring = '%Y-%m-%d %H:%i';
		$time = now('Europe/Rome');
		$now = mdate($datestring, $time);
		$newMail = array('title' => $oggetto, 'content' => $testo, 'mittID' => $mittID, 'destID' => $destID, 'type' => $type, 'parentID' => $parent, 'time' => $now);
		$this->db->insert('mails', (object) $newMail);
		return $this->db->insert_id();
	}

	public function createNot($id, $type, $mittID, $destID, $oggetto, $testo) {
		$mitt = $this->getMittName($mittID, $type);
		switch($type){
			case -1:
			case -5:
				$this->db->select('ID,email');
				$query = $this->db->get('admin');
				foreach ($query->result() as $row) {
					$this->db->insert('not_mail', array('destID' => $row->ID, 'mailID' => $id, 'role' => 'admin'));
					$this->sendNotMail($row->email, $oggetto, $testo, $mitt);
				}
			break;
			case -2:
				$this->db->insert('not_mail', array('destID' => $destID, 'mailID' => $id, 'role' => 'clickMaster'));
				$this->sendNotMail($this->getEmailAddress($destID,2), $oggetto, $testo, $mitt);
			break;
			case -3:
				$this->db->select('ID,email');
				$query = $this->db->get('admin');
				foreach ($query->result() as $row) {
					$this->db->insert('not_mail', array('destID' => $row->ID, 'mailID' => $id, 'role' => 'admin'));
					$this->sendNotMail($row->email,  $oggetto, $testo, $mitt);
					}
				$this->db->insert('not_mail', array('destID' => $destID, 'mailID' => $id, 'role' => 'clickMaster'));
				$this->sendNotMail($this->getEmailAddress($destID,2),  $oggetto, $testo, $mitt);
			break;
			case -4:
				$users = $this->getCMusers($mittID, -1);
				foreach($users as $row) {
					$this->db->insert('not_mail', array('destID' => $row->ID, 'mailID' => $id, 'role' => 'user'));
					$this->sendNotMail($row->email, $oggetto, $testo, $mitt);
				}
			break;
			case -9:
				$users = $this->getCMusers($mittID, -1);
				foreach($users as $row){
					$this->db->insert('not_mail', array('destID' => $row->ID, 'mailID' => $id, 'role' => 'user'));
					$this->sendNotMail($row->email, $oggetto, $testo, $mitt);
				}
				$this->db->select('ID,email');
				$query = $this->db->get('admin');
				foreach ($query->result() as $row) {
					$this->db->insert('not_mail', array('destID' => $row->ID, 'mailID' => $id, 'role' => 'admin'));
					$this->sendNotMail($row->email, $oggetto, $testo, $mitt);
				}
			break;
			case -7:
				$users = $this->getUsers(-1);
				foreach($users as $row){
					$this->db->insert('not_mail', array('destID' => $row->ID, 'mailID' => $id, 'role' => 'user'));
					$this->sendNotMail($row->email, $oggetto, $testo, $mitt);
				}
			break;
			case -8:
				$cms = $this->getCMs(-1);
				foreach($cms as $row){
					$this->db->insert('not_mail', array('destID' => $row->ID, 'mailID' => $id, 'role' => 'clickMaster'));
					$this->sendNotMail($row->email, $oggetto, $testo, $mitt);
				}
			break;
			case -15:
			$cms = $this->getCMs(-1);
				foreach($cms as $row){
					$this->db->insert('not_mail', array('destID' => $row->ID, 'mailID' => $id, 'role' => 'clickMaster'));
					$this->sendNotMail($row->email, $oggetto, $testo, $mitt);
				}
				$users = $this->getUsers(-1);
				foreach($users as $row){
					$this->db->insert('not_mail', array('destID' => $row->ID, 'mailID' => $id, 'role' => 'user'));
					$this->sendNotMail($row->email, $oggetto, $testo, $mitt);
				}
			break;
			case -22:
			case -28:
				$this->db->insert('not_mail', array('destID' => $destID, 'mailID' => $id, 'role' => 'clickMaster'));
				$this->sendNotMail($this->getEmailAddress($destID,2), $oggetto, $testo, $mitt);
			break;
			case -23:
			case -26:
				$this->db->insert('not_mail', array('destID' => $destID, 'mailID' => $id, 'role' => 'admin'));
				$this->sendNotMail($this->getEmailAddress($destID,3), $oggetto, $testo, $mitt);
			break;
			case -24:
			case -27:
				$this->db->insert('not_mail', array('destID' => $destID, 'mailID' => $id, 'role' => 'user'));
				$this->sendNotMail($this->getEmailAddress($destID,1), $oggetto, $testo, $mitt);
			break;
		}
		return;
	}

	public function getNot($ID, $role)
	{
		$this->db->select('mailID');
		$query = $this->db->get_where('not_mail', array('destID' => $ID, 'role' => $role));
		$result = $query->result();
		$nots = array();
		foreach($result as $not)
			$nots[]=intval($not->mailID);
		return $nots;
	}

	public function deleteNot($ID, $destID, $role)
	{
		$this->db->where(array('mailID' => $ID, 'destID' => $destID, 'role' => $role));
		$this->db->delete('not_mail');

	}

	public function getMails($role, $ID, $CMId = 0)
	{
		$this->db->order_by("ID", "desc");
		if($role=="user"){
			$this->db->distinct();
			$this->db->from('mails');
			$where = "( (type=-4 AND mittID=$CMId) OR (type=-9 AND mittID=$CMId) OR (type=-7) OR (type=-15) ) OR ( (type=-21 OR type=-24 OR type=-27) AND destID=$ID)";
			$this->db->where($where);
			$query = $this->db->get();
		}
		if($role=="clickMaster"){
			$this->db->distinct();
			$this->db->from('mails');
			$where = "( (type=-2 AND destID=$ID) OR (type=-3 AND destID=$ID) OR (type=-8) OR (type=-15) ) OR ( (type=-22 OR type=-25 OR type=-28) AND destID=$ID)";
			$this->db->where($where);
			$query = $this->db->get();
		}
		if($role=="admin"){
			$this->db->from('mails');
			//$where = "( type=-1 OR type=-3 OR type=-5 OR type=-9 OR ( (type=-23 OR type=-26 OR type=-29) AND destID=$ID) )";
			$where = "( type=-1 OR type=-3 OR type=-5 OR type=-9 OR ( (type=-23 OR type=-26 OR type=-29) ) )";
			$this->db->where($where);
			$query = $this->db->get();
		}
		$results = $query->result_array();
		$mails = array();
		$mails2 = array();
		$ids = array();
		$nots = $this->getNot($ID, $role);
		$pos = 0;
		foreach($results as $mail){

			if ( (!(in_array($mail['ID'], $ids))) ){
				$mail['time'] = date('H:i:s d/m/Y', strtotime($mail['time']));
				if($mail['parentID']!=-1){
					$prec = $this->getprecMails($mail['parentID'], $mail['mittID'], $mail['destID']);
					foreach($prec as $p)
						$ids[] = $p['ID'];
					$ids[] = $mail['parentID'];
					$mail['convlength'] = $this->countPrec($mail['parentID'], $mail['mittID'], $mail['destID'], $mail['type'], $mail['ID']);
					$mail['mitt'] = $this->getMittName($mail['mittID'], $mail['type'])." (".$mail['convlength'].")";
				}
				else
					$mail['mitt'] = $this->getMittName($mail['mittID'], $mail['type']);
				if(in_array($mail['ID'], $nots)){
					$mail['mitt'] = '<strong>'.$mail['mitt'].'</strong>';
					$mail['title'] = '<strong>'.$mail['title'].'</strong>';
					$mail['time'] = '<strong>'.$mail['time'].'</strong>';
				}
				$mail['pos'] = $pos;
				$pos++;
				$mails[] = $mail;
			}
		}

		$ids = array();

		return $mails;
	}

	public function getPrecMails($parentID, $mittID, $destID) {
		$this->db->order_by("ID", "desc");
		$this->db->from('mails');
		$where = "parentID=$parentID AND mittID=$mittID AND destID=$destID";
		$this->db->where($where);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function getMailsCM($ID){
		$this->db->order_by("ID", "desc");
		$this->db->distinct();
		$this->db->from('mails');
		$where = "( (type=-22 AND destID=$ID) OR (type=-24 AND mittID=$ID) )";
		$this->db->where($where);
		$query = $this->db->get();
		$results = $query->result_array();
		$mails = array();
		$ids = array();
		foreach($results as $mail){
			if ( (!(in_array($mail['ID'], $ids))) && (!(in_array($mail['parentID'], $ids))) ){
				$mail['time'] = date('H:i:s d/m/Y', strtotime($mail['time']));
				if($mail['parentID']!=-1){
					$ids[] = $mail['parentID'];
					$mail['convlength'] = $this->countPrec($mail['parentID'], $mail['mittID'], $mail['destID'], $mail['type'], $mail['ID']);
					if($mail['type']==-24){
						$mail['dest'] = $this->getMittName($mail['mittID'], $mail['type'])." (".$mail['convlength'].")";
						$mail['mitt'] = $this->dashboard_model->getDestName($mail['destID'], $mail['type']);
						$mail['type'] = -30;
					} else {
						$mail['mitt'] = $this->getMittName($mail['mittID'], $mail['type']);
						$mail['dest'] = $this->dashboard_model->getDestName($mail['destID'], $mail['type'])." (".$mail['convlength'].")";
						$mail['type'] = -30;
					}
				}
				else
					$mail['mitt'] = $this->getMittName($mail['mittID'], $mail['type']);
				$mails[] = $mail;
			}
		}
		return $mails;
	}

	public function getSentMessages($ID, $role){
		$this->db->order_by("ID", "desc");
		if($role=="user"){
			$this->db->distinct();
			$this->db->from('mails');
			$where = "( (type=-1) OR (type=-2) OR (type=-3) OR (type=-21) OR (type=-22) OR (type=-23))  AND mittID=$ID";
			$this->db->where($where);
			$query = $this->db->get();
		}
		if($role=="clickMaster"){
			$this->db->distinct();
			$this->db->from('mails');
			$where = "( (type=-4) OR (type=-5) OR (type=-9) OR (type=-24) OR (type=-25) OR (type=-26))  AND mittID=$ID";
			$this->db->where($where);
			$query = $this->db->get();
		}
		if($role=="admin"){
			$this->db->from('mails');
			$where = "( (type=-7) OR (type=-8) OR (type=-15) OR (type=-27) OR (type=-28) OR (type=-29))  AND mittID=$ID";
			$this->db->where($where);
			$query = $this->db->get();
		}

		if($query->num_rows() > 0){
			return $query->result_array();
		}else{
			return [];
		}
	}

	public function getMailType($ID){
		$query = $this->db->get_where('mails', array('ID' => $ID));
		if($query->num_rows() > 0){
			return $query->row()->type;
		}else{
			return 0;
		}
	}

	public function getMittID($ID){
		$query = $this->db->get_where('mails', array('ID' => $ID));
		if($query->num_rows() > 0){
			return $query->row()->mittID;
		}else{
			return 0;
		}
	}

	public function getEmailAddress($ID, $case) {
		switch($case){
			case 1:
				$query = $this->db->get_where('users', array('ID' => $ID));
				if($query->num_rows() > 0){
					return $query->row()->email;
				}else{
					return '';
				}
			break;
			case 2:
				$query = $this->db->get_where('clickmasters', array('ID' => $ID));
				if($query->num_rows() > 0){
					return $query->row()->email;
				}else{
					return '';
				}
			break;
			case 3:
				$query = $this->db->get_where('admin', array('ID' => $ID));
				if($query->num_rows() > 0){
					return $query->row()->email;
				}else{
					return '';
				}
			break;
		}
	}

	public function getMittName($ID, $type)
	{
		switch($type){
			case -1:
			case -2:
			case -3:
			case -21:
			case -22:
			case -23:
				$query = $this->db->get_where('users', array('ID' => $ID));
				if($query->num_rows() > 0){
					return $query->row()->name.' '.$query->row()->surname;
				}else{
					return '';
				}
			break;
			case -4:
			case -5:
			case -9:
			case -24:
			case -25:
			case -26:
				$query = $this->db->get_where('clickmasters', array('ID' => $ID));
				if($query->num_rows() > 0){
					return 'CM '.$query->row()->name;
				}else{
					return '';
				}
			break;
			case -7:
			case -8:
			case -15:
			case -27:
			case -28:
			case -29:
				$query = $this->db->get_where('admin', array('ID' => $ID));
				if($query->num_rows() > 0){
					return 'Admin '.$query->row()->name;
				}else{
					return '';
				}
		}
	}

	public function getDestName($ID, $type)
	{
		switch($type){
			case -1:
			case -5:
				return 'Admins';
			break;
			case -2:
			case -8:
				$query = $this->db->get_where('clickmasters', array('ID' => $ID));
				if($query->num_rows() > 0){
					return 'Admins e CM '.$query->row()->name;
				}else{
					return '';
				}
			break;
			case -4:
			case -7:
				return 'Utenti';
			break;
			case -3:
				$query = $this->db->get_where('clickmasters', array('ID' => $ID));
				if($query->num_rows() > 0){
					return 'Admins e CM '.$query->row()->name;
				}else{
					return '';
				}
			break;
			case -9:
				return 'Admins e Utenti';
			break;
			case -15:
				return 'Clickmasters e Utenti';
			break;
			case -21:
			case -24:
			case -27:
				$query = $this->db->get_where('users', array('ID' => $ID));
				if($query->num_rows() > 0){
					return $query->row()->name.' '.$query->row()->surname;
				}else{
					return '';
				}
			break;
			case -22:
			case -25:
			case -28:
				$query = $this->db->get_where('clickmasters', array('ID' => $ID));
				if($query->num_rows() > 0){
					return 'CM '.$query->row()->name;
				}else{
					return '';
				}
			break;
			case -23:
			case -26:
			case -27:
				$query = $this->db->get_where('admin', array('ID' => $ID));
				if($query->num_rows() > 0){
					return 'Admin '.$query->row()->name;
				}else{
					return '';
				}
			break;

		}
	}

	public function getMittRole($type)
	{
		switch($type){
			case -1:
			case -2:
			case -3:
				return 'user';
			break;
			case -4:
			case -5:
			case -9:
				return 'clickMaster';
			break;
			case -7:
			case -8:
			case -15:
				return 'admin';
		}
	}

	public function getMessage($ID)
	{
		$query = $this->db->get_where('mails', array('ID' => $ID));
		if($query->num_rows() > 0){
			return $query->row();
		}else{
			return '';
		}
	}

	public function countPrec($parentID, $userID, $userID2, $type, $ID){
		$type2 = 0;
		switch($type){
			case -22:
				$type2 = -24;
			break;
			case -24:
				$type2 = -22;
			break;
			case -23:
				$type2= -27;
			break;
			case -27:
				$type2 = -23;
			break;
			case -26:
				$type2 = -28;
			break;
			case -28:
				$type2 = -26;
			break;
		}
		$this->db->from('mails');
		$where = "( ( (destID=$userID AND mittID=$userID2) OR (mittID=$userID AND destID=$userID2) ) AND parentID=$parentID AND ( (type=$type) OR (type=$type2) ) AND ID<=$ID )";
		$this->db->where($where);
		$query = $this->db->get();
		return count($query->result_array())+1;
	}

	public function getprecMessages($parentID, $userID, $userID2, $type, $ID)
	{
		$type2 = 0;
		switch($type){
			case -22:
				$type2 = -24;
			break;
			case -24:
				$type2 = -22;
			break;
			case -23:
				$type2= -27;
			break;
			case -27:
				$type2 = -23;
			break;
			case -26:
				$type2 = -28;
			break;
			case -28:
				$type2 = -26;
			break;
		}
		$this->db->order_by("ID", "desc");
		$this->db->from('mails');
		$where = "( ( (destID=$userID AND mittID=$userID2) OR (mittID=$userID AND destID=$userID2) ) AND parentID=$parentID AND ( (type=$type) OR (type=$type2) ) AND ID<$ID )";
		$this->db->where($where);
		$query = $this->db->get();

		if($query->num_rows() > 0){
			return $query->result_array();
		}else{
			return null;
		}
	}

	public function deleteMessages($ID,$role){
		if($role=="clickMaster"){
			$where = "( (type=-3 AND destID=$ID) ) OR ( (type=-22 OR type=-25 OR type=-28) AND destID=$ID) OR ( ( (type=-4) OR (type=-5) OR (type=-9) OR (type=-24) OR (type=-25) OR (type=-26))  AND mittID=$ID)";
			$this->db->where($where);
			$query = $this->db->delete('mails');
		}
		if($role=="user"){
			$where = "( (type=-21 OR type=-24 OR type=-27) AND destID=$ID) OR  ( ((type=-1) OR (type=-2) OR (type=-3) OR (type=-21) OR (type=-22) OR (type=-23))  AND mittID=$ID)";
			$this->db->where($where);
			$query = $this->db->delete('mails');
		}
	}

	public function setView()
	{
		$this->load->helper('date');
		$datestring = '%Y-%m-%d %H:%i';
		$time = now('Europe/Rome');
		$now = mdate($datestring, $time);
		switch($this->session->userdata('role')){
			case 'user':
				$this->db->set('lastSeen', $now)->where('ID', $this->session->userdata('ID'))->update('users');
			break;
			case 'clickMaster':
				$this->db->set('lastSeen', $now)->where('ID', $this->session->userdata('ID'))->update('clickmasters');
			break;
			case 'admin':
				$this->db->set('lastSeen', $now)->where('ID', $this->session->userdata('ID'))->update('admin');
		}
		$this->session->set_userdata('lastSeen', $now);
	}

	public function getProjectsClassic()
	{
		$query = $this->db->get('projects_classic');
		return $query->result_array();
	}

	public function getProjectsSC()
	{
		$query = $this->db->get('projects_sc');
		return $query->result_array();
	}

  public function getProjectClickers($code)
  {
    $query = $this->db->get_where('users', array('code' => $code));
    return $query->result_array();
  }

	public function setcode($id, $code, $region, $assigned)
	{
		$this->db->set(array('code' => $code, 'region' => $region, 'code_assigned' => $assigned))->where('ID', $id)->update('users');
		//$this->db->set('region', $region)->where('ID', $id)->update('users');
		if ($this->db->affected_rows() > 0){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function sendCodeMail($id, $code)
	{
		$user = $this->dashboard_model->getUser($id);
		$email = $user->email;
		$data = array( 'base_url' => base_url(), 'email' => urlencode($email), 'code' => $code, 'name' => $user->name);
		$this->load->library('email');
		$this->load->helper('url');
		//$config['protocol'] = 'sendmail';
		$config['protocol']    = 'smtp';
    $config['smtp_host']    = 'emcwhosting.hwgsrl.it';
    $config['smtp_port']    = '25';
    $config['smtp_timeout'] = '7';
    $config['smtp_user']    = 'notification@clickdayats.it';
    $config['smtp_pass']    = 'Clickday1';
		$config['validate'] = 'FALSE';
		$config['mailtype'] = 'html';
		$this->email->initialize($config);
		$this->email->from('notification@clickdayats.it', 'ClickDay 2016');
		$this->email->to($email);
		$this->email->subject('Codice progetto Click Day 2016');
		$content = $this->load->view('emails/codemail', $data, TRUE);
		$this->email->message($content);
		$sent = $this->email->send();

		$this->db->set('code_received', 1)->where('ID', $id)->update('users');
    return $sent;
	}

}

?>
