# zemoga
Zemoga Test
Drupal 8.

You can find the site DB Backup into the ddbb_backups folder.

Admin Name => devadmin
Admin Password => DevAdmin

The zemoga user form URL => /zemoga-multi-step-form

Custom module name => zemoga_ms_form

El utimo paso de la prueba no lo alcanc a terminar pero mi solución sería :

1) Opción 1.
Agregar un submit en el ultimo paso para resetear el formulario y volver a la pagina en el paso 1, haciendo usode un form Rebuild o simplemente un GoTo.

2) Opción 2.
Agregar una especie de temporizador para que dado un lapso de tiempo en el 3er paso automaticamente redirija con nun GoTo al primer paso al usuario.
