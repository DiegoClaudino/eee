<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ProMarket Brasil - Compre e Venda Online</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        /* Header */
        .header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }
        .header-top {
            padding: 10px 0;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }
        .header-top-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 13px;
            color: #666;
        }
        .header-main { padding: 15px 0; }
        .header-content {
            display: flex;
            align-items: center;
            gap: 30px;
        }
        .logo {
            font-size: 28px;
            font-weight: bold;
            background: linear-gradient(45deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .search-container {
            flex: 1;
            position: relative;
            max-width: 600px;
        }
        .search-box {
            width: 100%;
            padding: 12px 50px 12px 20px;
            border: 2px solid #e0e0e0;
            border-radius: 25px;
            font-size: 16px;
            transition: all 0.3s ease;
            background: white;
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
        }
        .search-btn:hover {
            transform: translateY(-50%) scale(1.1);
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        }
        .header-actions {
            display: flex;
            gap: 20px;
            align-items: center;
        }
        .header-btn {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            background: transparent;
            border: 2px solid #667eea;
            border-radius: 25px;
            color: #667eea;
            text-decoration: none;
            transition: all 0.3s ease;
            font-weight: 500;
        }
        .header-btn:hover {
            background: #667eea;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }
        .header-btn.primary {
            background: linear-gradient(45deg, #667eea, #764ba2);
            color: white;
            border-color: transparent;
        }
        .header-btn.primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 20px rgba(102, 126, 234, 0.4);
        }
        /* Navigation */
        .nav {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            padding: 15px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }
        .nav-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .nav-links {
            display: flex;
            gap: 30px;
            list-style: none;
        }
        .nav-links a {
            text-decoration: none;
            color: #333;
            font-weight: 500;
            transition: all 0.3s ease;
            position: relative;
        }
        .nav-links a:hover { color: #667eea; }
        .nav-links a::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(45deg, #667eea, #764ba2);
            transition: width 0.3s ease;
        }
        .nav-links a:hover::after { width: 100%; }
        /* Hero Section */
        .hero {
            padding: 60px 0;
            text-align: center;
            color: white;
        }
        .hero h1 {
            font-size: 48px;
            margin-bottom: 20px;
            font-weight: 700;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }
        .hero p {
            font-size: 20px;
            margin-bottom: 40px;
            opacity: 0.9;
        }
        .hero-buttons {
            display: flex;
            gap: 20px;
            justify-content: center;
            flex-wrap: wrap;
        }
        .hero-btn {
            padding: 15px 30px;
            border: none;
            border-radius: 30px;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }
        .hero-btn.primary {
            background: rgba(255, 255, 255, 0.9);
            color: #667eea;
            backdrop-filter: blur(10px);
        }
        .hero-btn.primary:hover {
            background: white;
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }
        .hero-btn.secondary {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border: 2px solid white;
            backdrop-filter: blur(10px);
        }
        .hero-btn.secondary:hover {
            background: white;
            color: #667eea;
            transform: translateY(-3px);
        }
        /* Categories */
        .categories {
            background: white;
            padding: 60px 0;
            margin-top: -30px;
            border-radius: 30px 30px 0 0;
        }
        .section-title {
            text-align: center;
            font-size: 36px;
            font-weight: 700;
            margin-bottom: 50px;
            color: #333;
        }
        .categories-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 30px;
        }
        .category-card {
            background: white;
            border-radius: 20px;
            padding: 30px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            border: 2px solid transparent;
            cursor: pointer;
        }
        .category-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
            border-color: #667eea;
        }
        .category-icon {
            font-size: 48px;
            margin-bottom: 20px;
            background: linear-gradient(45deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .category-card h3 {
            font-size: 20px;
            margin-bottom: 10px;
            color: #333;
        }
        .category-card p {
            color: #666;
            font-size: 14px;
        }
        /* Featured Products */
        .featured-products {
            background: #f8f9fa;
            padding: 60px 0;
        }
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 30px;
        }
        .product-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            cursor: pointer;
        }
        .product-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }
        .product-image {
            width: 100%;
            height: 200px;
            background: linear-gradient(45deg, #667eea, #764ba2);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 48px;
        }
        .product-info { padding: 20px; }
        .product-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 10px;
            color: #333;
        }
        .product-price {
            font-size: 24px;
            font-weight: 700;
            color: #667eea;
            margin-bottom: 10px;
        }
        .product-rating {
            display: flex;
            align-items: center;
            gap: 5px;
            margin-bottom: 15px;
        }
        .stars { color: #ffc107; }
        .product-btn {
            width: 100%;
            padding: 12px;
            background: linear-gradient(45deg, #667eea, #764ba2);
            color: white;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .product-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }
        /* Stats Section */
        .stats {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 80px 0;
            color: white;
        }
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 50px;
            text-align: center;
        }
        .stat-item h3 {
            font-size: 48px;
            font-weight: 700;
            margin-bottom: 10px;
        }
        .stat-item p {
            font-size: 18px;
            opacity: 0.9;
        }
        /* Footer */
        .footer {
            background: #222;
            color: white;
            padding: 60px 0 20px;
        }
        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 40px;
            margin-bottom: 40px;
        }
        .footer-section h3 {
            font-size: 20px;
            margin-bottom: 20px;
            color: #667eea;
        }
        .footer-section ul { list-style: none; }
        .footer-section ul li { margin-bottom: 10px; }
        .footer-section ul li a {
            color: #ccc;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        .footer-section ul li a:hover { color: #667eea; }
        .footer-bottom {
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid #444;
            color: #999;
        }
        @media (max-width: 768px) {
            .header-content { flex-direction: column; gap: 20px; }
            .search-container { max-width: 100%; }
            .header-actions { flex-wrap: wrap; justify-content: center; }
            .nav-links { display: none; }
            .hero h1 { font-size: 36px; }
            .hero-buttons { flex-direction: column; align-items: center; }
            .section-title { font-size: 28px; }
            .categories-grid { grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 20px; }
            .products-grid { grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; }
            .stats-grid { grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 30px; }
        }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px);}
            to { opacity: 1; transform: translateY(0);}
        }
        .category-card, .product-card { animation: fadeInUp 0.6s ease forwards; }
        .category-card:nth-child(odd) { animation-delay: 0.1s; }
        .category-card:nth-child(even) { animation-delay: 0.2s; }
        .product-card:nth-child(1) { animation-delay: 0.1s; }
        .product-card:nth-child(2) { animation-delay: 0.2s; }
        .product-card:nth-child(3) { animation-delay: 0.3s; }
        .product-card:nth-child(4) { animation-delay: 0.4s; }
        .product-card:nth-child(5) { animation-delay: 0.5s; }
        .product-card:nth-child(6) { animation-delay: 0.6s; }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="header-top">
            <div class="container">
                <div class="header-top-content">
                    <span>📍 Entregamos em todo o Brasil</span>
                    <span>📞 Central de Atendimento: 0800-123-4567</span>
                </div>
            </div>
        </div>
        <div class="header-main">
            <div class="container">
                <div class="header-content">
                    <div class="logo">
                        <i class="fas fa-store"></i> MarketPlace Brasil
                    </div>
                    <div class="search-container">
                        <input type="text" class="search-box" placeholder="Buscar produtos, marcas, lojas...">
                        <button class="search-btn">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
