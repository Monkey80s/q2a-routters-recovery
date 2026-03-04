<?php

class qa_recovery_admin {
    public function option_default($name) {
        if ($name == 'routters_master_css') return '';
        if ($name == 'routters_css_version') return '1.0';
    }

    public function admin_form(&$qa_content) {
        $saved = false;
        if (qa_clicked('routters_save_button')) {
            qa_opt('routters_master_css', qa_post_text('routters_css_field'));
            qa_opt('routters_css_version', qa_post_text('routters_version_field'));
            $saved = true;
        }

        return array(
            'ok' => $saved ? '✅ Configuración de seguridad guardada y caché reiniciado' : null,
            'fields' => array(
                'version' => array(
                    'label' => 'Versión del Caché (Cambia esto para limpiar el historial de Chrome):',
                    'type' => 'text',
                    'value' => qa_opt('routters_css_version'),
                    'tags' => 'name="routters_version_field"',
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
                    'label' => 'Guardar y Aplicar Cambios',
                    'tags' => 'name="routters_save_button" style="background:#007bff; color:white; padding:10px 20px; border:none; border-radius:5px; cursor:pointer;"',
                ),
            ),
        );
    }
}
