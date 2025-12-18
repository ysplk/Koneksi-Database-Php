<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Silahkan Login Terlebih Dahulu</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #e9ecef;
            margin: 0;
        }

        .login-container {
            background: white;
            padding: 2.5rem;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 350px;
        }

        h2 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 2rem;
            margin-top: 0;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            color: #555;
            font-weight: 600;
        }

        input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ced4da;
            border-radius: 6px;
            box-sizing: border-box;
            transition: border-color 0.15s ease-in-out;
        }

        input:focus {
            border-color: #007bff;
            outline: 0;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, .25);
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #0d6efd;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 600;
            transition: background-color 0.15s;
        }

        button:hover {
            background-color: #0b5ed7;
        }

        .alert {
            padding: 12px;
            margin-bottom: 1rem;
            border-radius: 6px;
            text-align: center;
            font-size: 0.9rem;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #842029;
            border: 1px solid #f5c2c7;
        }

        .alert-success {
            background-color: #d1e7dd;
            color: #0f5132;
            border: 1px solid #badbcc;
        }

        .alert-warning {
            background-color: #fff3cd;
            color: #664d03;
            border: 1px solid #ffecb5;
        }

        .info {
            font-size: 0.8rem;
            text-align: center;
            margin-top: 1.5rem;
            color: #6c757d;
            border-top: 1px solid #eee;
            padding-top: 1rem;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <h2>Sistem Kampus</h2>

        <?php
        if (isset($_GET['pesan'])) {
            if ($_GET['pesan'] == "gagal") {
                echo "<div class='alert alert-danger'>Login gagal! Username atau Password salah !</div>";
            } else if ($_GET['pesan'] == "logout") {
                echo "<div class='alert alert-success'>Berhasil Logout</div>";
            } else if ($_GET['pesan'] == "belum_login") {
                echo "<div class='alert alert-warning'>Silahkan Login Terlebih Dahulu</div>";
            }
        }
        ?>

        <form action="proses_login.php" method="post">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" required autocomplete="off" placeholder="Masukan Username">
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required placeholder="Masukan Password">
            </div>

            <button type="submit">LOGIN</button>
        </form>

        <div class="info">
            <p>Belum Punya Akun?</p>
        </div>
    </div>
</body>

</html>