<div class="header-actions">
    <?php
    if (!empty($_SESSION['user_id'])): // Agora usamos user_id e user_tipo ?>
        <?php
        if ($_SESSION['user_tipo'] === 'comprador') {
            echo '<a href="painel_comprador.php" class="header-btn primary"><i class="fas fa-user"></i> Painel Comprador</a>';
        } elseif ($_SESSION['user_tipo'] === 'vendedor') {
            echo '<a href="painel_vendedor.php" class="header-btn primary"><i class="fas fa-store"></i> Painel Vendedor</a>';
        } elseif ($_SESSION['user_tipo'] === 'ambos') {
            echo '<a href="painel_comprador.php" class="header-btn primary"><i class="fas fa-user"></i> Painel Comprador</a>';
            echo '<a href="painel_vendedor.php" class="header-btn primary"><i class="fas fa-store"></i> Painel Vendedor</a>';
        }
        ?>
    <?php else: ?>
        <a href="login_cadastro.php" class="header-btn">
            <i class="fas fa-user"></i> Entrar
        </a>
    <?php endif; ?>
    <a href="#" class="header-btn">
        <i class="fas fa-shopping-cart"></i> Carrinho
    </a>
</div>
                </div>
            </div>
        </div>
    </header>
    <!-- Navigation -->
    <nav class="nav">
        <div class="container">
            <div class="nav-content">
                <ul class="nav-links">
                    <li><a href="#"><i class="fas fa-home"></i> Início</a></li>
                    <li><a href="#"><i class="fas fa-tags"></i> Ofertas</a></li>
                    <li><a href="#"><i class="fas fa-star"></i> Mais Vendidos</a></li>
                    <li><a href="#"><i class="fas fa-truck"></i> Frete Grátis</a></li>
                    <li><a href="#"><i class="fas fa-mobile-alt"></i> Eletrônicos</a></li>
                    <li><a href="#"><i class="fas fa-tshirt"></i> Moda</a></li>
                    <li><a href="#"><i class="fas fa-home"></i> Casa</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <h1>Compre e Venda com Segurança</h1>
            <p>O maior marketplace do Brasil. Milhões de produtos com os melhores preços e frete grátis.</p>
            <div class="hero-buttons">
                <a href="login_cadastro.php" class="hero-btn primary" <?php if (!empty($_SESSION['usuario_logado'])) echo 'style="display:none;"'; ?>>
                    <i class="fas fa-shopping-bag"></i> Começar a Comprar
                </a>
                <a href="login_cadastro.php" class="hero-btn secondary">
                    <i class="fas fa-store"></i> Começar a Vender
                </a>
                <?php if (!empty($_SESSION['usuario_logado'])): ?>
                    <a href="painel_usuario.php" class="hero-btn secondary">
                        <i class="fas fa-user"></i> Meu Painel
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </section>
    <!-- Categories -->
    <section class="categories">
        <div class="container">
            <h2 class="section-title">Categorias Populares</h2>
            <div class="categories-grid">
                <div class="category-card">
                    <div class="category-icon"><i class="fas fa-mobile-alt"></i></div>
                    <h3>Eletrônicos</h3>
                    <p>Smartphones, tablets, notebooks e mais</p>
                </div>
                <div class="category-card">
                    <div class="category-icon"><i class="fas fa-tshirt"></i></div>
                    <h3>Moda</h3>
                    <p>Roupas, calçados e acessórios</p>
                </div>
                <div class="category-card">
                    <div class="category-icon"><i class="fas fa-home"></i></div>
                    <h3>Casa & Jardim</h3>
                    <p>Decoração, móveis e utilidades</p>
                </div>
                <div class="category-card">
                    <div class="category-icon"><i class="fas fa-dumbbell"></i></div>
                    <h3>Esportes</h3>
                    <p>Equipamentos e roupas esportivas</p>
                </div>
                <div class="category-card">
                    <div class="category-icon"><i class="fas fa-car"></i></div>
                    <h3>Automotivo</h3>
                    <p>Peças, acessórios e ferramentas</p>
                </div>
                <div class="category-card">
                    <div class="category-icon"><i class="fas fa-baby"></i></div>
                    <h3>Bebês</h3>
                    <p>Produtos para mamães e bebês</p>
                </div>
            </div>
        </div>
    </section>
    <!-- Featured Products -->
    <section class="featured-products">
        <div class="container">
            <h2 class="section-title">Produtos em Destaque</h2>
            <div class="products-grid">
                <div class="product-card">
                    <div class="product-image"><i class="fas fa-mobile-alt"></i></div>
                    <div class="product-info">
                        <h3 class="product-title">Smartphone Galaxy Ultra</h3>
                        <div class="product-price">R$ 2.499,00</div>
                        <div class="product-rating"><span class="stars">★★★★★</span><span>(4.8) 1.234 avaliações</span></div>
                        <button class="product-btn">Comprar Agora</button>
                    </div>
                </div>
                <div class="product-card">
                    <div class="product-image"><i class="fas fa-laptop"></i></div>
                    <div class="product-info">
                        <h3 class="product-title">Notebook Gamer Pro</h3>
                        <div class="product-price">R$ 3.999,00</div>
                        <div class="product-rating"><span class="stars">★★★★★</span><span>(4.9) 876 avaliações</span></div>
                        <button class="product-btn">Comprar Agora</button>
                    </div>
                </div>
                <div class="product-card">
                    <div class="product-image"><i class="fas fa-headphones"></i></div>
                    <div class="product-info">
                        <h3 class="product-title">Fone Bluetooth Premium</h3>
                        <div class="product-price">R$ 299,00</div>
                        <div class="product-rating"><span class="stars">★★★★☆</span><span>(4.6) 2.156 avaliações</span></div>
                        <button class="product-btn">Comprar Agora</button>
                    </div>
                </div>
                <div class="product-card">
                    <div class="product-image"><i class="fas fa-camera"></i></div>
                    <div class="product-info">
                        <h3 class="product-title">Câmera Digital 4K</h3>
                        <div class="product-price">R$ 1.899,00</div>
                        <div class="product-rating"><span class="stars">★★★★★</span><span>(4.7) 543 avaliações</span></div>
                        <button class="product-btn">Comprar Agora</button>
                    </div>
                </div>
                <div class="product-card">
                    <div class="product-image"><i class="fas fa-gamepad"></i></div>
                    <div class="product-info">
                        <h3 class="product-title">Console Gaming Next-Gen</h3>
                        <div class="product-price">R$ 2.799,00</div>
                        <div class="product-rating"><span class="stars">★★★★★</span><span>(4.9) 3.421 avaliações</span></div>
                        <button class="product-btn">Comprar Agora</button>
                    </div>
                </div>
                <div class="product-card">
                    <div class="product-image"><i class="fas fa-watch"></i></div>
                    <div class="product-info">
                        <h3 class="product-title">Smartwatch Fitness</h3>
                        <div class="product-price">R$ 599,00</div>
                        <div class="product-rating"><span class="stars">★★★★☆</span><span>(4.5) 1.876 avaliações</span></div>
                        <button class="product-btn">Comprar Agora</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Stats Section -->
    <section class="stats">
        <div class="container">
            <div class="stats-grid">
                <div class="stat-item"><h3>10M+</h3><p>Produtos Disponíveis</p></div>
                <div class="stat-item"><h3>500K+</h3><p>Lojas Parceiras</p></div>
                <div class="stat-item"><h3>50M+</h3><p>Usuários Registrados</p></div>
                <div class="stat-item"><h3>99.9%</h3><p>Satisfação do Cliente</p></div>
            </div>
        </div>
    </section>
    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>Sobre o MarketPlace</h3>
                    <ul>
                        <li><a href="#">Quem Somos</a></li>
                        <li><a href="#">Trabalhe Conosco</a></li>
                        <li><a href="#">Investidores</a></li>
                        <li><a href="#">Sustentabilidade</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h3>Atendimento</h3>
                    <ul>
                        <li><a href="#">Central de Ajuda</a></li>
                        <li><a href="#">Como Comprar</a></li>
                        <li><a href="#">Como Vender</a></li>
                        <li><a href="#">Política de Privacidade</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h3>Pagamento</h3>
                    <ul>
                        <li><a href="#">Cartão de Crédito</a></li>
                        <li><a href="#">Boleto Bancário</a></li>
                        <li><a href="#">PIX</a></li>
                        <li><a href="#">Marketplace Pay</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h3>Redes Sociais</h3>
                    <ul>
                        <li><a href="#"><i class="fab fa-facebook"></i> Facebook</a></li>
                        <li><a href="#"><i class="fab fa-instagram"></i> Instagram</a></li>
                        <li><a href="#"><i class="fab fa-twitter"></i> Twitter</a></li>
                        <li><a href="#"><i class="fab fa-youtube"></i> YouTube</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2025 MarketPlace Brasil. Todos os direitos reservados.</p>
            </div>
        </div>
    </footer>
    <script>
        // Smooth scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
        // Search functionality
        const searchBtn = document.querySelector('.search-btn');
        const searchBox = document.querySelector('.search-box');
        searchBtn.addEventListener('click', function() {
            const searchTerm = searchBox.value.trim();
            if (searchTerm) {
                alert(`Buscando por: ${searchTerm}`);
                // Aqui você implementaria a busca real
            }
        });
        searchBox.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') { searchBtn.click(); }
        });
        // Product cards interaction
        document.querySelectorAll('.product-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const productTitle = this.closest('.product-card').querySelector('.product-title').textContent;
                alert(`Produto "${productTitle}" adicionado ao carrinho!`);
            });
        });
        // Category cards interaction
        document.querySelectorAll('.category-card').forEach(card => {
            card.addEventListener('click', function() {
                const categoryName = this.querySelector('h3').textContent;
                alert(`Navegando para categoria: ${categoryName}`);
            });
        });
        // Footer links externos
        document.querySelectorAll('.footer-section ul li a').forEach(link => {
            link.addEventListener('click', function(e) {
                if(this.getAttribute('href') === "#") {
                    e.preventDefault();
                    alert('Página ainda não implementada.');
                }
            });
        });
        window.addEventListener('DOMContentLoaded', () => {
            setTimeout(() => {
                // alert('Bem-vindo ao MarketPlace Brasil! Aproveite as ofertas.');
            }, 800);
        });
    </script>

    <!-- Sidebar do Carrinho de Compras (Profissional e Completo) -->
