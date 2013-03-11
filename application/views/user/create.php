<h2>Create a New User</h2>
<? if ($message) : ?>
    <h3 class="message">
        <?= $message; ?>
    </h3>
<? endif; ?>
 
<form method="post" action="create" name="createform">
 
<input type="text" name="username" value="" autocomplete="off" maxlength=50 style="width:250px; font: 11px Verdana, Geneva, Arial, Helvetica, sans-serif;">

<input type="text" name="email" value="" autocomplete="off"  style="width:250px; font: 11px Verdana, Geneva, Arial, Helvetica, sans-serif;">

 <input name="password" value="" autocomplete="off" type="password" maxlength=50 style="width:250px; font: 11px Verdana, Geneva, Arial, Helvetica, sans-serif;">
<input name="password_confirm" value="" autocomplete="off" type="password" maxlength=50 style="width:250px; font: 11px Verdana, Geneva, Arial, Helvetica, sans-serif;">
																
 

 
<input type="submit" name="login" value="Sign In">
</form>
 