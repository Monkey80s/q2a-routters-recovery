<?php

class qa_html_theme_layer extends qa_html_theme_base {
    public function head_css() {
        $v = qa_opt('routters_css_version');
        
        // 1. Limpiamos caché del CSS del tema automáticamente
        if (isset($this->content['css_src']) && is_array($this->content['css_src'])) {
            foreach ($this->content['css_src'] as &$css_url) {
                if (strpos($css_url, 'qa-styles.css') !== false) {
                    $pure_url = explode('?', $css_url)[0];
                    $css_url = $pure_url . '?v=' . $v;
                }
            }
        }

        parent::head_css();

        // 2. Inyectamos el CSS Maestro que escribiste en el panel
        $master_css = qa_opt('routters_master_css');
        if (!empty($master_css)) {
            $this->output('<style>', $master_css, '</style>');
        }
    }
}
