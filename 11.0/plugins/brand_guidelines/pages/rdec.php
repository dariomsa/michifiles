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
.michi-guide {
    max-width: 1000px;
    margin: 40px auto 48px;
    color: #334155;
    background: #f8fafc;
}
.michi-header {
    background: #1e293b;
    border-bottom: 3px solid #475569;
    border-radius: 8px;
    color: #fff;
    padding: 28px;
    margin-bottom: 24px;
    box-shadow: 0 1px 3px rgba(0,0,0,.12);
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 16px;
}
.michi-header h1 {
    color: #fff;
    font-size: 28px;
    margin: 0 0 6px;
}
.michi-header p {
    color: #e2e8f0;
    margin: 0;
}
.michi-version {
    background: #64748b;
    color: #fff;
    border-radius: 6px;
    font-family: monospace;
    font-size: 13px;
    padding: 9px 14px;
    white-space: nowrap;
}
.michi-tabs {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 8px;
    margin-bottom: 24px;
}
.michi-tab {
    background: #fff;
    border: 1px solid #cbd5e1;
    border-radius: 6px;
    color: #475569;
    cursor: pointer;
    font-weight: 700;
    padding: 13px 16px;
    text-align: center;
}
.michi-tab:hover {
    background: #f1f5f9;
    color: #0f172a;
}
.michi-tab.active {
    background: #334155;
    border-color: #334155;
    color: #fff;
}
.michi-pane {
    display: none;
}
.michi-pane.active {
    display: block;
}
.michi-alert {
    background: #fef2f2;
    border: 1px solid #fecaca;
    border-radius: 8px;
    color: #991b1b;
    display: flex;
    gap: 16px;
    margin-bottom: 24px;
    padding: 18px;
}
.michi-alert-icon {
    font-size: 30px;
    font-weight: 900;
    line-height: 1;
}
.michi-alert h2 {
    color: #991b1b;
    font-size: 17px;
    margin: 0 0 7px;
}
.michi-alert p {
    margin: 0 0 10px;
}
.michi-card {
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    box-shadow: 0 1px 3px rgba(0,0,0,.05);
    margin-bottom: 24px;
    overflow: hidden;
}
.michi-card-header {
    background: #f1f5f9;
    border-bottom: 1px solid #e2e8f0;
    color: #1e293b;
    font-weight: 800;
    padding: 14px 18px;
}
.michi-card-header-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 12px;
}
.michi-card-body {
    padding: 20px;
}
.michi-table-wrap {
    overflow-x: auto;
}
.michi-table {
    border-collapse: collapse;
    font-size: 13px;
    width: 100%;
}
.michi-table th,
.michi-table td {
    border-bottom: 1px solid #e2e8f0;
    padding: 13px;
    text-align: left;
    vertical-align: top;
}
.michi-table th {
    background: #f8fafc;
}
.michi-grid-2 {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 16px;
}
.michi-grid-3 {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 16px;
}
.michi-box {
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    padding: 16px;
}
.michi-box-accent {
    border-left: 3px solid #1e293b;
}
.michi-box h3 {
    border-bottom: 1px solid #e2e8f0;
    color: #1e293b;
    font-size: 16px;
    margin: 0 0 11px;
    padding-bottom: 9px;
}
.michi-small {
    font-size: 13px;
}
.michi-muted {
    color: #64748b;
}
.michi-badges {
    display: flex;
    flex-wrap: wrap;
    gap: 5px;
}
.michi-badge {
    background: #f1f5f9;
    border: 1px solid #cbd5e1;
    border-radius: 999px;
    color: #475569;
    display: inline-block;
    font-size: 12px;
    font-weight: 700;
    padding: 5px 9px;
}
.michi-badge-dark {
    background: #1e293b;
    border-color: #1e293b;
    color: #fff;
}
.michi-badge-secondary {
    background: #64748b;
    border-color: #64748b;
    color: #fff;
}
.michi-badge-danger {
    background: #dc2626;
    border-color: #dc2626;
    color: #fff;
}
.michi-badge-outline-danger {
    background: #fff;
    border-color: #dc2626;
    color: #dc2626;
}
.michi-badge-key {
    background: #e2e8f0;
    border: 1px solid #94a3b8;
    border-radius: 999px;
    color: #0f172a;
    font-size: 12px;
    font-weight: 800;
    padding: 5px 10px;
}
.michi-list {
    list-style: none;
    margin: 0;
    padding: 0;
}
.michi-list li {
    padding: 8px 0;
}
.michi-footer {
    border-top: 1px solid #e2e8f0;
    color: #64748b;
    font-size: 13px;
    margin-top: 24px;
    padding: 18px 0;
    text-align: center;
}
@media (max-width: 760px) {
    .michi-header,
    .michi-alert,
    .michi-card-header-row {
        display: block;
    }
    .michi-version,
    .michi-badge-key {
        display: inline-block;
        margin-top: 10px;
    }
    .michi-tabs,
    .michi-grid-2,
    .michi-grid-3 {
        grid-template-columns: 1fr;
    }
}
</style>

