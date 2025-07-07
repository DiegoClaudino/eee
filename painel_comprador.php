<?php
session_start();
if (!isset($_SESSION['user_id']) || ($_SESSION['user_tipo'] !== 'comprador' && $_SESSION['user_tipo'] !== 'ambos')) {
    header('Location: login_cadastro.php');
    exit;
}

// Conexão com banco
$host = 'localhost';
$db   = 'marketplace';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];
try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    die('Erro ao conectar no banco: ' . $e->getMessage());
}

$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare('SELECT nome, email FROM usuarios WHERE id = ?');
$stmt->execute([$user_id]);
$user_data = $stmt->fetch();

// Exemplo: quantidade de pedidos fictício. Você pode trocar isso para buscar do banco real.
$pedidos = 8;
$enderecos = 2;

// Logout
if (isset($_POST['logout'])) {
    session_destroy();
    header('Location: login_cadastro.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Painel do Comprador - MarketPlace Brasil</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 980px;
            margin: 40px auto;
            background: white;
            border-radius: 18px;
            box-shadow: 0 12px 40px rgba(102, 126, 234, 0.14);
            padding: 32px 24px 48px 24px;
        }
        .user-header {
            display: flex;
            align-items: center;
            gap: 18px;
            margin-bottom: 0;
        }
        .user-avatar {
            width: 68px;
            height: 68px;
            border-radius: 50%;
            background: linear-gradient(45deg, #667eea, #764ba2);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 34px;
            font-weight: bold;
        }
        .user-info {
            flex: 1;
        }
        .user-info h2 {
            margin: 0 0 5px 0;
            color: #667eea;
            font-size: 26px;
            font-weight: bold;
        }
        .user-info p {
            color: #777;
            font-size: 15px;
            margin: 0;
        }
        .logout-btn, .voltar-btn {
            background: linear-gradient(45deg, #667eea, #764ba2);
            color: white;
            border: none;
            border-radius: 8px;
            padding: 11px 24px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: opacity 0.2s;
            margin-left: 10px;
        }
        .logout-btn:hover, .voltar-btn:hover {
            opacity: 0.9;
        }
        .user-actions {
            display: flex;
            align-items: center;
            gap: 0;
        }
        .user-header-divider {
            width: 100%;
            height: 3px;
            background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
            opacity: 0.13;
            border-radius: 2px;
            margin-bottom: 32px;
            margin-top: 18px;
        }
        .dashboard {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 26px;
        }
        .dash-card {
            background: #f7f8fa;
            border-radius: 14px;
            padding: 34px 18px 22px 18px;
            box-shadow: 0 8px 22px rgba(102, 126, 234, 0.07);
            text-align: center;
            transition: box-shadow 0.2s, transform 0.15s;
            cursor: pointer;
            border: 2px solid transparent;
            position: relative;
            min-height: 160px;
        }
        .dash-card:hover {
            box-shadow: 0 18px 36px rgba(102, 126, 234, 0.15);
            border-color: #667eea;
            transform: translateY(-6px) scale(1.025);
        }
        .dash-card .icon {
            font-size: 40px;
            color: #667eea;
            margin-bottom: 16px;
        }
        .dash-card h3 {
            margin: 0 0 10px 0;
            font-size: 20px;
            color: #222;
        }
        .dash-card .count {
            font-size: 22px;
            color: #764ba2;
            font-weight: bold;
            margin-bottom: 8px;
        }
        .dash-card .desc {
            color: #555;
            font-size: 15px;
        }
        /* Busca estilo index */
        .search-container {
            width: 100%;
            max-width: 600px;
            margin: 38px auto 0 auto;
            position: relative;
            display: flex;
            align-items: center;
        }
        .search-box {
            width: 100%;
            padding: 12px 50px 12px 20px;
            border: 2px solid #e0e0e0;
            border-radius: 25px;
            font-size: 16px;
            transition: all 0.3s ease;
            background: #f7f8fa;
        }
        .search-box:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }
        .search-btn {
            position: absolute;
            right: 5px;
            top: 50%;
            transform: translateY(-50%);
            background: linear-gradient(45deg, #667eea, #764ba2);
            border: none;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            color: white;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
        }
        .search-btn:hover {
            transform: translateY(-50%) scale(1.1);
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        }
        @media (max-width: 700px) {
            .container { padding: 10px 2vw 30px 2vw; }
            .dashboard { gap: 14px; }
            .dash-card { min-height: 120px; }
            .user-header { flex-direction: column; align-items: flex-start; }
            .user-actions { margin-top: 12px; }
            .logout-btn, .voltar-btn { margin-left: 0; margin-top: 8px; width: 100%; }
            .user-header-divider { margin-bottom: 18px; margin-top: 12px; }
            .search-container { max-width: 100%; }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="user-header">
            <div class="user-avatar">
                <i class="fas fa-user"></i>
            </div>
            <div class="user-info">
                <h2>Olá, <?= htmlspecialchars($user_data['nome']) ?>!</h2>
                <p><?= htmlspecialchars($user_data['email']) ?></p>
            </div>
            <div class="user-actions">
                <form method="post" style="display:inline;">
                    <button class="logout-btn" type="submit" name="logout"><i class="fas fa-sign-out-alt"></i> Sair</button>
                </form>
                <a href="index.php" class="voltar-btn" style="text-decoration:none; display:inline-block;">
                    <i class="fas fa-arrow-left"></i> Voltar para Home
                </a>
            </div>
        </div>
        <div class="user-header-divider"></div>
        <div class="dashboard">
            <div class="dash-card" onclick="window.location='meus_pedidos.php';">
                <div class="icon"><i class="fas fa-box-open"></i></div>
                <div class="count"><?= $pedidos ?></div>
                <h3>Meus Pedidos</h3>
                <div class="desc">Acompanhe seus pedidos, status e detalhes de compra.</div>
            </div>
            <div class="dash-card" onclick="window.location='meus_dados.php';">
                <div class="icon"><i class="fas fa-id-card"></i></div>
                <h3>Meus Dados</h3>
                <div class="desc">Atualize seu nome, email e senha.</div>
            </div>
            <div class="dash-card" onclick="window.location='meus_enderecos.php';">
                <div class="icon"><i class="fas fa-map-marker-alt"></i></div>
                <div class="count"><?= $enderecos ?></div>
                <h3>Meus Endereços</h3>
                <div class="desc">Gerencie seus endereços de entrega.</div>
            </div>
            <div class="dash-card" onclick="window.location='central_ajuda.php';">
                <div class="icon"><i class="fas fa-headset"></i></div>
                <h3>Central de Ajuda</h3>
                <div class="desc">Dúvidas? Acesse nossos canais de atendimento.</div>
            </div>
        </div>
        <!-- Bloco de busca abaixo das 4 caixas -->
        <div class="search-container">
            <input type="text" class="search-box" placeholder="Buscar produtos, marcas, lojas...">
            <button class="search-btn">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </div>
    <script>
        // Search functionality
        const searchBtn = document.querySelector('.search-btn');
        const searchBox = document.querySelector('.search-box');
        searchBtn.addEventListener('click', function() {
            const searchTerm = searchBox.value.trim();
            if (searchTerm) {
                alert(`Buscando por: ${searchTerm}`);
                // Aqui você implementaria a busca real (redirecionar, AJAX, etc)
            }
        });
        searchBox.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') { searchBtn.click(); }
        });
    </script>
</body>
</html>