<?php

class qa_recovery_admin {
    public function option_default($name) {
        if ($name == 'routters_master_css') return '';
        if ($name == 'routters_css_version') return time(); // Iniciamos con el tiempo actual
    }

    public function admin_form(&$qa_content) {
        $saved = false;
        
        // Cuando se hace clic en el botón de guardar
        if (qa_clicked('routters_save_button')) {
            qa_opt('routters_master_css', qa_post_text('routters_css_field'));
            
            // ---> AQUÍ ESTÁ LA MAGIA <---
            // Forzamos la versión con el tiempo exacto actual automáticamente (Purga implícita)
            qa_opt('routters_css_version', time());
            
            $saved = true;
        }

        return array(
            'ok' => $saved ? '✅ Configuración guardada y Caché purgada automáticamente a nivel global' : null,
            'fields' => array(
                'version' => array(
                    'label' => 'Versión del Caché (Generada automáticamente al guardar):',
                    'type' => 'text',
                    'value' => qa_opt('routters_css_version'),
                    // Lo hacemos de solo lectura (readonly) porque ahora el sistema lo hace por ti
                    'tags' => 'readonly style="background:#e9ecef; color:#666; cursor:not-allowed;"', 
                ),
                'css' => array(
                    'label' => 'CSS Maestro de Recuperación (Este código siempre se inyectará al final):',
                    'type' => 'textarea',
                    'rows' => 15,
                    'value' => qa_opt('routters_master_css'),
                    'tags' => 'name="routters_css_field" style="font-family:monospace; background:#222; color:#0f0;"',
                ),
            ),
            'buttons' => array(
                array(
                    'label' => 'Guardar y Purgar Caché',
                    'tags' => 'name="routters_save_button" style="background:#007bff; color:white; padding:10px 20px; border:none; border-radius:5px; cursor:pointer;"',
                ),
            ),
        );
    }
}
