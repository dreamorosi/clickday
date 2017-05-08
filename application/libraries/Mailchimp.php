<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mailchimp
{
  protected $CI;

  public function __construct()
  {
    require_once APPPATH.'third_party/mailchimp/Mandrill.php';
    $this->CI =& get_instance();
    $this->mandrill = new Mandrill('tt5ZgKlSFLLoMpvBpa5SuQ');
  }

  function ping()
	{
		return TRUE;
	}

  function sendMail($email, $subject, $content)
  {
    try {
      $message = array(
        'html' => $content,
        'text' => 'Example text content',
        'subject' => $subject,
        'from_email' => 'info@clickdayats.it',
        'from_name' => 'ClickDay 2017',
        'to' => array(
            array(
                'email' => $email,
                'name' => 'Recipient Name',
                'type' => 'to'
            )
        ),
        'headers' => array('Reply-To' => 'info@clickdayats.it'),
        'important' => false,
        'track_opens' => null,
        'track_clicks' => null,
        'auto_text' => null,
        'auto_html' => null,
        'inline_css' => null,
        'url_strip_qs' => null,
        'preserve_recipients' => null,
        'view_content_link' => null,
        'tracking_domain' => null,
        'signing_domain' => null,
        'return_path_domain' => null,
        'merge' => true,
        'tags' => array('forgot-password'),
        'metadata' => array('website' => 'www.clickdayats.it'),
        // 'recipient_metadata' => array(
        //     array(
        //         'rcpt' => 'recipient.email@example.com',
        //         'values' => array('user_id' => 123456)
        //     )
        // ),
        // 'attachments' => array(
        //     array(
        //         'type' => 'text/plain',
        //         'name' => 'myfile.txt',
        //         'content' => 'ZXhhbXBsZSBmaWxl'
        //     )
        // ),
        // 'images' => array(
        //     array(
        //         'type' => 'image/png',
        //         'name' => 'IMAGECID',
        //         'content' => 'ZXhhbXBsZSBmaWxl'
        //     )
        // )
    );
    $async = false;
    $ip_pool = 'Main Pool';
    date_default_timezone_set("UTC");
    $send_at = date('m/d/Y h:i:s a', time() - 60);
    $result = $this->mandrill->messages->send($message, $async, $ip_pool, $send_at);
    return $result;
    /*
    Array
    (
        [0] => Array
            (
                [email] => recipient.email@example.com
                [status] => sent
                [reject_reason] => hard-bounce
                [_id] => abc123abc123abc123abc123abc123
            )

    )
    */
} catch(Mandrill_Error $e) {
    // Mandrill errors are thrown as exceptions
    echo 'A mandrill error occurred: ' . get_class($e) . ' - ' . $e->getMessage();
    // A mandrill error occurred: Mandrill_Unknown_Subaccount - No subaccount exists with the id 'customer-123'
    return $e;
}
  }
}
?>
