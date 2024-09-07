<html>
  <?php include('layouts/header.php'); ?>
  <body class="container mt-5">
    <h1 class="text-center">Descubra seu Signo</h1>
    <form method="POST" action="" class="mt-4">
      <div class="form-group">
        <label for="dataNascimento">Digite sua data de nascimento (DD/MM/YYYY):</label>
        <input type="text" id="dataNascimento" name="dataNascimento" class="form-control" placeholder="Ex: 21/03/2001" required>
      </div>
      <button type="submit" class="btn btn-primary mt-3">Descobrir Signo</button>
    </form>

      <?php include('show_zodiac_sign.php'); ?>
  </body>
</html>
