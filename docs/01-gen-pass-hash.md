# Generate user password hash

To generate hash you can use following code:

```html
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Hash generator</title>
  </head>
  <body>
    <h1>Hash generator for egzaminer</h1>
    <form method="post">
      <input type="password" name="p" autofocus required>
      <button name="submit">Generate!</button>
    </form>

    <?php if (isset($_POST['p'])): ?><br>
      <textarea cols="61" rows="2"><?=htmlspecialchars(password_hash($_POST['p'], PASSWORD_DEFAULT));?></textarea>
    <?php endif ?>

  </body>
</html>
```

or just:

```php
<?php

htmlspecialchars(password_hash('your-password', PASSWORD_DEFAULT))
```