<div class="michi-guide">
    <header class="michi-header">
        <div>
            <h1>Michipiti FILES</h1>
            <p>Sistema de Gestión de Activos Digitales y Normativa Editorial</p>
        </div>
        <span class="michi-version">Manual Web v2.1</span>
    </header>

    <nav class="michi-tabs" aria-label="Secciones del manual">
        <button class="michi-tab active" type="button" data-pane="instruccion">Instrucción</button>
        <button class="michi-tab" type="button" data-pane="taxonomia">Taxonomía</button>
        <button class="michi-tab" type="button" data-pane="categorizar">Categorizar</button>
    </nav>

    <div id="michi-pane-instruccion" class="michi-pane active">
        <section class="michi-alert" role="alert">
            <div class="michi-alert-icon" aria-hidden="true">!</div>
            <div>
                <h2>PROHIBICIÓN ESTRICTA DE MATERIAL DE AGENCIAS</h2>
                <p class="michi-small">Queda completamente prohibido subir fotografías o recursos provenientes de agencias de noticias internacionales o locales sin licencia comercial explícita.</p>
                <div class="michi-badges">
                    <span class="michi-badge michi-badge-danger">NO EFE</span>
                    <span class="michi-badge michi-badge-danger">NO AFP</span>
                    <span class="michi-badge michi-badge-danger">NO API</span>
                    <span class="michi-badge michi-badge-outline-danger">Otras Agencias</span>
                </div>
            </div>
        </section>

        <section class="michi-card">
            <div class="michi-card-header">Indicaciones de Fotografía</div>
            <div class="michi-table-wrap">
                <table class="michi-table">
                    <thead>
                        <tr>
                            <th style="width:25%;">Origen de la foto</th>
                            <th style="width:30%;">Requisito</th>
                            <th style="width:45%;">Detalles y Metadatos</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>Imágenes Propias</strong></td>
                            <td><span class="michi-badge michi-badge-dark">Autoría Directa</span></td>
                            <td>Colocar autoría explícita y llenar metadatos en el sistema.</td>
                        </tr>
                        <tr>
                            <td><strong>Imágenes de Cortesía</strong></td>
                            <td><span class="michi-badge michi-badge-secondary">Crédito Obligatorio</span></td>
                            <td>Siempre colocar créditos de la fuente o institución emisor.</td>
                        </tr>
                        <tr>
                            <td><strong>Imágenes de Coberturas</strong></td>
                            <td><span class="michi-badge michi-badge-secondary">Autorización / Cedidas</span></td>
                            <td>Colocar respaldo, créditos y detallar condiciones de uso.<br><em class="michi-muted">Ej. "Uso exclusivo en Instagram por una sola vez".</em></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>

        <div class="michi-grid-2">
            <section class="michi-card">
                <div class="michi-card-header">Videografía</div>
                <div class="michi-card-body michi-small">
                    <p class="michi-muted">Registro de videos con clasificación completa:</p>
                    <ul class="michi-list">
                        <li><strong>Categorías:</strong> <code>Paisajes de Quito</code>, <code>Verano Quito</code>, <code>Incendio Vicentina</code>.</li>
                        <li><strong>Datos SEO:</strong> Fecha de captura, palabras clave y ubicación.</li>
                    </ul>
                </div>
            </section>

            <section class="michi-card">
                <div class="michi-card-header">Diseño e Inteligencia Artificial</div>
                <div class="michi-card-body michi-small">
                    <p><strong>Diseñadores:</strong> Piezas originales del equipo interno.</p>
                    <hr>
                    <p><strong>Fotos / Ilustraciones IA:</strong> Especificar uso destinado, categoría especial "IA" y herramienta/prompt de referencia.</p>
                </div>
            </section>
        </div>

        <section class="michi-card">
            <div class="michi-card-header">Audiovisuales y Pistas de Audio</div>
            <div class="michi-card-body michi-small">
                <p class="michi-muted">Audios musicalizados para video o podcast:</p>
                <div class="michi-grid-3">
                    <div class="michi-box"><strong>Copyright:</strong> Detallar si posee derechos o es libre de copyright.</div>
                    <div class="michi-box"><strong>Estilo / Categoría:</strong> Música Ambiental, Suspenso, Acción, etc.</div>
                    <div class="michi-box"><strong>Origen y Crédito:</strong> Acreditar autor y fuente de descarga.</div>
                </div>
            </div>
        </section>
    </div>

    <div id="michi-pane-taxonomia" class="michi-pane">
        <section class="michi-card">
            <div class="michi-card-header">Configuración de Taxonomía Editorial</div>
            <div class="michi-card-body">
                <p class="michi-small michi-muted">Estructura estandarizada para la clasificación de contenidos en el sistema:</p>
                <div class="michi-grid-3 michi-small">
                    <div class="michi-box">
                        <h3>Sección</h3>
                        <div class="michi-badges">
                            <span class="michi-badge">Política y gobierno</span>
                            <span class="michi-badge">Economía y negocios</span>
                            <span class="michi-badge">Justicia y seguridad</span>
                            <span class="michi-badge">Conflicto guerra y paz</span>
                            <span class="michi-badge">Desastres y emergencias</span>
                        </div>
                    </div>
                    <div class="michi-box">
                        <h3>Tipo Editorial</h3>
                        <div class="michi-badges">
                            <span class="michi-badge">Noticia</span>
                            <span class="michi-badge">Entrevista</span>
                            <span class="michi-badge">Reportaje</span>
                            <span class="michi-badge">Columna</span>
                            <span class="michi-badge">Fotogalería</span>
                            <span class="michi-badge">Video</span>
                            <span class="michi-badge">Documento fuente</span>
                            <span class="michi-badge">Infografía</span>
                            <span class="michi-badge">Audio / podcast</span>
                        </div>
                    </div>
                    <div class="michi-box">
                        <h3>Cobertura</h3>
                        <div class="michi-badges">
                            <span class="michi-badge">Local</span>
                            <span class="michi-badge">Nacional</span>
                            <span class="michi-badge">Internacional</span>
                        </div>
                    </div>
                    <div class="michi-box">
                        <h3>Estado Legal / Derechos</h3>
                        <div class="michi-badges">
                            <span class="michi-badge michi-badge-secondary">Propio</span>
                            <span class="michi-badge michi-badge-danger">Agencia</span>
                            <span class="michi-badge michi-badge-dark">Cedido</span>
                            <span class="michi-badge michi-badge-secondary">Uso Restringido</span>
                            <span class="michi-badge">Expirado</span>
                        </div>
                    </div>
                    <div class="michi-box">
                        <h3>Atribución y Fechas</h3>
                        <ul class="michi-list">
                            <li><strong>Créditos:</strong> Autor / Fotógrafo / Fuente / Crédito.</li>
                            <li><strong>Cronología:</strong> Fecha de publicación, fecha de captura y vencimiento de derechos.</li>
                        </ul>
                    </div>
                    <div class="michi-box">
                        <h3>Temas Editoriales e Indexación SEO</h3>
                        <p><strong>Temas Editoriales:</strong></p>
                        <div class="michi-badges">
                            <span class="michi-badge">Elecciones</span>
                            <span class="michi-badge">Gobierno nacional</span>
                            <span class="michi-badge">Función legislativa</span>
                            <span class="michi-badge">Gobiernos seccionales</span>
                            <span class="michi-badge">Relaciones internacionales</span>
                            <span class="michi-badge">Partidos y movimientos</span>
                            <span class="michi-badge">Protesta social</span>
                            <span class="michi-badge">Educación</span>
                            <span class="michi-badge">Medioambiente</span>
                            <span class="michi-badge">Salud</span>
                            <span class="michi-badge">Ciencia y tecnología</span>
                            <span class="michi-badge">Deportes</span>
                            <span class="michi-badge">Cultura y entretenimiento</span>
                            <span class="michi-badge">Estilo de vida y ocio</span>
                            <span class="michi-badge">Trabajo y empleo</span>
                            <span class="michi-badge">Religión y creencias</span>
                            <span class="michi-badge">Sociedad</span>
                            <span class="michi-badge">Interés humano</span>
                            <span class="michi-badge">Clima y tiempo</span>
                            <span class="michi-badge">Ecuador</span>
                            <span class="michi-badge">Internacional</span>
                        </div>
                        <p>Registro de personas mencionadas, lugares y <strong>Keywords SEO Temas Clave</strong>.</p>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div id="michi-pane-categorizar" class="michi-pane">
        <section class="michi-card">
            <div class="michi-card-header michi-card-header-row">
                <span>2. Catalogar - Formulario de Metadatos Obligatorios</span>
                <span class="michi-badge-key">Requerido SEO</span>
            </div>
            <div class="michi-card-body">
                <p class="michi-small michi-muted">Completa los campos clave para asegurar el correcto procesamiento y posicionamiento SEO:</p>
                <div class="michi-grid-3 michi-small">
                    <div class="michi-box michi-box-accent"><strong>Title</strong><br><span class="michi-muted">Título descriptivo optimizado con la palabra clave principal.</span></div>
                    <div class="michi-box michi-box-accent"><strong>Caption</strong><br><span class="michi-muted">Descripción o leyenda detallada del recurso (Alt Text SEO).</span></div>
                    <div class="michi-box"><strong>Sección editorial:</strong> Categoría principal del activo (ej. <em>Política y gobierno, Economía y negocios</em>).</div>
                    <div class="michi-box"><strong>Tipo editorial:</strong> Formato (ej. <em>Noticia, Infografía, Audio / podcast</em>).</div>
                    <div class="michi-box"><strong>Estado legal / derechos:</strong> Tipo de licencia asignada.</div>
                    <div class="michi-box"><strong>Autor / redactor:</strong> Redactor o creador del contenido.</div>
                    <div class="michi-box"><strong>Fotógrafo / videógrafo:</strong> Autor de la captura visual.</div>
                    <div class="michi-box"><strong>Fuente / agencia:</strong> Entidad proveedora del material.</div>
                    <div class="michi-box"><strong>Fecha de captura / creación:</strong> Fecha exacta de origen.</div>
                    <div class="michi-box"><strong>Personas mencionadas:</strong> Personajes o figuras retratadas.</div>
                    <div class="michi-box"><strong>Lugares:</strong> Ubicación geográfica o espacio físico.</div>
                    <div class="michi-box michi-box-accent"><strong>Temas editoriales</strong><br><span class="michi-muted">Ejes conceptuales asociados (ej. <em>Elecciones, Gobierno nacional, Medioambiente</em>).</span></div>
                    <div class="michi-box michi-box-accent"><strong>Keywords SEO</strong><br><span class="michi-muted">Términos y palabras clave estratégicas para motores de búsqueda y buscadores internos.</span></div>
                </div>
            </div>
        </section>
    </div>

    <footer class="michi-footer">
        Michipiti FILES &copy; Sistema de Gestión de Activos Digitales
    </footer>
</div>

<script>
jQuery(function () {
    jQuery('.michi-tab').on('click', function () {
        const pane = jQuery(this).data('pane');
        jQuery('.michi-tab').removeClass('active');
        jQuery(this).addClass('active');
        jQuery('.michi-pane').removeClass('active');
        jQuery('#michi-pane-' + pane).addClass('active');
    });
});
</script>
<?php
include_once RESOURCESPACE_BASE_PATH . '/include/footer.php';