<style>
/* --- Sidebar Carrinho --- */
.carrinho-backdrop {
    position: fixed;
    inset: 0;
    background: rgba(34, 34, 34, 0.30);
    z-index: 2000;
    opacity: 0;
    pointer-events: none;
    transition: opacity 0.25s;
}
.carrinho-backdrop.active {
    opacity: 1;
    pointer-events: auto;
}
.sidebar-carrinho {
    position: fixed;
    top: 0;
    right: -440px;
    width: 420px;
    max-width: 97vw;
    height: 100vh;
    background: #fff;
    box-shadow: -2px 0 24px rgba(102,126,234,0.17);
    z-index: 2100;
    display: flex;
    flex-direction: column;
    transition: right 0.33s cubic-bezier(.55,.13,.43,1.13);
}
.sidebar-carrinho.active { right: 0; }
.sidebar-carrinho-header {
    padding: 20px 28px 12px 28px;
    border-bottom: 1.5px solid #f1f1f1;
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: linear-gradient(90deg, #667eea10 0%, #764ba215 100%);
}
.sidebar-carrinho-header h2 {
    margin: 0;
    font-size: 22px;
    color: #667eea;
    font-weight: 700;
    display: flex;
    align-items: center;
    gap: 12px;
}
.sidebar-carrinho-close {
    background: none;
    border: none;
    font-size: 28px;
    color: #888;
    cursor: pointer;
    transition: color 0.18s;
    padding: 4px;
}
.sidebar-carrinho-close:hover { color: #f44336; }
.sidebar-carrinho-content {
    flex: 1;
    overflow-y: auto;
    padding: 20px 28px 0 28px;
    display: flex;
    flex-direction: column;
    gap: 18px;
}
.carrinho-vazio {
    text-align: center;
    color: #bbb;
    padding: 60px 0 30px 0;
    font-size: 17px;
}
.carrinho-lista {
    display: flex;
    flex-direction: column;
    gap: 18px;
}
.carrinho-item {
    display: flex;
    align-items: flex-start;
    gap: 15px;
    padding-bottom: 16px;
    border-bottom: 1px solid #f3f3f3;
    position: relative;
}
.carrinho-item:last-child { border-bottom: none; }
.carrinho-item-img {
    width: 68px;
    height: 68px;
    border-radius: 8px;
    object-fit: cover;
    background: #f6f6fa;
    border: 1.5px solid #eee;
}
.carrinho-item-info {
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 5px;
}
.carrinho-item-title {
    font-size: 16px;
    font-weight: 600;
    color: #2e2e53;
}
.carrinho-item-details {
    font-size: 13px;
    color: #888;
}
.carrinho-item-preco {
    font-size: 15px;
    color: #764ba2;
    font-weight: 700;
}
.carrinho-item-qtd {
    display: flex;
    align-items: center;
    gap: 7px;
    margin-top: 2px;
}
.qtd-btn {
    width: 24px;
    height: 24px;
    border-radius: 6px;
    border: 1.5px solid #e0e0e0;
    background: #f6f7fb;
    color: #667eea;
    font-size: 17px;
    font-weight: bold;
    cursor: pointer;
    transition: background 0.18s, border 0.18s;
}
.qtd-btn:hover {
    background: #eceaff;
    border-color: #667eea;
}
.carrinho-item-remove {
    position: absolute;
    top: 4px;
    right: 0;
    background: none;
    border: none;
    color: #f44336;
    font-size: 16px;
    cursor: pointer;
    padding: 4px;
    transition: color 0.15s;
}
.carrinho-item-remove:hover { color: #b80000; }
.sidebar-carrinho-footer {
    padding: 22px 28px 22px 28px;
    border-top: 1.5px solid #f1f1f1;
    background: #fff;
    box-shadow: 0 -2px 16px rgba(102,126,234,0.07);
}
.carrinho-resumo {
    font-size: 16px;
    margin-bottom: 13px;
}
.carrinho-resumo .label {
    color: #777; font-weight: 500;
}
.carrinho-resumo .valor {
    color: #667eea;
    font-weight: bold;
    float: right;
}
.carrinho-btn-finalizar {
    width: 100%;
    padding: 14px 0;
    border-radius: 10px;
    border: none;
    background: linear-gradient(45deg, #667eea, #764ba2);
    color: #fff;
    font-size: 19px;
    font-weight: 700;
    cursor: pointer;
    box-shadow: 0 5px 18px rgba(102,126,234,0.10);
    margin-top: 4px;
    transition: background 0.19s, box-shadow 0.14s;
}
.carrinho-btn-finalizar:hover {
    background: linear-gradient(45deg, #564bb1, #6d479a);
    box-shadow: 0 8px 30px rgba(102,126,234,0.13);
}
.carrinho-link-resumo {
    color: #667eea;
    font-size: 13px;
    text-decoration: underline;
    display: inline-block;
    margin-bottom: 10px;
    cursor: pointer;
}
@media (max-width: 600px) {
    .sidebar-carrinho, .sidebar-carrinho-header, .sidebar-carrinho-content, .sidebar-carrinho-footer {
        padding-left: 10px;
        padding-right: 10px;
    }
    .sidebar-carrinho { width: 98vw; max-width: none; }
}
</style>
<div class="carrinho-backdrop" id="carrinho-backdrop"></div>
<aside class="sidebar-carrinho" id="sidebar-carrinho" aria-label="Carrinho de compras" tabindex="-1">
    <div class="sidebar-carrinho-header">
        <h2><i class="fas fa-shopping-cart"></i> Seu Carrinho</h2>
        <button class="sidebar-carrinho-close" id="carrinho-fechar" aria-label="Fechar carrinho">
            <i class="fas fa-times"></i>
        </button>
    </div>
    <div class="sidebar-carrinho-content">
        <div class="carrinho-vazio" id="carrinho-vazio" style="display:none;">
            <i class="fas fa-shopping-basket fa-2x" style="color:#bbb;margin-bottom:8px;"></i><br>
            Seu carrinho está vazio.<br>
            Adicione produtos para visualizar aqui.
        </div>
        <div class="carrinho-lista" id="carrinho-lista">
            <!-- Itens do carrinho serão renderizados aqui via JS -->
        </div>
    </div>
    <div class="sidebar-carrinho-footer">
        <div class="carrinho-resumo">
            <span class="label">Subtotal</span>
            <span class="valor" id="carrinho-subtotal">R$ 0,00</span>
        </div>
        <div class="carrinho-resumo" style="font-size:15px;">
            <span class="label">Frete estimado</span>
            <span class="valor" id="carrinho-frete">R$ 0,00</span>
        </div>
        <div class="carrinho-resumo" style="font-size:18px;font-weight:700;">
            <span class="label">Total</span>
            <span class="valor" id="carrinho-total">R$ 0,00</span>
        </div>
        <button class="carrinho-btn-finalizar" id="btn-finalizar-carrinho">
            <i class="fas fa-credit-card"></i> Finalizar Compra
        </button>
    </div>
</aside>
<script>
// Utilidades de preço
function formatPrice(valor) {
    return "R$ " + valor.toFixed(2).replace('.', ',');
}

// Estado fictício do carrinho (pode ser substituído por localStorage/backend)
let carrinho = JSON.parse(localStorage.getItem('carrinhoMPBR')) || [];

// Renderiza itens do carrinho
function renderCarrinho() {
    const carrinhoLista = document.getElementById('carrinho-lista');
    const carrinhoVazio = document.getElementById('carrinho-vazio');
    carrinhoLista.innerHTML = '';
    if (!carrinho || carrinho.length === 0) {
        carrinhoVazio.style.display = 'block';
        return;
    }
    carrinhoVazio.style.display = 'none';
    carrinho.forEach((item, idx) => {
        let div = document.createElement('div');
        div.className = 'carrinho-item';
        div.innerHTML = `
            <img src="${item.img || 'https://via.placeholder.com/68x68?text=IMG'}" class="carrinho-item-img" alt="Imagem do produto">
            <div class="carrinho-item-info">
                <span class="carrinho-item-title">${item.titulo}</span>
                <span class="carrinho-item-details">
                    ${item.variante ? 'Variante: ' + item.variante + ' | ' : ''} 
                    ${item.vendedor ? 'Vendedor: ' + item.vendedor : ''}
                </span>
                <span class="carrinho-item-preco">${formatPrice(item.preco)} x ${item.qtd}</span>
                <div class="carrinho-item-qtd">
                    <button class="qtd-btn" onclick="alterarQtdCarrinho(${idx}, -1)" aria-label="Diminuir quantidade">-</button>
                    <span>${item.qtd}</span>
                    <button class="qtd-btn" onclick="alterarQtdCarrinho(${idx}, 1)" aria-label="Aumentar quantidade">+</button>
                </div>
            </div>
            <button class="carrinho-item-remove" onclick="removerItemCarrinho(${idx})" aria-label="Remover item">
                <i class="fas fa-trash"></i>
            </button>
        `;
        carrinhoLista.appendChild(div);
    });
    atualizarResumoCarrinho();
}

// Atualiza valores do resumo
function atualizarResumoCarrinho() {
    let subtotal = 0;
    carrinho.forEach(item => subtotal += item.preco * item.qtd);
    let frete = subtotal > 300 ? 0 : (subtotal > 0 ? 24.90 : 0); // Exemplo: frete grátis acima de 300
    let total = subtotal + frete;
    document.getElementById('carrinho-subtotal').textContent = formatPrice(subtotal);
    document.getElementById('carrinho-frete').textContent = formatPrice(frete);
    document.getElementById('carrinho-total').textContent = formatPrice(total);
}

// Adiciona produto ao carrinho
function adicionarAoCarrinho(produto) {
    // produto: {titulo, preco, img, variante, vendedor, qtd}
    let idx = carrinho.findIndex(item => item.titulo === produto.titulo && item.variante === produto.variante);
    if (idx > -1) {
        carrinho[idx].qtd += produto.qtd || 1;
    } else {
        carrinho.push({...produto, qtd: produto.qtd || 1});
    }
    localStorage.setItem('carrinhoMPBR', JSON.stringify(carrinho));
    renderCarrinho();
    abrirCarrinho();
}

// Altera quantidade
function alterarQtdCarrinho(idx, delta) {
    if (!carrinho[idx]) return;
    carrinho[idx].qtd += delta;
    if (carrinho[idx].qtd < 1) carrinho[idx].qtd = 1;
    localStorage.setItem('carrinhoMPBR', JSON.stringify(carrinho));
    renderCarrinho();
}

// Remove item
function removerItemCarrinho(idx) {
    if (!carrinho[idx]) return;
    carrinho.splice(idx, 1);
    localStorage.setItem('carrinhoMPBR', JSON.stringify(carrinho));
    renderCarrinho();
}

// Abre/fecha carrinho
function abrirCarrinho() {
    document.getElementById('carrinho-backdrop').classList.add('active');
    document.getElementById('sidebar-carrinho').classList.add('active');
    document.body.style.overflow = 'hidden';
}
function fecharCarrinho() {
    document.getElementById('carrinho-backdrop').classList.remove('active');
    document.getElementById('sidebar-carrinho').classList.remove('active');
    document.body.style.overflow = '';
}

// Integrar botões e eventos
document.addEventListener('DOMContentLoaded', function() {
    // Botão carrinho no header
    let btnCarrinho = document.querySelector('.header-btn .fa-shopping-cart')?.parentNode;
    if (btnCarrinho) {
        btnCarrinho.setAttribute('href', 'javascript:void(0)');
        btnCarrinho.onclick = abrirCarrinho;
    }
    // Botão fechar
    document.getElementById('carrinho-fechar').onclick = fecharCarrinho;
    document.getElementById('carrinho-backdrop').onclick = fecharCarrinho;
    // Finalizar compra
    document.getElementById('btn-finalizar-carrinho').onclick = function() {
        if (!carrinho || carrinho.length === 0) {
            alert('Adicione produtos ao carrinho antes de finalizar a compra.');
            return;
        }
        // Aqui você pode redirecionar para uma página de checkout real
        alert('Checkout não implementado.\nSimulação: ' + JSON.stringify(carrinho, null, 2));
        fecharCarrinho();
    };
    // Render inicial
    renderCarrinho();
});

// Exemplo: Integração com botões "Comprar Agora"
document.querySelectorAll('.product-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        const card = btn.closest('.product-card');
        const titulo = card.querySelector('.product-title').textContent;
        const preco = Number(card.querySelector('.product-price').textContent.replace(/[^\d,]/g,'').replace(',','.'));
        let img = card.querySelector('img')?.src || '';
        if (!img) {
            let ic = card.querySelector('.product-image i');
            if (ic) img = `https://via.placeholder.com/68x68?text=${ic.className.replace('fas fa-','').toUpperCase()}`;
        }
        adicionarAoCarrinho({
            titulo,
            preco,
            img,
            variante: '', // Pode ser adicionado suporte a variantes
            vendedor: '', // Pode ser adicionado suporte ao nome do vendedor
            qtd: 1
        });
    });
});
</script>
</body>
</html>