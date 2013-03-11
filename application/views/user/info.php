<h2>Info for  user "<?= $user->username; ?>"</h2>
 
<ul>
    <li>Email: <?= $user->email; ?></li>
    <li>Number of logins: <?= $user->logins; ?></li>
    <li>Last Login: <?= Date::fuzzy_span($user->last_login); ?></li>
</ul>
 
<?= HTML::anchor('user/logout', 'Logout'); ?>
