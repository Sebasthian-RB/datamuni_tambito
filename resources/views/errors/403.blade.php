<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso Denegado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body {
            background: linear-gradient(135deg, #ffe3e3 0%, #f8d7da 100%);
            color: #2c0b0e;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        
        .error-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 2.5rem;
            box-shadow: 0 8px 32px rgba(220, 53, 69, 0.1);
            border: 1px solid rgba(220, 53, 69, 0.1);
            max-width: 500px;
            width: 100%;
            transition: transform 0.3s ease;
            animation: cardEnter 0.6s cubic-bezier(0.22, 1, 0.36, 1);
        }
        
        .error-icon {
            font-size: 4.5rem;
            color: #dc3545;
            margin-bottom: 1.5rem;
            animation: shake 1.5s ease infinite;
        }
        
        h1 {
            font-weight: 700;
            letter-spacing: -0.03em;
            margin-bottom: 1rem;
            font-size: 2.2rem;
        }
        
        .lead {
            font-size: 1.1rem;
            line-height: 1.6;
            margin-bottom: 2rem;
            color: #5c5c5c;
        }
        
        .btn-danger {
            padding: 0.8rem 1.5rem;
            font-weight: 500;
            border-radius: 12px;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: #dc3545;
            border: none;
        }
        
        .btn-danger:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(220, 53, 69, 0.3);
        }
        
        .error-image {
            border-radius: 12px;
            margin: 2rem 0;
            border: 2px solid rgba(220, 53, 69, 0.1);
        }
        
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-8px); }
            75% { transform: translateX(8px); }
        }
        
        @keyframes cardEnter {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @media (max-width: 576px) {
            .error-card {
                padding: 1.5rem;
            }
            h1 {
                font-size: 1.8rem;
            }
        }
    </style>
</head>
<body>
    <div class="error-card">
        <i class="bi bi-exclamation-triangle-fill error-icon"></i>
        <h1>Acceso Restringido</h1>
        <p class="lead">Lo sentimos, no cuentas con los permisos necesarios para acceder a este recurso. Por favor contacta al administrador del sistema si necesitas acceso.</p>
        <img src="{{ asset('Images/access_denied.jpg') }}" alt="Acceso Denegado" class="error-image img-fluid">
        <div class="d-grid">
            <a href="javascript:history.back()" class="btn btn-danger">
                <i class="bi bi-arrow-left-short"></i>
                Volver
            </a>
        </div>
    </div>
</body>
</html>