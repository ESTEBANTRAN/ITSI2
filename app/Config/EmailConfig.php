<?php

/**
 * Configuración de Email para el Sistema de Bienestar Estudiantil
 * 
 * INSTRUCCIONES PARA CONFIGURAR EL EMAIL:
 * 
 * 1. Para Gmail:
 *    - SMTPHost: 'smtp.gmail.com'
 *    - SMTPPort: 587
 *    - SMTPCrypto: 'tls'
 *    - SMTPUser: 'tu-email@gmail.com'
 *    - SMTPPass: 'tu-contraseña-de-aplicación' (NO tu contraseña normal)
 * 
 * 2. Para Outlook/Hotmail:
 *    - SMTPHost: 'smtp-mail.outlook.com'
 *    - SMTPPort: 587
 *    - SMTPCrypto: 'tls'
 *    - SMTPUser: 'tu-email@outlook.com'
 *    - SMTPPass: 'tu-contraseña'
 * 
 * 3. Para Yahoo:
 *    - SMTPHost: 'smtp.mail.yahoo.com'
 *    - SMTPPort: 587
 *    - SMTPCrypto: 'tls'
 *    - SMTPUser: 'tu-email@yahoo.com'
 *    - SMTPPass: 'tu-contraseña-de-aplicación'
 * 
 * NOTA: Para Gmail, necesitas generar una "Contraseña de aplicación":
 * 1. Ve a tu cuenta de Google
 * 2. Seguridad > Verificación en dos pasos > Contraseñas de aplicación
 * 3. Genera una nueva contraseña para "Correo"
 * 4. Usa esa contraseña en SMTPPass
 */

return [
    'smtp_host' => 'smtp.gmail.com',
    'smtp_port' => 587,
    'smtp_crypto' => 'tls',
    'smtp_user' => 'tu-email@gmail.com',
    'smtp_pass' => 'tu-contraseña-de-aplicación',
    'from_email' => 'noreply@bienestar.edu',
    'from_name' => 'Sistema de Bienestar Estudiantil'
];
