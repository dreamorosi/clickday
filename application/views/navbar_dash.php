<div class="container-fluid">
  <div class="row">
    <div class="col-md-2 sidebar">
      <ul class="nav nav-sidebar noHover">
        <li>
          <a href="<? echo base_url(); ?>">
            <img src="<? echo base_url('assets/img/logo.png'); ?>"/>
          </a>
        </li>
        <li>
          <a href="<? echo base_url('dashboard'); ?>">
            <?
            if ($role === 'user') {
              echo $user->name . ' ' . $user->surname;
            } else {
              $title = $role=='admin' ? 'Admin ' : '';
              echo $title . ' ' . $fullName;
            }
              if($cnots > 0):
            ?>
            <span class="badge pull-right" id="cnots2">
              <? echo $cnots; ?>
              <span class="glyphicon glyphicon-envelope"></span>
            </span>
            <? endif; ?>
          </a>
        </li>
      </ul>
      <ul class="nav nav-sidebar items" data-active="<? echo 'dash'; ?>">
        <? if($role != 'user'): ?>
          <li data-nav="dash"><a href="<? echo base_url('dashboard'); ?>">Home</a></li>
          <? if($role == 'clickMaster' || $role == 'admin'): ?>
            <li data-nav="userlist"><a href="<? echo base_url('dashboard/userlist'); ?>">Lista Utenti</a></li>
            <li data-nav="screenshots"><a href="<? echo base_url('dashboard/screens'); ?>">Screenshots</a></li>
            <? if($role == 'admin'): ?>
              <li data-nav="managecm"><a href="<? echo base_url('dashboard/managecm'); ?>">ClickMasters</a></li>
              <li data-nav="projects"><a href="<? echo base_url('dashboard/projects'); ?>">Elenco Progetti</a></li>
              <li data-nav="codes"><a href="<? echo base_url('dashboard/codes'); ?>">Codici</a/></li>
            <? endif; ?>
          <? endif; ?>
        <? else: ?>
          <li data-nav="profile"><a href="<? echo base_url('dashboard/profile'); ?>">Modifica dati personali</a></li>
        <? endif; ?>
        <li><a href="<? echo base_url('dashboard/signout'); ?>">Logout</a></li>
      </ul>
    </div>
  </div>
</div>
<script src="<? echo base_url('assets/js/navbar_dash.js'); ?>"></script>
