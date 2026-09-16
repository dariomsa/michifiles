<?php

declare(strict_types=1);

namespace Montala\ResourceSpace\Plugins\BrandGuidelines;

include_once dirname(__DIR__, 3) . '/include/boot.php';
include_once RESOURCESPACE_BASE_PATH . '/include/authenticate.php';

if (!acl_can_view_brand_guidelines()) {
    http_response_code(401);
    exit(escape($lang['error-permissiondenied']));
}

include_once RESOURCESPACE_BASE_PATH . '/include/header.php';
?>
<style>
.rdec-guide {
    max-width: 1180px;
    margin: 24px auto 48px;
    color: #263238;
}
.rdec-hero {
    background: #1f2937;
    color: #fff;
    border-left: 5px solid #0d6efd;
    border-radius: 8px;
    padding: 28px;
    box-shadow: 0 10px 28px rgba(0,0,0,.12);
    display: flex;
    justify-content: space-between;
    gap: 24px;
    align-items: center;
}
.rdec-hero h1 {
    color: #fff;
    margin: 0 0 6px;
    font-size: 32px;
}
.rdec-hero p {
    color: #b8c2cc;
    margin: 0;
}
.rdec-badge {
    background: #0d6efd;
    color: #fff;
    border-radius: 999px;
    padding: 10px 16px;
    font-weight: 700;
    white-space: nowrap;
}
.rdec-alert {
    border: 2px solid #dc3545;
    background: #fff5f5;
    color: #842029;
    border-radius: 8px;
    margin: 24px 0;
    padding: 22px;
    display: flex;
    gap: 16px;
}
.rdec-alert h2 {
    color: #842029;
    margin: 0 0 8px;
    font-size: 21px;
}
.rdec-alert p {
    margin: 0 0 10px;
}
.rdec-tag {
    display: inline-block;
    border-radius: 999px;
    padding: 5px 10px;
    margin: 3px 4px 3px 0;
    font-size: 12px;
    font-weight: 700;
}
.rdec-tag-danger {
    background: #dc3545;
    color: #fff;
}
.rdec-tag-outline {
    border: 1px solid #dc3545;
    color: #dc3545;
    background: #fff;
}
.rdec-card {
    background: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    box-shadow: 0 8px 24px rgba(15,23,42,.07);
    margin-bottom: 24px;
    overflow: hidden;
}
.rdec-card-header {
    color: #fff;
    font-weight: 700;
    padding: 14px 18px;
    font-size: 17px;
}
.rdec-green { background: #198754; }
.rdec-blue { background: #0d6efd; }
.rdec-dark { background: #212529; }
.rdec-cyan { background: #0dcaf0; color: #073642; }
.rdec-card-body {
    padding: 20px;
}
.rdec-table {
    width: 100%;
    border-collapse: collapse;
}
.rdec-table th,
.rdec-table td {
    padding: 14px;
    border-bottom: 1px solid #e5e7eb;
    vertical-align: top;
}
.rdec-table th {
    background: #f8fafc;
    text-align: left;
}
.rdec-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 24px;
}
.rdec-grid-3 {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 16px;
}
.rdec-box {
    background: #f8fafc;
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    padding: 16px;
}
.rdec-list {
    list-style: none;
    padding: 0;
    margin: 0;
}
.rdec-list li {
    border-top: 1px solid #e5e7eb;
    padding: 13px 0;
}
.rdec-list li:first-child {
    border-top: 0;
}
.rdec-muted {
    color: #6b7280;
}
.rdec-footer {
    text-align: center;
    color: #6b7280;
    border-top: 1px solid #e5e7eb;
    padding: 20px 0;
}
@media (max-width: 800px) {
    .rdec-hero,
    .rdec-alert {
        display: block;
    }
    .rdec-badge {
        display: inline-block;
        margin-top: 16px;
    }
    .rdec-grid,
    .rdec-grid-3 {
        grid-template-columns: 1fr;
    }
}
</style>

<div class="rdec-guide">
    <section class="rdec-hero">
        <div>
            <h1>Michipiti FILES</h1>
            <p>Guía y normativa oficial de carga de contenidos y metadatos</p>
        </div>
        <span class="rdec-badge">Manual de Protocolo</span>
    </section>

    <section class="rdec-alert" role="alert">
        <div aria-hidden="true" style="font-size:34px;">!</div>
        <div>
            <h2>LO QUE NO SE PUEDE SUBIR BAJO NINGUNA CIRCUNSTANCIA</h2>
            <p><strong>Ninguna foto o recurso procedente de agencias de noticias internacionales o locales</strong> sin licencia comercial previa.</p>
            <span class="rdec-tag rdec-tag-danger">NO EFE</span>
            <span class="rdec-tag rdec-tag-danger">NO AFP</span>
            <span class="rdec-tag rdec-tag-danger">NO API</span>
            <span class="rdec-tag rdec-tag-outline">Demás agencias</span>
        </div>
    </section>

    <section class="rdec-card">
        <div class="rdec-card-header rdec-green">1. Indicaciones de Fotografía</div>
        <div class="rdec-card-body" style="padding:0;">
            <table class="rdec-table">
                <thead>
                    <tr>
                        <th>Origen de la foto</th>
                        <th>Estatus / Requisito</th>
                        <th>Detalles y Metadatos</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>Imágenes Propias</strong></td>
                        <td>Autoría directa</td>
                        <td>Colocar <strong>autor</strong> y llenar todos los metadatos de origen en el sistema.</td>
                    </tr>
                    <tr>
                        <td><strong>Imágenes de Cortesía</strong></td>
                        <td>Crédito obligatorio</td>
                        <td>Siempre colocar de quién es la foto o institución que la provee.</td>
                    </tr>
                    <tr>
                        <td><strong>Imágenes de Coberturas</strong></td>
                        <td>Cedidas / autorización</td>
                        <td>Colocar respaldo, créditos y <strong>detallar condiciones de uso</strong>.<br><span class="rdec-muted">Ejemplo: "Uso exclusivo de Instagram por una sola vez".</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

    <div class="rdec-grid">
        <section class="rdec-card">
            <div class="rdec-card-header rdec-blue">2. Videografía</div>
            <div class="rdec-card-body">
                <p class="rdec-muted">Se pueden subir videos siempre y cuando se registren con su información completa de clasificación:</p>
                <ul class="rdec-list">
                    <li><strong>Categorías obligatorias</strong><br>Ejemplos: <code>Paisajes de Quito</code>, <code>Verano Quito</code>, <code>Incendio Vicentina</code>.</li>
                    <li><strong>Datos SEO y registro</strong><br>Llenar datos de búsqueda SEO, fecha exacta de captura, ubicación y descripción.</li>
                </ul>
            </div>
        </section>

        <section class="rdec-card">
            <div class="rdec-card-header rdec-dark">3. Diseño e Inteligencia Artificial</div>
            <div class="rdec-card-body">
                <h3>Diseñadores</h3>
                <p class="rdec-muted">Piezas gráficas originales creadas por el equipo de diseño interno.</p>
                <hr>
                <h3>Fotos de Inteligencia Artificial</h3>
                <p class="rdec-muted">Requiere especificar rigurosamente:</p>
                <span class="rdec-tag rdec-tag-outline">Uso destinado</span>
                <span class="rdec-tag rdec-tag-outline">Categoría especial IA</span>
                <span class="rdec-tag rdec-tag-outline">Referencia / herramienta / prompt</span>
            </div>
        </section>
    </div>

    <section class="rdec-card">
        <div class="rdec-card-header rdec-cyan">4. Audiovisuales y Pistas de Audio</div>
        <div class="rdec-card-body">
            <p>Aplica para audios musicalizados destinados a video o podcast:</p>
            <div class="rdec-grid-3">
                <div class="rdec-box">
                    <h3>Copyright</h3>
                    <p class="rdec-muted">Detallar explícitamente si la pista <strong>tiene o no Copyright</strong> o si es libre de derechos.</p>
                </div>
                <div class="rdec-box">
                    <h3>Categorías de estilo</h3>
                    <p class="rdec-muted">Clasificar en: música ambiental, suspenso, música de acción, etc.</p>
                </div>
                <div class="rdec-box">
                    <h3>Origen y crédito</h3>
                    <p class="rdec-muted">Colocar siempre el crédito del autor y especificar de dónde se tomó la pista.</p>
                </div>
            </div>
        </div>
    </section>

    <footer class="rdec-footer">
        <small>Michipiti FILES &copy; Sistema de Gestión de Activos Digitales</small>
    </footer>
</div>
<?php
include_once RESOURCESPACE_BASE_PATH . '/include/footer.php';
