<form action="" method="post">

    <label for="customer_name">Name:</label><br />
    <input type="text" name="customer[name]" value="<?php echo htmlspecialchars($customer['name']); ?>" id="customer_name" />
    <br />
    <label for="customer_address">Address:</label><br />
    <textarea type="text" name="customer[address]" id="customer_address"><?php echo htmlspecialchars($customer['address']); ?></textarea>
    <br />
    <label for="user_email">Email:</label><br />
    <input type="text" name="user[email]" value="<?php echo htmlspecialchars($user['email']); ?>" id="user_email" />
    <br />
    <label for="user_password">Password:</label><br />
    <input type="password" name="user[password]" value="<?php echo htmlspecialchars($user['password']); ?>" id="user_password" />
    <br />
    <label for="user_password2">Repeat password:</label><br />
    <input type="password" name="user[password2]" value="<?php echo htmlspecialchars($user['password2']); ?>" id="user_password2" />
    <br />
    <br />
    <input type="submit" value="Submit" name="submit_user_info" />

</form>