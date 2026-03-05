<?php
/*
    Plugin Name: Routters Recovery Tool
    Layer Name: Recovery Layer
    Description: Inyecta automáticamente la versión de caché en CSS y JS para evitar archivos obsoletos.
*/

class qa_html_theme_layer extends qa_html_theme_base {

    // 1. INYECTAR VERSIÓN EN EL CSS
    public function head_css() {
        // Usamos el nombre exacto de la base de datos: routters_css_version
        $cache_ver = qa_opt('routters_css_version') ?: '1.0';

        if (isset($this->content['css_src'])) {
            foreach ($this->content['css_src'] as &$url) {
                // Añade ?v=X.X o &v=X.X dependiendo de si ya existen parámetros
                $separator = (strpos($url, '?') !== false) ? '&' : '?';
                $url .= $separator . 'v=' . $cache_ver;
            }
        }
        parent::head_css();
    }

    // 2. INYECTAR VERSIÓN EN LOS SCRIPTS (JS)
    public function head_script() {
        $cache_ver = qa_opt('routters_css_version') ?: '1.0';

        if (isset($this->content['script'])) {
            foreach ($this->content['script'] as &$html) {
                // Esta lógica busca etiquetas <script src="..."> y les pega la versión
                // Cubre casos con comillas dobles y casos donde ya hay otros parámetros
                $html = preg_replace('/\.js\?/', '.js?v=' . $cache_ver . '&', $html);
                $html = preg_replace('/\.js"/', '.js?v=' . $cache_ver . '"', $html);
            }
        }
        parent::head_script();
    }
}
