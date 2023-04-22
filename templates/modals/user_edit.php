<?php $primary_id = $_POST["primary_id"]; ?>

<input type="hidden" name="primary_id" id="primary_id" value="<?php echo $primary_id ?>">
<div class="mb-3">
    <label for="edit_password" class="form-label">Password</label>
    <input type="password" class="form-control" name="edit_password" id="edit_password" placeholder="Password" required>
</div>
<div class="mb-3">
    <label for="edit_confirm_password" class="form-label">Confirm Password</label>
    <input type="password" class="form-control" name="edit_confirm_password" id="edit_confirm_password" placeholder="Confirm Password">
</div>