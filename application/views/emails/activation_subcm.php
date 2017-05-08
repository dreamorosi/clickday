<? include_once 'head_mail.php'; ?>
  <table class="row">
    <tr>
      <td class="wrapper last">
        <table class="twelve columns">
          <tr>
            <td class="text-pad">
              <h2 style="border-bottom: 1px solid #f6a723" class="text-ora">Un nuovo utente si è registrato</h2>
            </td>
            <td class="expander"></td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
  <table class="row">
    <tr>
      <td class="wrapper last">
        <table class="twelve columns">
          <tr>
            <td class="text-pad">
              <p><strong><? echo $name; ?></strong> si è registrato come referral.</p>
              <p>Adesso hai <strong><? echo $referredUsers; ?></strong> referral.</p>
            </td>
            <td class="expander"></td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
  <table class="row">
    <tr>
      <td class="wrapper last">
        <table class="twelve columns">
          <tr>
            <td class="text-pad">
              <a class="text-ora" style="text-decoration: underline" href="<? echo $base_url; ?>"><h6 style="font-family: 'Montserrat', sans-serif;" class="text-ora">Accedi al tuo Profilo ClickMaster</h6></a>
            </td>
            <td class="expander"></td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
  <table class="row">
    <tr>
      <td class="wrapper last">
        <table class="twelve columns">
          <tr>
            <td style="padding-bottom: 0px" class="text-pad">
            </td>
            <td class="expander"></td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
  <table class="row">
    <tr>
      <td class="wrapper last">
        <table class="twelve columns">
          <tr>
            <td class="text-pad">
              <p>Hai bisogno di aiuto? Scrivici a <a style="text-decoration: underline; font-size: 14px" class="text-ora" href="mailto:info@clickdayats.it">info@clickdayats.it</a></p>
            </td>
            <td class="expander"></td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
<? include_once 'footer_mail.php'; ?>