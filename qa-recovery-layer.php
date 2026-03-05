<?php
/*
    Plugin Name: Routters Recovery Tool
    Layer Name: Recovery Layer
*/

class qa_html_theme_layer extends qa_html_theme_base {

    // 1. INYECTAR VERSIÓN EN EL CSS DE SNOWFLAT
    public function head_css()
    {
        // Traemos la versión (ej: 1.3) que pusiste en el panel del plugin
        $cache_ver = qa_opt('routters_cache_version');
        if (empty($cache_ver)) { $cache_ver = '1.0'; }

        if (isset($this->content['css_src']) && is_array($this->content['css_src'])) {
            foreach ($this->content['css_src'] as &$css_url) {
                // Le ponemos el ?v=1.3 a todos los archivos de diseño
                $separator = (strpos($css_url, '?') !== false) ? '&' : '?';
                $css_url .= $separator . 'v=' . $cache_ver;
            }
        }

        parent::head_css();
    }

    // 2. INYECTAR VERSIÓN EN LOS SCRIPTS (JS)
    public function head_script()
    {
        $cache_ver = qa_opt('routters_cache_version');
        if (empty($cache_ver)) { $cache_ver = '1.0'; }

        // Si SnowFlat intenta cargar su core JS, le añadimos la versión
        if (isset($this->content['script'])) {
            foreach ($this->content['script'] as &$script_html) {
                // Buscamos el .js y le inyectamos la versión
                if (strpos($script_html, '.js') !== false && strpos($script_html, 'v=') === false) {
                    $script_html = str_replace('.js', '.js?v=' . $cache_ver, $script_html);
                }
            }
        }

        parent::head_script();
    }
}
