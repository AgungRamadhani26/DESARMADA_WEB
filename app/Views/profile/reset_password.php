<!-- file: reset_password_form.php -->
<form action="<?= base_url('lupa_password/reset_password') ?>" method="post">
   <input type="hidden" name="user_id" value="<?= $user['id_user'] ?>">
   <label for="password">New Password:</label>
   <input type="password" name="password" id="password" required>

   <label for="confirm_password">Confirm Password:</label>
   <input type="password" name="confirm_password" id="confirm_password" required>

   <button type="submit">Reset Password</button>
</form>