<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'colegiu';

$conn = mysqli_connect($host, $username, $password, $database);
if (!$conn) {
    die("Conexiune eșuată: " . mysqli_connect_error());
}

// ȘTERGERE
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_id']))
{
    $delete_id = mysqli_real_escape_string($conn, $_POST['delete_id']);
    $sql = "DELETE FROM elevi WHERE id = '$delete_id'";

    if (mysqli_query($conn, $sql)) {
        echo "<div class='success-message'>Elev șters cu succes!</div>";
    } else {
        echo "<div class='error-message'>Eroare la ștergere: " . mysqli_error($conn) . "</div>";
    }
}

// ACTUALIZARE (UPDATE)
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update']))
{
    $edit_id = mysqli_real_escape_string($conn, $_POST['edit_id']);
    $nume = mysqli_real_escape_string($conn, $_POST['nume']);
    $prenume = mysqli_real_escape_string($conn, $_POST['prenume']);
    $adresa = mysqli_real_escape_string($conn, $_POST['adresa']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $data_nastere = mysqli_real_escape_string($conn, $_POST['data_nastere']);
    $sex = mysqli_real_escape_string($conn, $_POST['sex']);
    $nota_medie_bac = mysqli_real_escape_string($conn, $_POST['media_bac']);

    $sql = "UPDATE elevi SET 
            nume = '$nume', 
            prenume = '$prenume', 
            adresa = '$adresa', 
            email = '$email', 
            data_nastere = '$data_nastere', 
            sex = '$sex', 
            nota_medie_bac = '$nota_medie_bac' 
            WHERE id = '$edit_id'";

    if (mysqli_query($conn, $sql)) {
        echo "<div class='success-message'>Elev actualizat cu succes!</div>";
    } else {
        echo "<div class='error-message'>Eroare la actualizare: " . mysqli_error($conn) . "</div>";
    }
}

// EDITARE (doar afișează formularul pentru editare)
$edit_data = null;
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit_id']) && !isset($_POST['update']))
{
    $edit_id = mysqli_real_escape_string($conn, $_POST['edit_id']);
    $sql = "SELECT * FROM elevi WHERE id = '$edit_id'";
    $result = mysqli_query($conn, $sql);
    $edit_data = mysqli_fetch_assoc($result);
}

// ADAUGARE
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['nume']) && !isset($_POST['edit_id']) && !isset($_POST['update']))
{
    $nume = mysqli_real_escape_string($conn, $_POST['nume']);
    $prenume = mysqli_real_escape_string($conn, $_POST['prenume']);
    $adresa = mysqli_real_escape_string($conn, $_POST['adresa']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $data_nastere = mysqli_real_escape_string($conn, $_POST['data_nastere']);
    $sex = mysqli_real_escape_string($conn, $_POST['sex']);
    $nota_medie_bac = mysqli_real_escape_string($conn, $_POST['media_bac']);

    $sql = "INSERT INTO elevi (nume, prenume, adresa, email, data_nastere, sex, nota_medie_bac) 
            VALUES ('$nume', '$prenume', '$adresa', '$email', '$data_nastere', '$sex', '$nota_medie_bac')";

    if (mysqli_query($conn, $sql)) {
        echo "<div class='success-message'>Utilizator adăugat cu succes!</div>";
    } else {
        echo "<div class='error-message'>Eroare: " . mysqli_error($conn) . "</div>";
    }
}

// Afișare tabel
$sql = "SELECT * FROM elevi";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Colegiu - Management Elevi</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            border-radius: 15px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        .header {
            background: linear-gradient(135deg, #2c3e50, #34495e);
            color: white;
            padding: 30px;
            text-align: center;
        }

        .header h1 {
            font-size: 2.5em;
            margin-bottom: 10px;
        }

        .content {
            padding: 30px;
        }

        .add-btn {
            background: linear-gradient(135deg, #00b09b, #96c93d);
            color: white;
            border: none;
            padding: 15px 30px;
            border-radius: 50px;
            font-size: 1.1em;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            margin-bottom: 30px;
        }

        .add-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.3);
        }

        .form-container {
            background: #f8f9fa;
            padding: 25px;
            border-radius: 10px;
            margin-bottom: 30px;
            border-left: 5px solid #667eea;
            display: none;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #2c3e50;
        }

        .form-group input, .form-group select {
            width: 100%;
            padding: 12px;
            border: 2px solid #e9ecef;
            border-radius: 8px;
            font-size: 1em;
            transition: border-color 0.3s ease;
        }

        .form-group input:focus, .form-group select:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .form-buttons {
            display: flex;
            gap: 15px;
            margin-top: 25px;
        }

        .btn {
            padding: 12px 25px;
            border: none;
            border-radius: 8px;
            font-size: 1em;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 600;
        }

        .btn-submit {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
        }

        .btn-update {
            background: linear-gradient(135deg, #4CAF50, #45a049);
            color: white;
        }

        .btn-cancel {
            background: #6c757d;
            color: white;
        }

        .btn-edit {
            background: linear-gradient(135deg, #4CAF50, #45a049);
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 0.9em;
            transition: all 0.3s ease;
        }

        .btn-delete {
            background: linear-gradient(135deg, #f44336, #d32f2f);
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 0.9em;
            transition: all 0.3s ease;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        .table-container {
            overflow-x: auto;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        th {
            background: linear-gradient(135deg, #34495e, #2c3e50);
            color: white;
            padding: 15px;
            text-align: left;
            font-weight: 600;
        }

        td {
            padding: 15px;
            border-bottom: 1px solid #e9ecef;
        }

        tr:hover {
            background-color: #f8f9fa;
        }

        tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        .action-buttons {
            display: flex;
            gap: 8px;
        }

        .success-message {
            background: linear-gradient(135deg, #4CAF50, #45a049);
            color: white;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
            font-weight: 600;
        }

        .error-message {
            background: linear-gradient(135deg, #f44336, #d32f2f);
            color: white;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
            font-weight: 600;
        }

        @media (max-width: 768px) {
            .container {
                margin: 10px;
                border-radius: 10px;
            }

            .content {
                padding: 15px;
            }

            .action-buttons {
                flex-direction: column;
            }

            table {
                font-size: 0.9em;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h1>🏫 Colegiu - Management Elevi</h1>
        <p>Gestionează elevii tăi cu ușurință</p>
    </div>

    <div class="content">
        <button id="addbtn" class="add-btn" onclick="showformBtn()">
            ➕ Adaugă Elev Nou
        </button>

        <div id="adduserform" class="form-container">
            <?php if($edit_data): ?>
                <h3 style="color: #2c3e50; margin-bottom: 20px;">✏️ Editare Elev</h3>
            <?php else: ?>
                <h3 style="color: #2c3e50; margin-bottom: 20px;">👤 Adăugare Elev Nou</h3>
            <?php endif; ?>

            <form method="POST" action="">
                <?php if($edit_data): ?>
                    <input type="hidden" name="edit_id" value="<?php echo $edit_data['id']; ?>">
                <?php endif; ?>

                <div class="form-group">
                    <label>Nume</label>
                    <input type="text" name="nume" maxlength="50" value="<?php echo $edit_data['nume'] ?? ''; ?>" required>
                </div>

                <div class="form-group">
                    <label>Prenume</label>
                    <input type="text" name="prenume" maxlength="50" value="<?php echo $edit_data['prenume'] ?? ''; ?>" required>
                </div>

                <div class="form-group">
                    <label>Adresa</label>
                    <input type="text" name="adresa" maxlength="50" value="<?php echo $edit_data['adresa'] ?? ''; ?>">
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" maxlength="50" value="<?php echo $edit_data['email'] ?? ''; ?>" required>
                </div>

                <div class="form-group">
                    <label>Data nașterii</label>
                    <input type="date" name="data_nastere" value="<?php echo $edit_data['data_nastere'] ?? ''; ?>" required>
                </div>

                <div class="form-group">
                    <label>Sex</label>
                    <select name="sex" required>
                        <option value="">Selectează</option>
                        <option value="M" <?php echo (isset($edit_data['sex']) && $edit_data['sex'] == 'M') ? 'selected' : ''; ?>>Masculin</option>
                        <option value="F" <?php echo (isset($edit_data['sex']) && $edit_data['sex'] == 'F') ? 'selected' : ''; ?>>Feminin</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Media BAC</label>
                    <input type="number" name="media_bac" min="1" max="10" step="0.01" value="<?php echo $edit_data['nota_medie_bac'] ?? ''; ?>" required>
                </div>

                <div class="form-buttons">
                    <?php if($edit_data): ?>
                        <button type="submit" name="update" class="btn btn-update">💾 Actualizează</button>
                    <?php else: ?>
                        <button type="submit" class="btn btn-submit">✅ Adaugă Elev</button>
                    <?php endif; ?>
                    <button type="button" onclick="hideform()" class="btn btn-cancel">❌ Închide</button>
                </div>
            </form>
        </div>

        <div class="table-container">
            <?php
            if (mysqli_num_rows($result) > 0) {
                echo "<table>";
                echo "<tr>
                            <th>ID</th>
                            <th>Nume</th>
                            <th>Prenume</th>
                            <th>Adresa</th>
                            <th>Email</th>
                            <th>Data Naștere</th>
                            <th>Sex</th>
                            <th>Nota BAC</th>
                            <th>Acțiuni</th>
                          </tr>";

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["nume"] . "</td>";
                    echo "<td>" . $row["prenume"] . "</td>";
                    echo "<td>" . $row["adresa"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "<td>" . $row["data_nastere"] . "</td>";
                    echo "<td>" . $row["sex"] . "</td>";
                    echo "<td>" . $row["nota_medie_bac"] . "</td>";
                    echo "<td>
                                <div class='action-buttons'>
                                    <form method='POST' style='display:inline;'>
                                        <input type='hidden' name='edit_id' value='" . $row["id"] . "'>
                                        <button type='submit' name='edit' class='btn-edit'>✏️ Modifică</button>
                                    </form>
                                    <form method='POST' style='display:inline;' onsubmit='return confirm(\"Sigur doriți să ștergeți acest elev?\")'>
                                        <input type='hidden' name='delete_id' value='" . $row["id"] . "'>
                                        <button type='submit' name='delete' class='btn-delete'>🗑️ Șterge</button>
                                    </form>
                                </div>
                              </td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "<div style='text-align: center; padding: 40px; color: #6c757d;'>
                            <h3>📝 Nu există elevi în baza de date</h3>
                            <p>Apasă butonul 'Adaugă Elev Nou' pentru a începe</p>
                          </div>";
            }
            mysqli_close($conn);
            ?>
        </div>
    </div>
</div>

<script>
    function hideform(){
        document.getElementById('adduserform').style.display='none';
        document.getElementById('addbtn').style.display='block';
    }

    function showformBtn(){
        document.getElementById('adduserform').style.display='block';
        document.getElementById('addbtn').style.display='none';
    }

    // Auto-show form when editing
    <?php if($edit_data): ?>
    document.addEventListener('DOMContentLoaded', function() {
        showformBtn();
    });
    <?php endif; ?>
</script>
</body>
</html>
