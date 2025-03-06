<style>
    /* Botón Flotante */
    .creators-container {
        position: fixed;
        bottom: 30px;
        right: 30px;
        z-index: 9999;
    }

    .creators-btn {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: #005293;
        border: 2px solid #E1AD01;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .creators-btn:hover {
        opacity: 1;
        transform: scale(1.1) rotate(15deg);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
    }

    /* Modal */
    #creatorsModal .modal-content {
        border-radius: 15px;
        border: none;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    }

    #creatorsModal .modal-header {
        background: #005293;
        padding: 1.5rem;
        position: relative;
    }

    #creatorsModal .modal-title {
        color: #fff;
        font-weight: 500;
        font-size: 1.3rem;
        letter-spacing: 0.5px;
    }

    .btn-close-custom {
        position: absolute;
        top: 15px;
        right: 15px;
        background: transparent;
        border: none;
        color: #E1AD01;
        font-size: 1.5rem;
        opacity: 0.8;
        transition: opacity 0.2s ease;
        padding: 2px;
        line-height: 0.9;
    }

    .btn-close-custom:hover {
        opacity: 1;
        color: #fff;
    }

    #creatorsModal .modal-body {
        padding: 2rem 1.5rem;
        background: #f8fafb;
    }

    .dev-item {
        padding: 1rem;
        margin: 0.5rem 0;
        border-radius: 8px;
        transition: background 0.2s ease;
        display: flex;
        align-items: center;
    }

    .dev-item:hover {
        background: rgba(0, 82, 147, 0.05);
    }

    .dev-icon {
        width: 40px;
        height: 40px;
        background: #005293;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1rem;
    }

    .dev-icon i {
        color: #E1AD01;
        font-size: 1.1rem;
    }

    .dev-info {
        flex: 1;
    }

    .dev-name {
        color: #2c3e50;
        font-weight: 500;
        margin-bottom: 0.2rem;
    }

    .dev-role {
        color: #7f8c8d;
        font-size: 0.9rem;
        font-weight: 400;
    }

    .uc-badge {
        background: rgba(225, 173, 1, 0.1);
        color: #E1AD01;
        padding: 3px 8px;
        border-radius: 4px;
        font-size: 0.8rem;
        margin-left: 10px;
    }
    .social-icons {
        bottom: 70px;
    }
</style>

<div class="creators-container">
    <button class="creators-btn" data-bs-toggle="modal" data-bs-target="#creatorsModal">
        <i class="fas fa-users"></i>
    </button>
</div>

<div class="modal fade" id="creatorsModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Equipo de Desarrollo</h5>
                <button class="btn-close-custom" data-bs-dismiss="modal" aria-label="Cerrar">
                    &times;
                </button>
            </div>
            <div class="modal-body">
                <div class="dev-item">
                    <div class="dev-icon">
                        <i class="fas fa-user-tie"></i>
                    </div>
                    <div class="dev-info">
                        <span class="dev-name">Paul David Quilca Coronación</span>
                        <div class="dev-role">
                            Jefe de Proyecto
                            <span class="uc-badge">Municipalidad de El Tambo</span>
                        </div>
                    </div>
                </div>

                <div class="dev-item">
                    <div class="dev-icon">
                        <i class="fas fa-code"></i>
                    </div>
                    <div class="dev-info">
                        <span class="dev-name">Yorshyo Artemio Villena Ochoa</span>
                        <div class="dev-role">
                            Desarrollo FullStack
                            <span class="uc-badge">Universidad Continental</span>
                        </div>
                    </div>
                </div>

                <div class="dev-item">
                    <div class="dev-icon">
                        <i class="fas fa-code"></i>
                    </div>
                    <div class="dev-info">
                        <span class="dev-name">Lenin Sebasthian Ramirez Basualdo</span>
                        <div class="dev-role">
                            Desarrollo FullStack
                            <span class="uc-badge">Universidad Continental</span>
                        </div>
                    </div>
                </div>

                <div class="dev-item">
                    <div class="dev-icon">
                        <i class="fas fa-code"></i>
                    </div>
                    <div class="dev-info">
                        <span class="dev-name">Brayan Angel Leon Taza</span>
                        <div class="dev-role">
                            Desarrollo FullStack
                            <span class="uc-badge">Universidad Continental</span>
                        </div>
                    </div>
                </div>

                <div class="dev-item">
                    <div class="dev-icon">
                        <i class="fas fa-code"></i>
                    </div>
                    <div class="dev-info">
                        <span class="dev-name">Jeffrey Salvatierra</span>
                        <div class="dev-role">
                            Desarrollo FullStack
                            <span class="uc-badge">Universidad Continental</span>
                        </div>
                    </div>
                </div>      
            </div>
        </div>
    </div>
</div>
