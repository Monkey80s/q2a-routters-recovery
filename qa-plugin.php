<?php
/*
    Plugin Name: Routters Recovery Tool
    Plugin Description: Interfaz para inyectar CSS de seguridad y limpiar caché.
    Plugin Version: 2.0
    Plugin Author: Monkey🐒
*/

if (!defined('QA_VERSION')) {
    header('Location: ../../');
    exit;
}

// Registramos el panel de administración
qa_register_plugin_module('module', 'qa-recovery-admin.php', 'qa_recovery_admin', 'Routters Recovery');

// Registramos la inyección de código
qa_register_plugin_layer('qa-recovery-layer.php', 'Recovery Layer');
